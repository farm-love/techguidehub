<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex">
            <!-- Left Side - Branding -->
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-brand-600 to-accent-600 dark:from-brand-900 dark:to-accent-900 p-12 flex-col justify-between">
                <div>
                    <a href="/" class="inline-flex items-center space-x-3 mb-12">
                        <div class="w-14 h-14 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center">
                            <span class="text-white font-bold text-2xl">T</span>
                        </div>
                        <span class="text-2xl font-bold text-white">{{ config('app.name') }}</span>
                    </a>
                    
                    <div class="max-w-md">
                        <h2 class="text-4xl font-extrabold text-white mb-6">
                            Welcome to the future of tech learning
                        </h2>
                        <p class="text-xl text-blue-100 mb-8">
                            Join thousands of developers and tech enthusiasts discovering the latest tutorials, tools, and insights.
                        </p>
                        
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3 text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>Expert tutorials and guides</span>
                            </div>
                            <div class="flex items-center space-x-3 text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>Latest tech news and updates</span>
                            </div>
                            <div class="flex items-center space-x-3 text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>Developer tools and resources</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-blue-100 text-sm">
                    © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </div>
            </div>

            <!-- Right Side - Form -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-gray-50 dark:bg-gray-900">
                <div class="w-full max-w-md">
                    <!-- Mobile Logo -->
                    <div class="lg:hidden mb-8 text-center">
                        <a href="/" class="inline-flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-brand-600 to-accent-600 rounded-xl flex items-center justify-center">
                                <span class="text-white font-bold text-xl">T</span>
                            </div>
                            <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ config('app.name') }}</span>
                        </a>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-8">
                        {{ $slot }}
                    </div>

                    <!-- Additional Links -->
                    <div class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
                        <a href="/" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">← Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
