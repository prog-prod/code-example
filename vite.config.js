import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/sass/app.scss",
                "resources/js/app.js",
                "resources/sass/base.scss",
            ],
            ssr: "resources/js/ssr.js",
            refresh: true,
            sourcemap: true,
        }),
        vue({
            template: {
                version: 3,
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    build: {
        rollupOptions: {
            external: "ziggy",
        },
    },
    ssr: {
        noExternal: [
            "@kyvg/vue3-notification",
            "laravel-vite-plugin",
            "@inertiajs/server",
            "jquery-nice-select",
            "vue-select",
            "vue-star-rating",
        ],
    },
});
