<article {{ $attributes->merge(['class' => 'card card-compact bg-base-100 shadow hover:shadow-lg transition']) }}>
    <div class="card-body">
        <h3 class="card-title text-lg font-semibold">
            <a href="{{ $url ?? '#' }}" class="hover:underline">{{ $title }}</a>
        </h3>
        <p class="text-sm text-gray-500">{{ $meta ?? '' }}</p>
        <p class="mt-2 text-gray-700 line-clamp-3">{{ $excerpt ?? '' }}</p>
        <div class="card-actions justify-end mt-4">
            <a href="{{ $url ?? '#' }}" class="btn btn-primary btn-sm">Read</a>
        </div>
    </div>
</article>
