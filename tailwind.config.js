import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: '#e1b656',
                    50: '#fdf9ed',
                    100: '#faf1d5',
                    200: '#f4e0a7',
                    300: '#eec973',
                    400: '#e9b556',
                    500: '#e1b656',
                    600: '#ca8e2f',
                    700: '#a86c29',
                    800: '#895628',
                    900: '#724824',
                },
                dark: {
                    DEFAULT: '#171923',
                    50: '#f5f6f7',
                    100: '#e1e3e8',
                    200: '#c3c7d1',
                    300: '#9ba1b0',
                    400: '#6e7587',
                    500: '#52586a',
                    600: '#424659',
                    700: '#37394a',
                    800: '#2f313f',
                    900: '#171923',
                }
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
