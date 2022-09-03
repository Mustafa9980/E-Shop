<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[App\Http\Controllers\Frontend\FrontendController::class, 'index']);
Route::get('category',[App\Http\Controllers\Frontend\FrontendController::class,'category']);
Route::get('view-category/{slug}',[App\Http\Controllers\Frontend\FrontendController::class,'viewcategory']);
Route::get('category/{cate_slug}/{pro_slug}',[App\Http\Controllers\Frontend\FrontendController::class,'viewproducts']);
Auth::routes();

Route::post('add-to-cart',[App\Http\Controllers\Frontend\CartController::class,'addproduct']);
Route::post('delete-cart-item',[App\Http\Controllers\Frontend\CartController::class,'delete']);
Route::post('update-cart',[App\Http\Controllers\Frontend\CartController::class,'updatecart']);

Route::middleware(['auth'])->group(function () {
Route::get('cart',[App\Http\Controllers\Frontend\CartController::class,'viewcart']);
Route::get('checkout',[App\Http\Controllers\Frontend\CheckoutController::class,'index']);
Route::post('place-order',[App\Http\Controllers\Frontend\CheckoutController::class,'placeorder']);
Route::get('my-order',[App\Http\Controllers\Frontend\UserController::class,'index']);
Route::get('view-order/{id}',[App\Http\Controllers\Frontend\UserController::class,'view']);


    
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// كانت في التحديث القديم
// Route::group(['middleware' => ['auth','isAdmin']], function () {

//     Route::get('/dashboard', function () {
//        return view('admin.dashboard');
//     });
 
//  });
//  التحديث الجديد
 Route::middleware(['auth','isAdmin'])->group(function(){
    Route::get('/dashboard',[App\Http\Controllers\Admin\FrontendController::class, 'index']);
    Route::get('categorise',[App\Http\Controllers\Admin\CategoryController::class, 'index']);
    Route::get('add-category',[App\Http\Controllers\Admin\CategoryController::class, 'add']);
    Route::post('insert-category',[App\Http\Controllers\Admin\CategoryController::class, 'insert']);
    Route::get('edit-category/{id}',[App\Http\Controllers\Admin\CategoryController::class, 'edit']);    
    Route::put('update-category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update']);  
    Route::get('delete-category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy']); 
    
   // products
    Route::get('product', [App\Http\Controllers\Admin\ProductController::class, 'index']);
    Route::get('add-product', [App\Http\Controllers\Admin\ProductController::class, 'add']);  
    Route::post('insert-product', [App\Http\Controllers\Admin\ProductController::class, 'insert']);
    Route::get('edit-prod/{id}',[App\Http\Controllers\Admin\ProductController::class, 'edit']);
    Route::put('update-product/{id}',[App\Http\Controllers\Admin\ProductController::class,'update']); 
    Route::get('delete-product/{id}',[App\Http\Controllers\Admin\ProductController::class,'destroy']);    
    // Route::get('delete-product/{id}',[App\Http\Controllers\Admin\ProductController::class,'destroy']);    
    Route::get('orders',[App\Http\Controllers\Admin\OrderController::class,'index']);    
    Route::get('Admin/view-order/{id}',[App\Http\Controllers\Admin\OrderController::class,'view']);    
    Route::put('update-order/{id}',[App\Http\Controllers\Admin\OrderController::class,'updteoeder']);    
    Route::get('orders-history',[App\Http\Controllers\Admin\OrderController::class,'prodcthistory']);    

    
  });