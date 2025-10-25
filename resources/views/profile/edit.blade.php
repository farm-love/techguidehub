<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Profile Header -->
            <div class="bg-gradient-to-r from-brand-600 to-accent-600 rounded-2xl shadow-xl p-8 mb-8">
                <div class="flex flex-col md:flex-row items-center gap-6">
                    @php
                        $avatarUrl = $user->avatar ? asset('storage/' . $user->avatar) : null;
                    @endphp
                    <div class="relative">
                        <div class="w-32 h-32 rounded-full overflow-hidden bg-white/20 backdrop-blur border-4 border-white/30 flex items-center justify-center">
                            @if($avatarUrl)
                                <img src="{{ $avatarUrl }}" alt="avatar" class="w-full h-full object-cover" />
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12a5 5 0 100-10 5 5 0 000 10zm-8 7a8 8 0 1116 0H2z"/>
                                </svg>
                            @endif
                        </div>
                        <button class="absolute bottom-0 right-0 p-2 bg-white rounded-full shadow-lg hover:bg-gray-100 transition-colors">
                            <svg class="w-5 h-5 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </button>
                    </div>

                    <div class="text-center md:text-left flex-1">
                        <h3 class="text-3xl font-bold text-white mb-2">{{ $user->name }}</h3>
                        <p class="text-blue-100 mb-3">{{ $user->email }}</p>
                        @if($user->bio)
                        <p class="text-white/90 max-w-2xl">{{ $user->bio }}</p>
                        @endif
                        <div class="flex flex-wrap gap-2 mt-4 justify-center md:justify-start">
                            <span class="px-3 py-1 bg-white/20 backdrop-blur rounded-full text-sm text-white font-medium">
                                {{ ucfirst($user->role ?? 'user') }}
                            </span>
                            <span class="px-3 py-1 bg-white/20 backdrop-blur rounded-full text-sm text-white">
                                Joined {{ $user->created_at->format('M Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs and Content -->
            <div x-data="{ tab: 'profile' }" class="space-y-6">
                <!-- Tab Navigation -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-2">
                    <nav class="flex flex-wrap gap-2" aria-label="Tabs">
                        <button 
                            @click="tab = 'profile'" 
                            :class="tab === 'profile' ? 'bg-gradient-to-r from-brand-600 to-accent-600 text-white shadow-lg' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700'" 
                            class="flex-1 md:flex-none px-6 py-3 rounded-xl font-medium transition-all duration-300 text-sm md:text-base">
                            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Profile Information
                        </button>
                        <button 
                            @click="tab = 'security'" 
                            :class="tab === 'security' ? 'bg-gradient-to-r from-brand-600 to-accent-600 text-white shadow-lg' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700'" 
                            class="flex-1 md:flex-none px-6 py-3 rounded-xl font-medium transition-all duration-300 text-sm md:text-base">
                            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Security
                        </button>
                        <button 
                            @click="tab = 'danger'" 
                            :class="tab === 'danger' ? 'bg-red-600 text-white shadow-lg' : 'text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20'" 
                            class="flex-1 md:flex-none px-6 py-3 rounded-xl font-medium transition-all duration-300 text-sm md:text-base">
                            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            Danger Zone
                        </button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 md:p-8">
                    <!-- Profile Information Tab -->
                    <div x-show="tab === 'profile'" x-cloak>
                        <div class="mb-6">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Profile Information</h3>
                            <p class="text-gray-600 dark:text-gray-400">Update your account's profile information and email address.</p>
                        </div>
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <!-- Security Tab -->
                    <div x-show="tab === 'security'" x-cloak>
                        <div class="mb-6">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Update Password</h3>
                            <p class="text-gray-600 dark:text-gray-400">Ensure your account is using a long, random password to stay secure.</p>
                        </div>
                        @include('profile.partials.update-password-form')
                    </div>

                    <!-- Danger Zone Tab -->
                    <div x-show="tab === 'danger'" x-cloak>
                        <div class="mb-6">
                            <h3 class="text-2xl font-bold text-red-600 dark:text-red-400 mb-2">Delete Account</h3>
                            <p class="text-gray-600 dark:text-gray-400">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                        </div>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
