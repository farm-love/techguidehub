<!-- Reading Progress Bar -->
<div id="reading-progress" class="fixed top-0 left-0 right-0 h-1 bg-gradient-to-r from-brand-600 via-purple-600 to-accent-600 transform origin-left scale-x-0 transition-transform duration-150 z-50" style="will-change: transform;"></div>

<script>
(function() {
    const progressBar = document.getElementById('reading-progress');
    
    if (!progressBar) return;
    
    function updateReadingProgress() {
        // Get scroll position and document height
        const windowHeight = window.innerHeight;
        const documentHeight = document.documentElement.scrollHeight - windowHeight;
        const scrolled = window.scrollY;
        
        // Calculate progress (0 to 1)
        const progress = Math.min(scrolled / documentHeight, 1);
        
        // Update progress bar
        progressBar.style.transform = `scaleX(${progress})`;
    }
    
    // Update on scroll (with passive for better performance)
    window.addEventListener('scroll', updateReadingProgress, { passive: true });
    
    // Update on resize
    window.addEventListener('resize', updateReadingProgress, { passive: true });
    
    // Initial update
    updateReadingProgress();
})();
</script>


