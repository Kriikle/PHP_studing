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
//About
Route::get('/about', [App\Http\Controllers\HomeController::class, 'index'])->name('about');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', [App\Http\Controllers\ProductsController::class, 'index'])->name('products');
Route::get('/home', [App\Http\Controllers\ProductsController::class, 'index'])->name('products');

//Auth
Auth::routes(['verify' => true]);
//View
Route::get('/products', [App\Http\Controllers\ProductsController::class, 'index'])
    ->name('products');
Route::get('/products/{id}', [App\Http\Controllers\ProductsController::class, 'productById'])
    ->name('product');
//Orders
////ProductCategory/5
///
Route::get('/CategoryProducts/{id}', [App\Http\Controllers\ProductsController::class, 'CategoryProducts'])
    ->name('CategoryProducts');
Route::get('/makeOrder', [App\Http\Controllers\OrderController::class, 'makeOrder'])
    ->name('order_create')
    ->middleware('auth')
    ->middleware('verified');
Route::post('/cancelOrder', [App\Http\Controllers\OrderController::class, 'cancelOrder'])
    ->name('order_cancel')
    ->middleware('auth');
Route::get('/cart', [App\Http\Controllers\OrderController::class, 'myOrders'])
    ->middleware('auth')
    ->name('cart');

//Admin
Route::prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'admin'])
        ->name('admin')
        ->middleware('auth');;
    Route::post('/addAdmin', [App\Http\Controllers\AdminController::class, 'addAdmin'])
        ->name('addAdmin');
    Route::post('/deleteAdmin', [App\Http\Controllers\AdminController::class, 'deleteAdmin'])
        ->name('deleteAdmin');
    Route::post('/updateEmail', [App\Http\Controllers\AdminController::class, 'updateEmail'])
        ->name('admin_email_upd');
    Route::post('/deleteOrder', [App\Http\Controllers\AdminController::class, 'deleteOrder'])
        ->name('admin_cat_del');
    Route::post('/deleteProduct', [App\Http\Controllers\AdminController::class, 'deleteProduct'])
        ->name('admin_product_del');
    Route::post('/deleteCategory', [App\Http\Controllers\AdminController::class, 'deleteCategory'])
        ->name('admin_cat_del');
    Route::post('/updateOrder', [App\Http\Controllers\AdminController::class, 'updateOrder'])
        ->name('admin_ord_upd');//updateProduct
    Route::post('/updateProduct', [App\Http\Controllers\AdminController::class, 'updateProduct'])
        ->name('admin_product_update');
    Route::post('/createProduct', [App\Http\Controllers\AdminController::class, 'addProduct'])
        ->name('admin_product_add');
    Route::get('/updateCategory', [App\Http\Controllers\AdminController::class, 'updateCategory'])
        ->name('admin_Category_update');
    Route::get('/createCategory', [App\Http\Controllers\AdminController::class, 'addCategory'])
        ->name('admin_Category_add');
    Route::get('/addRelationProductCategory', [App\Http\Controllers\AdminController::class, 'addProductCategory'])
        ->name('admin_rel_Category_Product');
});







