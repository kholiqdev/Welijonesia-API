<?php

namespace App\Http\Traits;

use Ramsey\Uuid\Uuid;

trait UsesUuid
{
    /**
     * Useful for auto create id with uuid when first call create function.
     *
     * @return void
     */
    protected static function bootUsesUuid()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = Uuid::uuid1()->toString();
            }
        });
    }

    /**
     * Set false auto increment.
     *
     * @return boolean
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Initialize Primary Key from another type to char or varchar.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }
}
