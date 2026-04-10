<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');   
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login'); 
});
  
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index'); 
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/show/{product}', [ProductController::class, 'show'])->name('product.show');

    Route::middleware('role:admin')->group(function () {
       // Product CRUD admin
       Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
       Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
       Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
       Route::patch('/product/{product}/update', [ProductController::class, 'update'])->name('product.update');
       Route::patch('/produks/stock/{product}', [ProductController::class, 'updateStock'])->name('product.updateStock');
       Route::delete('/product/{product}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');

       // User CRUD admin
       Route::get('/user', [UserController::class, 'index'])->name('user.index');
       Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
       Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
       Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show');
       Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
       Route::patch('/user/{user}/update', [UserController::class, 'update'])->name('user.update');
       Route::delete('/user/{user}/destroy', [UserController::class, 'destroy'])->name('user.destroy');
    });
});


