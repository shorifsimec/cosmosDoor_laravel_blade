<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\OrderController;
use App\Models\Product;
use App\Models\Category;

// Move auth routes before catch-all
require __DIR__ . '/auth.php';

Route::get('/', function () {
    $products = Product::all();
    $categories = Category::all();
    return view('welcome', compact('products', 'categories'));
})->name('home');

Route::get('/category/{category}', function ($category) {
    $categories = Category::all();
    $products = Product::whereHas('category', function ($q) use ($category) {
        $q->where('name', $category);
    })->get();
    return view('welcome', compact('products', 'categories', 'category'));
})->name('home.category');

Route::middleware('auth')->group(function () {
    Route::get('admin/dashboard', function () {
        return view('dashboard');
    })->name('admin.dashboard');

    // Customers Routes
    Route::resource('/admin/customers', CustomerController::class)->names('customers');

    // Brands Routes
    Route::resource('/admin/brands', BrandController::class)->names('brands');

    Route::prefix('admin')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('colors', ColorController::class);
        Route::resource('orders', OrderController::class);
    });
});
