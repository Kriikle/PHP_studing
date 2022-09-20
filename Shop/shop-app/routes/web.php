<?php

use App\Http\Resources\CategoryResourse;
use App\Http\Resources\ProductResourse;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [App\Http\Controllers\ProductsController::class, 'index'])->name('products');
Route::get('/home', [App\Http\Controllers\ProductsController::class, 'index'])->name('products');

//Auth
Auth::routes();
//View
Route::get('/products', [App\Http\Controllers\ProductsController::class, 'index'])
    ->name('products');
Route::get('/products/{id}', [App\Http\Controllers\ProductsController::class, 'productById'])
    ->name('products');

Route::get('/makeOrder', [App\Http\Controllers\OrderController::class, 'makeOrder'])
    ->name('order');
Route::get('/cart', [App\Http\Controllers\OrderController::class, 'myOrders'])
    ->name('order');

Route::get('/about', [App\Http\Controllers\HomeController::class, 'index'])->name('about');





