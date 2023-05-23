<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public const USER_INACTIVE = 1;
    public const USER_ACTIVE = 2;
    protected $fillable = [
        'name',
        'color',
        'status_type_id'
    ];
}
