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
    path: '/reserve_first',
    name: 'Reserve_first',
    component: () => import('../views/Reserve_first.vue'),
    meta: {
      layout: 'default'
    }
  },

  {
    path: '/reserve_sec',
    name: 'Reserve_sec',
    component: () => import('../views/Reserve_sec.vue'),
    meta: {
      layout: 'default'
    }
  },

  {
    path: '/cart',
    name: 'Cart',
    component: () => import('../views/Cart.vue'),
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
