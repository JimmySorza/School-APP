// eslint-disable-next-line
const plugin = require('tailwindcss/plugin')

module.exports = {
  darkMode: false,
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue'
  ],
  plugins: [
    plugin(function ({ addUtilities }) {
      const newUtilities = {
        '.body-1': {
          fontFamily: 'Roboto, sans-serif',
          fontSize: '14px',
          fontWeight: 400
        },
        '.body-2': {
          fontFamily: 'Roboto, sans-serif',
          fontSize: '15px',
          fontWeight: 500
        },
        '.heading-1': {
          fontFamily: 'Roboto, sans-serif',
          fontSize: '24px',
          fontWeight: 700
        },
        '.subtitle-1': {
          fontFamily: 'Roboto, sans-serif',
          fontSize: '16px',
          fontWeight: 500,
          lineHeight: '18.75px'
        },
        '.subtitle-2': {
          fontFamily: 'Roboto, sans-serif',
          fontSize: '18px',
          fontWeight: 500,
          lineHeight: '18.75px'
        },
        '.title-1': {
          fontFamily: 'Roboto, sans-serif',
          fontSize: '22px',
          fontWeight: 500
        },
        '.title-2': {
          fontFamily: 'Roboto, sans-serif',
          fontSize: '20px',
          fontWeight: 500
        }
      }

      addUtilities(newUtilities, ['responsive', 'hover'])
    })
  ],
  // or 'media' or 'class'
  theme: {
    colors: {
      background: '#F9FAFC',
      black: '#455160',
      danger: '#EA4D4D',
      grey: {
        default: '#BFC3D3',
        light: '#E0E9F1',
        lightest: '#F9FAFC'
      },
      brand: {
        DEFAULT: '#216FED',
        light: '#EDF3FE'
      },
      shadow: 'rgba(116, 116, 116, 0.5)',
      success: '#53CAA6',
      transparent: 'transparent',
      warning: '#FFC35F',
      white: '#FFFFFF'
    },
    extend: {}
  }
}
