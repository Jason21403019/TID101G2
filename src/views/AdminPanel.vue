<template>
  <AdminBreadcrumb :items="breadcrumbItems" />
  <!-- 標題 -->
  <div class="adminpanel">
    <h1 class="adminpanel-h1">{{ mainTitle }}</h1>
    <span class="adminpanel-pipe"> | </span>
    <h1 class="adminpanel-h1">{{ subTitle }}</h1>
  </div>

  <!-- 管理者資料 -->
  <section class="panelblock">
    <form @submit.prevent="handleSave">
      <div class="row mb-3">
        <label for="nameInput" class="col-sm-1 col-form-label">姓名</label>
        <div class="col-sm-3">
          <input
            id="nameInput"
            v-model="admin.employee_name"
            type="text"
            class="form-control"
            @blur="validateField('employee_name')"
          />
          <div v-if="errors.employee_name" class="text-danger">{{ errors.employee_name }}</div>
        </div>
      </div>
      <div class="row mb-3">
        <label for="phoneInput" class="col-sm-1 col-form-label">電話</label>
        <div class="col-sm-3">
          <input id="phoneInput" v-model="admin.phone" type="text" class="form-control" @blur="validateField('phone')" />
          <div v-if="errors.phone" class="text-danger">{{ errors.phone }}</div>
        </div>
      </div>
      <div class="row mb-3">
        <label for="emailInput" class="col-sm-1 col-form-label">Email</label>
        <div class="col-sm-3">
          <input id="emailInput" v-model="admin.email" type="email" class="form-control" @blur="validateField('email')" />
          <div v-if="errors.email" class="text-danger">{{ errors.email }}</div>
        </div>
      </div>
      <div class="row mb-3">
        <label for="positionInput" class="col-sm-1 col-form-label">職位</label>
        <div class="col-sm-3">
          <input id="positionInput" v-model="admin.job" type="text" class="form-control" disabled />
        </div>
      </div>
      <!-- 按鈕 -->
      <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        <admin-btn type="submit">
          <template #text>儲存</template>
        </admin-btn>
      </div>
    </form>
  </section>
</template>

<script>
import AdminBreadcrumb from '../components/AdminBreadcrumb.vue'
import AdminBtn from '../components/AdminBtn.vue'
import Swal from 'sweetalert2'
import { useAdminStore } from '../stores/admin'
import { variables } from '../js/AdminVariables.js'

export default {
  name: 'AdminPanel',
  components: {
    AdminBreadcrumb,
    AdminBtn
  },
  data() {
    return {
      mainTitle: variables.adminpanel.panel,
      subTitle: variables.adminpanel.profile,
      breadcrumbItems: [
        { text: '首頁', link: '/admin', active: false },
        { text: variables.adminpanel.panel, link: '', active: true },
        { text: variables.adminpanel.profile, link: '/admin_panel', active: false }
      ],
      admin: {
        employee_name: '',
        phone: '',
        email: '',
        job: ''
      },
      errors: {
        employee_name: '',
        phone: '',
        email: ''
      }
    }
  },
  async mounted() {
    await this.loadAdminData()
  },
  methods: {
    async loadAdminData() {
      const adminStore = useAdminStore()

      await adminStore.fetchAdmins()
      const currentUser = adminStore.adminUser

      if (currentUser) {
        const adminData = adminStore.admins.find((admin) => admin.id === currentUser.id)

        if (adminData) {
          this.admin = { ...adminData }
        } else {
          console.error('Failed to load admin data.')
        }
      } else {
        console.error('Current user not found.')
      }
    },
    async handleSave() {
      // if (!this.validateForm()) {
      //   return
      // }
      if (!this.validateForm()) {
        Swal.fire({
          title: '錯誤',
          text: '還有欄位有錯誤，請確認',
          icon: 'error',
          confirmButtonText: '確定'
        })

        return
      }
      const adminStore = useAdminStore()
      const result = await adminStore.updateAdmin(this.admin)

      if (result.success) {
        await this.loadAdminData() // 確保保存後加載最新資料
        Swal.fire({
          title: '成功',
          text: '資料更新成功',
          icon: 'success',
          confirmButtonText: '確定'
        })
      } else {
        Swal.fire({
          title: '錯誤',
          text: '資料更新失敗',
          icon: 'error',
          confirmButtonText: '確定'
        })
      }
    },
    async validateField(field) {
      if (field === 'phone') {
        const phone = this.admin.phone.replace(/[^0-9]/g, '') // 移除所有非數字字符
        const phonePattern = /^09\d{8}$/

        if (phonePattern.test(phone)) {
          this.admin.phone = phone // 將手機號碼轉換為09XXXXXXXX格式
          this.errors.phone = ''
        } else {
          this.errors.phone = '請輸入有效的手機號碼'
        }
      } else if (field === 'email') {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/

        if (!emailPattern.test(this.admin.email)) {
          this.errors.email = 'Email格式錯誤'
        } else {
          // 檢查Email是否重複
          const adminStore = useAdminStore()
          const isDuplicate = await adminStore.checkEmail({ email: this.admin.email, id: this.admin.id })

          if (isDuplicate) {
            this.errors.email = 'Email已存在'
          } else {
            this.errors.email = ''
          }
        }
      } else if (!this.admin[field]) {
        this.errors[field] = '該欄位為必填欄位'
      } else {
        this.errors[field] = ''
      }
    },
    validateForm() {
      this.validateField('employee_name')
      this.validateField('phone')
      this.validateField('email')

      return !this.errors.employee_name && !this.errors.phone && !this.errors.email
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss';

.adminpanel {
  margin-top: 40px;
  margin-left: 160px;
  color: $campari;
  &-h1 {
    display: inline;
    font-size: $fontSize_h3;
  }
  &-pipe {
    font-size: $fontSize_h3;
    margin: 0 20px;
  }
}
.panelblock {
  margin-top: 80px;
  font-size: $fontSize_h4;
  color: $campari;

  .col-form-label {
    margin-left: 160px;
  }

  .d-grid {
    margin-top: 40px;
    margin-left: 160px;
  }
  .admin_btn {
    &:hover {
      opacity: 0.7;
    }
  }
}
</style>
