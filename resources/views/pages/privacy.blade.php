@extends('layouts.app')

@section('title', 'Privacy Policy — ' . config('app.name'))

@section('content')
<div class="bg-gradient-to-br from-brand-600 to-accent-600 dark:from-brand-900 dark:to-accent-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-4xl lg:text-5xl font-extrabold text-white mb-4">Privacy Policy</h1>
        <p class="text-xl text-blue-100">Your privacy is important to us. Learn how we protect your data.</p>
    </div>
</div>

<div class="bg-gray-50 dark:bg-gray-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-8 lg:p-12 prose prose-lg dark:prose-invert max-w-none">
                <p class="lead text-gray-700 dark:text-gray-300">At <strong class="text-brand-600 dark:text-brand-400">{{ config('app.name') }}</strong>, accessible from {{ url('/') }}, we value your privacy. This Privacy Policy explains how we collect, use, and protect your personal information when you visit our Website.</p>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    1. Information We Collect
                </h2>
                <p class="text-gray-700 dark:text-gray-300">We may collect the following types of information:</p>
                <ul class="text-gray-700 dark:text-gray-300">
        <li><strong>Personal Information:</strong> Such as your name and email address when you subscribe to our newsletter, comment on posts, or contact us.</li>
        <li><strong>Usage Data:</strong> Information about how you interact with our Website, such as IP address, browser type, pages visited, and time spent on pages.</li>
        <li><strong>Cookies:</strong> Small text files stored on your device to improve your browsing experience and provide analytics.</li>
    </ul>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    2. How We Use Your Information
                </h2>
                <p class="text-gray-700 dark:text-gray-300">We use the collected information for purposes such as:</p>
                <ul class="text-gray-700 dark:text-gray-300">
        <li>Improving our content, user experience, and website performance.</li>
        <li>Sending newsletters or updates (only if you have subscribed).</li>
        <li>Analyzing traffic and usage trends to enhance site functionality.</li>
        <li>Complying with legal requirements and preventing misuse of the Website.</li>
    </ul>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    3. Cookies and Analytics
                </h2>
                <p class="text-gray-700 dark:text-gray-300">We use cookies and third-party analytics tools (such as Google Analytics) to understand how visitors use our Website. These tools may use cookies to collect anonymous traffic data. You can disable cookies in your browser settings if you prefer not to share this data, but some site features may not function properly.</p>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                    4. Google AdSense & Advertising
                </h2>
                <p class="text-gray-700 dark:text-gray-300">{{ config('app.name') }} may display Google AdSense or other third-party ads. These ad providers may use cookies and web beacons to collect non-personally identifiable information about your visits to this and other websites to provide relevant advertisements. For more details, please review <a href="https://policies.google.com/technologies/ads" target="_blank" rel="noopener noreferrer" class="text-brand-600 dark:text-brand-400 hover:underline">Google's Advertising Policy</a>.</p>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    5. Data Protection
                </h2>
                <p class="text-gray-700 dark:text-gray-300">We take reasonable technical and organizational measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction. However, please note that no method of data transmission over the Internet is completely secure.</p>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                    6. Third-Party Links
                </h2>
                <p class="text-gray-700 dark:text-gray-300">Our Website may include links to external websites that are not operated by {{ config('app.name') }}. We are not responsible for the privacy practices or content of third-party sites. We encourage you to review their privacy policies before providing any personal information.</p>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    7. AI-Assisted Content
                </h2>
                <p class="text-gray-700 dark:text-gray-300">Some articles or recommendations on {{ config('app.name') }} may be assisted by AI-based tools to improve content quality. All such content is human-reviewed for accuracy, transparency, and relevance.</p>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    8. Your Data Rights
                </h2>
                <p class="text-gray-700 dark:text-gray-300">You have the right to:</p>
                <ul class="text-gray-700 dark:text-gray-300">
        <li>Request access to or correction of your personal data.</li>
        <li>Request deletion of your personal data where applicable.</li>
        <li>Withdraw consent for marketing emails by unsubscribing anytime.</li>
    </ul>
                <p class="text-gray-700 dark:text-gray-300">To make a request, contact us using the details below.</p>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    9. Updates to This Policy
                </h2>
                <p class="text-gray-700 dark:text-gray-300">We may update this Privacy Policy periodically. Any changes will be posted on this page with an updated revision date. We encourage you to review this page regularly to stay informed about how we protect your information.</p>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    10. Contact Us
                </h2>
                <p class="text-gray-700 dark:text-gray-300">If you have any questions or concerns about this Privacy Policy, please contact us at:</p>
                <div class="bg-brand-50 dark:bg-brand-900/20 rounded-lg p-4 mt-4">
                    <ul class="list-none space-y-2 text-gray-700 dark:text-gray-300">
                        <li><strong>Email:</strong> <a href="mailto:privacy@techguidehub.site" class="text-brand-600 dark:text-brand-400 hover:underline">privacy@techguidehub.site</a></li>
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
