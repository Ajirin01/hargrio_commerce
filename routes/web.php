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
})->name('shop.index');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/blog', function () {
    return view('blog');
});

Route::get('/contact', function () {
    return view('contact');
});
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'submitContactForm'])->name('contact.submit');
Route::get('/test-mail', [\App\Http\Controllers\ContactController::class, 'testMailConnection']);


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

Route::post('/checkout/success', [CheckoutController::class, 'thankyou'])
    ->name('checkout.success');

Route::post('/checkout/tyl/callback', function () {
    return 'Received Tyl notification.';
})->name('checkout.tyl.callback');

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
});

Route::middleware(['auth'])->group(function () {
    // Orders list
    Route::get('/my-orders', [App\Http\Controllers\OrderController::class, 'index'])
        ->name('orders.index');

    // Order details
    Route::get('/my-orders/{order}', [App\Http\Controllers\OrderController::class, 'show'])
        ->name('orders.show');
});

// admin routes
Route::get('admin/admin-login', [App\Http\Controllers\Admin\AuthController::class, 'loginForm'])->name('admin.login');
Route::post('admin/admin-login-handle', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.login.handle');
Route::prefix('admin')->middleware(['web', 'admin'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('products', App\Http\Controllers\Admin\ProductsController::class);
    Route::get('products-bulk-edit',	[App\Http\Controllers\Admin\ProductsController::class, 'productBulkEditCreate'])->name('product.bulk.edit');
    Route::post('products-bulk-edit',	[App\Http\Controllers\Admin\ProductsController::class, 'productBulkEditStore'])->name('product.bulk.update');
    Route::get('order/{type}',	[App\Http\Controllers\Admin\OrdersController::class, 'getOrdersByType'])->name('orders_by_type');
    Route::get('order-details/{order}',	[App\Http\Controllers\Admin\OrdersController::class, 'orderDetails'])->name('order_details');
    Route::post('update_order_status/{order}', [App\Http\Controllers\Admin\OrdersController::class, 'updateOrderStatus'])->name('update_order_status');
    Route::resource('brands', App\Http\Controllers\Admin\BrandsController::class);
    Route::resource('sellers', App\Http\Controllers\Admin\SellerController::class);
    Route::resource('shops', App\Http\Controllers\Admin\ShopController::class);
    Route::resource('users', App\Http\Controllers\Admin\UsersController::class);
    Route::resource('categories', App\Http\Controllers\Admin\CategoriesController::class);

    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
    Route::resource('promo-codes', \App\Http\Controllers\Admin\PromoCodeController::class);
    Route::resource('promotions', \App\Http\Controllers\Admin\PromotionController::class);

    Route::get('newsletters', [NewsletterController::class, 'index'])->name('newsletters.index');
    Route::post('newsletters/store', [NewsletterController::class, 'store'])->name('newsletters.store');
    Route::post('newsletters/send', [NewsletterController::class, 'send'])->name('newsletters.send');
    Route::delete('newsletters/{id}', [NewsletterController::class, 'destroy'])->name('newsletters.destroy');

    // Route::get('admin-login', [App\Http\Controllers\Admin\AuthController::class, 'loginForm'])->name('admin.login');
    Route::post('admin-logut', function(){
        Auth::logout();
        return redirect()->route('admin-login');
    })->name('admin-logout');
}); 



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
