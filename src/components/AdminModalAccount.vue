<template>
  <div class="modal fade" ref="adminModal" id="adminModal" tabindex="-1" aria-labelledby="adminModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="adminModalLabel">{{ modalTitle }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="handleSave">
            <div class="mb-3">
              <label for="admin-name" class="col-form-label">姓名:</label>
              <input type="text" class="form-control" id="admin-name" v-model="admin.name" />
            </div>
            <div class="mb-3">
              <label for="admin-email" class="col-form-label">Email:</label>
              <input type="email" class="form-control" id="admin-email" v-model="admin.email" />
            </div>
            <div class="mb-3">
              <label for="admin-phone" class="col-form-label">手機:</label>
              <input type="tel" class="form-control" id="admin-phone" v-model="admin.phone" />
            </div>
            <div class="mb-3">
              <label for="admin-password" class="col-form-label">設定密碼:</label>
              <input type="password" class="form-control" id="admin-password" v-model="admin.password" />
            </div>
            <div class="mb-3">
              <label for="admin-position" class="col-form-label">職位:</label>
              <select class="form-select" id="admin-position" v-model="admin.position">
                <option value="supervisor">主管</option>
                <option value="employee">員工</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="admin-status" class="col-form-label">停用/啟用:</label>
              <div class="form-check form-switch">
                <input id="flexSwitchCheckChecked" class="form-check-input" type="checkbox" v-model="admin.status" />
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
        name: '',
        email: '',
        phone: '',
        password: '',
        position: '',
        status: false
      })
    },
    onSave: {
      type: Function,
      required: true
    }
  },
  data() {
    return {
      myModal: null
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
        this.myModal = new bootstrap.Modal(modalElement)
        this.myModal.show()
      } else {
        console.error('adminModal reference is not found.')
      }
    },
    handleSave() {
      this.onSave(this.admin)
      if (this.myModal) {
        this.myModal.hide()
      } else {
        console.error('Modal instance is not available to hide.')
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
