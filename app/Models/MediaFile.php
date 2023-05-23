<?php

namespace App\Models;

use App\Traits\FilterableTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    use HasFactory, FilterableTrait;

    protected $fillable = [
        'name',
        'description',
        'file',
        'file_link',
        'is_link',
        'file_type'
    ];

    public function file(): Attribute
    {
        return Attribute::make(
            get: fn($value) => env('APP_URL', 'http://localhost:8000/') . 'storage/' . $value
        );
    }
}
