<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Builder,
    Collection as EloquentCollection
};
use Illuminate\Support\Facades\{
    Auth,
    DB
};

use App\Common\{
    Formatter,
    Moment
};

use App\Services\QueryService;

class Drink extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
        'serving_size',
        'caffeine_content',
    ];

    const SAFE_LIMIT = 500;
    const LETHAL_LIMIT = 10000;

    public static function getQueryAggregates(): array
    {
        return [];
    }

    public static function forTable(array $params): Builder
    {
        $query = QueryService::join(self::query(), []);

        $query = QueryService::parameterize($query, $params);

        return $query->orderBy('name');
    }

    public static function getAll(array $params = []): EloquentCollection
    {
        return QueryService::selectAggregates(self::forTable($params), [self::getTableName() . '.*'])->get();
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function (self $model) {
        });

        self::created(function (self $model) {
        });

        self::updated(function (self $model) {
        });

        self::deleting(function (self $model) {
        });
    }
}
