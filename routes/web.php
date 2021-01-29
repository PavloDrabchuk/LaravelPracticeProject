<?php

use App\Http\Controllers\AdminController;
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

Route::get('/dashboard', function () {
    return view('layouts.new_dashboard');
})->middleware(['auth'])->name('new_dashboard');

Route::get('/account',function(){
    return view('account');
})->middleware(['auth'])->name('account');

Route::get('/account/edit',function (){
    return view('account.edit');
})->middleware(['auth'])->name('account.edit');

Route::resource('users', UserController::class)
    ->middleware(['auth']);

Route::resource('admins',AdminController::class)
    ->middleware(['auth']);

require __DIR__.'/auth.php';
