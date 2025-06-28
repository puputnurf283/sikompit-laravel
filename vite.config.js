import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',    // untuk halaman biasa tanpa React
                'resources/js/app.jsx',   // untuk halaman login dengan React
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
