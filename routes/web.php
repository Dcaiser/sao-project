<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

//
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home',[HomeController::class, 'index'])->name('home');
Route::get('/booking', function () {
    return view('booking');
});
Route::get('/admin/inbox', function () {
    return view('admin.order');
});
Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
