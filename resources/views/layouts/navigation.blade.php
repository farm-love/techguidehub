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
                    <div x-data="{open:false}" @mouseenter="open=true" @mouseleave="open=false" class="relative">
                        <button @keydown.escape="open=false" aria-haspopup="true" :aria-expanded="open ? 'true' : 'false'" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none transition-colors">
                            Categories
                            <svg class="ms-2 h-4 w-4 transition-transform" :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             x-cloak 
                             class="absolute left-0 z-50 mt-2 w-64 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-xl py-2">
                            @foreach($headerCategories as $cat)
                                <a href="{{ route('categories.show', $cat) }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-brand-50 dark:hover:bg-gray-700 hover:text-brand-600 dark:hover:text-brand-400 transition-colors">
                                    <div class="w-8 h-8 bg-gradient-to-br from-brand-600 to-accent-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                        <span class="text-white font-bold text-xs">{{ substr($cat->name, 0, 1) }}</span>
                                    </div>
                                    <span>{{ $cat->name }}</span>
                                </a>
                            @endforeach
                            <div class="border-t border-gray-200 dark:border-gray-700 mt-2 pt-2">
                                <a href="{{ route('categories.index') }}" class="flex items-center px-4 py-2.5 text-sm text-brand-600 dark:text-brand-400 hover:bg-brand-50 dark:hover:bg-gray-700 font-medium transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                    View all categories
                                </a>
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
                {{-- Search modal trigger (replaces inline header search to avoid header collisions) --}}
                <div x-data="{ showSearch: false }" class="me-2">
                    <button @click="showSearch = true; $nextTick(() => $refs.modalInput && $refs.modalInput.focus());" aria-haspopup="dialog" aria-expanded="false" type="button" class="p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-600 dark:text-gray-300">
                        <span class="sr-only">Open search</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
                    </button>

                    <!-- Modal -->
                    <div x-show="showSearch" x-cloak x-trap.noscroll="showSearch" x-on:keydown.escape="showSearch = false" class="fixed inset-0 z-50 flex items-start md:items-center justify-center p-4">
                        <div class="fixed inset-0 bg-black/40" @click="showSearch = false" aria-hidden="true"></div>
                        <div class="relative w-full max-w-2xl bg-white dark:bg-gray-800 rounded shadow-lg p-4 z-50">
                            @php $searchAction = Route::has('search') ? route('search') : (Route::has('posts.index') ? route('posts.index') : url('/')); @endphp
                            <form action="{{ $searchAction }}" method="GET" role="search" class="flex items-center">
                                <label for="modal-q" class="sr-only">Search</label>
                                <input id="modal-q" x-ref="modalInput" name="q" type="search" placeholder="Search tutorials, posts..." value="{{ request('q') }}" class="flex-1 rounded-md border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                <button type="submit" class="ms-3 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md">Search</button>
                                <button type="button" @click="showSearch = false" class="ms-2 inline-flex items-center px-3 py-2 border rounded-md text-sm">Close</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center ms-2">
                    <x-dark-toggle />
                </div>

                @auth
                    <div class="hidden sm:flex sm:items-center" x-data="{open:false}" @mouseenter="open=true" @mouseleave="open=false">
                        <div class="relative">
                            <button class="inline-flex items-center px-3 py-2 border border-gray-200 dark:border-gray-700 text-sm leading-4 font-medium rounded-lg text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-brand-500 dark:hover:border-brand-500 focus:outline-none transition-all duration-150">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-gradient-to-br from-brand-600 to-accent-600 rounded-full flex items-center justify-center shadow-sm">
                                        <span class="text-sm font-bold text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    </div>
                                    <span>{{ Auth::user()->name }}</span>
                                </div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4 transition-transform" :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                            
                            <div x-show="open"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 x-cloak
                                 class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-xl py-2 z-50">
                                <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-brand-50 dark:hover:bg-gray-700 hover:text-brand-600 dark:hover:text-brand-400 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    {{ __('Profile') }}
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </div>
                        </div>
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
