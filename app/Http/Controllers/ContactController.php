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
            Mail::to(env('ADMIN_EMAIL'))->queue(
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


    public function submitWholesaleForm(Request $request)
    {
        try {
            $validated = $request->validate([
                'business_name' => 'required|string|max:255',
                'contact_name'  => 'required|string|max:255',
                'email'         => 'required|email|max:255',
                'phone'         => 'required|string|max:50',
                'business_type' => 'required|string|max:100',
                'volume'        => 'required|string|max:100',
                'message'       => 'nullable|string|max:500',
            ]);

            // Format message body from wholesale fields
            $messageBody =
            "Wholesale Inquiry Details:<br><br>" .
            "Business Name: {$validated['business_name']}<br>" .
            "Contact Name: {$validated['contact_name']}<br>" .
            "Email: {$validated['email']}<br>" .
            "Phone: {$validated['phone']}<br>" .
            "Business Type: {$validated['business_type']}<br>" .
            "Estimated Monthly Volume: {$validated['volume']}<br><br>" .
            "Additional Information:<br>" .
            ($validated['message'] ?? 'N/A');

            // Queue email using existing ContactUsMail
            Mail::to(env('ADMIN_EMAIL'))->queue(
                new ContactUsMail(
                    $validated['contact_name'],
                    $validated['email'],
                    $messageBody
                )
            );

            return redirect()
                ->back()
                ->with('success', 'Wholesale inquiry submitted successfully!');

        } catch (\Exception $e) {

            \Log::error('Wholesale mail error: ' . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function testMailConnection()
    {
        try {
            \Mail::raw('This is a test email from Hargrio.', function ($message) {
                $message->to(env('ADMIN_EMAIL')) // Replace with your email
                        ->subject('Mail Configuration Test');
            });

            return 'Mail sent successfully!';
        } catch (\Exception $e) {
            return 'Mail failed: ' . $e->getMessage();
        }
    }
}