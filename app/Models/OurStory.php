<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurStory extends Model
{
    protected $fillable = ['type', 'title', 'description', 'image', 'status'];
    protected $casts = [
        'status' => 'boolean',
    ];
}
