@extends('layouts.app')

@section('title', 'Contact Us — ' . config('app.name'))

@section('content')
<div class="max-w-3xl mx-auto py-10 px-6">
    <h1 class="text-3xl font-extrabold mb-6 text-gray-800 dark:text-white">Contact Us</h1>
    <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed">
        We'd love to hear from you! Whether you have questions, feedback, or partnership inquiries, 
        feel free to reach out. Our team will get back to you as soon as possible.
    </p>

    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6 border border-gray-100 dark:border-gray-700">
        @if(session('success'))
    <div class="bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-400 p-3 rounded-lg mb-6 border border-green-300 dark:border-green-700">
        {{ session('success') }}
    </div>
@endif

        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Your Name</label>
                <input type="text" name="name" id="name" required
                       class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400">
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Email Address</label>
                <input type="email" name="email" id="email" required
                       class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400">
            </div>

            <div>
                <label for="subject" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Subject</label>
                <input type="text" name="subject" id="subject" 
                       class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400">
            </div>

            <div>
                <label for="message" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Message</label>
                <textarea name="message" id="message" rows="5" required
                          class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400"></textarea>
            </div>

            <div>
                <button type="submit"
                        class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                    Send Message
                </button>
            </div>
        </form>
    </div>

    <div class="mt-10">
        <h2 class="text-xl font-semibold mb-3 text-gray-800 dark:text-white">Other Ways to Reach Us</h2>
        <ul class="space-y-2 text-gray-600 dark:text-gray-300">
            <li><strong>Email:</strong> support@techguidehub.site</li>
            <li><strong>Twitter:</strong> <a href="https://twitter.com/techguidehub" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline">@techguidehub</a></li>
            <li><strong>Facebook:</strong> <a href="https://facebook.com/techguidehub" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline">facebook.com/techguidehub</a></li>
        </ul>
    </div>

    <div class="mt-8 text-gray-500 dark:text-gray-400 text-sm">
        <p>
            <strong>Note:</strong> Please allow up to 24–48 hours for our team to respond. For press or collaboration requests, 
            include detailed information about your proposal.
        </p>
    </div>
</div>
@endsection
