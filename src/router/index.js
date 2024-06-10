// import AboutUs from '../views/AboutUs.vue'
import { createRouter, createWebHashHistory } from 'vue-router'

const history = createWebHashHistory()
const routes = [
  // 登入前後台頁面
  {
    path: '/login_page',
    name: 'loginpage',
    component: () => import('../views/LoginPage.vue'),
    meta: {
      layout: 'logindefault'
    }
  },
  // 首頁
  {
    path: '/',
    name: 'Home',
    component: () => import('../views/Home.vue'),
    meta: {
      layout: 'default'
    }
  },
  // 關於我們
  {
    path: '/about_us',
    name: 'AboutUs',
    component: () => import('../views/AboutUs.vue'),
    meta: {
      layout: 'default'
    }
  },
  // 常見問題
  {
    path: '/questions',
    name: 'Questions',
    component: () => import('../views/Questions.vue'),
    meta: {
      layout: 'default'
    }
  },
  // 預約訂位
  {
    path: '/reserve_first',
    name: 'Reserve_first',
    component: () => import('../views/ReserveFirst.vue'),
    meta: {
      layout: 'default'
    }
  },
  // 訂位確認
  {
    path: '/reserve_sec',
    name: 'Reserve_sec',
    component: () => import('../views/ReserveSec.vue'),
    meta: {
      layout: 'default'
    }
  },
  // 菜單
  {
    path: '/menus',
    name: 'Menus',
    component: () => import('../views/Menus.vue'),
    meta: {
      layout: 'default'
    }
  },
  // 酒品專欄
  {
    path: '/wine_column',
    name: 'WineColumn',
    component: () => import('../views/WineColumn.vue'),
    meta: {
      layout: 'default'
    }
  },
  // 酒類知識
  {
    path: '/wine_column_wk',
    name: 'WineColumnWK',
    component: () => import('../views/WineColumnWK.vue'),
    meta: {
      layout: 'default'
    }
  },
  // 國外報導
  {
    path: '/wine_column_news',
    name: 'WineColumnNews',
    component: () => import('../views/WineColumnNews.vue'),
    meta: {
      layout: 'default'
    }
  },
  // 調酒新世界
  {
    path: '/wine_column_nc',
    name: 'WineColumnNC',
    component: () => import('../views/WineColumnNC.vue'),
    meta: {
      layout: 'default'
    }
  },
  // 文章頁面
  {
    path: '/wine_article',
    name: 'WineArticle',
    component: () => import('../views/WineArticle.vue'),
    meta: {
      layout: 'default'
    }
  },
  // 熱門商品
  {
    path: '/product',
    name: 'Product',
    component: () => import('../views/Product.vue'),
    meta: {
      layout: 'default'
    }
  },
  // 購物車
  {
    path: '/cart',
    name: 'Cart',
    component: () => import('../views/Cart.vue'),
    meta: {
      layout: 'default'
    }
  },

  // 測驗遊戲
  {
    path: '/quizgame',
    name: 'Quizgame',
    component: () => import('../views/QuizGame.vue'),
    meta: {
      layout: 'default'
    }
  },
  // 註冊
  {
    path: '/register',
    name: 'Register',
    component: () => import('../views/Register.vue'),
    meta: {
      layout: 'default'
    }
  },
  // 後台登入
  {
    path: '/admin_login',
    name: 'AdminLogin',
    component: () => import('../views/AdminLogin.vue'),
    meta: {
      layout: 'Admin'
    }
  },
  // 後台個人資料管理
  {
    path: '/admin_panel',
    name: 'AdminPanel',
    component: () => import('../views/AdminPanel.vue'),
    meta: {
      layout: 'Admin'
    }
  },
  // 後台首頁
  {
    path: '/admin',
    name: 'Admin',
    component: () => import('../views/Admin.vue'),
    meta: {
      layout: 'Admin'
    }
  },
  // 後台會員管理
  {
    path: '/admin_member',
    name: 'AdminMember',
    component: () => import('../views/AdminMember.vue'),
    meta: {
      layout: 'Admin'
    }
  },
  // 後台商品列別管理
  {
    path: '/admin_type',
    name: 'AdminType',
    component: () => import('../views/AdminType.vue'),
    meta: {
      layout: 'Admin'
    }
  },
  // 後台商品管理
  {
    path: '/admin_product',
    name: 'AdminProduct',
    component: () => import('../views/AdminProduct.vue'),
    meta: {
      layout: 'Admin'
    }
  },
  // 後台訂單管理
  {
    path: '/admin_order',
    name: 'AdminOrder',
    component: () => import('../views/AdminOrder.vue'),
    meta: {
      layout: 'Admin'
    }
  },
  // 後台文章分類管理
  {
    path: '/admin_category',
    name: 'AdminCategory',
    component: () => import('../views/AdminCategory.vue'),
    meta: {
      layout: 'Admin'
    }
  },
  // 後台文章管理
  {
    path: '/admin_article',
    name: 'AdminArticle',
    component: () => import('../views/AdminArticle.vue'),
    meta: {
      layout: 'Admin'
    }
  },
  // 後台訂位管理
  {
    path: '/admin_res',
    name: 'AdminRes',
    component: () => import('../views/AdminRes.vue'),
    meta: {
      layout: 'Admin'
    }
  },
  // 後台帳號管理
  {
    path: '/admin_account',
    name: 'AdminAccount',
    component: () => import('../views/AdminAccount.vue'),
    meta: {
      layout: 'Admin'
    }
  },
  {
    // 登入前後台頁面
    path: '/login_page',
    name: 'loginpage',
    component: () => import('../views/LoginPage.vue'),
    meta: {
      layout: 'logindefault'
    }
  },
  // 訂位確認
  {
    path: '/admin_panel',
    name: 'AdminPanel',
    component: () => import('../views/AdminPanel.vue'),
    meta: {
      layout: 'Admin'
    }
  }
]
const router = createRouter({
  linkActiveClass: 'active',
  history,
  routes
})

export { router }
