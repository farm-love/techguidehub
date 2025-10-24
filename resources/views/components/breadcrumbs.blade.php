@props(['items' => []])
<nav class="text-sm text-gray-600 mb-4" aria-label="Breadcrumb">
    <ol class="list-reset flex">
        <li><a href="/" class="hover:underline">Home</a></li>
        @foreach($items as $item)
            <li class="mx-2">/</li>
            @if(isset($item['url']))
                <li><a href="{{ $item['url'] }}" class="hover:underline">{{ $item['label'] }}</a></li>
            @else
                <li aria-current="page" class="text-gray-800">{{ $item['label'] }}</li>
            @endif
        @endforeach
    </ol>
</nav>


