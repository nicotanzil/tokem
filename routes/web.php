<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', function() {
    return view('about')->with('user', Auth::user());
})->name('about');

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/add-product', [ProductController::class, 'addProductView'])->middleware(['role.auth']);
Route::get('/update-product/{id}', [ProductController::class, 'updateProductView'])->middleware(['role.auth']);
Route::post('/product', [ProductController::class, 'create']);
Route::put('/product', [ProductController::class, 'update']);
Route::delete('/product', [ProductController::class, 'destroy']);
Route::get('/products/search', [ProductController::class, 'search']);

Route::get('/products/{id}', [ProductController::class, 'detail']);
Route::post('/add-cart', [CartController::class, 'addCart']);

Route::get('/cart', [CartController::class, 'index'])->middleware(['role.auth']);
Route::put('/cart', [CartController::class, 'updateCart'])->middleware(['role.auth']);

Route::get('/categories', [CategoryController::class, 'index'])->middleware(['role.auth'])->name('categories');
Route::post('/categories', [CategoryController::class, 'create'])->middleware(['role.auth']);

require __DIR__.'/auth.php';
