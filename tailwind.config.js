import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                theme: {
                    bg: '#0f1620',
                    surface: '#18212e',
                    'surface-raised': '#1f2938',
                    line: '#263243',
                    ink: '#eaf0f8',
                    body: '#b6c2d2',
                    muted: '#8b98ab',
                    primary: '#0f66e0',
                    'primary-dark': '#0c54b8',
                    'primary-soft': '#e7f0fc',
                    accent: '#d92e2e',
                    star: '#ffc531',
                    'footer-bg': '#0a1119',
                },
            },
            maxWidth: {
                container: '1220px',
            },
            borderRadius: {
                theme: '12px',
                'theme-sm': '8px',
            },
            boxShadow: {
                theme: '0 1px 2px rgba(0,0,0,.4), 0 4px 16px rgba(0,0,0,.35)',
                'theme-lg': '0 8px 40px rgba(0,0,0,.55)',
                'theme-header': '0 8px 32px rgba(0,0,0,.45), inset 0 1px 0 rgba(255,255,255,.06)',
            },
        },
    },
    plugins: [],
};
