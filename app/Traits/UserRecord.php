<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait UserRecord
{
    public static function bootUserRecord()
    {
        if (!Auth::user()->hasRole('Администратор')) {
            static::addGlobalScope('user', function (Builder $builder) {
                $builder->where('user_id', Auth::id());
            });
        }
    }
}
