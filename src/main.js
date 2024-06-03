import AdminDefault from './layouts/default/AdminDefault.vue'
import App from './App.vue'
import Default from './layouts/default/Default.vue'
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { router } from './router'

const app = createApp(App)

app.component('LayoutDefault', Default)
app.component('LayoutAdmin', AdminDefault)

app.use(createPinia())
app.use(router)

app.mount('#app')
