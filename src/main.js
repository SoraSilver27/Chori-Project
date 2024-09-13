/**
 * main.js
 *
 * Bootstraps Vuetify and other plugins then mounts the App`
 */

// Plugins
import { registerPlugins } from '@/plugins'

// Components
import App from './App.vue'

import { createVuetify } from 'vuetify';
import 'vuetify/styles'; // Importa los estilos de Vuetify

const vuetify = createVuetify(); // Crea una instancia de Vuetify

// Composables
import { createApp } from 'vue'

const app = createApp(App)

registerPlugins(app)

app.mount('#app')


createApp(App)
  .use(vuetify)