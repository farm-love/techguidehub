<footer class="mt-12 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
            <div class="text-lg font-semibold text-gray-900 dark:text-white">{{ config('app.name') }}</div>
            <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">{{ optional(\App\Models\Setting::find('site.tagline'))->value }}</p>
        </div>
        <div>
            <div class="font-semibold mb-2 text-gray-900 dark:text-white">Links</div>
            <ul class="space-y-1 text-sm">
                <li><a class="hover:underline text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200" href="{{ route('about') }}">About</a></li>
                <li><a class="hover:underline text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200" href="{{ route('contact') }}">Contact</a></li>
                <li><a class="hover:underline text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200" href="{{ route('privacy') }}">Privacy</a></li>
                <li><a class="hover:underline text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200" href="{{ route('terms') }}">Terms</a></li>
                <li><a class="hover:underline text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200" href="{{ route('rss') }}">RSS</a></li>
                <li><a class="hover:underline text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200" href="{{ route('sitemap') }}">Sitemap</a></li>
            </ul>
        </div>
        <div>
            <div class="font-semibold mb-2 text-gray-900 dark:text-white">Newsletter</div>
            <x-newsletter-form />
        </div>
    </div>
    <div class="text-center text-xs text-gray-500 dark:text-gray-400 py-4">© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</div>
</footer>


