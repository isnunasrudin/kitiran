import { defineConfig } from 'vite'
import laravel, { refreshPaths } from 'laravel-vite-plugin' 
 
export default defineConfig({
    build: {
        modulePreload: false
    },
    plugins: [
        laravel({
            input: [
                'resources/css/mail.css',
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: [ 
                ...refreshPaths,
                'app/Http/Livewire/**',
                'app/Forms/Components/**',
            ], 
        }),
    ],
})