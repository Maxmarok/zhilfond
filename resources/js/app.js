import './bootstrap'
import App from './App.vue'
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
import router from '@/router'
import { useProfileStore } from '@/stores/profileStore'

const pinia = createPinia()
pinia.use(piniaPluginPersistedstate)

const app = createApp(App)

app.use(pinia)
app.use(router)

const profile = useProfileStore()

axios.interceptors.request.use(function (config) {
    const token = profile.token;
    config.headers.Authorization = 'Bearer ' + token;
    return config;
});


app.mount('#app')
