@props(['post'])

<div class="comments-section mt-12 no-print" id="comments">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 sm:p-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
            <svg class="w-6 h-6 mr-2 text-brand-600 dark:text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
            </svg>
            Comments ({{ $post->allComments()->approved()->count() }})
        </h2>

        @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg text-green-800 dark:text-green-300">
            {{ session('success') }}
        </div>
        @endif

        @auth
        <!-- Comment Form -->
        <div class="mb-8">
            <form action="{{ route('comments.store', $post) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="comment-content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Leave a comment
                    </label>
                    <textarea 
                        name="content" 
                        id="comment-content" 
                        rows="4" 
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 dark:bg-gray-700 dark:text-white"
                        placeholder="Share your thoughts..."
                        required
                        minlength="3"
                        maxlength="1000"
                    ></textarea>
                    @error('content')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-500 dark:text-gray-400">
                        3-1000 characters
                    </span>
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-brand-600 to-accent-600 hover:from-brand-700 hover:to-accent-700 text-white font-semibold rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        Post Comment
                    </button>
                </div>
            </form>
        </div>
        @else
        <div class="mb-8 p-4 bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-700 rounded-lg text-center">
            <p class="text-gray-700 dark:text-gray-300">
                <a href="{{ route('login') }}" class="text-brand-600 dark:text-brand-400 hover:underline font-semibold">Log in</a> or 
                <a href="{{ route('register') }}" class="text-brand-600 dark:text-brand-400 hover:underline font-semibold">register</a> 
                to leave a comment
            </p>
        </div>
        @endauth

        <!-- Comments List -->
        <div class="space-y-6">
            @forelse($post->comments as $comment)
                <x-comment-item :comment="$comment" :postSlug="$post->slug" />
            @empty
                <div class="text-center py-8">
                    <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <p class="text-gray-600 dark:text-gray-400 text-lg font-medium">No comments yet</p>
                    <p class="text-gray-500 dark:text-gray-500 text-sm mt-1">Be the first to share your thoughts!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

