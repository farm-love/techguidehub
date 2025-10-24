<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenAI; // provided by openai-php/laravel

class AiGeneratorController extends Controller
{
    public function generate(Request $request)
    {
        $validated = $request->validate([
            'topic' => ['required','string','max:200'],
            'outline' => ['nullable','string','max:2000'],
            'tone' => ['nullable','string','max:50'],
        ]);

        $prompt = "Write a helpful, original blog post about: {$validated['topic']}.";
        if (!empty($validated['outline'])) {
            $prompt .= "\nFollow this outline:\n{$validated['outline']}";
        }
        if (!empty($validated['tone'])) {
            $prompt .= "\nTone: {$validated['tone']}";
        }

        $client = OpenAI::client();
        $response = $client->chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a senior technical writer. Produce HTML sections, headers, and lists. Avoid hallucinations.'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.7,
        ]);

        $content = $response->choices[0]->message->content ?? '';
        return response()->json([
            'html' => $content,
        ]);
    }
}


