import { createRouter, createWebHistory } from "vue-router";
import Index from "../components/Index.vue";
import Signup from "../components/Signup.vue";
import Signin from "../components/Signin.vue";
import User from "../components/User.vue";
import MovieDetail from "../components/MovieDetail.vue";
import { useUserStore } from "../../stores/user";

const routes = [
  { path: "/", name: "home", component: Index },
  { path: "/signup", name: "signup", component: Signup },
  { path: "/signin", name: "login", component: Signin },
  {
    path: "/user",
    name: "user",
    component: User,
    meta: { requiresAuth: true },
  },
  { path: "/movie/:id", name: "MovieDetail", component: MovieDetail },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const userData = useUserStore();
  if (to.matched.some((record) => record.meta.requiresAuth) && !userData.isLoggedIn)
  {
    next({ name: "login" });
  } else { next(); }
});

export default router;
