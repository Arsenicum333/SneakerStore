/** @type {import('tailwindcss').Config} */
const { default: fluid, extract, screens, fontSize } = require('fluid-tailwind')

module.exports = {
  content: {
    files: [
      "./*.html",
      "./src/**/*.html",
    ],
    extract,
  },
  theme: {
    screens,
    extend: {},
  },
  plugins: [
    fluid,
  ],
}
