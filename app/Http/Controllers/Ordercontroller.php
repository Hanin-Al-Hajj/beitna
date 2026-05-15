<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Orderitem;
use Illuminate\Support\Facades\Auth;



class Ordercontroller extends Controller
{
public function store(Request $request){
 $request->validate([
'fname' =>'required|string|max:255',
'lname' =>'required|string|max:255',
'email' =>'required|email',
'phone' =>'required|string|max:20',
'address'=>'required|string|max:255',
'total_price'=>'required|numeric|min:0',
'items'       => 'required|array|min:1',
'items.*.product_id' => 'required|integer',
'items.*.name'       => 'required|string|max:255',
'items.*.category'   => 'required|string|max:255',
'items.*.price'      => 'required|numeric|min:0',
'items.*.qty'        => 'required|integer|min:1',
 ]);

    $order = Order::create([
        'user_id'=>Auth::id(),
        'fname'=>$request->fname,
        'lname'=>$request->lname,
        'email'=>$request->email,
        'phone'=>$request->phone,
        'address'=>$request->address,
        'total_price'=>$request->total_price,
    ]);
 foreach ($request->items as $item) {
            Orderitem::create([
                'order_id'   => $order->id,
                'product_id' => $item['product_id'],
                'name'       => $item['name'],
                'category'   => $item['category'],
                'price'      => $item['price'],
                'qty'        => $item['qty'],
            ]);
        }

return redirect()->route('cart');
}

}


