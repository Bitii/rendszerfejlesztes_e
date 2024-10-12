import { createRouter, createWebHistory } from 'vue-router';
import Index from '../components/Index.vue';
import Signup from '../components/Signup.vue';
import Signin from '../components/Signin.vue';
import User from '../components/User.vue';

const routes = [
  { path: '/', component: Index },
  { path: '/signup', component: Signup },
  { path: '/signin', component: Signin },
  { path: '/user', component: User}
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
