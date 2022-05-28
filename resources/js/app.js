import {createApp, h, inject} from 'vue'
import {createInertiaApp} from '@inertiajs/inertia-vue3'
import {ZiggyVue} from 'ziggy'
import {Ziggy} from 'ziggyRoutes'

createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  title: title => title ? `${title} - CSSM` : 'CSSM',
  setup({el, App, props, plugin}) {
    createApp({render: () => h(App, props)})
      .use(plugin)
      .use(ZiggyVue, Ziggy)
      .mount(el)
  },
})
