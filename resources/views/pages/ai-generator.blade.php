@extends('layouts.app')

@section('title', 'AI Post Generator — ' . config('app.name'))

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-4">AI Post Generator</h1>
    <form id="aiForm" class="space-y-4">
        <div>
            <label class="block text-sm font-medium">Topic</label>
            <input name="topic" required class="border rounded w-full px-3 py-2" placeholder="e.g., Laravel caching best practices">
        </div>
        <div>
            <label class="block text-sm font-medium">Outline (optional)</label>
            <textarea name="outline" class="border rounded w-full px-3 py-2" rows="4"></textarea>
        </div>
        <div>
            <label class="block text-sm font-medium">Tone (optional)</label>
            <input name="tone" class="border rounded w-full px-3 py-2" placeholder="e.g., friendly, professional">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Generate</button>
    </form>
    <div id="result" class="prose max-w-none mt-8"></div>
</div>

<script>
    document.getElementById('aiForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const form = e.target;
        const payload = { topic: form.topic.value, outline: form.outline.value, tone: form.tone.value };
        const res = await fetch('{{ url('/api/ai-generator') }}', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(payload) });
        const data = await res.json();
        document.getElementById('result').innerHTML = data.html || '<p>Failed to generate content.</p>';
    });
</script>
@endsection


