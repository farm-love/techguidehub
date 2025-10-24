<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $data = $request->validate([
            'email' => ['required','email','max:255'],
            'name' => ['nullable','string','max:120'],
        ]);

        $subscriber = Subscriber::firstOrCreate([
            'email' => strtolower($data['email']),
        ], [
            'name' => $data['name'] ?? null,
            'unsubscribe_token' => Str::random(40),
            'source' => 'site_form',
        ]);

        return back()->with('status', 'Thanks for subscribing!');
    }
}


