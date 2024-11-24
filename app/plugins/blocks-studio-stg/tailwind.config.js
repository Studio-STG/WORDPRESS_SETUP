/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./src/**/*.{html,js,scss,css,php}"],
    theme: {
      extend: {},
      container: {
        center: true,
      },
      screens: {
        sm: '576px',
        md: '768px',
        lg: '992px',
        xl: '1200px',
        xxl: '1400px',
      },
    },
    plugins: [],
  }