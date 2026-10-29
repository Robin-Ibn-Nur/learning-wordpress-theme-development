import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  plugins: [
    tailwindcss(),
    {
      name: 'php-reload',
      handleHotUpdate({ file, server }) {
        if (file.endsWith('.php')) {
          server.ws.send({
            type: 'full-reload',
            path: '*',
          });
        }
      },
    },
  ],
  build: {
    manifest: true,
    outDir: 'dist',
    emptyOutDir: true,
    rollupOptions: {
      input: {
        main: './src/main.js',
      },
    },
  },
  server: {
    cors: true,
    strictPort: true,
    port: 5173,
    origin: 'http://localhost:5173',
    hmr: {
      host: 'localhost',
    },
  },
});
