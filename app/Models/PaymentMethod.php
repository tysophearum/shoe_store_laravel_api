<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'card_number', 'name_on_card', 'expire_date', 'cvv', 'order_id'];
}
