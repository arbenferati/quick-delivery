<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Sellers\OrderController;
use App\Http\Controllers\Sellers\ProductController;
use App\Http\Controllers\UserController;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/delete-user-{id}', [UserController::class, 'deleteUser'])->name('delete-user');
Route::get('/enable-user-{id}', [UserController::class, 'enableUser'])->name('enable-user');
Route::get('/disable-user-{id}', [UserController::class, 'disableUser'])->name('disable-user');


Route::middleware('isSeller')->group(function(){
    Route::post('/add-product', [ProductController::class, 'addProduct'])->name('add-product');
    Route::post('/edit-product-{id}', [ProductController::class, 'editProduct'])->name('edit-product');
    Route::get('/delete-product-{id}', [ProductController::class, 'deleteProduct'])->name('delete-product');
    Route::get('/restore-product-{id}', [ProductController::class, 'restoreProduct'])->name('restore-product');
    Route::get('/deleted-products', [ProductController::class, 'deletedProducts'])->name('deleted-products');

    Route::get('/order-{id}', [OrderController::class, 'show'])->name('show-order');

    Route::get('/deliverers', [DelivererController::class, 'index'])->name(('index-deliverers'));
    Route::post('/add-deliverer', [DelivererController::class, 'addDeliverer'])->name('add-deliverer');
});
