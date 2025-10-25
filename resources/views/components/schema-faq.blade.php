@props(['faqs'])

@if(!empty($faqs))
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    @foreach($faqs as $index => $faq)
    {
      "@type": "Question",
      "name": "{{ $faq['question'] }}",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "{{ $faq['answer'] }}"
      }
    }{{ $loop->last ? '' : ',' }}
    @endforeach
  ]
}
</script>

<div class="faq-section my-8 p-6 bg-gradient-to-br from-brand-50 to-accent-50 dark:from-gray-800 dark:to-gray-900 rounded-xl border border-brand-200 dark:border-gray-700">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
        <svg class="w-6 h-6 mr-2 text-brand-600 dark:text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        Frequently Asked Questions
    </h2>
    <div class="space-y-4" x-data="{activeIndex: null}">
        @foreach($faqs as $index => $faq)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden border border-gray-200 dark:border-gray-700">
            <button 
                @click="activeIndex = activeIndex === {{ $index }} ? null : {{ $index }}"
                class="w-full px-5 py-4 text-left flex justify-between items-center hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
            >
                <span class="font-semibold text-gray-900 dark:text-white">{{ $faq['question'] }}</span>
                <svg 
                    class="w-5 h-5 text-brand-600 dark:text-brand-400 transform transition-transform" 
                    :class="activeIndex === {{ $index }} ? 'rotate-180' : ''"
                    fill="none" 
                    stroke="currentColor" 
                    viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div 
                x-show="activeIndex === {{ $index }}"
                x-collapse
                class="px-5 py-4 bg-gray-50 dark:bg-gray-900 text-gray-700 dark:text-gray-300 border-t border-gray-200 dark:border-gray-700"
            >
                {{ $faq['answer'] }}
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

