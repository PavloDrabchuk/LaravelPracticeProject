<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CategoryController;
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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
//Route::('*', 'csrf', array('post', 'put', 'delete'));
Route::post("login", [UserController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post("logout", [UserController::class, 'logout']);

    Route::get('categories', function () {
        return new CategoryCollection(Category::all());
    });

    Route::get('categories/{id}', function ($id) {
        return new CategoryResource(Category::findOrFail($id));
    });

    Route::get('products', function () {
        return ProductResource::collection(Product::all());
    });

    Route::get('products/{id}', function ($id) {
        return new ProductResource(Product::findOrFail($id));
    });

    Route::get('carts', function () {
        return CartResource::collection(Cart::all());
    });

    Route::get('cart', [CartController::class, 'show']);

    Route::post('cart/add_item', [CartItemController::class, 'store']);

    Route::delete('cart', [CartController::class, 'destroy']);
});


/*Route::get('carts',function (){
    return Cart::get();
});*/

