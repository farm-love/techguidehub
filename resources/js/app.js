import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// PrismJS syntax highlighting (import CSS via Vite -> bundled)
import 'prismjs';
import 'prismjs/components/prism-markup.min.js';
import 'prismjs/components/prism-javascript.min.js';
import 'prismjs/components/prism-php.min.js';
import 'prismjs/components/prism-css.min.js';
import 'prismjs/components/prism-bash.min.js';
import 'prismjs/themes/prism.css';

document.addEventListener('DOMContentLoaded', function () {
	try {
		if (window.Prism) {
			window.Prism.highlightAll();
		}
	} catch (e) {
		// fail silently
	}
});
