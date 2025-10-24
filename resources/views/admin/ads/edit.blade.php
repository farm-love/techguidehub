@extends('layouts.app')

@section('title', 'Edit Ad')

@section('content')
    <div class="max-w-3xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-4">Edit Ad</h1>
        <form method="POST" action="{{ route('admin.ads.update', $ad) }}">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label class="block mb-1">Name</label>
                <input name="name" value="{{ $ad->name }}" class="input input-bordered w-full" required />
            </div>
            <div class="mb-3">
                <label class="block mb-1">Position</label>
                <input name="position" value="{{ $ad->position }}" class="input input-bordered w-full" required />
            </div>
            <div class="mb-3">
                <label class="block mb-1">Script (HTML / JS)</label>
                <textarea name="script" class="textarea textarea-bordered w-full" rows="6">{{ $ad->script }}</textarea>
            </div>
            <div class="mb-3">
                <label class="inline-flex items-center gap-2"><input type="checkbox" name="is_active" class="checkbox" {{ $ad->is_active ? 'checked' : '' }} /> Active</label>
            </div>
            <div class="flex gap-2">
                <button class="btn btn-primary">Save</button>
                <a href="{{ route('admin.ads.index') }}" class="btn">Cancel</a>
            </div>
        </form>
    </div>
@endsection
