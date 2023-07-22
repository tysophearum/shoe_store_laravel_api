<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingInformation extends Model
{
    use HasFactory;

    protected $fillable = ['firstName', 'lastName', 'user_id', 'company', 'address', 'apt', 'country', 'state', 'zip'];
}
