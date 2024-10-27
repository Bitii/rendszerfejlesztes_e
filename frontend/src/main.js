import { createApp } from 'vue';
import App from './App.vue';
import router from './router'; // Router importálása
import { createPinia } from 'pinia'; // Pinia importálása

// Az alkalmazás létrehozása és a sajat routerunk hasznalata
createApp(App)
  .use(createPinia())
  .use(router)
  .mount('#app');
