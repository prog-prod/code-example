import { createSSRApp, h } from "vue";
import { renderToString } from "@vue/server-renderer";
import { createInertiaApp } from "@inertiajs/vue3";
import createServer from "@inertiajs/vue3/server";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import { translations } from "@/Mixins/translations.js";
import common from "@/Mixins/common.js";
import { store } from "@/store.js";
import FloatingVue from "floating-vue";

import notifier from "@/Mixins/notifier.js";
import { $request } from "@/Services/RequestService.ts";
import { $search } from "@/Services/SearchService.ts";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";

const appName = "Printopia";

createServer((page) =>
    createInertiaApp({
        page,
        render: renderToString,
        title: (title) => `${title} - ${appName}`,
        resolve: (name) =>
            resolvePageComponent(
                `./Pages/${name}.vue`,
                import.meta.glob("./Pages/**/*.vue")
            ),
        setup({ App, props, plugin }) {
            const app = createSSRApp({ render: () => h(App, props) })
                .use(plugin)
                .mixin(translations)
                .mixin(common)
                .mixin(notifier)
                .use(store)
                .use(FloatingVue)
                .use(ZiggyVue, {
                    ...page.props.ziggy,
                    location: new URL(page.props.ziggy.location),
                });

            app.config.globalProperties.$request = $request;
            app.config.globalProperties.$search = $search;
            return app;
        },
        progress: {
            color: "#ff4135",
        },
    })
);
