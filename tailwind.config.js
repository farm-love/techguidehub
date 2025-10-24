import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import lineClamp from '@tailwindcss/line-clamp';
import daisyui from 'daisyui';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class', // use class-based dark mode
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, typography, lineClamp, daisyui],
    // basic daisyUI config; customize themes if you want
    daisyui: {
        themes: [
            'light',
            'dark',
        ],
    },
};
