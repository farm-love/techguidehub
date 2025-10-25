@extends('layouts.app')

@section('title', 'About Us — ' . config('app.name'))

@section('content')
<div class="bg-gradient-to-br from-brand-600 to-accent-600 dark:from-brand-900 dark:to-accent-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-4xl lg:text-5xl font-extrabold text-white mb-4">About Us</h1>
        <p class="text-xl text-blue-100">Learn more about {{ config('app.name') }} and our mission</p>
    </div>
</div>

<div class="bg-gray-50 dark:bg-gray-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-8 lg:p-12 space-y-8">
                <div>
                    <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed">
                        Welcome to <strong class="text-brand-600 dark:text-brand-400">{{ config('app.name') }}</strong> — your trusted source for the latest tutorials, guides, and tips 
                        on technology, software, and digital innovation. Our goal is to simplify complex topics and help readers stay ahead 
                        in the fast-changing tech world.
                    </p>
                </div>

                <div class="bg-gradient-to-r from-brand-50 to-accent-50 dark:from-gray-700 dark:to-gray-700 rounded-xl p-6">
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        We focus on delivering clear, practical, and beginner-friendly content covering web development, mobile apps, 
                        AI tools, gadgets, and digital productivity. Every article is carefully reviewed to ensure accuracy, usefulness, 
                        and readability.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Our Mission
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        Our mission is to empower learners, professionals, and enthusiasts by providing easy-to-understand tutorials and 
                        guides that make technology accessible to everyone. Whether you're a student, a developer, or simply curious about 
                        the latest digital trends — {{ config('app.name') }} is here for you.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        How We Create Content
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        Our content is created by a mix of experienced writers and tech enthusiasts. We may also use AI tools to enhance 
                        research, formatting, or grammar — but every post is reviewed and verified by our editorial team before publication. 
                        This ensures quality and reliability in everything we share.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Transparency & Integrity
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        We believe in transparency and honesty. Any sponsored content, affiliate link, or partnership will be clearly 
                        disclosed. Our goal is to provide value to our readers — not just generate clicks.
                    </p>
                </div>

                <div class="bg-gradient-to-br from-brand-600 to-accent-600 rounded-2xl p-8 text-white">
                    <h2 class="text-2xl font-bold mb-4">Join Our Journey</h2>
                    <p class="text-blue-100 leading-relaxed mb-6">
                        Technology is always evolving, and so are we. Follow us on social media, subscribe to our updates, or contribute 
                        your own ideas — together, we can build a smarter and more connected digital world.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('contact') }}" class="px-6 py-3 bg-white hover:bg-gray-100 text-brand-600 rounded-lg font-medium transition-colors">
                            Contact Us
                        </a>
                        <x-newsletter-form />
                    </div>
                </div>

                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-6 border border-blue-200 dark:border-blue-800">
                    <p class="text-gray-700 dark:text-gray-300">
                        💡 <strong>Have suggestions or collaboration ideas?</strong><br>
                        Reach out to us anytime at 
                        <a href="mailto:support@techguidehub.site" class="text-brand-600 dark:text-brand-400 hover:underline font-medium">
                            support@techguidehub.site
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
