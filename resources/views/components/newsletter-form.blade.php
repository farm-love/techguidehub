<form method="POST" action="{{ route('newsletter.subscribe') }}" class="flex flex-col sm:flex-row gap-2">
    @csrf
    <input name="email" type="email" placeholder="you@domain.com" required class="input input-bordered w-full" />
    <button type="submit" class="btn btn-primary">Subscribe</button>
</form>
<form method="POST" action="{{ route('newsletter.subscribe') }}" class="mt-8 flex gap-2">
    @csrf
    <input type="email" name="email" required placeholder="Your email" class="border rounded px-3 py-2 w-full" />
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Subscribe</button>
</form>


