<template>
  <div
    id="categoryModal"
    ref="categoryModal"
    class="modal fade"
    tabindex="-1"
    aria-labelledby="categoryModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 id="categoryModalLabel" class="modal-title fs-5">{{ modalTitle }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="handleSave">
            <div class="mb-3">
              <label for="category-id" class="form-label">ID:</label>
              <input id="category-id" v-model="categoryData.id" type="text" class="form-control" :readonly="actionType === 'edit'" />
            </div>
            <div class="mb-3">
              <label for="category-memo" class="form-label">備註:</label>
              <textarea id="category-memo" v-model="categoryData.note" class="form-control"></textarea>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">{{ modalButtonText }}</button>
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
    category: {
      type: Object,
      required: true,
      default: () => ({
        id: '',
        note: ''
      })
    }
  },
  data() {
    return {
      categoryData: {
        id: '',
        note: ''
      },
      myModal: null
    }
  },
  computed: {
    modalTitle() {
      return this.actionType === 'add' ? '分類新增' : '分類編輯'
    },
    modalButtonText() {
      return this.actionType === 'add' ? '新增' : '更新'
    }
  },
  watch: {
    category: {
      immediate: true,
      handler(newVal) {
        if (newVal) {
          this.categoryData = { ...newVal }
        } else {
          this.categoryData = {
            id: '',
            note: ''
          }
        }
      }
    }
  },
  mounted() {
    const modalElement = this.$refs.categoryModal
    if (modalElement) {
      this.myModal = new bootstrap.Modal(modalElement)
    } else {
      console.error('categoryModal reference is not found.')
    }
  },
  methods: {
    show() {
      if (this.myModal) {
        this.myModal.show()
      } else {
        console.error('Modal instance is not available to show.')
      }
    },
    hide() {
      if (this.myModal) {
        this.myModal.hide()
      } else {
        console.error('Modal instance is not available to hide.')
      }
    },
    async handleSave() {
      try {
        if (this.actionType === 'add') {
          // 新增分類
          const response = await axios.post(`${import.meta.env.VITE_PHP_PATH}adminarticle_class.php`, this.categoryData);
          console.log('新增分類成功:', response.data);
        } else {
          // 修改分類
          if (!this.categoryData.id) {
            throw new Error('無效輸入或缺少原始ID。');
          }
          const response = await axios.put(`${import.meta.env.VITE_PHP_PATH}adminarticle_class.php?id=${this.categoryData.id}`, this.categoryData);
          console.log('修改分類成功:', response.data);
        }
        this.$emit('save', this.categoryData);
        this.hide();
      } catch (error) {
        console.error('儲存分類失敗:', error);
      }
    }
  }
}
</script>
<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss';

#categoryModal {
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
  .modal-footer {
    background-color: $babypowder;
    .btn {
      background-color: $campari;
      color: $ramos-gin-fizz;
    }
  }
}
</style>
