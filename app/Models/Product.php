<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CartItem; 

class Product extends Model
{
    protected $fillable=[
        'category',
        'name',
        'description',
        'price',
        'image',
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
