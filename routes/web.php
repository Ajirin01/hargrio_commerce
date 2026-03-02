<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

use App\Models\Product;
use App\Models\ProductCategory;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Http;
use App\Helpers\TylHelper;

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
// Route::get('/checkout', function () {
//     return view('checkout');
// });


Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::post('/product/{product}/add-to-cart', [ProductController::class, 'addToCart'])->name('product.addToCart');


Route::middleware('auth')->group(function () {

    // Show checkout page
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    // Handle checkout form submission and initiate Tyl payment
    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');

    // Thank you page after payment
    Route::get('/thank-you', [CheckoutController::class, 'thankyou'])
        ->name('checkout.thankyou');

    // Tyl payment callback (handle both POST and GET just in case)
    Route::match(['get', 'post'], '/checkout/tyl/callback', [CheckoutController::class, 'tylCallback'])
        ->name('checkout.tyl.callback');
});



Route::get('/test-tyl', function () {
    $txndatetime = now()->timezone('Europe/London')->format('Y:m:d-H:i:s');

    $params = [
        'chargetotal' => '1.00',
        'checkoutoption' => 'combinedpage',
        'currency' => '826',
        'hash_algorithm' => 'HMACSHA256',
        'txntype' => 'sale',
        'responseFailURL' => route('checkout.fail'),
        'responseSuccessURL' => route('checkout.success'),
        'storename' => env('TYL_STORE_ID'),
        'timezone' => 'Europe/London',
        'transactionNotificationURL' => route('checkout.tyl.callback'),
        'txndatetime' => $txndatetime,
        'bname' => 'John Smith',
        'baddr1' => '123 Street',
        'baddr2' => 'London',
        'bcity' => 'London',
        'bstate' => 'London',
        'bcountry' => 'GB',
        'bzip' => 'EC2M 4AA',
        'phone' => '07790778747',
        'email' => 'john.smith@mail.com',
    ];

    // Generate the extended hash
    $params['hashExtended'] = TylHelper::createExtendedHash($params, env('TYL_SHARED_SECRET'));

    return view('tyl.redirect', compact('params'));
});

// Dummy routes for testing
// Dummy routes for testing
Route::post('/checkout/fail', function () {
    return view('checkout.fail');
})->name('checkout.fail');

Route::post('/checkout/success', function () {
    return 'Payment successful. Thank you!';
})->name('checkout.success');

Route::post('/checkout/tyl/callback', function () {
    return 'Received Tyl notification.';
})->name('checkout.tyl.callback');

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
