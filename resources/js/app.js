import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Enhanced PrismJS with plugins
import Prism from 'prismjs';
import 'prismjs/components/prism-markup.min.js';
import 'prismjs/components/prism-javascript.min.js';
import 'prismjs/components/prism-php.min.js';
import 'prismjs/components/prism-css.min.js';
import 'prismjs/components/prism-bash.min.js';
import 'prismjs/components/prism-python.min.js';
import 'prismjs/components/prism-json.min.js';
import 'prismjs/components/prism-typescript.min.js';
import 'prismjs/components/prism-jsx.min.js';
import 'prismjs/components/prism-sql.min.js';
import 'prismjs/themes/prism-tomorrow.css';
import 'prismjs/plugins/line-numbers/prism-line-numbers.css';
import 'prismjs/plugins/line-numbers/prism-line-numbers.min.js';
import 'prismjs/plugins/toolbar/prism-toolbar.css';
import 'prismjs/plugins/toolbar/prism-toolbar.min.js';
import 'prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js';

document.addEventListener('DOMContentLoaded', function () {
    // Prism highlighting
    if (window.Prism) {
        window.Prism.highlightAll();
    }

    // Enhanced lazy loading with blur-up effect
    const lazyImages = document.querySelectorAll('img[loading="lazy"]');
    lazyImages.forEach(img => {
        img.classList.add('lazy-loading');
        img.addEventListener('load', function() {
            img.classList.remove('lazy-loading');
            img.classList.add('lazy-loaded');
        });
    });

    // Share highlighted text
    document.addEventListener('mouseup', function() {
        const selection = window.getSelection();
        const selectedText = selection.toString().trim();
        
        if (selectedText.length > 10) {
            showSharePopup(selectedText, selection);
        } else {
            hideSharePopup();
        }
    });

    // Click-to-tweet functionality
    const tweetBlocks = document.querySelectorAll('[data-tweet]');
    tweetBlocks.forEach(block => {
        block.style.cursor = 'pointer';
        block.addEventListener('click', function() {
            const text = this.dataset.tweet || this.textContent;
            const url = window.location.href;
            const tweetUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(url)}`;
            window.open(tweetUrl, '_blank', 'width=550,height=420');
        });
    });

    // Bookmark functionality
    initBookmarks();

    // Infinite scroll
    initInfiniteScroll();

    // Print friendly
    if (document.querySelector('.print-btn')) {
        document.querySelector('.print-btn').addEventListener('click', function() {
            window.print();
        });
    }

    // Smooth scroll for TOC links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#' && document.querySelector(href)) {
                e.preventDefault();
                document.querySelector(href).scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});

// Share popup functions
let sharePopup = null;
function showSharePopup(text, selection) {
    hideSharePopup();
    
    const range = selection.getRangeAt(0);
    const rect = range.getBoundingClientRect();
    
    sharePopup = document.createElement('div');
    sharePopup.className = 'share-popup';
    sharePopup.innerHTML = `
        <button class="share-btn" data-platform="twitter" title="Share on Twitter">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/></svg>
        </button>
        <button class="share-btn" data-platform="copy" title="Copy">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
        </button>
    `;
    
    sharePopup.style.position = 'absolute';
    sharePopup.style.top = `${rect.top + window.scrollY - 50}px`;
    sharePopup.style.left = `${rect.left + rect.width / 2}px`;
    sharePopup.style.transform = 'translateX(-50%)';
    
    document.body.appendChild(sharePopup);
    
    // Event listeners
    sharePopup.querySelector('[data-platform="twitter"]').addEventListener('click', () => {
        const url = window.location.href;
        const tweetUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(url)}`;
        window.open(tweetUrl, '_blank', 'width=550,height=420');
    });
    
    sharePopup.querySelector('[data-platform="copy"]').addEventListener('click', () => {
        navigator.clipboard.writeText(text).then(() => {
            alert('Copied to clipboard!');
        });
    });
}

function hideSharePopup() {
    if (sharePopup) {
        sharePopup.remove();
        sharePopup = null;
    }
}

// Bookmark system
function initBookmarks() {
    const bookmarkBtns = document.querySelectorAll('.bookmark-btn');
    bookmarkBtns.forEach(btn => {
        const postId = btn.dataset.postId;
        if (isBookmarked(postId)) {
            btn.classList.add('bookmarked');
        }
        
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            toggleBookmark(postId, btn);
        });
    });
}

function isBookmarked(postId) {
    const bookmarks = JSON.parse(localStorage.getItem('bookmarks') || '[]');
    return bookmarks.includes(postId);
}

function toggleBookmark(postId, btn) {
    let bookmarks = JSON.parse(localStorage.getItem('bookmarks') || '[]');
    
    if (bookmarks.includes(postId)) {
        bookmarks = bookmarks.filter(id => id !== postId);
        btn.classList.remove('bookmarked');
        showNotification('Bookmark removed');
    } else {
        bookmarks.push(postId);
        btn.classList.add('bookmarked');
        showNotification('Bookmarked!');
    }
    
    localStorage.setItem('bookmarks', JSON.stringify(bookmarks));
}

function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);
    
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, 2000);
}

// Infinite scroll
function initInfiniteScroll() {
    const infiniteContainer = document.querySelector('[data-infinite-scroll]');
    if (!infiniteContainer) return;
    
    let page = 1;
    let loading = false;
    let hasMore = true;
    
    const loadingIndicator = document.createElement('div');
    loadingIndicator.className = 'loading-indicator';
    loadingIndicator.innerHTML = '<div class="spinner"></div><p>Loading more posts...</p>';
    loadingIndicator.style.display = 'none';
    infiniteContainer.after(loadingIndicator);
    
    window.addEventListener('scroll', () => {
        if (loading || !hasMore) return;
        
        const scrollPosition = window.innerHeight + window.scrollY;
        const threshold = document.body.offsetHeight - 1000;
        
        if (scrollPosition >= threshold) {
            loadMore();
        }
    });
    
    async function loadMore() {
        loading = true;
        loadingIndicator.style.display = 'block';
        page++;
        
        try {
            const response = await fetch(`?page=${page}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            const html = await response.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newPosts = doc.querySelectorAll('[data-infinite-scroll] > *');
            
            if (newPosts.length === 0) {
                hasMore = false;
                loadingIndicator.innerHTML = '<p>No more posts</p>';
                setTimeout(() => loadingIndicator.style.display = 'none', 2000);
            } else {
                newPosts.forEach(post => {
                    infiniteContainer.appendChild(post.cloneNode(true));
                });
                loading = false;
                loadingIndicator.style.display = 'none';
            }
        } catch (error) {
            console.error('Error loading more posts:', error);
            loading = false;
            loadingIndicator.style.display = 'none';
        }
    }
}

// Export for global access
window.showSharePopup = showSharePopup;
window.hideSharePopup = hideSharePopup;
window.toggleBookmark = toggleBookmark;
