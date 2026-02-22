<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

use App\Models\Product;
use App\Models\ProductCategory;

use App\Http\Controllers\CheckoutController;

Route::get('/', function () {
    $categories = ProductCategory::with('products')->get();
    $latestProducts = Product::latest()->take(8)->get();

    return view('home', compact('categories', 'latestProducts'));
    // return view('home');
})->name('home');
Route::get('/shop', function () {
    $products = Product::latest()->get();
    return view('shop', compact('products'));
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/blog', function () {
    return view('blog');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/checkout', function () {
    return view('checkout');
});


Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/thank-you', [CheckoutController::class, 'thankyou'])->name('checkout.thankyou');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
