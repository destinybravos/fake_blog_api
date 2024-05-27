/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./content_maager/**/*.{js,php,html}", "./index.html"],
  theme: {
    extend: {
      colors : {
        primary : "#004c98"
      }
    },
  },
  plugins: [],
}

