<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'image', 'status', 'published_at'];

    protected $casts = [
        'status' => 'boolean',
        'published_at' => 'datetime',
    ];
}
