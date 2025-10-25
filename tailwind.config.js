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
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
                display: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Custom brand colors
                brand: {
                    50: '#f0f9ff',
                    100: '#e0f2fe',
                    200: '#bae6fd',
                    300: '#7dd3fc',
                    400: '#38bdf8',
                    500: '#0ea5e9',
                    600: '#0284c7',
                    700: '#0369a1',
                    800: '#075985',
                    900: '#0c4a6e',
                    950: '#082f49',
                },
                accent: {
                    50: '#fdf4ff',
                    100: '#fae8ff',
                    200: '#f5d0fe',
                    300: '#f0abfc',
                    400: '#e879f9',
                    500: '#d946ef',
                    600: '#c026d3',
                    700: '#a21caf',
                    800: '#86198f',
                    900: '#701a75',
                    950: '#4a044e',
                },
            },
            animation: {
                'fade-in': 'fadeIn 0.5s ease-in-out',
                'fade-in-up': 'fadeInUp 0.6s ease-out',
                'slide-in-right': 'slideInRight 0.4s ease-out',
                'scale-in': 'scaleIn 0.3s ease-out',
                'bounce-slow': 'bounce 3s infinite',
                'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                'shimmer': 'shimmer 2s linear infinite',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                fadeInUp: {
                    '0%': { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                slideInRight: {
                    '0%': { opacity: '0', transform: 'translateX(20px)' },
                    '100%': { opacity: '1', transform: 'translateX(0)' },
                },
                scaleIn: {
                    '0%': { opacity: '0', transform: 'scale(0.9)' },
                    '100%': { opacity: '1', transform: 'scale(1)' },
                },
                shimmer: {
                    '0%': { backgroundPosition: '-1000px 0' },
                    '100%': { backgroundPosition: '1000px 0' },
                },
            },
            boxShadow: {
                'glow': '0 0 20px rgba(14, 165, 233, 0.3)',
                'glow-lg': '0 0 40px rgba(14, 165, 233, 0.4)',
                'inner-glow': 'inset 0 0 20px rgba(14, 165, 233, 0.2)',
            },
            backgroundImage: {
                'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                'gradient-conic': 'conic-gradient(from 180deg at 50% 50%, var(--tw-gradient-stops))',
            },
        },
    },

    plugins: [forms, typography, lineClamp, daisyui],
    // basic daisyUI config; customize themes if you want
    daisyui: {
        themes: [
            {
                light: {
                    'primary': '#0ea5e9',
                    'secondary': '#d946ef',
                    'accent': '#0369a1',
                    'neutral': '#1f2937',
                    'base-100': '#ffffff',
                    'info': '#0ea5e9',
                    'success': '#10b981',
                    'warning': '#f59e0b',
                    'error': '#ef4444',
                },
            },
            {
                dark: {
                    'primary': '#38bdf8',
                    'secondary': '#e879f9',
                    'accent': '#0ea5e9',
                    'neutral': '#1f2937',
                    'base-100': '#0f172a',
                    'info': '#38bdf8',
                    'success': '#10b981',
                    'warning': '#f59e0b',
                    'error': '#ef4444',
                },
            },
        ],
    },
};
