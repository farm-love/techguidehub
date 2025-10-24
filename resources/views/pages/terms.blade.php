@extends('layouts.app')

@section('title', 'Terms & Conditions — ' . config('app.name'))

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4 prose dark:prose-invert">
    <h1>Terms & Conditions</h1>
    <p>Welcome to {{ config('app.name') }} (the “Website”). By accessing or using this Website, you agree to comply with and be bound by the following Terms and Conditions. If you disagree with any part of these terms, please do not use our Website.</p>

    <h2>1. Use of Our Website</h2>
    <p>All content provided on {{ config('app.name') }} is for informational and educational purposes only. You agree to use this Website only for lawful purposes and in a way that does not infringe the rights of, restrict, or inhibit anyone else’s use of the Website.</p>

    <h2>2. Intellectual Property</h2>
    <p>All articles, images, code samples, designs, and other materials on this Website are the property of {{ config('app.name') }} or its content creators unless otherwise stated. Unauthorized reproduction, distribution, or modification of any material without prior written consent is strictly prohibited.</p>

    <h2>3. Accuracy of Information</h2>
    <p>We make every effort to ensure the accuracy and reliability of the content on this Website. However, {{ config('app.name') }} makes no warranties or representations about the completeness, reliability, or accuracy of the information. Any action you take based on the information found on this Website is strictly at your own risk.</p>

    <h2>4. Affiliate Disclosure</h2>
    <p>{{ config('app.name') }} may include affiliate links to products or services. When you click on these links and make a purchase, we may earn a small commission at no extra cost to you. These commissions help support our content and maintenance costs. All affiliate relationships are disclosed where applicable.</p>

    <h2>5. Sponsored Content</h2>
    <p>Occasionally, we may publish sponsored posts or product reviews. Sponsored content will always be clearly identified, and our opinions will remain unbiased and authentic to maintain trust with our readers.</p>

    <h2>6. AI-Assisted Content</h2>
    <p>Some content on {{ config('app.name') }} may be generated or enhanced with the assistance of artificial intelligence tools. All AI-generated content is carefully reviewed, edited, and fact-checked by our team to ensure accuracy, relevance, and compliance with editorial standards.</p>

    <h2>7. External Links</h2>
    <p>Our Website may contain links to third-party websites that are not owned or controlled by {{ config('app.name') }}. We have no control over and assume no responsibility for the content, privacy policies, or practices of any third-party websites or services.</p>

    <h2>8. Limitation of Liability</h2>
    <p>{{ config('app.name') }} and its contributors will not be held liable for any losses or damages arising from the use of our Website, including but not limited to indirect, incidental, or consequential damages.</p>

    <h2>9. Changes to These Terms</h2>
    <p>We may update or revise these Terms & Conditions at any time without prior notice. Changes will take effect immediately upon posting on this page. We encourage users to review this page periodically to stay informed.</p>

    <h2>10. Contact Us</h2>
    <p>If you have any questions, concerns, or requests regarding these Terms & Conditions, please contact us at:</p>
    <ul>
        <li><strong>Email:</strong> support@{{ Str::slug(config('app.name')) }}.site</li>
        <li><strong>Contact Form:</strong> <a href="{{ url('/contact') }}">{{ url('/contact') }}</a></li>
    </ul>

    <p class="mt-6 text-sm text-gray-600">Last updated: {{ now()->format('F j, Y') }}</p>
</div>
@endsection
