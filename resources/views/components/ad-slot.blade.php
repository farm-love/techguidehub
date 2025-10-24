@props(['position' => 'default'])
@php
    $ad = \App\Models\Ad::where('position', $position)->where('is_active', true)->orderByDesc('id')->first();
@endphp

@if($ad && $ad->script)
    <div {!! $attributes->merge(['class' => 'w-full']) !!}>
        {!! $ad->script !!}
    </div>
@else
    {{-- default placeholder with explicit theme-aware colors --}}
    <div {{ $attributes->merge(['class' => 'w-full p-4 rounded bg-gray-100 dark:bg-gray-800 text-center text-sm text-gray-800 dark:text-gray-200 ring-1 ring-gray-50 dark:ring-gray-700']) }}>
        <div class="font-semibold text-gray-900 dark:text-gray-100">Ad / Affiliate Slot</div>
        <div class="text-xs text-gray-600 dark:text-gray-300">Position: {{ $position }}</div>
    </div>
@endif


