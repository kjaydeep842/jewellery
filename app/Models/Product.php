<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'category_id',
        'subcategory_id',
        'brand_id', // New
        'unit_id',  // New
        'color_id', // New
        'description',
        'short_description', // New
        'price',            // Base Price
        'discount_price',
        'stock',            // Global stock
        'status',
        'image',
        'video_url', // New
        'is_featured', // New
        'is_new', // New
        'is_bestseller', // New
        'meta_title', // New
        'meta_description', // New
        'meta_keywords', // New

        // Detailed Info
        'material',
        'weight',           // Gross Weight
        'metal_type',       // e.g. Gold
        'metal_color_id',   // FK
        'metal_purity',
        'gender',
        'occasion',
        'making_charges',
        'tax_rate',

        // Diamond Details
        'diamond_type',
        'diamond_shape_id', // FK
        'diamond_color',
        'diamond_clarity',
        'diamond_carat',
        'diamond_count',
        'diamond_weight',   // Total Diamond Weight
        'diamond_price',

        // Price Breakup
        'price_gold_value',
        'price_diamond_value',
        // 'price_making_charges', // Use 'making_charges'
        'price_gst',
        'price_subtotal',
        'price_grand_total',
        'selling_price',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Variants (Size + Stock)
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function stones()
    {
        return $this->hasMany(ProductStone::class);
    }

    // Masters Relationships
    public function metalColor()
    {
        return $this->belongsTo(MetalColor::class, 'metal_color_id');
    }

    public function diamondShape()
    {
        return $this->belongsTo(Shape::class, 'diamond_shape_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
