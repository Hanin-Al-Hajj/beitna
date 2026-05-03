<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\CartItem;

class Product extends Model
{
    protected $fillable=[
       'image',
       'category',
       'name',
       'description',
       'price',

    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
  public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

}
