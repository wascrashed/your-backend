<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'language',
        'publication_type',
        'image',
        'title',
        'description',
        'heading',
        'tags',
        'site_location',
        'link',
        'content',
        'author_comment',
        'user_id'
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function heading () {
        return $this->belongsTo(Heading::class);
    }

    public function tags () {
        return $this->belongsTo(Tag::class);
    }

    public function comment () {
        return $this->hasMany(Commment::class);
    }

}
