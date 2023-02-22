import 'mdb-vue-ui-kit/css/mdb.min.css';
import '../assets/css/app.css';

// import "primevue/resources/themes/saga-blue/theme.css"
import "primevue/resources/themes/saga-green/theme.css"    //theme
import "primevue/resources/primevue.min.css "                //core css
import "primeicons/primeicons.css"
import "/node_modules/primeflex/primeflex.css"
import "../assets/scss/styles/layout.scss"

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import AdminLayout from './Layouts/AdminLayout.vue';
import AppVue from './Layouts/App.vue';

import PrimeVue from 'primevue/config';
import ConfirmationService from "primevue/confirmationservice";
import ToastService from 'primevue/toastservice';
import locale from './utils/locale';
import VueSocialSharing from 'vue-social-sharing'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Trường cao đẳng Y tế';

createInertiaApp({
    title: (title) => `${title}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        const vApp = createApp({ render: () => h(app, props) });
            vApp.use(PrimeVue, { ripple: true, inputStyle: "outlined", locale: locale });
            vApp.use(plugin);
            vApp.use(ZiggyVue, Ziggy);
            vApp.use(ConfirmationService);
            vApp.use(ToastService);
            vApp.use(VueSocialSharing);

            vApp.component('AdminLayout', AdminLayout);
            vApp.component('AppLayout', AppVue);
            vApp.mount(el);
        return vApp;
    },
});

InertiaProgress.init({
    // The delay after which the progress bar will
    // appear during navigation, in milliseconds.
    delay: 250,

    // The color of the progress bar.
    color: '#10af7e',

    // Whether to include the default NProgress styles.
    includeCSS: true, //this

    // Whether the NProgress spinner will be shown.
    showSpinner: true,
  })

