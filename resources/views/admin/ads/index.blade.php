@extends('layouts.app')

@section('title', 'Manage Ads')

@section('content')
    <div class="max-w-4xl mx-auto py-8 px-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Ads</h1>
            <a href="{{ route('admin.ads.create') }}" class="btn btn-primary">New Ad</a>
        </div>

        @if(session('status'))<div class="alert alert-success mb-4">{{ session('status') }}</div>@endif

        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Active</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ads as $ad)
                        <tr>
                            <td>{{ $ad->name }}</td>
                            <td>{{ $ad->position }}</td>
                            <td>{{ $ad->is_active ? 'Yes' : 'No' }}</td>
                            <td class="text-right">
                                <a href="{{ route('admin.ads.edit', $ad) }}" class="btn btn-sm">Edit</a>
                                <form action="{{ route('admin.ads.destroy', $ad) }}" method="POST" class="inline-block ms-2">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-error" onclick="return confirm('Delete?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $ads->links() }}</div>
    </div>
@endsection
