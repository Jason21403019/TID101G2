import { defineStore } from 'pinia'

export const useUserStore = defineStore('user', {
  state: () => ({
    isLoggedIn: false
  }),
  actions: {
    toggleLogin() {
      this.isLoggedIn = !this.isLoggedIn
    },
    login(userData) {
      this.isLoggedIn = true
      localStorage.setItem('isLoggedIn', 'true')
      // 可以進一步存儲用戶數據，例如用戶名
      localStorage.setItem('username', userData.username)
    },
    logout() {
      this.isLoggedIn = false
      localStorage.clear() // 清除所有本地存儲數據
    },
    checkLoginStatus() {
      this.isLoggedIn = localStorage.getItem('isLoggedIn') === 'true'
      // 這裡可以進一步恢復其他用戶數據
    }
  }
})
