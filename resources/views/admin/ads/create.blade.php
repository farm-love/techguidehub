@extends('layouts.app')

@section('title', 'New Ad')

@section('content')
    <div class="max-w-3xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-4">Create Ad</h1>
        <form method="POST" action="{{ route('admin.ads.store') }}">
            @csrf
            <div class="mb-3">
                <label class="block mb-1">Name</label>
                <input name="name" class="input input-bordered w-full" required />
            </div>
            <div class="mb-3">
                <label class="block mb-1">Position</label>
                <input name="position" class="input input-bordered w-full" required />
                <div class="text-xs text-gray-500 mt-1">e.g. header, sidebar_top, in_article_top, footer</div>
            </div>
            <div class="mb-3">
                <label class="block mb-1">Script (HTML / JS)</label>
                <textarea name="script" class="textarea textarea-bordered w-full" rows="6"></textarea>
            </div>
            <div class="mb-3">
                <label class="inline-flex items-center gap-2"><input type="checkbox" name="is_active" class="checkbox" /> Active</label>
            </div>
            <div class="flex gap-2">
                <button class="btn btn-primary">Save</button>
                <a href="{{ route('admin.ads.index') }}" class="btn">Cancel</a>
            </div>
        </form>
    </div>
@endsection
