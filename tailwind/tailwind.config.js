/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "../index-style.html",
    "../**/*.php",
    "../patterns/**/*.php",
    "../template-parts/**/*.php",
    "../includes/**/*.php",
    "../src/**/*.{js,ts,jsx,tsx,html}",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};