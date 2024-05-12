import { createApp, ref } from "vue";
// import "./style.css";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";

import App from "./App.vue";
import { createRouter, createWebHashHistory } from "vue-router";
import Kambing from "./components/Kambing.vue";
import KambingDetail from "./components/KambingDetail.vue";
import Auth from "./components/Auth.vue";

export const ctx = ref ({ token: null as string | null });

const routes = [
  { path: "/", component: Kambing },
  { path: "/kambings/:id", component: KambingDetail },
  { path: "/login", component: Auth },

  // { path: '/about', component: AboutView },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

createApp(App).use(router).mount("#app");
