<template>
  <div id="adminModal" ref="adminModal" class="modal fade" tabindex="-1" aria-labelledby="adminModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 id="adminModalLabel" class="modal-title fs-5">{{ modalTitle }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="handleSave">
            <div class="mb-3">
              <label for="admin-name" class="col-form-label">姓名:</label>
              <input id="admin-name" v-model="admin.employee_name" type="text" class="form-control" />
            </div>
            <div class="mb-3">
              <label for="admin-email" class="col-form-label">Email:</label>
              <input id="admin-email" v-model="admin.email" type="email" class="form-control" @blur="checkEmail" />
              <div v-if="emailError" class="text-danger">{{ emailError }}</div>
            </div>
            <div class="mb-3">
              <label for="admin-phone" class="col-form-label">手機:</label>
              <input id="admin-phone" v-model="admin.phone" type="tel" class="form-control" />
            </div>
            <div class="mb-3">
              <label for="admin-password" class="col-form-label">設定密碼:</label>
              <input id="admin-password" v-model="admin.password" type="password" class="form-control" />
            </div>
            <div class="mb-3">
              <label for="admin-job" class="col-form-label">職位:</label>
              <select id="admin-job" v-model="admin.job" class="form-select">
                <option value="老闆">老闆</option>
                <option value="主管">主管</option>
                <option value="員工">員工</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="admin-status" class="col-form-label">停用/啟用:</label>
              <div class="form-check form-switch">
                <input id="flexSwitchCheckChecked" v-model="admin.admin_status" class="form-check-input" type="checkbox" />
              </div>
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
import { useAdminStore } from '../stores/admin'

export default {
  props: {
    actionType: {
      type: String,
      required: true
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
    onSave: {
      type: Function,
      required: true
    }
  },
  data() {
    return {
      myModal: null,
      errorMessage: '', // 用於儲存錯誤訊息
      emailError: '' // 用於儲存Email錯誤訊息
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
    show() {
      const modalElement = this.$refs.adminModal

      if (modalElement) {
        this.errorMessage = '' // 用於儲存錯誤訊息
        this.emailError = '' // 用於儲存Email錯誤訊息
        this.myModal = new bootstrap.Modal(modalElement)
        this.myModal.show()
      } else {
        console.error('adminModal reference is not found.')
      }
    },
    async handleSave() {
      const result = await this.onSave(this.admin)

      if (result.success) {
        if (this.myModal) {
          this.myModal.hide()
        } else {
          console.error('Modal instance is not available to hide.')
        }
      } else {
        this.errorMessage = result.message
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

      const isDuplicate = await adminStore.checkEmail(params)

      if (isDuplicate) {
        this.emailError = '該Email帳號已存在'
      } else {
        this.emailError = ''
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
}
</style>
