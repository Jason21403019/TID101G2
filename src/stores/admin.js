import { defineStore } from 'pinia'

export const useAdminStore = defineStore('admin', {
  state: () => ({
    adminUser: null,
    isLoggedIn: false,
    admins: []
  }),
  actions: {
    async login(params) {
      try {
        const protocol = window.location.protocol
        const hostname = window.location.hostname
        const apiUrl = `${protocol}//${hostname}/TID101G2/public/api`
        const url = `${apiUrl}/adminaccount.php` // 動態設置 URL,對應該資料表.php

        params.action = 'login'

        const response = await fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(params)
        })

        const data = await response.json()

        if (data.success) {
          const adminUserContent = data.adminUser[0]

          this.adminUser = adminUserContent
          this.isLoggedIn = true
          localStorage.setItem('admin_user', JSON.stringify(adminUserContent))

          return { success: true, adminUser: adminUserContent }
        } else {
          return { success: false, message: data.message }
        }
      } catch (error) {
        console.error('Error parsing JSON:', error)

        return { success: false, message: error.message }
      }
    },
    logout() {
      this.adminUser = null
      this.isLoggedIn = false
      localStorage.removeItem('admin_user')
    },

    // 管理者列表
    async fetchAdmins() {
      try {
        const protocol = window.location.protocol
        const hostname = window.location.hostname
        const apiUrl = `${protocol}//${hostname}/TID101G2/public/api`
        const url = `${apiUrl}/adminaccount.php` // 動態設置 URL,對應該資料表.php

        const response = await fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ action: 'fetch' })
        })

        const data = await response.json()

        if (data.success) {
          data.admins.forEach((admin) => {
            admin.admin_status = admin.admin_status === 1 // 動態轉換
          })
          this.admins = data.admins

          return { success: true, admins: data.admins }
        } else {
          return { success: false, message: data.message }
        }
      } catch (error) {
        console.error('Failed to fetch admins', error)

        return { success: false, message: error.message }
      }
    },

    // 新增管理者
    async createAdmin(params) {
      try {
        const protocol = window.location.protocol
        const hostname = window.location.hostname
        const apiUrl = `${protocol}//${hostname}/TID101G2/public/api/adminaccount.php`
        const url = `${apiUrl}/adminaccount.php` // 動態設置 URL,對應該資料表.php

        // 將 boolean 轉換為數字
        params.admin_status = params.admin_status ? 1 : 0
        params.action = 'create'

        const response = await fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(params)
        })

        const data = await response.json()

        if (data.success) {
          data.newAdmin.admin_status = data.newAdmin.admin_status === 1

          return { success: true, newAdmin: data.newAdmin }
        } else {
          return { success: false, message: data.message }
        }
      } catch (error) {
        console.error('Failed to create admin', error)

        return { success: false, message: error.message }
      }
    },

    // 編輯管理者
    async updateAdmin(params) {
      try {
        const protocol = window.location.protocol
        const hostname = window.location.hostname
        const apiUrl = `${protocol}//${hostname}/TID101G2/public/api`
        const url = `${apiUrl}/adminaccount.php` // 動態設置 URL,對應該資料表.php

        // 將booylean轉換數字
        params.admin_status = params.admin_status ? 1 : 0
        params.action = 'update'

        const response = await fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(params)
        })

        const data = await response.json()

        if (data.success) {
          data.updatedAdmin.admin_status = data.updatedAdmin.admin_status === 1

          return { success: true, updatedAdmin: data.updatedAdmin }
        } else {
          return { success: false, message: data.message }
        }
      } catch (error) {
        console.error('Failed to update admin', error)

        return { success: false, message: error.message }
      }
    },
    // 檢查Email
    async checkEmail(params) {
      try {
        const protocol = window.location.protocol
        const hostname = window.location.hostname
        const apiUrl = `${protocol}//${hostname}/TID101G2/public/api` // 到時候改路徑
        const url = `${apiUrl}/adminaccount.php`

        params.action = 'checkEmail'

        const response = await fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(params)
        })

        const data = await response.json()

        if (!response.ok) {
          throw new Error(data.message || '檢查 email 失敗')
        }

        return data.exists
      } catch (error) {
        console.error('Error checking email:', error)

        return false
      }
    }
  }
})
