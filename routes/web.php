<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return redirect()->route('products.index');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Product & Comment Routes (Hanya bisa diakses jika sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/produk', [ProductController::class, 'index'])->name('products.index');
    Route::get('/produk/tambah', [ProductController::class, 'create'])->name('products.create');
    Route::post('/produk', [ProductController::class, 'store'])->name('products.store');
    Route::get('/produk/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/produk/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/produk/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/produk/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::post('/komentar/{product_id}', [CommentController::class, 'store'])->name('comments.store');
});