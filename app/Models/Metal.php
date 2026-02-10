<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
