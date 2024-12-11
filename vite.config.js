import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
            'resources/css/app.css',
                'resources/css/landing.css',
                'resources/css/table.css',
                'resources/css/form.css',
                'resources/js/Dashboard.js',
                'resources/js/Incidencias.js',
                'resources/js/index.js',
                'resources/js/landing.js',
                'resources/js/app.js',
                'resources/js/bootstrap.js',
            ],
            refresh: true,
        }),
    ],
});
