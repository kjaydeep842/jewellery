<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
