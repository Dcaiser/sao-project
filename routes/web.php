<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\bookingcontroller;
use App\Http\Controllers\AdminBookingController;
//
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home',[HomeController::class, 'index'])->name('home');
Route::get('/booking', [bookingcontroller::class, 'index'])->name('booking');
Route::post('/booking', [bookingcontroller::class, 'store'])->middleware('auth')->name('booking.store');
Route::get('/home/status-peminjaman',[bookingcontroller::class, 'status'])->name('status');

Route::middleware(['auth','role:admin,staff'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/inbox', [AdminBookingController::class, 'index'])->name('admin.inbox');
    Route::patch('/admin/inbox/{booking}/approve', [AdminBookingController::class, 'approve'])->name('admin.inbox.approve');
    Route::patch('/admin/inbox/{booking}/reject', [AdminBookingController::class, 'reject'])->name('admin.inbox.reject');
    Route::get('/admin/booking-status', [AdminBookingController::class, 'status'])->name('admin.booking.status');
    Route::patch('/admin/booking-status/{booking}', [AdminBookingController::class, 'updateStatus'])->name('admin.booking.status.update');
});

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/booking-status', [bookingcontroller::class, 'status'])->name('booking.status');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
