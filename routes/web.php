<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\orders_controller;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UsersController;
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
Route::get('/', [UsersController::class, 'home'])->name('home');
Route::get('user/home', [UsersController::class, 'userHome'])->name('user.home');

Route::get('/register', [AuthController::class, 'formRegister'])->name('user.formRegister');
Route::post('/register', [AuthController::class, 'register'])->name('user.register');
Route::get('/login', [AuthController::class, 'formLogin'])->name('user.formLogin');
Route::post('/login', [AuthController::class, 'Login'])->name('user.login ');
Route::get('/auth/redirect/{provider}', [SocialController::class, 'redirect']);
Route::get('/callback/{provider}', [SocialController::class, 'callback']);

Route::prefix('products')->group(function () {
    Route::get('/search', [ProductsController::class, 'search'])->name('search');
    Route::get('/list', [ProductsController::class, 'index'])->name('product.list');
    Route::get('{id}/detail', [ProductsController::class, 'detail'])->name('detail.product');

});

Route::middleware('auth')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('/list', [CategoriesController::class, 'index'])->name('categories.list');
    });

    Route::prefix('users')->group(function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('user.logout');

        Route::prefix('orders')->group(function () {
            Route::get('/list', [orders_controller::class, 'index'])->name('user.order.list');
            Route::post('/delete', [orders_controller::class, 'delete'])->name('user.order.delete');
        });

        Route::prefix('cart')->group(function () {
            Route::get('{id}/addToCart', [CartsController::class, 'addToCart'])->name('addToCart');
            Route::get('{id}/delete', [CartsController::class, 'delete'])->name('cart.delete');
            Route::get('/index', [CartsController::class, 'index'])->name('cart.reload');
            Route::get('/checkout', function () {
                return view('users.orders.checkOut');
            })->name('checkOut');
            Route::post('/buy', [RevenueController::class, 'buy'])->name('buy');
        });

        Route::prefix('products')->group(function () {
        });
    });

    Route::prefix('admin')->group(function () {

        Route::get('/users/list', [UsersController::class, 'index'])->name('user.list');
        Route::post('/users/delete', [UsersController::class, 'delete'])->name('user.delete');

        Route::prefix('categories')->group(function () {
            Route::get('/create', [CategoriesController::class, 'create'])->name('categories.create');
            Route::get('{id}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
            Route::post('/store', [CategoriesController::class, 'store'])->name('categories.store');
            Route::post('/update', [CategoriesController::class, 'update'])->name('categories.update');
            Route::get('{id}/delete', [CategoriesController::class, 'delete'])->name('categories.delete');
        });

        Route::prefix('/products')->group(function () {
            Route::post('/delete', [ProductsController::class, 'delete'])->name('product.delete');
            Route::get('{id}/edit', [ProductsController::class, 'edit'])->name('product.edit');
            Route::post('/store', [ProductsController::class, 'store'])->name('product.store');
            Route::post('/update', [ProductsController::class, 'update'])->name('product.update');
            Route::get('/create', [ProductsController::class, 'create'])->name('product.create');
        });
    });

});
