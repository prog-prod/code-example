import "./bootstrap";
// import '../css/app.css';
import { createSSRApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import { translations } from "@/Mixins/translations.js";
import common from "@/Mixins/common.js";
import { store } from "@/store.js";
import Notifications from "@kyvg/vue3-notification";
import { $request } from "@/Services/RequestService";
import notifier from "@/Mixins/notifier.js";
import { $search } from "@/Services/SearchService";
import FloatingVue from "floating-vue";
import "floating-vue/dist/style.css";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

const app = createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        const app = createSSRApp({ render: () => h(App, props) })
            .use(plugin)
            .mixin(translations)
            .mixin(common)
            .mixin(notifier)
            .use(ZiggyVue, Ziggy)
            .use(Notifications)
            .use(FloatingVue)
            .use(store);

        app.config.globalProperties.$request = $request;
        app.config.globalProperties.$search = $search;
        app.mount(el);
        return app;
    },
    progress: {
        color: "#ff4135",
    },
});
