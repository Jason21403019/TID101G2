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
<<<<<<< HEAD
  {
    path: '/reserve',
    name: 'Reserve',
    component: () => import('../views/Reserve.vue'),
    meta: {
      layout: 'default'
    }
  },
=======

  // backend
  // {
  //   path: '/admin_login',
  //   name: 'AdminLogin',
  //   component: () => import('../views/AdminLogin.vue'),
  //   meta: {
  //     layout: 'Admin'
  //   }
  // },
  // {
  //   path: '/admin',
  //   name: 'Admin',
  //   component: () => import('../views/Admin.vue'),
  //   meta: {
  //     layout: 'Admin'
  //   }
  // },
  // {
  //   path: '/admin_account',
  //   name: 'AdminAccount',
  //   component: () => import('../views/AdminAccount.vue'),
  //   meta: {
  //     layout: 'Admin'
  //   }
  // },
  {
    path: '/menus',
    name: 'Menus',
    component: () => import('../views/Menus.vue'),
    meta: {
      layout: 'default'
    }
  }
>>>>>>> 8b770451d92844c08881c8a6e7b7f947f24f392c
]
const router = createRouter({
  linkActiveClass: 'active',
  history,
  routes
})

export { router }
