<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Dummy customers Routes
    Route::get('/admin/customers', function () {
        return view('admin/customers.index');
    })->name('customers.index');

    Route::get('/admin/customers/create', function () {
        return view('admin/customers.create');
    })->name('customers.create');

    // Brands Routes
    Route::resource('/admin/brands', BrandController::class)->names('brands');

    Route::prefix('admin')->group(function () {
        Route::resource('categories', CategoryController::class);
    });
});

require __DIR__ . '/auth.php';
