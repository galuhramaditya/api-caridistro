<?php

namespace App\Traits;

use Ramsey\Uuid\Uuid as Generate;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

trait Uuid
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            try {
                $model->id = Generate::uuid4()->toString();
            } catch (UnsatisfiedDependencyException $e) {
                abort(500, $e->getMessage());
            }
        });
    }
}