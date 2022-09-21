<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function makeOrder(Request $request)
    {
        $input = $request->all();
        $order = new Order([
            'user_id' => Auth::id(),
            'product_id' => $input['OrderNum'],
            'status' => 'consideration',
            'prize' => Product::find($input['OrderNum'])->prize
        ]);
        $order->save();

        return redirect(url('/cart'));

    }

    public function cancelOrder()
    {
        if (Auth::user()){
            if (isset($_POST['id_order'])){
                if (Auth::id() === Order::find($_POST['id_order'])->user_id) {
                    Order::where('id', $_POST['id_order'])->delete();
                }
            }
        }

        return view('myOrders',['orders' =>  Auth::user()->getMyOrders()->get()]);
    }



    public function myOrders()
    {
        if(Auth::check()){

            return view('myOrders',['orders' =>  Auth::user()->getMyOrders()->get()]);
        }

        return redirect('login');
    }

}

