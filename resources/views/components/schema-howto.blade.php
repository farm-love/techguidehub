@props(['title', 'description', 'steps', 'image' => null, 'totalTime' => null])

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "HowTo",
  "name": "{{ $title }}",
  "description": "{{ $description }}",
  @if($image)
  "image": "{{ $image }}",
  @endif
  @if($totalTime)
  "totalTime": "{{ $totalTime }}",
  @endif
  "step": [
    @foreach($steps as $index => $step)
    {
      "@type": "HowToStep",
      "position": {{ $index + 1 }},
      "name": "{{ $step['name'] }}",
      "text": "{{ $step['text'] }}"
      @if(isset($step['image']))
      ,"image": "{{ $step['image'] }}"
      @endif
    }{{ $loop->last ? '' : ',' }}
    @endforeach
  ]
}
</script>

<div class="howto-section my-8 p-6 bg-gradient-to-br from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-900 rounded-xl border border-green-200 dark:border-gray-700">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2 flex items-center">
        <svg class="w-6 h-6 mr-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ $title }}
    </h2>
    <p class="text-gray-700 dark:text-gray-300 mb-6">{{ $description }}</p>
    
    @if($totalTime)
    <div class="inline-flex items-center px-3 py-1 bg-white dark:bg-gray-800 rounded-full text-sm font-medium text-gray-700 dark:text-gray-300 mb-6 border border-gray-200 dark:border-gray-700">
        <svg class="w-4 h-4 mr-1.5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        Total Time: {{ $totalTime }}
    </div>
    @endif
    
    <div class="space-y-4">
        @foreach($steps as $index => $step)
        <div class="flex gap-4 bg-white dark:bg-gray-800 rounded-lg p-5 shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-green-600 to-emerald-600 text-white rounded-full flex items-center justify-center font-bold text-lg">
                {{ $index + 1 }}
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-gray-900 dark:text-white mb-2">{{ $step['name'] }}</h3>
                <p class="text-gray-700 dark:text-gray-300">{{ $step['text'] }}</p>
                @if(isset($step['image']))
                <img src="{{ $step['image'] }}" alt="{{ $step['name'] }}" class="mt-3 rounded-lg max-w-full h-auto" loading="lazy">
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

