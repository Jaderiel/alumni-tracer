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
    './resources/views/add-gallery.blade.php',
    './resources/views/auth/user-profile.blade.php',
    './resources/views/profile/edit.blade.php',
    './resources/views/auth/show-profile.blade.php',
    './resources/views/popups/update-post.blade.php',
    './resources/views/auth/analytics.blade.php',
    './resources/views/components/change-password.blade.php',
    './resources/views/components/employment-history.blade.php',
    './resources/views/components/add-past-employment.blade.php',
    './resources/views/components/generate-pdf.blade.php',
    './resources/views/auth/login.blade.php',
    './resources/views/auth/privacy-notice.blade.php',
    './resources/views/website/user-guide.blade.php',
    './resources/views/components/preview.blade.php',


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
        customDanger: '#BB0237',
        customError: '#F8D7DA',
        customErrorText: '#721C24',
      },
    },
  },
  plugins: [],
}

