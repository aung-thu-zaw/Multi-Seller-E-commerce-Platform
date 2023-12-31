import './bootstrap'
import '../css/app.css'
import('preline')

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m'
import { VueReCaptcha } from 'vue-recaptcha-v3'
import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'
import { translations } from './Services/translations'
import { Can } from './Services/can'
import store from './store'
import CKEditor from '@ckeditor/ckeditor5-vue'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) =>
    resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    const captcheKey = props.initialPage.props.recaptcha_site_key

    return createApp({ render: () => h(App, props) })
      .use(plugin)
      .mixin(translations)
      .use(ZiggyVue, Ziggy)
      .use(VueReCaptcha, {
        siteKey: captcheKey,
        loaderOptions: {
          useRecaptchaNet: true
        }
      })
      .use(VueSweetalert2)
      .use(store)
      .use(Can)
      .use(CKEditor)
      .mount(el)
  },
  progress: {
    delay: 250,
    color: '#fff',
    includeCSS: true,
    showSpinner: true
  }
})
