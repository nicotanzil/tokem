<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckoutController;
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

// Route::get('/add-product', [ProductController::class, 'addProductView'])->middleware(['role.auth']);
// Route::get('/update-product/{id}', [ProductController::class, 'updateProductView'])->middleware(['role.auth']);
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/add-product', [ProductController::class, 'addProductView'])->middleware(['admin']);
Route::get('/update-product/{id}', [ProductController::class, 'updateProductView'])->middleware(['admin']);
Route::post('/product', [ProductController::class, 'create']);
Route::put('/product', [ProductController::class, 'update']);
Route::delete('/product', [ProductController::class, 'destroy']);
Route::get('/products/search', [ProductController::class, 'search']);

Route::get('/products/{id}', [ProductController::class, 'detail']);
Route::post('/add-cart', [CartController::class, 'addCart']);

// Route::get('/cart', [CartController::class, 'index'])->middleware(['role.auth']);
// Route::put('/cart', [CartController::class, 'updateCart'])->middleware(['role.auth']);
Route::get('/cart', [CartController::class, 'index'])->middleware(['member']);
Route::put('/cart', [CartController::class, 'updateCart'])->middleware(['member']);

// Route::get('/categories', [CategoryController::class, 'index'])->middleware(['role.auth'])->name('categories');
// Route::post('/categories', [CategoryController::class, 'create'])->middleware(['role.auth']);
Route::get('/categories', [CategoryController::class, 'index'])->middleware(['admin'])->name('categories');
Route::post('/categories', [CategoryController::class, 'create'])->middleware(['admin']);

Route::get('/profile', [UserController::class, 'index'])->middleware(['auth']);
Route::get('/profile/detail', [UserController::class, 'detail'])->middleware(['auth']);
Route::put('/profile', [UserController::class, 'update'])->middleware(['auth']);

// Route::get('/checkout', [CheckoutController::class, 'index'])->middleware(['auth','role.auth']);
// Route::post('/checkout', [CheckoutController::class, 'store'])->middleware(['auth','role.auth']);
// Route::get('/transactions', [CheckoutController::class, 'viewTransactions'])->middleware(['auth','role.auth']);
Route::get('/checkout', [CheckoutController::class, 'index'])->middleware(['member']);
Route::post('/checkout', [CheckoutController::class, 'store'])->middleware(['member']);
Route::get('/transactions', [CheckoutController::class, 'viewTransactions'])->middleware(['member']);

require __DIR__.'/auth.php';
