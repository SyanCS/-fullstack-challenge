import { createApp } from 'vue';
import './style.css';
import App from './App.vue';

import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import vuetify from './plugins/vuetify' // import the Vuetify plugin


const vuetify = createVuetify({
  components,
  directives,
});

createApp(App).use(vuetify).mount('#app')