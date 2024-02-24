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
        },
        colors: {
            facilityEaseMain: 'rgb(252, 179, 22)',
            facilityEaseSecondary: 'rgb(26, 24, 81)',
            facilityEaseLightGrey: 'rgb(233, 236, 239)',
            facilityEaseDarkGrey: 'rgb(174, 174, 174)',
            facilityEaseWhite: 'rgb(229, 231, 235)',
            facilityEaseRed: 'rgb(239, 68, 68)',
            facilityEaseGreen: 'rgb(52, 211, 153)',
            facilityEaseBlue: 'rgb(62, 124, 225)',
            facilityEaseYellow: 'rgb(255, 202, 65)',
            facilityEaseTeal: 'rgb(0,128,128)',
            facilityEaseBlack: 'rgb(44, 49, 58)',
          },
    },

    plugins: [forms, require('tailwind-scrollbar')],
};
