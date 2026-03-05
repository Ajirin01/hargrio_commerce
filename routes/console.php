<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use App\Mail\LowStockAlertMail;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| Here you may define all of your Closure based console commands.
|
*/

// Default inspire command
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Low stock check command
Artisan::command('stock:check', function () {

    $threshold = 5; // Low stock threshold
    $lowProducts = Product::where('stock', '<=', $threshold)->get();

    if ($lowProducts->isNotEmpty()) {
        // Send mail to admin
        Mail::to(env('ADMIN_EMAIL'))->send(new LowStockAlertMail($lowProducts));
        $this->info('Low stock email sent!');
    } else {
        $this->info('No low stock products.');
    }

})->describe('Check low stock products and notify admin');