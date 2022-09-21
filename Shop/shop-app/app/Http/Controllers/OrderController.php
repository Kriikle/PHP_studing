<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        //$order->save();
        foreach (Admin::all() as $user){
            try {
                $user = User::find($user->user_id);
                Mail::send('mailOrderPush', ['order' => $order], function ($m) use ($user) {
                    //$m->from('Shop@app.com', 'Shop');
                    $m->to($user->email, $user->name)->subject('Your Reminder!');
                });
            } catch (Exception $e) {
                //var_dump($e->getMessage());
            }
        }

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

