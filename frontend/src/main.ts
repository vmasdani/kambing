import { createApp } from "vue";
// import "./style.css";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";

import App from "./App.vue";
import { createRouter, createWebHashHistory } from "vue-router";
import Kambing from "./components/Kambing.vue";
import KambingDetail from "./components/KambingDetail.vue";

const routes = [
  { path: "/", component: Kambing },
  { path: "/kambings/:id", component: KambingDetail },

  // { path: '/about', component: AboutView },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

createApp(App).use(router).mount("#app");
