@extends('layouts.app')

@section('title', 'Terms & Conditions — ' . config('app.name'))

@section('content')
<div class="bg-gradient-to-br from-brand-600 to-accent-600 dark:from-brand-900 dark:to-accent-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-4xl lg:text-5xl font-extrabold text-white mb-4">Terms & Conditions</h1>
        <p class="text-xl text-blue-100">Please read these terms carefully before using our services</p>
    </div>
</div>

<div class="bg-gray-50 dark:bg-gray-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-8 lg:p-12 prose prose-lg dark:prose-invert max-w-none">
                <p class="lead text-gray-700 dark:text-gray-300">Welcome to <strong class="text-brand-600 dark:text-brand-400">{{ config('app.name') }}</strong> (the "Website"). By accessing or using this Website, you agree to comply with and be bound by the following Terms and Conditions. If you disagree with any part of these terms, please do not use our Website.</p>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    1. Use of Our Website
                </h2>
                <p class="text-gray-700 dark:text-gray-300">All content provided on {{ config('app.name') }} is for informational and educational purposes only. You agree to use this Website only for lawful purposes and in a way that does not infringe the rights of, restrict, or inhibit anyone else's use of the Website.</p>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    2. Intellectual Property
                </h2>
                <p class="text-gray-700 dark:text-gray-300">All articles, images, code samples, designs, and other materials on this Website are the property of {{ config('app.name') }} or its content creators unless otherwise stated. Unauthorized reproduction, distribution, or modification of any material without prior written consent is strictly prohibited.</p>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    3. Accuracy of Information
                </h2>
                <p class="text-gray-700 dark:text-gray-300">We make every effort to ensure the accuracy and reliability of the content on this Website. However, {{ config('app.name') }} makes no warranties or representations about the completeness, reliability, or accuracy of the information. Any action you take based on the information found on this Website is strictly at your own risk.</p>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    4. Affiliate Disclosure
                </h2>
                <p class="text-gray-700 dark:text-gray-300">{{ config('app.name') }} may include affiliate links to products or services. When you click on these links and make a purchase, we may earn a small commission at no extra cost to you. These commissions help support our content and maintenance costs. All affiliate relationships are disclosed where applicable.</p>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                    5. Sponsored Content
                </h2>
                <p class="text-gray-700 dark:text-gray-300">Occasionally, we may publish sponsored posts or product reviews. Sponsored content will always be clearly identified, and our opinions will remain unbiased and authentic to maintain trust with our readers.</p>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    6. AI-Assisted Content
                </h2>
                <p class="text-gray-700 dark:text-gray-300">Some content on {{ config('app.name') }} may be generated or enhanced with the assistance of artificial intelligence tools. All AI-generated content is carefully reviewed, edited, and fact-checked by our team to ensure accuracy, relevance, and compliance with editorial standards.</p>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    7. External Links
                </h2>
                <p class="text-gray-700 dark:text-gray-300">Our Website may contain links to third-party websites that are not owned or controlled by {{ config('app.name') }}. We have no control over and assume no responsibility for the content, privacy policies, or practices of any third-party websites or services.</p>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    8. Limitation of Liability
                </h2>
                <p class="text-gray-700 dark:text-gray-300">{{ config('app.name') }} and its contributors will not be held liable for any losses or damages arising from the use of our Website, including but not limited to indirect, incidental, or consequential damages.</p>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    9. Changes to These Terms
                </h2>
                <p class="text-gray-700 dark:text-gray-300">We may update or revise these Terms & Conditions at any time without prior notice. Changes will take effect immediately upon posting on this page. We encourage users to review this page periodically to stay informed.</p>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    10. Contact Us
                </h2>
                <p class="text-gray-700 dark:text-gray-300">If you have any questions, concerns, or requests regarding these Terms & Conditions, please contact us at:</p>
                <div class="bg-brand-50 dark:bg-brand-900/20 rounded-lg p-4 mt-4">
                    <ul class="list-none space-y-2 text-gray-700 dark:text-gray-300">
                        <li><strong>Email:</strong> <a href="mailto:support@techguidehub.site" class="text-brand-600 dark:text-brand-400 hover:underline">support@techguidehub.site</a></li>
                        <li><strong>Contact Form:</strong> <a href="{{ url('/contact') }}" class="text-brand-600 dark:text-brand-400 hover:underline">{{ url('/contact') }}</a></li>
    </ul>
                </div>

                <div class="mt-8 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-0">
                        <strong>Last updated:</strong> {{ now()->format('F j, Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
