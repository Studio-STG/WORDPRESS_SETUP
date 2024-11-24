/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./src/**/*.{html,js,scss,css,php}"],
    theme: {
      extend: {},
      container: {
        screens: {
          sm: '576px',
          md: '768px',
          lg: '992px',
          xl: '1140px',
          xxl: '1140px',
        },
        center: true,
        padding: {
          DEFAULT: '15px'
        },
      },
      screens: {
        xs: '375px',
        sm: '576px',
        md: '768px',
        lg: '992px',
        xl: '1200px',
        xxl : '1366px',
      },
      fontFamily: {
        roboto: ['Roboto', 'sans-serif'],
    },
    },
    plugins: [],
  }