<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\Mail;
use App\Models\NewsletterTemplate;

use App\Mail\NewsletterMail;
use App\Models\Product;
use App\Models\PromoCode;

class NewsletterController extends Controller
{
    // List subscribers
    public function index()
    {
        $subscribers = NewsletterSubscriber::latest()->get();
        $products = Product::all();
        $templates = NewsletterTemplate::all();
        $promoCodes = PromoCode::where('status', 'active')->get(); // fetch only active ones

        return view('Admin.Newsletters.index', compact('subscribers', 'products', 'templates', 'promoCodes'));
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
    public function send(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'products' => 'nullable|array',
            'promo_code' => 'nullable|string|max:50',
            'save_template' => 'nullable',
            'template_name' => 'nullable|string|max:255',
        ]);

        $subscribers = NewsletterSubscriber::all();
        $products = Product::whereIn('id', $request->products ?? [])->get();

        foreach ($subscribers as $subscriber) {

            // Extract first and last name
            $names = explode(' ', $subscriber->name, 2);
            $firstName = $names[0] ?? '';
            $lastName = $names[1] ?? '';

            // Start with the original template message
            $message = $request->message;

            // Replace name placeholders
            $message = str_replace(
                ['{{full_name}}', '{{first_name}}', '{{last_name}}'],
                [$subscriber->name, $firstName, $lastName],
                $message
            );

            // Replace promo code placeholder if exists
            $message = str_replace('{{promo_code}}', $request->promo_code ?? '', $message);

            // Replace product placeholders for inline HTML (optional for message body)
            if ($products->count()) {
                $productHtml = '<ul>';
                foreach ($products as $p) {
                    $productHtml .= '<li><a href="'.url("product/{$p->id}").'">'.$p->name.' - ₦'.number_format($p->price,2).'</a></li>';
                }
                $productHtml .= '</ul>';

                $message = str_replace('{{product_name}}', $productHtml, $message);

                $allPrices = $products->pluck('price')->map(fn($p) => '₦'.number_format($p,2))->implode(', ');
                $message = str_replace('{{product_price}}', $allPrices, $message);
            }

            // Send the email with all variables ready for the Blade view
            Mail::to($subscriber->email)->send(new NewsletterMail([
                'subject'       => $request->subject,
                'full_name'     => $subscriber->name,
                'first_name'    => $firstName,
                'last_name'     => $lastName,
                'products'      => $products,
                'promo_code'    => $request->promo_code ?? null,
                'message_intro' => $message, // ✅ Already processed HTML
            ]));
        }

        // Optionally save template
        if ($request->has('save_template')) {
            $templateName = $request->template_name ?? $request->subject;
            NewsletterTemplate::create([
                'name'       => $templateName,
                'subject'    => $request->subject,
                'message'    => $request->message,
                'products'   => $request->products ? implode(',', $request->products) : null,
                'promo_code' => $request->promo_code ?? null,
            ]);
        }

        return redirect()->back()->with('success','Newsletter sent successfully!');
    }

    // Delete subscriber
    public function destroy($id)
    {
        NewsletterSubscriber::findOrFail($id)->delete();
        return back()->with('success', 'Subscriber removed.');
    }
}
