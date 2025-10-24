<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 p-6 lg:p-8">
                    <!-- Left: summary -->
                    <aside class="lg:col-span-4">
                        <div class="flex flex-col items-center text-center gap-4">
                            @php
                                $avatarUrl = $user->avatar ? asset('storage/' . $user->avatar) : null;
                            @endphp
                            <div class="w-32 h-32 rounded-full overflow-hidden bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                                @if($avatarUrl)
                                    <img src="{{ $avatarUrl }}" alt="avatar" class="w-full h-full object-cover" />
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12a5 5 0 100-10 5 5 0 000 10zm-8 7a8 8 0 1116 0H2z"/></svg>
                                @endif
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $user->name }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                            </div>

                            <div class="w-full mt-4">
                                <p class="text-sm text-gray-700 dark:text-gray-300">{{ $user->bio }}</p>
                            </div>
                        </div>
                    </aside>

                    <!-- Right: tabs and content -->
                    <div class="lg:col-span-8">
                        <div x-data="{ tab: 'profile' }" class="space-y-6">
                            <nav class="flex gap-2 bg-gray-50 dark:bg-gray-900 p-2 rounded-md" aria-label="Tabs">
                                <button :class="tab === 'profile' ? 'bg-white dark:bg-gray-800 shadow' : 'hover:bg-gray-100 dark:hover:bg-gray-800'" @click="tab = 'profile'" class="px-4 py-2 rounded-md text-sm font-medium">{{ __('Profile') }}</button>
                                <button :class="tab === 'security' ? 'bg-white dark:bg-gray-800 shadow' : 'hover:bg-gray-100 dark:hover:bg-gray-800'" @click="tab = 'security'" class="px-4 py-2 rounded-md text-sm font-medium">{{ __('Security') }}</button>
                                <button :class="tab === 'danger' ? 'bg-white dark:bg-gray-800 shadow' : 'hover:bg-gray-100 dark:hover:bg-gray-800'" @click="tab = 'danger'" class="px-4 py-2 rounded-md text-sm font-medium text-red-600">{{ __('Danger Zone') }}</button>
                            </nav>

                            <div class="p-4 bg-white dark:bg-gray-800 rounded-md shadow-sm">
                                <div x-show="tab === 'profile'" x-cloak>
                                    @include('profile.partials.update-profile-information-form')
                                </div>

                                <div x-show="tab === 'security'" x-cloak>
                                    @include('profile.partials.update-password-form')
                                </div>

                                <div x-show="tab === 'danger'" x-cloak>
                                    @include('profile.partials.delete-user-form')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
