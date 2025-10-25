@extends('layouts.app')

@section('title', 'Contact Us — ' . config('app.name'))

@section('content')
<div class="bg-gradient-to-br from-brand-600 to-accent-600 dark:from-brand-900 dark:to-accent-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-4xl lg:text-5xl font-extrabold text-white mb-4">Contact Us</h1>
        <p class="text-xl text-blue-100">We'd love to hear from you! Get in touch with our team</p>
    </div>
</div>

<div class="bg-gray-50 dark:bg-gray-900">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Contact Form -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Send us a message</h2>
                    
                    @if(session('success'))
                    <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-xl p-4 mb-6 flex items-center space-x-3">
                        <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-sm font-medium text-green-800 dark:text-green-100">{{ session('success') }}</p>
                    </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Your Name <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" required
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-colors">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address <span class="text-red-500">*</span></label>
                                <input type="email" name="email" id="email" required
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-colors">
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Subject</label>
                            <input type="text" name="subject" id="subject" 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-colors">
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Message <span class="text-red-500">*</span></label>
                            <textarea name="message" id="message" rows="6" required
                                      class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-colors"></textarea>
                        </div>

                        <button type="submit"
                                class="w-full px-6 py-4 bg-gradient-to-r from-brand-600 to-accent-600 hover:from-brand-700 hover:to-accent-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="space-y-6">
                <!-- Contact Details -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Contact Information</h3>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-600 dark:text-brand-400 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Email</p>
                                <a href="mailto:support@techguidehub.site" class="text-brand-600 dark:text-brand-400 hover:underline">support@techguidehub.site</a>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-600 dark:text-brand-400 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Response Time</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Within 24-48 hours</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="bg-gradient-to-br from-brand-600 to-accent-600 rounded-2xl shadow-xl p-6 text-white">
                    <h3 class="text-lg font-bold mb-4">Follow Us</h3>
                    <div class="space-y-3">
                        <a href="https://twitter.com/techguidehub" target="_blank" class="flex items-center space-x-3 text-blue-100 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/></svg>
                            <span>Twitter</span>
                        </a>
                        <a href="https://facebook.com/techguidehub" target="_blank" class="flex items-center space-x-3 text-blue-100 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            <span>Facebook</span>
                        </a>
                        <a href="#" target="_blank" class="flex items-center space-x-3 text-blue-100 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            <span>LinkedIn</span>
                        </a>
                    </div>
                </div>

                <!-- Note -->
                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-4 border border-blue-200 dark:border-blue-800">
                    <p class="text-sm text-gray-700 dark:text-gray-300">
                        <strong class="text-brand-600 dark:text-brand-400">Note:</strong> For press or collaboration requests, 
                        please include detailed information about your proposal in your message.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
