import { createApp } from 'vue'
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import Dashboard from './components/Dashboard.vue'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import axios from 'axios'
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const vuetify = createVuetify({
  components,
  directives
})

const app = createApp({
  components: {
    Dashboard
  }
})

app.use(vuetify).mount('#app')

