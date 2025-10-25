@props(['items' => []])
<nav {{ $attributes->merge(['class' => 'text-sm mb-4']) }} aria-label="Breadcrumb">
    <ol class="flex items-center flex-wrap gap-2">
        <li>
            <a href="/" class="text-gray-700 dark:text-gray-300 hover:text-brand-600 dark:hover:text-brand-400 transition-colors inline-flex items-center font-medium">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Home
            </a>
        </li>
        @foreach($items as $item)
            <li class="text-gray-500 dark:text-gray-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
            </li>
            @if(isset($item['url']))
                <li>
                    <a href="{{ $item['url'] }}" class="text-gray-700 dark:text-gray-300 hover:text-brand-600 dark:hover:text-brand-400 transition-colors font-medium">
                        {{ $item['label'] }}
                    </a>
                </li>
            @else
                <li aria-current="page" class="text-gray-900 dark:text-white font-semibold">
                    {{ $item['label'] }}
                </li>
            @endif
        @endforeach
    </ol>
</nav>
