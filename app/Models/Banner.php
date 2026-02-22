<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['title', 'desc', 'image', 'status', 'type', 'is_product_banner', 'is_prod_vertical'];

    protected $casts = [
        'status' => 'boolean',
        'is_product_banner' => 'boolean',
        'is_prod_vertical' => 'boolean',
    ];

    public function imageUrl()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
