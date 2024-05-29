/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/views/main.blade.php',
    './resources/views/auth/dashboard.blade.php',
    './resources/views/auth/alumni-list.blade.php',
    './resources/views/auth/mobile-login.blade.php',
    './resources/views/auth/mobile-signup.blade.php',
    './resources/views/auth/add-event.blade.php',
    './resources/views/auth/add-announcement.blade.php',
    './resources/views/auth/events.blade.php',
    './resources/views/popups/event-registration.blade.php',
    './resources/views/popups/update-event.blade.php',
    './resources/views/auth/jobs.blade.php',
    './resources/views/job-post.blade.php',
    './resources/views/auth/gallery.blade.php',

  ],
  theme: {
    extend: {
      size: {
        '700': '700px',
      },
      fontFamily: {
        'Poppins': ['Poppins', 'sans-serif'],
      },
      colors: {
        customBlue: '#162F65',
        customYellow: '#E8C766',
        customBgColor: '#EFF2FB',
        customTextBlue: '#ABAEB7',
        customGreen: '#00A36C',
        primaryYellow: "#E8AF30",
      },
    },
  },
  plugins: [],
}

