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
        'category_id',
        'subcategory_id',
        'description',
        'price',
        'image',
        'making_charges',
        'tax_rate',
        'metal_type',
        'metal_purity',
        'gender',
        'occasion',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function stones()
    {
        return $this->hasMany(ProductStone::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}


