<template>
  <div id="typeModal" ref="typeModal" class="modal fade" tabindex="-1" aria-labelledby="typeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 id="typeModalLabel" class="modal-title fs-5">{{ modalTitle }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="handleSave">
            <div class="mb-3" v-if="actionType === 'add'">
              <label for="type-name" class="form-label">名稱:</label>
              <input id="type-name" v-model="type.id" type="text" class="form-control" />
            </div>
            <div class="mb-3">
              <label for="type-memo" class="form-label">備註:</label>
              <textarea id="type-memo" v-model="type.note" class="form-control"></textarea>
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
import axios from 'axios';

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
        id: '',
        note: ''
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
    async handleSave() {
      try {
        let response;
        if (this.actionType === 'add') {
          response = await axios.post(`${import.meta.env.VITE_PHP_PATH}AdminType.php`, this.type);
        } else {
          response = await axios.put(`/${import.meta.env.VITE_PHP_PATH}AdminType.php/${this.type.id}`, this.type);
        }

        if (response.data.success) {
          this.onSave(response.data.type);
          if (this.myModal) {
            this.myModal.hide();
          } else {
            console.error('Modal instance is not available to hide.');
          }
        } else {
          console.error('Error saving type:', response.data.message);
        }
      } catch (error) {
        console.error('Error saving type:', error);
      }
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss';

#typeModal {
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
