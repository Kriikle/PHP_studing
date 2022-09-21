<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function CategoryProducts($id)
    {
        $category = Category::find($id);
        return view('products',[
            'products' => $category->products,
            'categories' => Category::all()
        ]);
    }

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

        return view('products',[
            'products' => Product::all(),
            'categories' => Category::all()
        ]);
    }


}
