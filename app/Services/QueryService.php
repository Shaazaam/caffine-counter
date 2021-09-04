<?php

namespace App\Services;

use Closure;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Expression;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

use App\Common\Formatter;

class QueryService
{
    private static function formatAssociativeFilters($subValue, string $expression, array $data): Builder
    {
        [$query, $field] = $data;
        if (is_string($subValue)) {
            switch ($expression) {
                case 'raw':
                    return $query->whereRaw($subValue);
                case 'nullOrInRaw':
                    return $query->where(function ($query) use ($subValue, $expression, $field) {
                        $query->whereNull($field)->orWhereRaw($subValue);
                    });
                default:
                    //throw maybe?
                    break;
            }
        }
        if (is_array($subValue)) {
            switch ($expression) {
                case 'nullOrIn':
                    return $query->where(function ($query) use ($subValue, $expression, $field) {
                        $query->whereNull($field)->orWhereIn($field, $subValue);
                    });
                case 'between':
                    return $query->whereBetween($field, $subValue);
                default:
                    array_walk($subValue, Closure::fromCallable('self::formatAssociativeFilters'), [$query, $field]);
            }
        }
        return $query->where($field, $expression, $subValue);
    }

    public static function formatParameters(string $parameters): array
    {
        $parameters = Formatter::jsonDecode($parameters);
        /* Also implicitly includes:
            page
            perPage
            columns
        */
        return array_merge($parameters, [
            'sort'    => [$parameters['sortField'], $parameters['sortDirection']],
            'filter'  => function ($query) use (&$parameters) {
                array_walk($parameters['filters'], function ($value, $field, $query) {
                    if (is_array($value)) {
                        if (!Arr::isAssoc($value)) {
                            $query->whereIn($field, $value);
                        } elseif (Arr::isAssoc($value)) {
                            array_walk($value, Closure::fromCallable('self::formatAssociativeFilters'), [$query, $field]);
                        }
                    } else {
                        $query->where($field, $value);
                    }
                }, $query);
            },
        ]);
    }

    public static function parameterize(Builder $query, array $params): Builder
    {
        array_walk($params, function ($value, $param, $query) {
            switch ($param) {
                case 'limit':
                    $query->limit($value);
                    break;
                case 'columns':
                    $query->where(function ($query) use ($value) {
                        $aggregates = [];
                        if (($query->getModel())::hasMethodStatic('getQueryAggregates')) {
                            $aggregates = ($query->getModel())::getQueryAggregates();
                        }
                        array_walk($value, function ($term, $column, $data) {
                            if (Formatter::isPhoneNumber($term)) {
                                $term = Formatter::formatPhoneNumberIn($term);
                            }

                            [$query, $aggregates] = $data;

                            $query->orWhereRaw(array_key_exists($column, $aggregates)
                                ? '(' . $aggregates[$column] . ') LIKE ?'
                                : $query->getModel()->getTable() . ' . ' . $column . ' LIKE ?'
                            , ['%' . $term . '%']);

                        }, [$query, $aggregates]);
                    });
                    break;
                case 'filter':
                    $query->where($value);
                    break;
                case 'sort':
                    //Future iteration will be able to accept an array of orderBy
                    /*array_walk($value, function ($direction, $column, $query) {
                        $query->orderBy($column, $direction);
                    }, $query);*/
                    //Expected to have array of two values, column and direction
                    $query->orderBy(...$value);
                    break;
                case 'group':
                    $query->groupBy($value);
                    break;
                case 'scope':
                    // like active()
                    $query->tap($value);
                    break;
                case 'offset':
                    $query->offset($value);
                    break;
            }
        }, $query);

        return $query;
    }

    public static function join(Builder $query, array $joins): Builder
    {
        array_walk($joins, function ($join, $index, $query) {
            $query->leftJoin(...$join);
        }, $query);

        return $query;
    }

    private static function formatSelectAggregates(array $aggregates): array
    {
        return array_map(function ($aggregate, $alias) {
            return DB::raw($aggregate . ' AS ' . $alias);
        }, $aggregates, array_keys($aggregates));
    }

    public static function selectAggregates(Builder $query, array $initial = [], array $aggregates = []): Builder
    {
        // If no overload was given, try to get from model
        if (empty($aggregates)) {
            $aggregates = ($query->getModel())::hasMethodStatic('getQueryAggregates')
                ? ($query->getModel())::getQueryAggregates()
                : $aggregates
            ;
        }

        return $query->select(array_merge($initial, self::formatSelectAggregates($aggregates)));
    }

    public static function getPaginatedResults(Builder $query, array $params): LengthAwarePaginator
    {
        LengthAwarePaginator::currentPageResolver(function () use ($params) {
            return $params['page'];
        });

        $results = $query->paginate($params['perPage']);

        if ($results->lastPage() < $params['page']) {
            $results = self::getPaginatedResults($query, array_merge($params, ['page' => $results->lastPage()]));
        }

        return $results;
    }

    public static function createNewRelated($model, array $input, string $relation): void
    {
        foreach (array_udiff(
            $input[$relation],
            $model->{$relation}->all(),
            function ($inputRelation, $modelRelation) {
                return $inputRelation['id'] <=> $modelRelation['id'];
            }
        ) as $add) {
            $model->{$relation}()->create($add);
        }
    }

    public static function updateExistingRelated($model, array $input, string $relation): void
    {
        foreach (array_uintersect(
            $input[$relation],
            $model->{$relation}->all(),
            function ($inputRelation, $modelRelation) {
                return $inputRelation['id'] <=> $modelRelation['id'];
            }
        ) as $update) {
            $model->{$relation}()->where('id', $update['id'])->first()->update($update);
        }
    }

    public static function deleteMissingRelated($model, array $input, string $relation): void
    {
        foreach (array_udiff(
            $model->{$relation}->all(),
            $input[$relation],
            function ($modelRelation, $inputRelation) {
                return $modelRelation['id'] <=> $inputRelation['id'];
            }
        ) as $remove) {
            $model->{$relation}()->where('id', $remove['id'])->first()->delete();
        }
    }

    public static function syncModelHasMany($model, array $input, string $relation): void
    {
        self::createNewRelated($model, $input, $relation);
        self::updateExistingRelated($model, $input, $relation);
        self::deleteMissingRelated($model, $input, $relation);
    }
}
