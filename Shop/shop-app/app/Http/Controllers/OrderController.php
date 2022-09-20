<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function makeOrder(Request $request)
    {
        $input = $request->all();
        $order = new Order(['user_id' => Auth::id(),'product_id' => $input['OrderNum']]);
        $order->save();
        return redirect(url('/products'));

    }

    public function myOrders()
    {

        return view('myOrders',['orders' => ""]);
    }

}

