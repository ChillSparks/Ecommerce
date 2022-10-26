<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('index');
});
Route::view('/register','register');
Route::view('/contact','contact');
Route::view('/login','login');
Route::post('/logincheck',[LoginController::class,'logincheck'])->name('check');
Route::post('/saveuser',[LoginController::class,'saveuser'])->name('saveuser');
Route::get('/forgot',[LoginController::class,'forgot'])->name('forgot');
Route::get('/reset',[LoginController::class,'reset'])->name('reset');
Route::get('/reset-email',[LoginController::class,'resetemail'])->name('reset-email');
Route::post('forgotpost',[LoginController::class,'forgotpost'])->name('forgotpost');

Route::get('/category',[ProductController::class,'products'])->name('products');
Route::get('/single-product/{id}',[ProductController::class,'singleproduct'])->name('single-product');
Route::post('/addtocart',[ProductController::class,'addtoCart'])->name('addtocart');
Route::post('/comment',[ProductController::class,'addComment'])->name('comment');
Route::post('/review',[ProductController::class,'addReview'])->name('review');
Route::get('/cart',[ProductController::class,'cartDisplay'])->name('cart');
Route::post('/updatecart',[ProductController::class,'updatecart'])->name('updatecart');
Route::post('/product_order',[ProductController::class,'product_order'])->name('order');
Route::get('/checkout',[ProductController::class,'checkoutitems'])->name('checkout');
//stripe
Route::get('stripe',[ProductController::class,'stripe'])->name('stripe');
Route::post('stripe',[ProductController::class,'stripePost'])->name('stripe.post');