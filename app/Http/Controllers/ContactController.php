<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string|max:1000',
        ]);

        // Optional: send an email (requires mail config)
        // Mail::to('support@techguidehub.site')->send(new \App\Mail\ContactMail($validated));

        // You can also store the message in DB or log it
        \Log::info('Contact form submission', $validated);

        return back()->with('success', 'Thank you for contacting us! We’ll get back to you soon.');
    }
}
