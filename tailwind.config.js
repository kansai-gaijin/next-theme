module.exports = {
  future: {
    removeDeprecatedGapUtilities: true,
    purgeLayersByDefault: true,
  },
  purge: [
    './**/*.php',
  ],
  theme: {
    borderWidth: {
      DEFAULT: '1px',
      '0': '0',
      '1': '1px',
      '2': '2px',
      '3': '3px',
      '4': '4px',
      '6': '6px',
      '8': '8px',
      '10': '10px',
    },
    extend: {
      fontFamily: {
        'sans': ['Noto Sans JP', 'sans-serif'],
      },
      colors: {
        gray: {
          900: '#1A1A1A',
          700: '#4C4D55'
        },
        yellow: {
          500: '#F5BF1E'
        },
        red: {
          900: '#701D07'
        }
      },
    },
  },
  variants: {
    transform: ['hover', 'group-hover'],
    translate: ['active', 'group-hover'],
  },
  plugins: [],
}