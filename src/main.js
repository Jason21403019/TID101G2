import AdminDefault from './layouts/default/AdminDefault.vue'
import App from './App.vue'
import Default from './layouts/default/Default.vue'
// import GAuth from 'vue3-google-oauth2'
import vue3GoogleLogin from 'vue3-google-login'
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { router } from './router'

const app = createApp(App)

// const gAuthOptions = {
//   clientId: '1044890836835-59gl5r2o3efhla80sosf9lab07uulbj8.apps.googleusercontent.com',
//   scope: 'email',
//   prompt: 'consent',
//   fetch_basic_profile: true
// }
// app.use(GAuth, gAuthOptions)
app.use(vue3GoogleLogin, {
  clientId: '1044890836835-59gl5r2o3efhla80sosf9lab07uulbj8.apps.googleusercontent.com'
})
app.component('LayoutDefault', Default)
app.component('LayoutAdmin', AdminDefault)

app.use(createPinia())
app.use(router)

app.mount('#app')
