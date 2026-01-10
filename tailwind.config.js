import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
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
            colors: {
                primary: {
                    DEFAULT: 'var(--color-primary)',
                    50: '#fffbf0',
                    100: '#fff4cc',
                    200: '#ffe699',
                    300: '#ffd966',
                    400: '#ffcc33',
                    500: 'var(--color-primary)', // Dynamic Main Gold
                    600: '#e6ac00',
                    700: '#cc9900',
                    800: '#b38600',
                    900: '#997300',
                },
                secondary: {
                    DEFAULT: 'var(--color-secondary)',
                    50: '#f2f2f2',
                    100: '#e6e6e6',
                    200: '#cccccc',
                    300: '#b3b3b3',
                    400: '#999999',
                    500: '#808080',
                    600: '#666666',
                    700: '#4d4d4d',
                    800: '#333333',
                    900: '#1a1a1a',
                },
            },
        },
    },

    plugins: [forms],
};
