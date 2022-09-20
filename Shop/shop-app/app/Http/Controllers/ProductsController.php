<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function productById($id)
    {
        $product = Product::findOrFail($id);
        return view('product',[
            'product' => $product,
            'categories' => $product->categories()->get()]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('products',['products' => Product::all()]);
    }


}
