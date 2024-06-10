<template>
  <div class="modal fade" ref="articleModal" id="articleModal" tabindex="-1" aria-labelledby="articleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="articleModalLabel">{{ modalTitle }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="handleSave">
            <div class="mb-3">
              <label for="article-category" class="col-form-label">專欄分類:</label>
              <select class="form-select" id="article-category" v-model="article.category">
                <option value="酒類知識">酒類知識</option>
                <option value="國外報導">國外報導</option>
                <option value="調酒新世代">調酒新世代</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="article-title" class="col-form-label">專欄標題:</label>
              <input type="text" class="form-control" id="article-title" v-model="article.title">
            </div>
            <div class="mb-3">
              <label for="article-author" class="col-form-label">作者:</label>
              <input type="text" class="form-control" id="article-author" v-model="article.author">
            </div>
            <div class="mb-3">
              <label for="article-publish-date" class="col-form-label">發布時間:</label>
              <input type="date" class="form-control" id="article-publish-date" v-model="article.publishDate">
            </div>
            <div class="mb-3">
              <label for="article-content" class="col-form-label">專欄內容:</label>
              <textarea class="form-control" id="article-content" v-model="article.content"></textarea>
            </div>
            <div class="mb-3">
              <label for="article-image" class="col-form-label">標題圖上傳:</label>
              <input type="file" class="form-control" id="article-image" @change="handleImageUpload">
            </div>
            <div class="mb-3">
              <label for="article-status" class="col-form-label">顯示狀態:</label>
              <div class="form-check form-switch">
                <input
                  id="flexSwitchCheckChecked"
                  class="form-check-input"
                  type="checkbox"
                  v-model="article.status"
                />
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
    article: {
      type: Object,
      required: true,
      default: () => ({
        category: '',
        title: '',
        author: '',
        publishDate: '',
        content: '',
        image: '',
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
    };
  },
  computed: {
    modalTitle() {
      return this.actionType === 'add' ? '文章新增' : '文章編輯';
    },
    modalButtonText() {
      return this.actionType === 'add' ? '新增' : '更新';
    }
  },
  methods: {
    show() {
      const modalElement = this.$refs.articleModal;
      if (modalElement) {
        this.myModal = new bootstrap.Modal(modalElement);
        this.myModal.show();
      } else {
        console.error("articleModal reference is not found.");
      }
    },
    handleSave() {
      this.onSave(this.article);
      if (this.myModal) {
        this.myModal.hide();
      } else {
        console.error("Modal instance is not available to hide.");
      }
    },
    handleImageUpload(event) {
      const file = event.target.files[0];
      if (file) {
        this.article.image = file;
      }
    }
  }
};
</script>

<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss'; 

#articleModal{
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