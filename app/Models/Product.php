<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'category_id', 'price', 'image_id', 'promotion_id'];

    public function sizes() {
        return $this->belongsToMany(Size::class, 'product_size', 'product_id', 'size_id');
    }
    public function images(): HasMany {
        return $this->hasMany(Image::class);
    }
    public function items() {
        return $this->hasMany(Item::class);
    }
}
