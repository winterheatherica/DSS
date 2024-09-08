import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

// Define Vite configuration
export default defineConfig({
    plugins: [
        laravel({
            // Specify the entry points for the CSS and JavaScript files
            input: [
                'resources/css/app.css', // CSS entry point
                'resources/js/app.js'    // JavaScript entry point
            ],
            refresh: true, // Enable hot module replacement
        }),
    ],
    // Additional Vite configuration options
    build: {
        // Specify the output directory for build files
        outDir: 'public/build',
        // Set the base path for the application (optional)
        base: '/',
        // Configure manifest generation
        manifest: true,
        // Set the target environment for build (optional)
        target: 'es2015',
        // Enable source maps for debugging (optional)
        sourcemap: false,
    },
    server: {
        // Configure the development server
        host: 'localhost',
        port: 3000,
        strictPort: true, // Prevent the server from trying to use another port if the specified port is taken
        // Enable HMR (hot module replacement)
        hmr: {
            protocol: 'ws',
            host: 'localhost',
        },
    },
});
