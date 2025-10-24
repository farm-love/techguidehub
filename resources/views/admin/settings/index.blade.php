@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Settings</h1>
            <p class="text-gray-600">Manage site settings and configuration</p>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 rounded-md p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Settings Sections -->
    <div class="space-y-6">
        <!-- Site Settings -->
        <div class="bg-white shadow-sm rounded-lg border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Site Settings</h3>
                <p class="text-sm text-gray-600">Basic site configuration</p>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.settings.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="site_name" class="block text-sm font-medium text-gray-700 mb-2">Site Name</label>
                            <input type="text" name="key" value="site.name" hidden>
                            <input type="text" name="value" id="site_name" value="{{ optional(\App\Models\Setting::find('site.name'))->value ?? config('app.name') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="site_tagline" class="block text-sm font-medium text-gray-700 mb-2">Site Tagline</label>
                            <input type="text" name="key" value="site.tagline" hidden>
                            <input type="text" name="value" id="site_tagline" value="{{ optional(\App\Models\Setting::find('site.tagline'))->value }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                            Save Site Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- AdSense Settings -->
        <div class="bg-white shadow-sm rounded-lg border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">AdSense Settings</h3>
                <p class="text-sm text-gray-600">Google AdSense configuration for monetization</p>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.settings.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="adsense_publisher_id" class="block text-sm font-medium text-gray-700 mb-2">AdSense Publisher ID</label>
                        <input type="text" name="key" value="adsense.publisher_id" hidden>
                        <input type="text" name="value" id="adsense_publisher_id" value="{{ optional(\App\Models\Setting::find('adsense.publisher_id'))->value }}"
                            placeholder="ca-pub-XXXXXXXXXXXXXXX"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <p class="mt-1 text-sm text-gray-500">Your Google AdSense publisher ID (starts with ca-pub-)</p>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                            Save AdSense Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- SEO Settings -->
        <div class="bg-white shadow-sm rounded-lg border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">SEO Settings</h3>
                <p class="text-sm text-gray-600">Search engine optimization configuration</p>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.settings.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="seo_description" class="block text-sm font-medium text-gray-700 mb-2">Default Meta Description</label>
                            <input type="text" name="key" value="seo.default_description" hidden>
                            <textarea name="value" id="seo_description" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ optional(\App\Models\Setting::find('seo.default_description'))->value }}</textarea>
                        </div>
                        <div>
                            <label for="seo_keywords" class="block text-sm font-medium text-gray-700 mb-2">Default Keywords</label>
                            <input type="text" name="key" value="seo.default_keywords" hidden>
                            <input type="text" name="value" id="seo_keywords" value="{{ optional(\App\Models\Setting::find('seo.default_keywords'))->value }}"
                                placeholder="keyword1, keyword2, keyword3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                            Save SEO Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Social Media Settings -->
        <div class="bg-white shadow-sm rounded-lg border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Social Media</h3>
                <p class="text-sm text-gray-600">Social media links and sharing settings</p>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.settings.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="twitter_handle" class="block text-sm font-medium text-gray-700 mb-2">Twitter Handle</label>
                            <input type="text" name="key" value="social.twitter" hidden>
                            <input type="text" name="value" id="twitter_handle" value="{{ optional(\App\Models\Setting::find('social.twitter'))->value }}"
                                placeholder="@yourhandle"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="facebook_page" class="block text-sm font-medium text-gray-700 mb-2">Facebook Page</label>
                            <input type="text" name="key" value="social.facebook" hidden>
                            <input type="url" name="value" id="facebook_page" value="{{ optional(\App\Models\Setting::find('social.facebook'))->value }}"
                                placeholder="https://facebook.com/yourpage"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="linkedin_profile" class="block text-sm font-medium text-gray-700 mb-2">LinkedIn Profile</label>
                            <input type="text" name="key" value="social.linkedin" hidden>
                            <input type="url" name="value" id="linkedin_profile" value="{{ optional(\App\Models\Setting::find('social.linkedin'))->value }}"
                                placeholder="https://linkedin.com/in/yourprofile"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="youtube_channel" class="block text-sm font-medium text-gray-700 mb-2">YouTube Channel</label>
                            <input type="text" name="key" value="social.youtube" hidden>
                            <input type="url" name="value" id="youtube_channel" value="{{ optional(\App\Models\Setting::find('social.youtube'))->value }}"
                                placeholder="https://youtube.com/c/yourchannel"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                            Save Social Media Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- All Settings Table -->
        <div class="bg-white shadow-sm rounded-lg border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">All Settings</h3>
                <p class="text-sm text-gray-600">View and manage all site settings</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Key</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Updated</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($settings as $setting)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $setting->key }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 max-w-xs truncate">{{ Str::limit($setting->value, 50) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $setting->updated_at->format('M j, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form action="{{ route('admin.settings.destroy', $setting) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this setting?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                No settings found.
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
