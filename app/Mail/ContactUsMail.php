<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $messageText;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $email, $messageText)
    {
        $this->name = $name;
        $this->email = $email;
        $this->messageText = $messageText;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->subject('New Contact Form Submission')
                    ->view('emails.contact_us');
    }
}