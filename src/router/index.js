// import AboutUs from '../views/AboutUs.vue'
import { createRouter, createWebHashHistory } from 'vue-router'

const history = createWebHashHistory()
const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import('../views/Home.vue'),
    meta: {
      layout: 'default'
    }
  },
  {
    path: '/about_us',
    name: 'AboutUs',
    component: () => import('../views/AboutUs.vue'),
    meta: {
      layout: 'default'
    }
  },
  {
    path: '/questions',
    name: 'Questions',
    component: () => import('../views/Questions.vue'),
    meta: {
      layout: 'default'
    }
  },
  {
    path: '/reserve',
    name: 'Reserve',
    component: () => import('../views/Reserve.vue'),
    meta: {
      layout: 'default'
    }
  },
  {
    path: '/menus',
    name: 'Menus',
    component: () => import('../views/'),
    meta: {
      layout: 'default'
    }
  },
]
const router = createRouter({
  linkActiveClass: 'active',
  history,
  routes
})

export { router }
