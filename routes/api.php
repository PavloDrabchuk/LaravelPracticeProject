<?php

use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Cart\CartItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Resources\CartResource;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Cart;
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

Route::post("login", [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post("logout", [UserController::class, 'logout']);

    Route::get('categories', [CategoryController::class, 'getAllCategories']);

    Route::get('categories/{id}', [CategoryController::class, 'getCategoryById']);

    Route::get('products', [ProductController::class, 'getAllProducts']);

    Route::get('products/{id}', [ProductController::class, 'getProductById']);

    Route::get('carts', [CartController::class, 'index']);

    Route::get('cart', [CartController::class, 'show']);

    Route::get('cart/checkout', [CartController::class, 'buyTours']);

    Route::post('cart/add_item', [CartItemController::class, 'store']);

    Route::delete('cart/item/{id}', [CartItemController::class, 'destroy']);

    Route::delete('cart', [CartController::class, 'destroy']);

    Route::get('cart/checkout', [CartController::class, 'buyTours']);
});


