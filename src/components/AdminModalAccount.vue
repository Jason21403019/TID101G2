<template>
  <div id="adminModal" ref="modal" class="modal fade" tabindex="-1" aria-labelledby="adminModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 id="adminModalLabel" class="modal-title fs-5">{{ modalTitle }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="handleSave">
            <div class="mb-3">
              <label for="admin-name" class="col-form-label"> <span class="text-danger">*</span>姓名: </label>
              <input id="admin-name" v-model="admin.employee_name" type="text" class="form-control" @blur="checkName" />
              <div v-if="nameError" class="text-danger">{{ nameError }}</div>
            </div>
            <div class="mb-3">
              <label for="admin-email" class="col-form-label"><span class="text-danger">*</span>Email:</label>
              <input
                id="admin-email"
                v-model="admin.email"
                type="email"
                class="form-control"
                autocomplete="email"
                @blur="checkEmail"
              />
              <div v-if="emailError" class="text-danger">{{ emailError }}</div>
            </div>
            <div class="mb-3">
              <label for="admin-phone" class="col-form-label"><span class="text-danger">*</span>手機:</label>
              <input id="admin-phone" v-model="admin.phone" type="tel" class="form-control" @blur="checkPhone" />
              <div v-if="phoneError" class="text-danger">{{ phoneError }}</div>
            </div>
            <div class="mb-3">
              <label for="admin-password" class="col-form-label"
                ><span v-if="actionType === 'add'" class="text-danger">*</span>設定密碼:</label
              >
              <input
                v-if="actionType === 'edit'"
                id="admin-password"
                v-model="admin.password"
                type="password"
                class="form-control"
                :class="{ 'bg-gray': !isEditing, 'bg-white': isEditing }"
                :placeholder="isEditing ? '' : '點擊可修改新密碼'"
                autocomplete="current-password"
                @focus="onFocusEdit"
                @blur="onBlurEdit"
              />
              <!-- 如果是點擊新增，呈現一般輸入框 -->
              <input
                v-else
                id="admin-password"
                v-model="admin.password"
                type="password"
                class="form-control"
                :class="{ 'bg-white': isAdding }"
                :placeholder="isAdding ? '' : '請輸入密碼'"
                autocomplete="current-password"
                @focus="onFocusAdd"
                @blur="onBlurAdd"
              />
              <div v-if="passwordError" class="text-danger">{{ passwordError }}</div>
            </div>
            <div class="mb-3">
              <label for="admin-job" class="col-form-label"><span class="text-danger">*</span>職位:</label>
              <select id="admin-job" v-model="admin.job" class="form-select" @blur="checkJob">
                <option disabled value="">請選擇職位</option>
                <option v-for="role in roles" :key="role" :value="role">{{ role }}</option>
              </select>
              <div v-if="jobError" class="text-danger">{{ jobError }}</div>
              <!-- 降級提示 -->
              <div v-if="permissionError" class="text-danger">{{ permissionError }}</div>
            </div>
            <div class="mb-3">
              <label for="admin-status" class="col-form-label"><span class="text-danger">*</span>停用/啟用:</label>
              <div class="form-check form-switch">
                <input
                  id="flexSwitchCheckChecked"
                  v-model="admin.admin_status"
                  class="form-check-input"
                  type="checkbox"
                  @change="checkPermissionAndToggle"
                />
              </div>
              <div v-if="errorMessage" class="text-danger">{{ errorMessage }}</div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn">{{ modalButtonText }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Swal from 'sweetalert2'
import { useAdminStore } from '../stores/admin'

export default {
  props: {
    actionType: {
      type: String,
      required: true
    },
    roles: {
      type: Array,
      required: true // 確保傳入的 roles prop 是必需的
    },
    admin: {
      type: Object,
      required: true,
      default: () => ({
        employee_name: '',
        email: '',
        phone: '',
        password: '',
        job: '',
        admin_status: false
      })
    },
    originalAdmin: {
      type: Object,
      required: false,
      default: null
    },
    onSave: {
      type: Function,
      required: true
    }
  },
  data() {
    return {
      myModal: null,
      errorMessage: '', // 用於儲存錯誤訊息
      isEditing: false, // 初始狀態為未編輯
      isAdding: false, // 初始狀態為未新增
      nameError: '',
      emailError: '',
      phoneError: '',
      passwordError: '',
      jobError: '',
      permissionError: ''
    }
  },
  computed: {
    modalTitle() {
      return this.actionType === 'add' ? '新增管理者' : '編輯管理者'
    },
    modalButtonText() {
      return this.actionType === 'add' ? '新增' : '更新'
    }
  },
  methods: {
    onFocusEdit() {
      this.isEditing = true
    },
    onBlurEdit() {
      if (!this.admin.password) {
        this.isEditing = false
      }
    },
    onFocusAdd() {
      this.isAdding = true
    },
    onBlurAdd() {
      if (!this.admin.password) {
        this.isAdding = false
      }
      this.checkPassword()
    },
    resetStatus() {
      this.isEditing = false
      this.isAdding = false
      this.errorMessage = '' // 用於儲存錯誤訊息
      this.nameError = ''
      this.emailError = ''
      this.phoneError = ''
      this.passwordError = ''
      this.jobError = ''
      this.permissionError = ''
    },
    show() {
      const modalElement = this.$refs.modal

      if (modalElement) {
        this.myModal = new bootstrap.Modal(modalElement)
        this.myModal.show()
      } else {
        console.error('adminModal reference is not found.')
      }
    },
    async handleSave() {
      if (!this.checkRequiredFields()) {
        return
      }

      const result = await this.onSave(this.admin)

      if (result.success) {
        if (this.myModal) {
          this.myModal.hide()
          Swal.fire({
            title: '成功',
            text: this.actionType === 'add' ? '新增成功' : '更新成功',
            icon: 'success',
            confirmButtonText: '確定'
          })
        } else {
          console.error('Modal instance is not available to hide.')
        }
      } else {
        this.errorMessage = result ? result.message : 'Unknown error occurred'
      }
    },
    // Double check
    checkRequiredFields() {
      const adminStore = useAdminStore()
      const currentUser = adminStore.adminUser

      if (!this.admin.employee_name) {
        Swal.fire({
          title: '錯誤',
          text: '姓名是必填欄位',
          icon: 'error',
          confirmButtonText: '確定'
        })

        return false
      }
      if (!this.admin.email) {
        Swal.fire({
          title: '錯誤',
          text: 'Email是必填欄位',
          icon: 'error',
          confirmButtonText: '確定'
        })

        return false
      }
      if (!this.admin.phone) {
        Swal.fire({
          title: '錯誤',
          text: '手機是必填欄位',
          icon: 'error',
          confirmButtonText: '確定'
        })

        return false
      }
      if (this.actionType === 'add' && !this.admin.password) {
        Swal.fire({
          title: '錯誤',
          text: '密碼是必填欄位',
          icon: 'error',
          confirmButtonText: '確定'
        })

        return false
      }
      if (!this.admin.job) {
        Swal.fire({
          title: '錯誤',
          text: '職位是必填欄位',
          icon: 'error',
          confirmButtonText: '確定'
        })

        return false
      }
      // 檢查是否在編輯模式中進行降級檢查
      if (this.actionType === 'edit') {
        const permissionResult = this.checkPermissions(currentUser, this.admin, this.originalAdmin)

        if (!permissionResult.success) {
          Swal.fire({
            title: '錯誤',
            text: permissionResult.message,
            icon: 'error',
            confirmButtonText: '確定'
          })

          return false
        }
      }

      return true
    },
    checkName() {
      // 確保admin.employee_name存在並且不為空
      if (this.admin.employee_name && this.admin.employee_name.trim()) {
        this.nameError = ''
      } else {
        this.nameError = '請輸入姓名'
      }
    },
    async checkEmail() {
      // 簡單的email格式檢查
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/

      if (!emailPattern.test(this.admin.email)) {
        this.emailError = '請輸入有效的Email地址'

        return
      }

      // 呼叫Pinia store的檢查動作
      const adminStore = useAdminStore()
      const params = {}

      params.email = this.admin.email
      params.id = this.admin.id

      const isDuplicate = await adminStore.checkEmail(params)

      if (isDuplicate) {
        this.emailError = '該Email帳號已存在'
      } else {
        this.emailError = ''
      }
    },
    checkPhone() {
      // 檢查手機格式並轉換
      const phonePattern = /^(09\d{2})-?(\d{3})-?(\d{3})$|^(09\d{2})-?(\d{4})$/
      const phone = this.admin.phone.replace(/[^0-9]/g, '') // 移除所有非數字字符

      if (phonePattern.test(phone)) {
        this.admin.phone = phone // 將手機號碼轉換為09XXXXXXXX格式
        this.phoneError = ''
      } else {
        this.phoneError = '請輸入有效的手機號碼'
      }
    },
    checkPassword() {
      // 檢查密碼是否為空
      if (this.admin.password && this.admin.password.trim()) {
        this.passwordError = ''
      } else {
        this.passwordError = '密碼不能為空'
      }
    },
    checkJob() {
      const adminStore = useAdminStore()
      const currentUser = adminStore.adminUser

      if (!this.checkPermissions(currentUser, this.admin, this.originalAdmin)) {
        return
      }
      // 檢查是否選擇職位
      if (this.admin.job && this.admin.job !== '') {
        this.jobError = ''
      } else {
        this.jobError = '請選擇職位'
      }
    },
    checkPermissions(currentUser, admin, originalAdmin) {
      if (this.actionType === 'edit') {
        if (currentUser.job === '老闆') {
          if (currentUser.id === originalAdmin.id && admin.job !== '老闆') {
            this.permissionError = '您不能降級自己'

            return { success: false, message: '您不能降級自己' }
          }
          if (originalAdmin.job === '老闆' && originalAdmin.id === 1 && currentUser.id !== 1) {
            this.permissionError = '您不能降級最高權限者'

            return { success: false, message: '您不能降級最高權限者' }
          }
        }

        if (currentUser.job === '主管') {
          if (currentUser.id === originalAdmin.id && admin.job !== '主管') {
            this.permissionError = '您不能降級自己'

            return { success: false, message: '您不能降級自己' }
          }
          if (originalAdmin.job === '主管' && originalAdmin.id !== currentUser.id && admin.job !== '主管') {
            this.permissionError = '您不能降級其他主管'

            return { success: false, message: '您不能降級其他主管' }
          }
        }
      }

      return { success: true }
    },
    checkPermissionAndToggle() {
      const adminStore = useAdminStore()
      const currentUser = adminStore.adminUser

      if (this.actionType === 'edit') {
        if (currentUser.id === this.admin.id) {
          this.errorMessage = '您無權停權自己'
          this.admin.admin_status = !this.admin.admin_status // 恢復原狀態
        } else if (currentUser.job === this.admin.job) {
          this.errorMessage = '您無權停權他人'
          this.admin.admin_status = !this.admin.admin_status // 恢復原狀態
        } else {
          this.errorMessage = ''
        }
      }
    }
  }
}
</script>
<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss';

#adminModal {
  font-size: $fontSize_h4;
  color: $campari;

  .modal-header {
    background-color: $babypowder;
  }

  .modal-body {
    background-color: $babypowder;

    .col-form-label {
      font-size: $fontSize_h4;
    }

    .form-control {
      outline: 1px solid $campari;
    }
    .form-check-input:checked {
      background-color: $toggle-on;
      border: solid $toggle-on;
    }
  }
  .btn {
    background-color: $campari;
    color: $ramos-gin-fizz;
  }
  .modal-footer {
    background-color: $babypowder;
  }
  .bg-gray {
    background-color: #f0f0f0; /* 灰色背景 */
  }
  .bg-white {
    background-color: #ffffff; /* 白色背景 */
  }
}
</style>
