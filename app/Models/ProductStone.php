<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStone extends Model
{
    protected $fillable = [
        'product_id',
        'type',
        'shape',
        'total_count',
        'total_weight',
        'clarity',
        'color',
        'setting_type',
        'stone_price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
