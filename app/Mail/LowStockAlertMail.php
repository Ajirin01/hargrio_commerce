<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LowStockAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public $products; // collection of low stock products

    public function __construct($products)
    {
        $this->products = $products;
    }

    public function build()
    {
        return $this->subject('Low Stock Alert')
                    ->view('emails.products.low_stock'); // pass collection to view
    }
}