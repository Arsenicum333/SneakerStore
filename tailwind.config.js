const fluid = require('fluid-tailwind');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: {
        files: [
            "./resources/**/*.blade.php",
            "./resources/**/*.js",
        ],
        extract: fluid.extract,
    },
    theme: {
        screens: fluid.screens,
        fontSize: fluid.fontSize,
        extend: {},
    },
    plugins: [
        fluid,
    ],
};
