@extends('layouts.app')

@section('title', $tool->name . ' — Tool Review')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-2">{{ $tool->name }}</h1>
    <p class="text-sm text-gray-500 mb-4">Rating: {{ $tool->rating }}/5</p>
    @if($tool->image)
        <img class="rounded mb-6 w-full" src="{{ $tool->image }}" alt="{{ $tool->name }}" />
    @endif
    @if($tool->affiliate_link)
        <a class="inline-block bg-green-600 text-white px-4 py-2 rounded mb-6" href="{{ $tool->affiliate_link }}" target="_blank" rel="nofollow sponsored noopener">Buy / Try Now</a>
    @endif
    <div class="prose max-w-none">{!! nl2br(e($tool->description)) !!}</div>
</div>
@endsection


