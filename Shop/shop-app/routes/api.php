<?php

use App\Http\Resources\CategoryResourse;
use App\Http\Resources\ProductResourse;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('products', function () {
    return ProductResourse::collection(Product::all());
});
Route::get('products/{id}', function ($id) {
    return new ProductResourse(Product::findOrFail($id));
});
Route::get('Category', function () {
    return CategoryResourse::collection(Category::all());
});
Route::get('Category/{id}', function ($id) {
    return new CategoryResourse(Category::findOrFail($id));
});
