const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
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
                'indigo': {
                    100: '#e0e7ff',
                    500: '#6366f1',
                    600: '#4f46e5',
                },
                'purple': {
                    100: '#f3e8ff',
                    500: '#a855f7',
                    600: '#9333ea',
                },
                'pink': {
                    100: '#fce7f3',
                    500: '#ec4899',
                    600: '#db2777',
                },
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};