const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                'pest-green': {
                    DEFAULT: colors.teal[400],
                    ...colors.teal
                },
                'pest-pink': {
                    DEFAULT: colors.pink[400],
                    ...colors.pink
                },
            }
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/line-clamp'),
    ],
}
