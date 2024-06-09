<template>
  <div class="modal fade" ref="typeModal" id="typeModal" tabindex="-1" aria-labelledby="typeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="typeModalLabel">{{ modalTitle }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="handleSave">
            <div class="mb-3">
              <label for="type-name" class="form-label">名稱:</label>
              <input type="text" class="form-control" id="type-name" v-model="type.name" />
            </div>
            <div class="mb-3">
              <label for="type-memo" class="form-label">備註:</label>
              <textarea class="form-control" id="type-memo" v-model="type.memo"></textarea>
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
    type: {
      type: Object,
      required: true,
      default: () => ({
        name: '',
        memo: ''
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
      return this.actionType === 'add' ? '新增類別' : '編輯類別'
    },
    modalButtonText() {
      return this.actionType === 'add' ? '新增' : '更新'
    }
  },
  methods: {
    show() {
      const modalElement = this.$refs.typeModal
      if (modalElement) {
        this.myModal = new bootstrap.Modal(modalElement)
        this.myModal.show()
      } else {
        console.error('typeModal reference is not found.')
      }
    },
    handleSave() {
      this.onSave(this.type)
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

#typeModal{
  font-size: $fontSize_h4;
  color: $campari;

  .modal-header{
    background-color: $babypowder;
  }

  .modal-body{
    background-color: $babypowder;

    .col-form-label{
      font-size: $fontSize_h4;
    }

    .form-control{
      outline: 1px solid $campari;
    }
    .form-check-input:checked{
      background-color: $toggle-on;
      border: solid $toggle-on;
    }
  }
  .btn{
    background-color: $campari;
    color: $ramos-gin-fizz;
  }
  .modal-footer{
    background-color: $babypowder;
  }
}

</style>