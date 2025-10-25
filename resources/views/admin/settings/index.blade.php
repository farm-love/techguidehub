@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold bg-gradient-to-r from-brand-600 to-accent-600 bg-clip-text text-transparent">Settings</h1>
        <p class="text-gray-600 dark:text-gray-300 mt-1">Configure your site and integrations</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-xl p-4 flex items-center space-x-3">
        <svg class="h-5 w-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        <p class="text-sm font-medium text-green-800 dark:text-green-100">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Settings Sections -->
    <div class="space-y-6">
        <!-- Site Settings -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-brand-50 to-accent-50 dark:from-gray-700 dark:to-gray-700">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-brand-600 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Site Settings</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Basic site configuration</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.settings.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="site_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Site Name</label>
                            <input type="text" name="key" value="site.name" hidden>
                            <input type="text" name="value" id="site_name" value="{{ optional(\App\Models\Setting::find('site.name'))->value ?? config('app.name') }}"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-colors">
                        </div>
                        <div>
                            <label for="site_tagline" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Site Tagline</label>
                            <input type="text" name="key" value="site.tagline" hidden>
                            <input type="text" name="value" id="site_tagline" value="{{ optional(\App\Models\Setting::find('site.tagline'))->value }}"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-colors">
                        </div>
                    </div>
                    <div class="flex justify-end pt-4">
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-brand-600 to-accent-600 hover:from-brand-700 hover:to-accent-700 text-white rounded-lg font-medium shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- AdSense Settings -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-700 dark:to-gray-700">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-green-600 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">AdSense Settings</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Google AdSense monetization</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.settings.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="adsense_publisher_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">AdSense Publisher ID</label>
                        <input type="text" name="key" value="adsense.publisher_id" hidden>
                        <input type="text" name="value" id="adsense_publisher_id" value="{{ optional(\App\Models\Setting::find('adsense.publisher_id'))->value }}"
                            placeholder="ca-pub-XXXXXXXXXXXXXXX"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Your Google AdSense publisher ID (starts with ca-pub-)</p>
                    </div>
                    <div class="flex justify-end pt-4">
                        <button type="submit" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- SEO Settings -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-purple-50 to-pink-50 dark:from-gray-700 dark:to-gray-700">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-purple-600 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">SEO Settings</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Search engine optimization</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.settings.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="seo_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Default Meta Description</label>
                            <input type="text" name="key" value="seo.default_description" hidden>
                            <textarea name="value" id="seo_description" rows="3"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors">{{ optional(\App\Models\Setting::find('seo.default_description'))->value }}</textarea>
                        </div>
                        <div>
                            <label for="seo_keywords" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Default Keywords</label>
                            <input type="text" name="key" value="seo.default_keywords" hidden>
                            <input type="text" name="value" id="seo_keywords" value="{{ optional(\App\Models\Setting::find('seo.default_keywords'))->value }}"
                                placeholder="keyword1, keyword2, keyword3"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors">
                        </div>
                    </div>
                    <div class="flex justify-end pt-4">
                        <button type="submit" class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-medium shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- All Settings Table -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">All Settings</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">View and manage all configuration values</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Key</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Value</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Updated</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($settings as $setting)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $setting->key }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400 max-w-xs truncate">{{ Str::limit($setting->value, 50) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $setting->updated_at->format('M j, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form action="{{ route('admin.settings.destroy', $setting) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this setting?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <p class="font-medium">No settings configured yet</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
