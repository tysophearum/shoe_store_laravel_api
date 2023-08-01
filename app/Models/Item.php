<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'size_id', 'order_id', 'quantity'];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function carts(){
        return $this->hasOne(Cart::class);
    }
}
