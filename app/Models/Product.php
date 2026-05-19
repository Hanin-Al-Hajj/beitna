<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Orderitem;

class Product extends Model
{
    protected $fillable=[
       'image',
       'category',
       'name',
       'description',
       'price',

    ];

    public function orderItems(): HasMany
    {
    return $this->hasMany(Orderitem::class, 'product_id');
    }

}
