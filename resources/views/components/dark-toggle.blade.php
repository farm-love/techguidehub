<button id="darkToggle" aria-pressed="false" class="px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-200">
    <span id="darkToggle-moon" class="">🌙</span>
    <span id="darkToggle-sun" class="hidden">☀️</span>
</button>
<script>
    (function(){
        const key = 'theme';
        const root = document.documentElement;
        const btn = document.getElementById('darkToggle');
        const moon = document.getElementById('darkToggle-moon');
        const sun = document.getElementById('darkToggle-sun');

        const apply = (t) => {
            if (t === 'dark') {
                root.classList.add('dark');
                btn.setAttribute('aria-pressed', 'true');
                moon.classList.add('hidden');
                sun.classList.remove('hidden');
            } else {
                root.classList.remove('dark');
                btn.setAttribute('aria-pressed', 'false');
                moon.classList.remove('hidden');
                sun.classList.add('hidden');
            }
        };

        const stored = localStorage.getItem(key) || (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        apply(stored);

        btn.addEventListener('click', () => {
            const next = root.classList.contains('dark') ? 'light' : 'dark';
            localStorage.setItem(key, next);
            apply(next);
        });
    })();
</script>


