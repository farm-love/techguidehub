<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <!-- Inline theme initializer: set dark class before CSS loads to avoid FOUC -->
    <script>
        (function () {
            try {
                var theme = localStorage.getItem('theme');
                if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } catch (e) {
                // ignore
            }
        })();
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>
    @hasSection('meta')
        @yield('meta')
    @else
        <meta name="description" content="@yield('meta_description', config('app.name') . ' — Tutorials and Guides')">
    @endif
    <x-ga4 />
    <x-adsense />

    <!-- Prevent flash of incorrect theme -->
    <script>
        (function() {
            try {
                var theme = localStorage.getItem('theme');
                if (theme === 'dark' || (!theme && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } catch (e) {
                // ignore
            }
        })();
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-full bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 font-sans antialiased">
    <div class="min-h-full">
        @include('layouts.navigation')

    <!-- Page Heading: prefer component slot ($header) when using &lt;x-app-layout&gt;, fall back to sections -->
        @if(!empty(trim($header ?? '')))
            <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {!! $header !!}
                </div>
            </header>
        @elseif(View::hasSection('header'))
            <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <!-- Ensure main content has an explicit light background so body-level backgrounds
             or theme overrides don't create a dark band in light mode. Use transparent in
             dark mode so the site's dark background is still visible when intended. -->
        <main class="flex-1 bg-white dark:bg-transparent">
            {{-- prefer default component slot ($slot) when present, otherwise fall back to section('content') --}}
            @php $slotString = trim((string) ($slot ?? '')); @endphp
            @if(!empty($slotString))
                {!! $slot !!}
            @else
                @yield('content')
            @endif
        </main>
        
        @include('layouts.footer')
    </div>
    {{-- Small enhancements for tutorials: code copy buttons and heading anchors for TOC/navigation --}}
    <script>
        (function(){
            // Add copy buttons to all code blocks
            function addCopyButtons() {
                document.querySelectorAll('pre > code').forEach(function(code){
                    var pre = code.parentNode;
                    if (pre.querySelector('.copy-btn')) return; // already added
                    var btn = document.createElement('button');
                    btn.className = 'copy-btn absolute top-2 end-2 bg-white dark:bg-gray-700 border rounded px-2 py-1 text-xs';
                    btn.type = 'button';
                    btn.innerText = 'Copy';
                    btn.addEventListener('click', function(){
                        navigator.clipboard.writeText(code.innerText).then(function(){
                            btn.innerText = 'Copied';
                            setTimeout(function(){ btn.innerText = 'Copy'; }, 1500);
                        }).catch(function(){
                            btn.innerText = 'Copy';
                        });
                    });
                    pre.style.position = 'relative';
                    pre.appendChild(btn);
                });
            }

            // Add heading IDs for TOC (h2-h4) but do not append a visible icon
            function addHeadingAnchors(){
                var container = document.querySelector('main');
                if(!container) return;
                ['h2','h3','h4'].forEach(function(tag){
                    container.querySelectorAll(tag).forEach(function(h){
                        // only ensure an id exists; avoid appending icons to headings
                        if (!h.id) {
                            var id = h.textContent.trim().toLowerCase().replace(/[^a-z0-9]+/g, '-');
                            h.id = id;
                        }
                    });
                });
            }

            document.addEventListener('DOMContentLoaded', function(){
                addCopyButtons();
                addHeadingAnchors();
            });
        })();
    </script>
</body>
</html>
