<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        'checkout/tyl/callback', // Tyl server POST callback
        'checkout/success',      // Tyl success POST
        'checkout/fail',         // Tyl fail POST
    ];
}