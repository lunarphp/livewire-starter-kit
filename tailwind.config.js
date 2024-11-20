module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './vendor/lunarphp/stripe-payments/resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {},
    },
    variants: {
      fill: ['hover'],
    },
    plugins: [require('@tailwindcss/forms')],
};
