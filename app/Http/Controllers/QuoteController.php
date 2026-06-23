<?php

namespace App\Http\Controllers;

use App\Models\QuoteRequest;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuoteController extends Controller
{
    public function show(): View
    {
        return view('quote.show');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'required|string|max:20',
            'event_type' => 'required|string|max:255',
            'budget_min' => 'required|numeric|min:0',
            'budget_max' => 'required|numeric|min:0',
            'estimated_guests' => 'nullable|integer|min:1',
            'event_date' => 'nullable|date',
            'special_requirements' => 'nullable|string',
        ]);

        // Create quote request
        $quote = QuoteRequest::create($validated);

        // Send email to admin
        $adminEmail = env('ADMIN_EMAIL', 'kabumba79@gmail.com');
        
        Mail::raw(
            "New Custom Quote Request\n\n" .
            "Client: {$validated['client_name']}\n" .
            "Email: {$validated['client_email']}\n" .
            "Phone: {$validated['client_phone']}\n" .
            "Event Type: {$validated['event_type']}\n" .
            "Budget: KES {$validated['budget_min']} - KES {$validated['budget_max']}\n" .
            "Estimated Guests: {$validated['estimated_guests']}\n" .
            "Event Date: {$validated['event_date']}\n" .
            "Special Requirements:\n{$validated['special_requirements']}",
            function ($message) use ($adminEmail) {
                $message->to($adminEmail)
                    ->subject('New Custom Quote Request');
            }
        );

        return redirect()->back()
            ->with('success', 'Thank you! We\'ve received your quote request. Our team will contact you shortly.');
    }
}
