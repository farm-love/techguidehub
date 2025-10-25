@props(['comment', 'postSlug', 'level' => 0])

<div class="comment-item {{ $level > 0 ? 'ml-8 md:ml-12' : '' }}">
    <div class="flex gap-4">
        <!-- Avatar -->
        <div class="flex-shrink-0">
            <div class="w-10 h-10 bg-gradient-to-br from-brand-600 to-accent-600 rounded-full flex items-center justify-center shadow-sm">
                <span class="text-sm font-bold text-white">{{ substr($comment->user->name, 0, 1) }}</span>
            </div>
        </div>

        <!-- Comment Content -->
        <div class="flex-1 min-w-0">
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                <div class="flex items-start justify-between mb-2">
                    <div>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $comment->user->name }}</span>
                        @if($comment->user->role === 'admin')
                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-brand-100 dark:bg-brand-900/30 text-brand-800 dark:text-brand-300">
                            Admin
                        </span>
                        @endif
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                            {{ $comment->created_at->diffForHumans() }}
                        </div>
                    </div>

                    @auth
                    @if(Auth::id() === $comment->user_id || Auth::user()->role === 'admin')
                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                    @endif
                    @endauth
                </div>

                <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed">{{ $comment->content }}</p>
            </div>

            <!-- Reply Button -->
            @auth
            @if($level < 2)
            <button 
                @click="activeReply = activeReply === {{ $comment->id }} ? null : {{ $comment->id }}"
                x-data="{activeReply: null}"
                class="mt-2 text-sm text-brand-600 dark:text-brand-400 hover:text-brand-700 dark:hover:text-brand-300 font-medium flex items-center"
            >
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                </svg>
                Reply
            </button>

            <!-- Reply Form -->
            <div x-show="activeReply === {{ $comment->id }}" x-collapse class="mt-4" x-data="{activeReply: null}">
                <form action="{{ route('comments.store', $postSlug) }}" method="POST" class="space-y-3">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    <textarea 
                        name="content" 
                        rows="3" 
                        class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 dark:bg-gray-700 dark:text-white"
                        placeholder="Write a reply..."
                        required
                        minlength="3"
                        maxlength="1000"
                    ></textarea>
                    <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white text-sm font-medium rounded-lg transition-colors">
                            Post Reply
                        </button>
                        <button type="button" @click="activeReply = null" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg transition-colors">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
            @endif
            @endauth

            <!-- Nested Replies -->
            @if($comment->replies->isNotEmpty() && $level < 2)
            <div class="mt-4 space-y-4">
                @foreach($comment->replies as $reply)
                    <x-comment-item :comment="$reply" :postSlug="$postSlug" :level="$level + 1" />
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>

