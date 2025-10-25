@props(['position' => 'default'])
@php
    $ad = \App\Models\Ad::where('position', $position)->where('is_active', true)->orderByDesc('id')->first();
@endphp

@if($ad && $ad->script)
    {{-- Show actual ad content --}}
    <div {!! $attributes->merge(['class' => 'w-full']) !!}>
        {!! $ad->script !!}
    </div>
@elseif(auth()->check() && auth()->user()->role === 'admin')
    {{-- Show placeholder only for admins --}}
    <div {{ $attributes->merge(['class' => 'w-full']) }}>
        <div class="bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border-2 border-dashed border-gray-300 dark:border-gray-600">
            <div class="flex flex-col items-center justify-center text-center space-y-3">
                <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                </svg>
                <div>
                    <div class="font-semibold text-gray-700 dark:text-gray-300 text-sm">Ad Placeholder (Admin Only)</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Position: {{ $position }}</div>
                    <a href="{{ route('admin.ads.create') }}" class="inline-block mt-2 px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded-lg text-xs font-medium transition-colors">
                        Configure Ad →
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif
{{-- Regular users see nothing when no ad is configured --}}
