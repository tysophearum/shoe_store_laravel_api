<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'size_id', 'order_id', 'quantity'];

    public function products() {
        return $this->belongsTo(Product::class);
    }
}
