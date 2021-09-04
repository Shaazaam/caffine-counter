<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Reflects;

class BaseModel extends Model
{
    use Reflects;

    /**
     * @param $thing
     * @return static|null
     */
    public static function cast($thing)
    {
        return $thing instanceof self ? $thing : null;
    }

    public static function getTableName(): string
    {
        return (new static)->getTable();
    }
}
