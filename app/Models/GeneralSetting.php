<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $fillable = [
        'site_name',
        'primary_color',
        'secondary_color',
        'header_color',
        'font_family',
        'logo_path',
    ];
}
