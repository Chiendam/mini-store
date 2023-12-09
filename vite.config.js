import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/init.js',
                'resources/js/login/index.js',

                //User
                'resources/js/users/index.js',
                'resources/js/users/create.js',
                'resources/js/users/edit.js',
            ],
            refresh: true,
        }),
    ],
});
