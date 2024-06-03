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
    path: '/menus',
    name: 'Menus',
    component: () => import('../views/Menus.vue'),
    meta: {
      layout: 'default'
    }
  },
  {
    path: '/wine_column',
    name: 'WineColumn',
    component: () => import('../views/WineColumn.vue'),
    meta: {
      layout: 'default'
    }
  },

  // backend
  {
    path: '/admin_login',
    name: 'AdminLogin',
    component: () => import('../views/AdminLogin.vue'),
    meta: {
      layout: 'Admin'
    }
  },
  // {
  //   path: '/admin',
  //   name: 'Admin',
  //   component: () => import('../views/Admin.vue'),
  //   meta: {
  //     layout: 'Admin'
  //   }
  // },
  {
    path: '/admin_account',
    name: 'AdminAccount',
    component: () => import('../views/AdminAccount.vue'),

  {
    path: '/reserve_sec',
    name: 'Reserve_sec',
    component: () => import('../views/Reserve_sec.vue'),
    meta: {
      layout: 'Admin'
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
