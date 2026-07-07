import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import router from './router'
import "./assets/styles.css";
createApp(App)
.use(router)
.use(Toast, {
    position: "top-right",
    timeout: 3000,
    closeOnClick: true,
    pauseOnHover: true,
    draggable: true,
    hideProgressBar: false,
    newestOnTop: true,
})
.mount('#app')

