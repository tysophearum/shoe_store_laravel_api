<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'promo_code_id', 'price'];

    public function items(): HasMany {
        return $this->hasMany(Item::class);
    }
    public function paymentMethod(): HasOne{
        return $this->hasOne(PaymentMethod::class);
    }
    public function shippingInformation(): HasOne{
        return $this->hasOne(ShippingInformation::class);
    }
    public function shippingMethod(): HasOne{
        return $this->hasOne(ShippingMethod::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
