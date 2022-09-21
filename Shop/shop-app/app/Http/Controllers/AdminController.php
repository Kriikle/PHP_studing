<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function addProductCategory(Request $request)
    {
        if (User::isAdmin(Auth::id())) {
            $product = Product::find($_GET['product_id']);
            $category = Category::find($_GET['category_id']);
            $product->categories()->attach($category);
        }

        return redirect(url('/admin'));
    }

    public function updateEmail(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'email' => 'required|email|string|max:255'
            ]);
            $user = Auth::user();
            $user->email = $request['email'];
            $user->email_verified_at = NULL;
            $user->save();
        }

        return redirect(url('/admin'));
    }

    public function deleteAdmin()
    {
        if (User::isAdmin(Auth::id())){
            if (isset($_POST['admin_id'])) {
                Admin::where('id', $_POST['admin_id'])->delete();
            }
        }

        return redirect(url('/admin'));
    }

    public function addAdmin()
    {
        var_dump($_POST['admin_id']);
        if (User::isAdmin(Auth::id())){
            if (isset($_POST['admin_id'])) {
                if ($_POST['admin_id'] !== ""){
                    $Admin = new Admin();
                    $Admin->user_id = $_POST['admin_id'];
                    $Admin->save();
                }
            }
        }

        return redirect(url('/admin'));
    }


    public function deleteOrder(Request $request)
    {
        if (User::isAdmin(Auth::id())){
            if (isset($_POST['id_order'])) {
                Order::where('id', $_POST['id_order'])->delete();
            }
        }

        return redirect(url('/admin'));
    }

    public function deleteCategory(Request $request)
    {
        if (User::isAdmin(Auth::id())){
            if (isset($_POST['id_category'])) {
                Category::where('id', $_POST['id_category'])->delete();
            }
        }

        return redirect(url('/admin'));
    }

    public function deleteProduct(Request $request)
    {
        if (User::isAdmin(Auth::id())){
            if (isset($_POST['id_product'])){
                Product::where('id', $_POST['id_product'])->delete();
            }
        }

        return redirect(url('/admin'));
    }

    public function updateOrder()
    {
        if (User::isAdmin(Auth::id())){
            if (isset($_POST['id_order']) && isset($_POST['status'])) {
                $order = Order::find($_POST['id_order']);
                $order->status = $_POST['status'];
                $order->save();
            }
        }

        return redirect(url('/admin'));
    }


    public function updateProduct(Request $request)
    {
        if (User::isAdmin(Auth::id())){
            if (isset($_POST['id_product'])) {
                $product = Product::find($_POST['id_product']);
                $product->name = $_POST['name'];
                $product->prize = $_POST['prize'];
                $product->description = $_POST['description'];
                if($request->hasFile('img')) {
                    $request->validate([
                        'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                    ]);
                    $file = $request->file('img');
                    $name = $_POST['id_product'] . '_productLogo.png';
                    $file->move(public_path() . '/storage/images/',$name);
                    $product->img = $name;
                }
                $product->save();
            }
        }

        return redirect(url('/admin'));
    }

    public function addProduct(Request $request)
    {
        if (User::isAdmin(Auth::id())) {
            $product = new Product();
            $product->name = $_POST['name'];
            $product->prize = $_POST['prize'];
            $product->description = $_POST['description'];
            $request->validate([
                'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            if($request->hasFile('img')) {
                $file = $request->file('img');
                $name = Product::find(\DB::table('products')->max('id'))->id + 1 . '_productLogo.png';
                $file->move(public_path() . '/storage/images/',$name);
                $product->img = $name;
            } else{

               return redirect(url('/admin'));
            }

            $product->save();
        }

        return redirect(url('/admin'));
    }

    public function updateCategory()
    {
        if (User::isAdmin(Auth::id())){
            if (isset($_GET['id_category'])) {
                $category = Category::find($_GET['id_category']);
                $category->name = $_GET['name'];
                $category->description = $_GET['description'];
                $category->save();
            }
        }

        return redirect(url('/admin'));
    }

    public function addCategory()
    {
        if (User::isAdmin(Auth::id())) {
            $category = new Category();
            $category->name = $_GET['name'];
            $category->description = $_GET['description'];
            $category->save();
        }

        return redirect(url('/admin'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin()
    {

        return view('admin',[
            'products' => Product::all(),
            'orders' => Order::all(),
            'categories' => Category::all()
        ]);
    }
}
