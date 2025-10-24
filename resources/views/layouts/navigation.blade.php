<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 shadow-sm border-b border-gray-100 dark:border-gray-800">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14 items-center">
            <!-- Left: Logo -->
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">T</span>
                        </div>
                        <span class="text-lg font-semibold text-gray-900 dark:text-white">{{ config('app.name') }}</span>
                    </a>
                </div>
            </div>

            <!-- Center: Navigation links -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6 sm:mx-auto">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-nav-link>

                @php $headerCategories = \App\Models\Category::orderBy('name')->take(8)->get(); @endphp
                @if($headerCategories->isNotEmpty())
                    <div x-data="{open:false}" class="relative">
                        <button @click="open=!open" @keydown.escape="open=false" aria-haspopup="true" :aria-expanded="open ? 'true' : 'false'" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none">
                            Categories
                            <svg class="ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-cloak @click.away="open = false" class="absolute z-50 mt-2 w-56 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded shadow-lg py-2">
                            @foreach($headerCategories as $cat)
                                <a href="{{ route('categories.show', $cat) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">{{ $cat->name }}</a>
                            @endforeach
                            <div class="border-t border-gray-100 dark:border-gray-700 mt-2">
                                <a href="{{ route('categories.index') }}" class="block px-4 py-2 text-sm text-blue-600 dark:text-blue-400">View all categories</a>
                            </div>
                        </div>
                    </div>
                @else
                    <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">Categories</x-nav-link>
                @endif

                <x-nav-link :href="route('about')" :active="request()->routeIs('about')">About</x-nav-link>
                <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">Contact</x-nav-link>
                @if (Route::has('tools.index'))
                    <x-nav-link :href="route('tools.index')" :active="request()->routeIs('tools.*')">Tools</x-nav-link>
                @endif
                @auth
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'author')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->is('admin/*')">Admin</x-nav-link>
                    @endif
                @endauth
            </div>

            <!-- Right: Search, theme toggle, user/settings, mobile hamburger -->
            <div class="flex items-center space-x-4">
                @php
                    $searchAction = Route::has('search') ? route('search') : (Route::has('posts.index') ? route('posts.index') : url('/'));
                @endphp
                <form action="{{ $searchAction }}" method="GET" role="search" class="hidden md:block me-2">
                    <label for="q" class="sr-only">Search</label>
                    <div class="relative">
                        {{-- compact input + extra right padding so icon sits comfortably inside --}}
                        <input id="q" name="q" type="search" placeholder="Search tutorials, posts..." value="{{ request('q') }}" class="w-36 rounded-md border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm px-3 pr-10 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        {{-- icon inside input, positioned inward and above other controls --}}
                        <button type="submit" class="absolute end-3 top-1/2 -translate-y-1/2 z-30 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-100" aria-label="Search">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
                        </button>
                    </div>
                </form>

                <div class="hidden sm:flex sm:items-center ms-2">
                    <x-dark-toggle />
                </div>

                @auth
                    <div class="hidden sm:flex sm:items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-700 hover:text-gray-700 dark:hover:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none transition ease-in-out duration-150">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-gray-300 dark:bg-gray-600 rounded-full flex items-center justify-center">
                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                        </div>
                                        <span>{{ Auth::user()->name }}</span>
                                    </div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">@csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">{{ __('Log Out') }}</x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <div class="hidden sm:flex sm:items-center">
                        <a href="{{ route('login') }}" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 px-3 py-2 text-sm font-medium">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium ml-2">Register</a>
                    </div>
                @endauth

                <!-- Mobile hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-700 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-3">
            @php $mobileCategories = \App\Models\Category::orderBy('name')->take(12)->get(); @endphp

            <!-- Mobile search -->
            @php
                $searchAction = Route::has('search') ? route('search') : (Route::has('posts.index') ? route('posts.index') : url('/'));
            @endphp
            <form action="{{ $searchAction }}" method="GET" role="search" class="px-4">
                <label for="mq" class="sr-only">Search</label>
                <div class="relative">
                    <input id="mq" name="q" type="search" placeholder="Search posts & tutorials" value="{{ request('q') }}" class="w-full rounded-md border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm px-3 py-2 focus:outline-none" />
                </div>
            </form>

            <div class="px-2">
                <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">About</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">Contact</x-responsive-nav-link>
                @if (Route::has('tools.index'))
                    <x-responsive-nav-link :href="route('tools.index')" :active="request()->routeIs('tools.*')">Tools</x-responsive-nav-link>
                @endif
                @auth
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'author')
                        <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->is('admin/*')">Admin</x-responsive-nav-link>
                    @endif
                @endauth
            </div>

            <!-- Mobile categories quick list -->
            @if($mobileCategories->isNotEmpty())
                <div class="px-4">
                    <div class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase mb-2">Categories</div>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach($mobileCategories as $cat)
                            <a href="{{ route('categories.show', $cat) }}" class="block px-3 py-2 rounded text-sm bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200">{{ $cat->name }}</a>
                        @endforeach
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('categories.index') }}" class="text-sm text-blue-600 dark:text-blue-400">View all categories</a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        @auth
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @else
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-700">
            <div class="px-4 space-y-2">
                <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">Login</a>
                <a href="{{ route('register') }}" class="block px-3 py-2 text-base font-medium bg-blue-600 text-white rounded-md hover:bg-blue-700">Register</a>
            </div>
        </div>
        @endauth
    </div>
</nav>
