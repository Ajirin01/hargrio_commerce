<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactUsMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submitContactForm(Request $request)
    {
        try {
            $validated = $request->validate([
                'fname'   => 'required|string|max:255',
                'lname'   => 'required|string|max:255',
                'email'   => 'required|email|max:255',
                'message' => 'required|string',
            ]);

            $fullName = $validated['fname'] . ' ' . $validated['lname'];

            // Queue the email to admin
            Mail::to('mubarakolagoke@gmail.com')->queue(
                new ContactUsMail(
                    $fullName,
                    $validated['email'],
                    $validated['message']
                )
            );

            return redirect()
                ->back()
                ->with('success', 'Your message has been sent successfully!');

        } catch (Exception $e) {

            // Optional: log the error
            \Log::error('Contact form mail error: ' . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function testMailConnection()
    {
        try {
            \Mail::raw('This is a test email from Hargrio.', function ($message) {
                $message->to('mubarakolagoke@gmail.com') // Replace with your email
                        ->subject('Mail Configuration Test');
            });

            return 'Mail sent successfully!';
        } catch (\Exception $e) {
            return 'Mail failed: ' . $e->getMessage();
        }
    }
}