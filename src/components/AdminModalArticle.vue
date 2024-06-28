<template>
  <div
    id="articleModal"
    class="modal fade"
    tabindex="-1"
    aria-labelledby="articleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 id="articleModalLabel" class="modal-title fs-5">{{ modalTitle }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="handleSave">
            <div class="mb-3">
              <label for="article-category" class="col-form-label">專欄分類:</label>
              <select id="article-category" v-model="article.article_class_id" class="form-select">
                <option value="酒類知識">Wine Knowledge 酒類知識</option>
                <option value="國外報導">News Report 國外報導</option>
                <option value="調酒新世代">Cotail World 調酒新世代</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="article-id" class="col-form-label">id:</label>
              <input id="article-id" v-model="article.id" type="text" class="form-control" />
            </div>
            <div class="mb-3">
              <label for="article-title" class="col-form-label">專欄標題:</label>
              <input id="article-title" v-model="article.name" type="text" class="form-control" />
            </div>
            <div class="mb-3">
              <label for="article-author" class="col-form-label">作者:</label>
              <input id="article-author" v-model="article.publisher" type="text" class="form-control" />
            </div>
            <div class="mb-3">
              <label for="article-publish-date" class="col-form-label">發布時間:</label>
              <input id="article-publish-date" v-model="article.publish_date" type="date" class="form-control" />
            </div>
            <div class="mb-3">
              <label for="article-content" class="col-form-label">專欄內容:</label>
              <input id="article-content" v-model="article.content" type="text" class="form-control"></input>
            </div>
            <div class="mb-3">
              <label for="article-image" class="col-form-label">標題圖上傳:</label>
              <input id="article-image" type="file" class="form-control" @change="handleImageUpload" />
            </div>
            <div class="mb-3">
              <label for="article-status" class="col-form-label">顯示狀態:</label>
              <div class="form-check form-switch">
                <input id="flexSwitchCheckChecked" v-model="article.article_status" class="form-check-input" type="checkbox" />
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
import AdminTextEditor from '../components/AdminTextEditor.vue'

export default {
  components: {
    AdminTextEditor
  },
  props: {
    actionType: {
      type: String,
      required: true
    },
    article: {
      type: Object,
      required: true,
      default: () => ({
        id: '',
        article_class_id: '',
        name: '',
        publisher: '',
        publish_date: '',
        content: '',
        image: '',
        article_status: false
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
      return this.actionType === 'add' ? '文章新增' : '文章編輯'
    },
    modalButtonText() {
      return this.actionType === 'add' ? '新增' : '更新'
    }
  },
  methods: {
    show() {
      // const modalElement = this.$refs.articleModal

      // if (modalElement) {
        this.myModal = new bootstrap.Modal(document.getElementById(('articleModal')))
        this.myModal.show('articleModal')
      // } else {
      //   console.error('articleModal reference is not found.')
      // }
    },
    handleSave() {
      console.log('Form Data:', this.article);
      this.onSave(this.article)
      console.log(this.myModal);
      if (this.myModal) {
        console.log('hide');
        this.myModal.hide('articleModal')
        if(document.querySelector('.modal-backdrop.fade.show')){
          document.querySelector('.modal-backdrop.fade.show').remove()
        }
        
      } else {
        console.error('Modal instance is not available to hide.')
      }
    },
    handleImageUpload(event) {
      const file = event.target.files[0]

      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          this.article.image = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    },
    hideModal() {
      this.myModal.hide('articleModal');
      // if (this.myModal) {
      //   this.myModal.hide();
      // } else {
      //   console.error('Modal instance is not available to hide.');
      // }
    }
  }
}
</script>
<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss';

#articleModal {
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
    .mb-3 {
      h4 {
        font-weight: none;
      }
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