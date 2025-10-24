@extends('layouts.app')

@section('title', 'Privacy Policy — ' . config('app.name'))

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4 prose dark:prose-invert">
    <h1>Privacy Policy</h1>
    <p>At {{ config('app.name') }}, accessible from {{ url('/') }}, we value your privacy. This Privacy Policy explains how we collect, use, and protect your personal information when you visit our Website.</p>

    <h2>1. Information We Collect</h2>
    <p>We may collect the following types of information:</p>
    <ul>
        <li><strong>Personal Information:</strong> Such as your name and email address when you subscribe to our newsletter, comment on posts, or contact us.</li>
        <li><strong>Usage Data:</strong> Information about how you interact with our Website, such as IP address, browser type, pages visited, and time spent on pages.</li>
        <li><strong>Cookies:</strong> Small text files stored on your device to improve your browsing experience and provide analytics.</li>
    </ul>

    <h2>2. How We Use Your Information</h2>
    <p>We use the collected information for purposes such as:</p>
    <ul>
        <li>Improving our content, user experience, and website performance.</li>
        <li>Sending newsletters or updates (only if you have subscribed).</li>
        <li>Analyzing traffic and usage trends to enhance site functionality.</li>
        <li>Complying with legal requirements and preventing misuse of the Website.</li>
    </ul>

    <h2>3. Cookies and Analytics</h2>
    <p>We use cookies and third-party analytics tools (such as Google Analytics) to understand how visitors use our Website. These tools may use cookies to collect anonymous traffic data. You can disable cookies in your browser settings if you prefer not to share this data, but some site features may not function properly.</p>

    <h2>4. Google AdSense & Advertising</h2>
    <p>{{ config('app.name') }} may display Google AdSense or other third-party ads. These ad providers may use cookies and web beacons to collect non-personally identifiable information about your visits to this and other websites to provide relevant advertisements. For more details, please review <a href="https://policies.google.com/technologies/ads" target="_blank" rel="noopener noreferrer">Google’s Advertising Policy</a>.</p>

    <h2>5. Data Protection</h2>
    <p>We take reasonable technical and organizational measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction. However, please note that no method of data transmission over the Internet is completely secure.</p>

    <h2>6. Third-Party Links</h2>
    <p>Our Website may include links to external websites that are not operated by {{ config('app.name') }}. We are not responsible for the privacy practices or content of third-party sites. We encourage you to review their privacy policies before providing any personal information.</p>

    <h2>7. AI-Assisted Content</h2>
    <p>Some articles or recommendations on {{ config('app.name') }} may be assisted by AI-based tools to improve content quality. All such content is human-reviewed for accuracy, transparency, and relevance.</p>

    <h2>8. Your Data Rights</h2>
    <p>You have the right to:</p>
    <ul>
        <li>Request access to or correction of your personal data.</li>
        <li>Request deletion of your personal data where applicable.</li>
        <li>Withdraw consent for marketing emails by unsubscribing anytime.</li>
    </ul>
    <p>To make a request, contact us using the details below.</p>

    <h2>9. Updates to This Policy</h2>
    <p>We may update this Privacy Policy periodically. Any changes will be posted on this page with an updated revision date. We encourage you to review this page regularly to stay informed about how we protect your information.</p>

    <h2>10. Contact Us</h2>
    <p>If you have any questions or concerns about this Privacy Policy, please contact us at:</p>
    <ul>
        <li><strong>Email:</strong> privacy@{{ Str::slug(config('app.name')) }}.site</li>
        <li><strong>Contact Form:</strong> <a href="{{ url('/contact') }}">{{ url('/contact') }}</a></li>
    </ul>

    <p class="mt-6 text-sm text-gray-600">Last updated: {{ now()->format('F j, Y') }}</p>
</div>
@endsection
