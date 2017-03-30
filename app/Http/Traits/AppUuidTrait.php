<?php

namespace App\Http\Traits;

use Webpatser\Uuid\Uuid;

/*
 */
trait AppUuidTrait
{
    public function getIncrementing()
    {
        return false;
    }

    public static function bootAppUuidTrait()
    {
        static::creating(function ($model) {
            $model->incrementing = false;
            $uuidVersion = (!empty($model->uuidVersion) ? $model->uuidVersion : 4);   // defaults to 4
            $uuid = Uuid::generate($uuidVersion);
            $model->attributes[$model->uuidKey] = $uuid->string;
        }, 0);
    }
}
