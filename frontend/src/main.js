import { createApp } from 'vue';
import App from './App.vue';
import router from './router'; // Router importálása

// Az alkalmazás létrehozása és a sajat routerunk hasznalata
createApp(App)
  .use(router)
  .mount('#app');
