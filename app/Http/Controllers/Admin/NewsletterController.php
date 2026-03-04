<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\Mail;

use App\Mail\NewsletterMail;

class NewsletterController extends Controller
{
    // List subscribers
    public function index()
    {
        $subscribers = NewsletterSubscriber::latest()->paginate(20);
        return view('Admin.Newsletters.index', compact('subscribers'));
    }

    // Store new subscriber
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:newsletter_subscribers,email',
        ]);

        NewsletterSubscriber::create($data);

        return back()->with('success', 'Subscribed successfully!');
    }

    // Send newsletter to all subscribers
    public function sendNewsletter(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:191',
            'message' => 'required|string',
        ]);

        $subscribers = NewsletterSubscriber::all();

        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)
                ->queue(new NewsletterMail($request->subject, $request->message));
        }

        return back()->with('success', 'Newsletter queued successfully!');
    }

    // Delete subscriber
    public function destroy($id)
    {
        NewsletterSubscriber::findOrFail($id)->delete();
        return back()->with('success', 'Subscriber removed.');
    }
}
