@php
$pubId = optional(\App\Models\Setting::find('adsense.publisher_id'))->value;
@endphp
@if($pubId)
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{ $pubId }}" crossorigin="anonymous"></script>
@endif


