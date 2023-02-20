/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      './resources/**/*.php',
    './inc/**/*.php',
    './views/**/*.php',
    './assets/js/**/*.js',
    './assets/css/**/*.css',
    './config/*.php',
  ],
  theme: {
    extend: {
      colors: {
        yellowbee: {
          500: '#fbde20',
        },
      }
    },
  },
  plugins: [],
}
