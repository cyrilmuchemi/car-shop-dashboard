import { createApp } from "vue";
import { plugin, defaultConfig } from "@formkit/vue";
import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";
import App from "./App.vue";
import router from "./router";
import store from "./store";

createApp(App).use(store).use(plugin, defaultConfig).use(router).mount("#app");
