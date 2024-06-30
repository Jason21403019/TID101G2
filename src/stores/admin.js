import { defineStore } from 'pinia'

export const useAdminStore = defineStore('admin', {
  state: () => ({
    adminUser: null,
    isLoggedIn: false,
    isSuspended: false, // 權限
    admins: []
  }),
  actions: {
    async login(params) {
      try {
        const apiUrl = import.meta.env.VITE_PHP_PATH
        const url = `${apiUrl}adminaccount.php`

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
          this.isSuspended = adminUserContent.admin_status === 0 // 根據 admin_status 設置 isSuspended
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
    // 停權權限檢查
    canSuspend(targetUser) {
      if (!this.adminUser) return false
      const currentUserRole = this.adminUser.job
      const targetUserRole = targetUser.job

      // 不允許停權自己
      if (this.adminUser.id === targetUser.id) {
        return false
      }
      // 主管可以停權員工，但不能停權老闆
      const roleHierarchy = {
        員工: 1,
        主管: 2,
        老闆: 3
      }

      return roleHierarchy[currentUserRole] > roleHierarchy[targetUserRole]
    },
    // 管理者列表
    async fetchAdmins() {
      try {
        const apiUrl = import.meta.env.VITE_PHP_PATH
        const url = `${apiUrl}adminaccount.php`

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
        const apiUrl = import.meta.env.VITE_PHP_PATH
        const url = `${apiUrl}adminaccount.php`

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
    async updateAdmin(params, originalAdmin) {
      // 先處理老闆編輯自己的資料，但不能停權自己
      if (!params.admin_status && originalAdmin.admin_status) {
        if (this.adminUser.job === '老闆' && this.adminUser.id === params.id) {
          if (params.admin_status === 0) {
            return { success: false, message: '您無權停權自己' }
          }
        } else if (this.adminUser.job === '主管' && this.adminUser.id === params.id) {
          // 主管編輯自己的資料，但不能停權自己
          if (params.admin_status === 0) {
            return { success: false, message: '您無權停權自己' }
          }
        } else if (!this.canSuspend(params)) {
          // 檢查是否有權限停權其他人
          return { success: false, message: '您無權停權此用戶' }
        }
      }

      try {
        const apiUrl = import.meta.env.VITE_PHP_PATH
        const url = `${apiUrl}adminaccount.php`

        // 將booylean轉換數字
        params.admin_status = params.admin_status ? 1 : 0
        params.action = 'update'
        params.currentAdminId = this.adminUser.id // 傳遞當前操作用戶的 ID

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
        const apiUrl = import.meta.env.VITE_PHP_PATH
        const url = `${apiUrl}adminaccount.php`

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
    },
    // 接收router呼叫
    setSuspended(status) {
      this.isSuspended = status
    }
  }
})
