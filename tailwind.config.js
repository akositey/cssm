const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Cerebri Sans', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        indigo: {
          900: '#191e38',
          800: '#2f365f',
          600: '#5661b3',
          500: '#6574cd',
          400: '#7886d7',
          300: '#b2b7ff',
          100: '#e6e8ff',
        },
      },
      boxShadow: (theme) => ({
        outline: '0 0 0 2px ' + theme('colors.indigo.500'),
      }),
      fill: (theme) => theme('colors'),
    },
  },
  variants: {
    opacity: ['responsive', 'hover', 'focus', 'disabled'],
    fill: ['responsive', 'hover', 'focus', 'group-hover'],
    textColor: ['responsive', 'hover', 'focus', 'group-hover'],
    zIndex: ['responsive', 'focus'],
  },
  // plugins: [],
}
