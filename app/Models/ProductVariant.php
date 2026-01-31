<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'size',
        'color',
        'material_purity',
        'diamond_quality',
        'sku',
        'price',
        'stock_quantity'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
