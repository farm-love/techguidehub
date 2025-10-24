@extends('layouts.app')

@section('title', 'About Us — ' . config('app.name'))

@section('content')
<div class="max-w-3xl mx-auto py-10 px-6">
    <h1 class="text-3xl font-extrabold mb-6 text-gray-800 dark:text-white">About {{ config('app.name') }}</h1>

    <p class="text-gray-600 dark:text-gray-300 mb-5 leading-relaxed">
        Welcome to <strong>{{ config('app.name') }}</strong> — your trusted source for the latest tutorials, guides, and tips 
        on technology, software, and digital innovation. Our goal is to simplify complex topics and help readers stay ahead 
        in the fast-changing tech world.
    </p>

    <p class="text-gray-600 dark:text-gray-300 mb-5 leading-relaxed">
        We focus on delivering clear, practical, and beginner-friendly content covering web development, mobile apps, 
        AI tools, gadgets, and digital productivity. Every article is carefully reviewed to ensure accuracy, usefulness, 
        and readability.
    </p>

    <h2 class="text-2xl font-semibold mt-8 mb-3 text-gray-800 dark:text-white">Our Mission</h2>
    <p class="text-gray-600 dark:text-gray-300 mb-5 leading-relaxed">
        Our mission is to empower learners, professionals, and enthusiasts by providing easy-to-understand tutorials and 
        guides that make technology accessible to everyone. Whether you're a student, a developer, or simply curious about 
        the latest digital trends — {{ config('app.name') }} is here for you.
    </p>

    <h2 class="text-2xl font-semibold mt-8 mb-3 text-gray-800 dark:text-white">How We Create Content</h2>
    <p class="text-gray-600 dark:text-gray-300 mb-5 leading-relaxed">
        Our content is created by a mix of experienced writers and tech enthusiasts. We may also use AI tools to enhance 
        research, formatting, or grammar — but every post is reviewed and verified by our editorial team before publication. 
        This ensures quality and reliability in everything we share.
    </p>

    <h2 class="text-2xl font-semibold mt-8 mb-3 text-gray-800 dark:text-white">Transparency & Integrity</h2>
    <p class="text-gray-600 dark:text-gray-300 mb-5 leading-relaxed">
        We believe in transparency and honesty. Any sponsored content, affiliate link, or partnership will be clearly 
        disclosed. Our goal is to provide value to our readers — not just generate clicks.
    </p>

    <h2 class="text-2xl font-semibold mt-8 mb-3 text-gray-800 dark:text-white">Join Our Journey</h2>
    <p class="text-gray-600 dark:text-gray-300 mb-5 leading-relaxed">
        Technology is always evolving, and so are we. Follow us on social media, subscribe to our updates, or contribute 
        your own ideas — together, we can build a smarter and more connected digital world.
    </p>

    <div class="mt-8 p-4 bg-blue-50 dark:bg-blue-800/60 rounded-xl border border-blue-100 dark:border-blue-700">
        <p class="text-gray-700 dark:text-gray-100">
            💡 Have suggestions or collaboration ideas? <br>
            Reach out to us anytime at 
            <a href="mailto:support@techguidehub.site" class="text-blue-600 dark:text-blue-300 hover:underline">
                support@techguidehub.site
            </a>.
        </p>
    </div>
</div>
@endsection
