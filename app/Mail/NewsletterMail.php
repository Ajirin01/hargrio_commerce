<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data; // All needed variables: subject, first_name, full_name, products, promo_code, message_intro
    }

    public function build()
    {
        return $this->subject($this->data['subject'])
                    ->view('emails.newsletter')
                    ->with($this->data);
    }
}