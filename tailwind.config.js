/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/views/main.blade.php',
  ],
  theme: {
    extend: {
      fontFamily: {
        'Poppins': ['sans-serif'],
      },
      colors: {
        customBlue: '#162F65',
        customYellow: '#E8C766',
      },
    },
  },
  plugins: [],
}

