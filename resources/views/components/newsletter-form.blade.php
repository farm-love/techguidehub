<form method="POST" action="{{ route('newsletter.subscribe') }}" class="flex flex-col sm:flex-row gap-2" x-data="{ subscribed: false, error: false }" @submit.prevent="
    fetch($el.action, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content },
        body: JSON.stringify({ email: $refs.email.value })
    })
    .then(r => r.ok ? subscribed = true : error = true)
    .catch(() => error = true)
">
    @csrf
    <div class="flex-1">
        <input 
            x-ref="email"
            name="email" 
            type="email" 
            placeholder="your@email.com" 
            required 
            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all"
            :disabled="subscribed"
        />
    </div>
    <button 
        type="submit" 
        class="px-6 py-2.5 bg-gradient-to-r from-brand-600 to-accent-600 hover:from-brand-700 hover:to-accent-700 text-white font-medium rounded-lg transition-all duration-200 hover:shadow-lg hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed whitespace-nowrap"
        :disabled="subscribed"
    >
        <span x-show="!subscribed">Subscribe</span>
        <span x-show="subscribed" class="flex items-center">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Subscribed!
        </span>
    </button>
    <p x-show="error" x-cloak class="text-sm text-red-600 dark:text-red-400 mt-2">Something went wrong. Please try again.</p>
</form>


