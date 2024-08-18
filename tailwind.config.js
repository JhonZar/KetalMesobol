/** @type {import('tailwindcss').Config} */
// tailwind.config.js
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {},
    },
    variants: {
        extend: {
            opacity: ['responsive', 'hover', 'focus', 'group-hover'],
            scale: ['responsive', 'hover', 'focus', 'group-hover'],
            backgroundColor: ['responsive', 'hover', 'focus', 'group-hover'],
        }
    },
    plugins: [],
};
