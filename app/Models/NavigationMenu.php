<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavigationMenu extends Model
{
    protected $fillable = [
        'title',
        'route_name',
        'url',
        'status',
        'order',
    ];
}
