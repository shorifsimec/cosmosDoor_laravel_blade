<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
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

use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;

// Customer Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
});

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::patch('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');

// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/', function () {
    $products = Product::all();
    $categories = Category::all();
    return view('publicPage.welcome', compact('products', 'categories'));
})->name('home');

Route::get('/product/{product}', function (Product $product) {
    $categories = Category::all();
    return view('publicPage.product', compact('product', 'categories'));
})->name('public.products.show');

Route::get('/category/{category}', function ($category) {
    $categories = Category::all();
    $products = Product::whereHas('category', function ($q) use ($category) {
        $q->where('name', $category);
    })->get();
    return view('publicPage.welcome', compact('products', 'categories', 'category'));
})->name('home.category');

Route::get('/about', function () {
    $categories = Category::all();
    return view('publicPage.about', compact('categories'));
})->name('about');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin', function () {
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
        Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::get('orders/{order}/voucher', [OrderController::class, 'voucher'])->name('orders.voucher');
    });
});
