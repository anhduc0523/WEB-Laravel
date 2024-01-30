<?php

use App\Http\Controllers\Admin\CartAdminController;
use App\Http\Controllers\Admin\MainAdminController;
use App\Http\Controllers\Admin\MenuAdminController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
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
Route::get('/admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('/admin/users/login/store', [LoginController::class, 'store']);

Route::middleware(['auth'])->group(function (){
    
    Route::prefix('admin')->group(function (){
        Route::get('/', [MainAdminController::class, 'index'])->name('admin');
        Route::get('main', [MainAdminController::class, 'index']);

        #Menu
        Route::prefix('menus')->group(function () {
            Route::get('add', [MenuAdminController::class, 'create']);
            Route::post('add', [MenuAdminController::class, 'store']);
            Route::get('list', [MenuAdminController::class, 'index']);
            Route::get('edit/{menu}', [MenuAdminController::class, 'show']);
            Route::post('edit/{menu}', [MenuAdminController::class, 'update']);
            Route::DELETE('destroy', [MenuAdminController::class, 'destroy']);
        });

        #Product
        Route::prefix('products')->group(function () {
            Route::get('add', [ProductAdminController::class, 'create']);
            Route::post('add', [ProductAdminController::class, 'store']);
            Route::get('list', [ProductAdminController::class, 'index']);
            Route::get('edit/{product}', [ProductAdminController::class, 'show']);
            Route::post('edit/{product}', [ProductAdminController::class, 'update']);
            Route::DELETE('destroy', [ProductAdminController::class, 'destroy']);
        });

        #Slider
        Route::prefix('sliders')->group(function () {
            Route::get('add', [SliderController::class, 'create']);
            Route::post('add', [SliderController::class, 'store']);
            Route::get('list', [SliderController::class, 'index']);
            Route::get('edit/{slider}', [SliderController::class, 'show']);
            Route::post('edit/{slider}', [SliderController::class, 'update']);
            Route::DELETE('destroy', [SliderController::class, 'destroy']);
        });
        
        #Upload
        Route::post('upload/services', [UploadController::class, 'store']);

         #Cart
         Route::get('customers', [CartAdminController::class, 'index']);
         Route::get('customers/view/{customer}', [CartAdminController::class, 'show']);
    });
    
});

Route::get('/', [MainController::class, 'index']);
Route::post('/services/load-product', [MainController::class, 'loadProduct']);

Route::get('danh-muc/{id}-{slug}.html', [MenuController::class, 'index']);
Route::get('san-pham/{id}-{slug}.html', [ProductController::class, 'index']);

Route::post('add-cart', [CartController::class, 'index']);
Route::get('carts', [CartController::class, 'show']);
Route::post('update-cart', [CartController::class, 'update']);
Route::get('carts/delete/{id}', [CartController::class, 'remove']);
Route::post('carts', [CartController::class, 'addCart']);
