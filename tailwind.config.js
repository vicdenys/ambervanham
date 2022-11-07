const { opacity } = require("tailwindcss/defaultTheme");
const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./public/js/**/*.js",
    ],
    safelist: [
        {
            pattern: /bg-(white|green|red|black)/,
            variants: ["hover", "focus", "hover"],
        },
        {
            pattern: /text-(white|green|red|black)/,
            variants: ["hover", "focus", "hover"],
        },
        {
            pattern: /delay-(50|100|150|200|350|300|450|500|550|600|650|700)/,
            variants: ["hover", "focus", "hover"],
        },
    ],

    theme: {
        fontFamily: {
            // Array format:
            sans: ["Helvetica", "Arial", "sans-serif"],
            // Array format:
            serif: ["Playfair Display", "serif"],
        },
        extend: {
            colors: {
                white: {
                    DEFAULT: "#FFFCF8",
                },
            },
            transitionDelay: {
                50: "50ms",
                100: "50ms",
                150: "150ms",
                200: "200ms",
                250: "250ms",
                350: "350ms",
                400: "400ms",
                450: "450ms",
                500: "500ms",
                550: "550ms",
                600: "600ms",
                650: "650ms",
                700: "700ms",
            },

            keyframes: {
                "slide-up": {
                    "0%": { height: "4rem" },
                    "100%": { height: "0rem" },
                },
                "pop-up": {
                    "0%": { transform: "translateY(100%)", opacity: 0 },
                    "50%": { opacity: 0 },
                    "100%": { transform: "translateY(0)", opacity: 1 },
                },
                "text-loop": {
                    "0%": { transform: "translateX(-20%)" },
                    "100%": { transform: "translateX(-120%)" },
                },
                "text-loop-2": {
                    "0%": { transform: "translateX(0%)" },
                    "100%": { transform: "translateX(-200%)" },
                },
                wipe: {
                    "0%": { height: 0 },
                    "100%": { height: "100%" },
                },
            },
            animation: {
                "slide-up": "slide-up 0.5s ease-in-out 3s forwards",
                "pop-up": "pop-up 0.3s ease-in-out forwards",
                "text-loop": "text-loop 10s linear infinite",
                "text-loop-2": "text-loop-2 10s linear infinite",
                loading: "wipe 2s cubic-bezier(.2,.6,.8,.4) forwards;",
            },
        },
    },

    plugins: [require("@tailwindcss/forms")],
};

// MOUSE ACTION
