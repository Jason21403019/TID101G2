<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mt-5">
          <div class="card-header">
            <h3 class="text-center">後台登入</h3>
          </div>
          <div class="card-body">
            <div v-if="isSuspended" class="alert alert-danger d-flex align-items-center" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                <use xlink:href="#exclamation-triangle-fill" />
              </svg>
              <div>您的帳戶目前無法登入後台系統，如有問題請洽後台管理員。</div>
            </div>
            <form @submit.prevent="handleSubmit">
              <div class="form-group">
                <label for="email">電子郵件</label>
                <input id="email" v-model="email" type="email" class="form-control" placeholder="請輸入電子郵件" />
              </div>
              <div class="form-group">
                <label for="password">密碼</label>
                <input id="password" v-model="password" type="password" class="form-control" placeholder="請輸入密碼" />
              </div>
              <button type="submit" class="btn btn-primary">登入</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useAdminStore } from '../stores/admin'

export default {
  name: 'AdminLogin',
  data() {
    return {
      email: '',
      password: ''
    }
  },
  computed: {
    isSuspended() {
      const adminStore = useAdminStore()

      return adminStore.isSuspended
    }
  },
  methods: {
    async handleSubmit() {
      const adminStore = useAdminStore()

      try {
        const params = {}

        params.email = this.email
        params.password = this.password

        const response = await adminStore.login(params)

        if (response.success) {
          const adminUser = response.adminUser

          // 檢查 admin_status
          if (adminUser.admin_status === 0) {
            adminStore.setSuspended(true)
            localStorage.removeItem('admin_user')

            return
          }

          adminStore.adminUser = adminUser // 確保設置正確的 管理者 物件
          adminStore.isLoggedIn = true // 設置為已登入
          adminStore.setSuspended(false) // 清除停權標記

          if (adminUser.job === '老闆' || adminUser.job === '主管') {
            this.$router.push({ path: '/admin_account' }) // 老闆、主管導向管理者帳號頁面
          } else {
            this.$router.push({ path: '/admin' }) // 員工導向後台首頁
          }
        } else {
          alert(response.message)
        }
      } catch (error) {
        console.error('Error during login:', error)
        alert('登入時發生錯誤，請稍後再試。')
      }
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss';
.container {
  padding: 5px;
  font-size: $fontSize_h4;

  .text-center {
    font-size: $fontSize_h3;
  }
  body {
    background-color: $babypowder;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .card {
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  .card-header {
    background-color: $irishcoffee;
    color: $babypowder;
    border-bottom: none;
    border-radius: 10px 10px 0 0;
    padding: 10px;
  }
  label,
  .form-control {
    margin-bottom: 10px;
  }

  .btn-primary {
    background-color: $campari;
    border-color: $campari;
  }
}
</style>
