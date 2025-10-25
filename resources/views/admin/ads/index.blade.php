@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-brand-600 to-accent-600 bg-clip-text text-transparent">Ads Management</h1>
            <p class="text-gray-600 dark:text-gray-300 mt-1">Manage AdSense placements and custom ads</p>
        </div>
        <a href="{{ route('admin.ads.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-brand-600 to-accent-600 hover:from-brand-700 hover:to-accent-700 text-white text-sm font-medium rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            New Ad
        </a>
    </div>

    <!-- Success Message -->
    @if(session('status') || session('success'))
    <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-xl p-4 flex items-center space-x-3">
        <svg class="h-5 w-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        <p class="text-sm font-medium text-green-800 dark:text-green-100">{{ session('status') ?? session('success') }}</p>
    </div>
    @endif

    <!-- Ads Grid -->
    <div class="grid grid-cols-1 gap-6">
        @forelse($ads as $ad)
        <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-6">
                <div class="flex flex-col sm:flex-row items-start justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="p-3 bg-gradient-to-br from-brand-600 to-accent-600 rounded-xl">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $ad->name }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Position: <span class="font-medium">{{ $ad->position }}</span></p>
                            </div>
                        </div>

                        @if($ad->description)
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ $ad->description }}</p>
                        @endif

                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                @if($ad->is_active) bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300
                                @else bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300
                                @endif">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    @if($ad->is_active)
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    @else
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    @endif
                                </svg>
                                {{ $ad->is_active ? 'Active' : 'Inactive' }}
                            </span>
                            
                            @if($ad->slot_id)
                            <span class="inline-flex items-center px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 rounded-full text-xs font-medium">
                                AdSense
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1 bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300 rounded-full text-xs font-medium">
                                Custom HTML
                            </span>
                            @endif
                        </div>

                        @if($ad->slot_id)
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3">
                            <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Slot ID:</p>
                            <code class="text-xs font-mono text-gray-900 dark:text-gray-100">{{ $ad->slot_id }}</code>
                        </div>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center space-x-2 flex-shrink-0">
                        <a href="{{ route('admin.ads.edit', $ad) }}" class="p-2 text-gray-400 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-brand-50 dark:hover:bg-brand-900/20 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <form action="{{ route('admin.ads.destroy', $ad) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this ad?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-12">
            <div class="text-center">
                <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">No ads configured</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">Start monetizing your site by creating ad placements.</p>
                <a href="{{ route('admin.ads.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-brand-600 to-accent-600 hover:from-brand-700 hover:to-accent-700 text-white rounded-lg font-medium shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create Your First Ad
                </a>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($ads->hasPages())
    <div class="flex justify-center">
        {{ $ads->links() }}
    </div>
    @endif

    <!-- Help Section -->
    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-2xl p-6 border border-blue-200 dark:border-blue-800">
        <div class="flex items-start space-x-3">
            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <h4 class="text-sm font-bold text-gray-900 dark:text-white mb-2">Ad Placement Tips</h4>
                <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                    <li>• Active ads will automatically display on your site based on their position</li>
                    <li>• Make sure to configure your AdSense Publisher ID in Settings</li>
                    <li>• Popular positions: header, in_article_middle, sidebar_top</li>
                    <li>• Inactive ads won't appear even if the position is called in templates</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
