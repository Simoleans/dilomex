import './bootstrap'
import '../css/app.css'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m'

//primeVue
import PrimeVue from 'primevue/config';
import "primevue/resources/themes/saga-blue/theme.css";
import "primevue/resources/primevue.min.css";
import "primeicons/primeicons.css";
 //service prime vue
 import ToastService from 'primevue/toastservice';
import ConfirmationService from 'primevue/confirmationservice';

const appName =
    window.document.getElementsByTagName('title')[0]?.innerText || 'Dilomex'

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue')
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(PrimeVue, {
                locale: {
                    accept: 'Aceptar',
                    reject: 'Rechazar',
                    //...
                }
            })
            .mount(el)
    },
    progress: {
        color: '#a855f7'
    }
})
