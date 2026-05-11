<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Orderitem;  
use App\Models\User;  

class Order extends Model
{

protected $fillable = [
'user_id',   
'fname',
'lname',
'email',
'phone',
'address',
'total_price',
];
public function Orderitems():HasMany 
{
    return $this->hasMany(Orderitem::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

}
