import { createApp } from 'vue';
import App from './App.vue';
import router from './router'; // Router importálása
import { createPinia } from 'pinia'; // Pinia importálása

const pinia = createPinia(); // Pinia példány létrehozása

// Az alkalmazás létrehozása és a sajat routerunk hasznalata
createApp(App)
  .use(pinia)
  .use(router)
  .mount('#app');
