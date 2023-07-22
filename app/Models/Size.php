<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $fillable = ['size'];
    public $timestamps = false;
    protected $hidden = ['pivot'];
    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
