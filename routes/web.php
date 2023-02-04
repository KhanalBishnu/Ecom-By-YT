<?php

use App\Http\Livewire\Admin\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Front\FrontendController;
use App\Http\Controllers\Front\WishlistController;
use App\Http\Controllers\Admin\DashboardController;


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
Route::get('/',[FrontendController::class,'index']);
Route::get('/collection',[FrontendController::class,'category']);
Route::get('/collection/{category_slug}',[FrontendController::class,'product']);
Route::get('/collection/{category_slug}/{product_slug}',[FrontendController::class,'productView']);
Route::get('/new_arrival',[FrontendController::class,'new_arrival']);
// for wishlist
Route::middleware(['auth'])->group(function () {

    Route::get('/wishlist',[WishlistController::class,'index']);
    Route::get('/cart',[CartController::class,'index']);
    Route::get('/checkout',[CheckoutController::class,'index']);
    Route::get('/order',[OrderController::class,'index']);
    Route::get('/order/{order_id}',[OrderController::class,'view']);

});
// for thank you page
Route::get('thankyou', [FrontendController::class, 'thankyou']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {

    Route::controller(CategoryController::class)->group(function () {
        Route::get('category', 'index');
        Route::get('category/create', 'create');
        Route::post('category', 'store');
        Route::get('category/{category}/edit', 'edit');
        Route::put('category/{category}', 'update');
        Route::get('category/delete/{category}', 'delete');
    });
    Route::controller(BrandController::class)->group(function () {
        Route::get('brands', 'index');
        Route::get('brands/create', 'create');
        // for form fill gareko aako xa ki xaina
        Route::post('brands', 'store');
        Route::get('brands/{brand}/edit', 'edit');
        Route::put('brands/{brand_id}', 'update');
        Route::get('brands/delete/{brand}', 'delete');
    });
        //for product
    Route::controller(ProductController ::class)->group(function () {
        Route::get('product', 'index');
        Route::get('product/create', 'create');
        Route::post('product', 'store');
        Route::get('product/{product}/edit', 'edit');
        Route::put('product/{product}', 'update');
        Route::get('product/{product_id}/delete','destroy');

        Route::get('product-image/{product_image_id}/delete','destroyImage');

    });

    // for color
    Route::controller(ColorController ::class)->group(function () {
        Route::get('color', 'index');
        Route::get('color/create', 'create');
        Route::post('color', 'store');
        Route::get('color/{color}/edit', 'edit');
        Route::put('color/{color_id}', 'update');
        Route::get('color/{color_id}/delete', 'destroy');




    });


    Route::controller(SliderController ::class)->group(function () {
        Route::get('slider', 'index');
        Route::get('slider/create', 'create');
        Route::post('slider', 'store');
        Route::get('slider/{slider}/edit', 'edit');
        Route::put('slider/{slider}', 'update');
        Route::get('slider/{slider}/delete', 'destroy');


    });


    Route::get('dashboard',[DashboardController::class,'index']);

    //Category Route


    Route::controller(OrderController::class)->group(function () {

        Route::get('/order', 'index');
        Route::get('/order/{orderId}', 'show');
        Route::post('/orders', 'store');
    });


});
