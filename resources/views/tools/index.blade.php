@extends('layouts.app')

@section('title', 'Top Tools — ' . config('app.name'))

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-6">Top Tools</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($tools as $tool)
            <a class="block border rounded p-4 hover:shadow" href="{{ route('tools.show', $tool) }}">
                <div class="flex items-center gap-3">
                    @if($tool->image)
                        <img src="{{ $tool->image }}" alt="{{ $tool->name }}" class="w-12 h-12 object-cover rounded" />
                    @endif
                    <div>
                        <div class="font-semibold">{{ $tool->name }}</div>
                        <div class="text-sm text-gray-500">Rating: {{ $tool->rating }}/5</div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    <div class="mt-6">{{ $tools->links() }}</div>
</div>
@endsection


