import 'mdb-vue-ui-kit/css/mdb.min.css';
import '../assets/css/app.css';

// import "primevue/resources/themes/saga-blue/theme.css"
import "primevue/resources/themes/saga-green/theme.css"    //theme
import "primevue/resources/primevue.min.css "                //core css
import "primeicons/primeicons.css"
import "/node_modules/primeflex/primeflex.css"

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

import PrimeVue from 'primevue/config';


const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        const vApp =  createApp({ render: () => h(app, props) });
            vApp.use(PrimeVue);
            vApp.use(plugin);
            vApp.use(ZiggyVue, Ziggy);
            vApp.mount(el);

        return vApp;

    },
});

InertiaProgress.init({ color: '#4B5563' });
