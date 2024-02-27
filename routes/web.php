<?php

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

Route::get('/', function () {
    return view('welcome');
});

// dd(12);


// Route::middleware(['auth'])->group(function () {
Route::get('/front-index', [App\Http\Controllers\PageController::class, 'index'])->name('index');
Route::get('/blog', [App\Http\Controllers\PageController::class, 'blog'])->name('blog');
Route::get('/blog-details', [App\Http\Controllers\PageController::class, 'blogDetails'])->name('blog-details');
Route::get('/shop-grid', [App\Http\Controllers\PageController::class, 'shopGrid'])->name('shop-grid');
Route::get('/shop-details', [App\Http\Controllers\PageController::class, 'shopDetails'])->name('shop-details');
Route::get('/shoping-cart/{product_id}', [App\Http\Controllers\PageController::class, 'shopingCart'])->name('shoping_cart');
Route::get('/checkout', [App\Http\Controllers\PageController::class, 'checkout'])->name('checkout');
Route::get('/contact', [App\Http\Controllers\PageController::class, 'contact'])->name('contact');

Route::get('/category-product/{slug}', [App\Http\Controllers\PageController::class, 'categorysProduct'])->name('category_product');
Route::get('/product-detail/{product_slug}',[App\Http\Controllers\PageController::class, 'productDetail'])->name('product_detail');
Route::get('/show-cart', [App\Http\Controllers\PageController::class,'showCart'])->name('show_cart');
Route::get('remove-from-cart/{id}', [App\Http\Controllers\PageController::class, 'remove'])->name('remove.from.cart');

// Route::patch('update-cart', [App\Http\Controllers\PageController::class, 'update'])->name('update.cart');


Route::get('/add-to-quantity/',[App\Http\Controllers\PageController::class, 'addToQuantity'])->name('add.to.quantity');















Route::get('/tast',[App\Http\Controllers\PageController::class,'tast'])->name('tast');





// });
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
