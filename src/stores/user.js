import { defineStore } from 'pinia'

export const useUserStore = defineStore('user', {
  state: () => ({
    isLoggedIn: null
    // userid: null
    // username: null
  }),
  actions: {
    toggleLogin() {
      this.isLoggedIn = !this.isLoggedIn
    },
    login(userid) {
      this.isLoggedIn = userid
      // this.username = username
      localStorage.setItem('isLoggedIn', userid)
      // 可以進一步存儲用戶數據，例如用戶名
      // localStorage.setItem('username', username)
    },
    logout() {
      this.isLoggedIn = null
      localStorage.clear('isLoggedIn') // 清除所有本地存儲數據
    },
    checkLoginStatus() {
      const login_check = localStorage.getItem('isLoggedIn')
      if (login_check) {
        this.isLoggedIn = login_check
        return true
      }
      return false

      // this.isLoggedIn = localStorage.getItem('isLoggedIn')
      // 這裡可以進一步恢復其他用戶數據
    }
  }
})
