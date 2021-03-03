<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::view('/dashboard', 'new_dashboard')
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/account', [AdminController::class, 'show'])
    ->middleware(['auth'])
    ->name('account');

Route::get('/account/edit', [AdminController::class, 'edit'])
    ->middleware(['auth'])
    ->name('account.edit');

Route::get('/account/edit', [AdminController::class, 'edit'])
    ->middleware(['auth'])
    ->name('account.edit');

Route::resource('users', UserController::class)
    ->middleware(['auth']);

Route::resource('categories', CategoryController::class)
    ->middleware(['auth']);

Route::resource('products', ProductController::class)
    ->middleware(['auth']);

Route::resource('admins', AdminController::class)
    ->middleware(['auth']);

Route::resource('currencies', CurrencyController::class)
    ->middleware(['auth']);

require __DIR__ . '/auth.php';
