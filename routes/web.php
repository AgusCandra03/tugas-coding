<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/categories', App\Http\Controllers\CategoryController::class);
Route::resource('/products', App\Http\Controllers\ProductController::class);
Route::resource('/stocks', App\Http\Controllers\StockController::class);
Route::resource('/transactions', App\Http\Controllers\TransactionController::class);

Route::get('/api/categories', [App\Http\Controllers\CategoryController::class, 'api']);
Route::get('/api/products', [App\Http\Controllers\ProductController::class, 'api']);
Route::get('/api/stocks', [App\Http\Controllers\StockController::class, 'api']);
Route::get('/api/transactions', [App\Http\Controllers\TransactionController::class, 'api']);
