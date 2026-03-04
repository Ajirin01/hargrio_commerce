<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $statusUpdate;

    public function __construct($order, $statusUpdate)
    {
        $this->order = $order;
        $this->statusUpdate = $statusUpdate;
    }

    public function build()
    {
        return $this->subject('Order Update - ' . $this->order->order_number)
                    ->view('emails.orders.update');
    }
}
