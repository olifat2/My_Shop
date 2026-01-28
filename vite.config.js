import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';


export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: true,
        origin: 'http://10.72.26.153:5173',
        hmr: {
            host: '10.72.26.153',
            protocol: 'ws',
            port: 5173,
        },
        cors: true,
    },
});
