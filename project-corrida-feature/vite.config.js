import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/formulario.css',
                'resources/js/formulario.js',
                'resources/js/obrigado.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '127.0.0.1',
        port: 5173,
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
