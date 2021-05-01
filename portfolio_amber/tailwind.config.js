// tailwind.config.js
const colors = require('tailwindcss/colors');


module.exports = {
  purge: ['./src/**/*.{js,jsx,ts,tsx}', './public/index.html'],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      fontFamily: {
        'sans': ['"Roboto"', 'san-serif']
      },
      keyframes: {
         openmenu: {
           '0%': { left: '0', width: '0' },
           '49%': { left: '0', width: '100%' },
           '50%': { left: 'auto', right: '0', width: '100%' },
           '100%': { left: 'auto', right: '0', width: '0' },
         },
         hovermenuitem: {
           '0%': { opacity: '1', transform: 'translateY(-50%)'  },
           '24%': { opacity: '0', transform: 'translateY(0)'},
           '25%': { opacity: '0', transform: 'translateY(-100%)'},
           '50%': { opacity: '1', transform: 'translateY(-50%)' },
         }
       },
       animation: {
         openmenufast: 'openmenu 0.8s ease-in-out 1',
         openmenuslow: 'openmenu 1.1s ease-in-out 1',
         openmenuslowest: 'openmenu 1.2s ease-in-out 1 forwards',
         hovermenuitem: 'hovermenuitem 1.2s ease-in-out 1 ',
        }
    },
    rotate: {
       '-180': '-180deg',
        '-90': '-90deg',
       '-45': '-45deg',
        '0': '0',
        '45': '45deg',
        '90': '90deg',
       '135': '135deg',
       '-135': '-135deg',
        '180': '180deg',
       '270': '270deg',
     },
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      black: colors.black,
      white: colors.white,
      gray: colors.trueGray,
      indigo: colors.indigo,
      red: colors.rose,
      yellow: colors.amber,
    }
  },
  variants: {
    extend: {
      animation: ['hover', 'focus','group-hover']
    },
  },
  plugins: [
    require('tailwindcss-text-fill-stroke')(),
  ],
}
