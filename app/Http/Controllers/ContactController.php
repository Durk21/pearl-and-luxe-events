<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('contact.show');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        $adminEmail = env('ADMIN_EMAIL', 'kabumba79@gmail.com');

        // Send email to admin
        Mail::raw(
            "Name: {$validated['name']}\nEmail: {$validated['email']}\n\nMessage:\n{$validated['message']}",
            function ($message) use ($validated, $adminEmail) {
                $message->to($adminEmail)
                    ->subject("New Contact Form: {$validated['subject']}")
                    ->replyTo($validated['email']);
            }
        );

        return redirect()->back()
            ->with('success', 'Thank you! We\'ll get back to you soon.');
    }
}
