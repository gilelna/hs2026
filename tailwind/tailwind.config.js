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
  safelist: [
    {
      pattern: /^(p|px|py|pt|pr|pb|pl|m|mx|my|mt|mr|mb|ml)-(auto|\\d+)$/,
    },
  ],
  theme: {
    extend: {
      spacing: {
        '10': '2.5rem',
        '20': '5rem',
        '24': '6rem',
        '32': '8rem',
      },
    },
  },
  plugins: [],
};