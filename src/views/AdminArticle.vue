<template>
  <AdminBreadcrumb :items="breadcrumbItems" />
  <!-- 標題 -->
  <div class="articleblock">
    <h1 class="articleblock-h1">{{ mainTitle }}</h1>
    <span class="articleblock-pipe"> | </span>
    <h1 class="articleblock-h1">{{ subTitle }}</h1>
  </div>

  <!-- 按鈕 -->
  <div class="d-grid gap-2 d-md-flex justify-content-md-between">
    <admin-bulk-btn :handle-click="bulkDelete">
      <template #bulkicon>
        <img src="../imgs/icon/icon_delete.svg" alt="delIcon" height="20" width="20" />
      </template>
      <template #bulktext>多筆刪除</template>
    </admin-bulk-btn>

    <admin-btn @click="openModal('add')">
      <template #icon>
        <img src="../imgs/icon/icon_expand-w-67.svg" alt="addIcon" height="20" width="20" />
      </template>
      <template #text>新增</template>
    </admin-btn>
  </div>

  <!-- 列表 -->
  <section>
    <table class="table">
      <thead class="table-thead">
        <tr>
          <th scope="col">
            <input v-model="selectAll" class="form-check-input" type="checkbox" @change="toggleAllCheckboxes" />
          </th>
          <th scope="col">名稱</th>
          <th scope="col">作者</th>
          <th scope="col">分類 ID</th>
          <th scope="col">發布時間</th>
          <th scope="col">編輯</th>
          <th scope="col">刪除</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(article, index) in articles" :key="article.id"> 
          <th scope="row">
            <input v-model="selectedArticleIds[article.id]" class="form-check-input" type="checkbox" />
          </th>
          <td>{{ article.name }}</td>
          <td>{{ article.publisher }}</td>
          <td>{{ article.article_class_id }}</td>
          <td>{{ article.publish_date }}</td>
          <td>
            <button @click="openModal('edit', article)">
              <img src="../imgs/icon/icon_admin-edit.svg" alt="編輯" width="20px" height="20px" />
            </button>
          </td>
          <td>
            <button @click="deleteArticle(article.id)"> 
              <img src="../imgs/icon/icon_delete.svg" alt="刪除" width="20px" height="20px" />
            </button>
          </td>
        </tr>
      </tbody>
      <caption>
        每頁列表顯示<span class="main__list-number">6</span>筆
      </caption>
    </table>
  </section>

  <!-- 彈跳視窗 -->
  <ModalArticle ref="modal" :action-type="currentActionType" :article="currentArticle" :on-save="handleSave" />
</template>

<script>
import axios from 'axios';
import AdminBreadcrumb from '../components/AdminBreadcrumb.vue';
import AdminBtn from '../components/AdminBtn.vue';
import AdminBulkBtn from '../components/AdminBulkBtn.vue';
import ModalArticle from '../components/AdminModalArticle.vue';
import Swal from 'sweetalert2';
import { variables } from '../js/AdminVariables.js';

export default {
  name: 'AdminArticle',
  components: {
    AdminBreadcrumb,
    AdminBtn,
    AdminBulkBtn,
    ModalArticle,
  },
  data() {
    return {
      mainTitle: variables.articleblock.wine,
      subTitle: variables.articleblock.articleList,
      breadcrumbItems: [
        { text: '首頁', link: '/admin', active: false },
        { text: variables.articleblock.wine, link: '', active: true },
        { text: variables.articleblock.articleList, link: '/admin_article', active: false },
      ],
      currentActionType: 'add',
      currentArticle: {},
      articles: [],
      selectedArticleIds: {}, // 使用物件來追蹤選取的 ID
      selectAll: false,
    };
  },
  mounted() {
    this.fetchArticles();
  },
  methods: {
    fetchArticles() {
      axios.get(`${import.meta.env.VITE_PHP_PATH}adminarticle.php`)
        .then(response => {
          this.articles = response.data;
        })
        .catch(error => {
          console.error('Error fetching articles:', error);
        });
    },
    openModal(action, article = {}) { 
      this.currentActionType = action;
      this.currentArticle = { ...article }; 
      this.$refs.modal.show();
    },
    handleSave(formData) {
      if (this.currentActionType === 'add') {
        this.createArticle(formData);
      } else {
        this.updateArticle(formData);
      }
    },
    createArticle(articleData) {
      axios.post(`${import.meta.env.VITE_PHP_PATH}adminarticle.php`, articleData) 
        .then(response => {
          console.log('Article created:', response.data);
          this.fetchArticles(); 
        })
        .catch(error => {
          console.error('Error creating article:', error);
        });
    },
    updateArticle(articleData) {
      axios.put(`${import.meta.env.VITE_PHP_PATH}adminarticle.php?id=${articleData.name}`, articleData) 
        .then(response => {
          console.log('Article updated:', response.data);
          this.fetchArticles(); 
          this.$refs.modal.hide(); 
        })
        .catch(error => {
          console.error('Error updating article:', error);
        });
    },
    deleteArticle(articleId) {
      Swal.fire({
        title: '確認刪除',
        text: '您確定要刪除此項目嗎？',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '刪除!',
        cancelButtonText: '取消',
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete(`${import.meta.env.VITE_PHP_PATH}adminarticle.php?id=${articleId}`) 
            .then(response => {
              console.log('Article deleted:', response.data);
              this.fetchArticles(); 
            })
            .catch(error => {
              console.error('Error deleting article:', error);
            });
        }
      });
    },
    bulkDelete() {
      const selectedIds = Object.keys(this.selectedArticleIds).filter(id => this.selectedArticleIds[id]);

      if (selectedIds.length === 0) {
        Swal.fire('未選擇任何項目', '請選擇要刪除的項目', 'warning');
        return;
      }

      Swal.fire({
        title: '確認刪除',
        text: `您確定要刪除選中的 ${selectedIds.length} 個項目嗎？`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '刪除!',
        cancelButtonText: '取消',
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete(`${import.meta.env.VITE_PHP_PATH}adminarticle.php`, { 
            data: { ids: selectedIds } 
          })
          .then(response => {
            console.log('Articles deleted:', response.data);
            this.fetchArticles();
            this.selectAll = false;
            this.selectedArticleIds = {};
          })
          .catch(error => {
            console.error('Error deleting articles:', error);
          });
        }
      });
    },
    toggleAllCheckboxes() {
      this.articles.forEach(article => {
        this.selectedArticleIds[article.id] = this.selectAll;
      });
    },
  },
};
</script>
<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss';

.articleblock {
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

.d-grid {
  margin-top: 190px;
  margin-left: 160px;
  margin-right: 55px;
  @include breakpoint(1280px) {
    margin-right: 35px;
  }
  img {
    margin-right: 5px;
  }
}
.table td,
.table th {
  vertical-align: middle;
}
.table {
  width: 85%;
  margin-top: 10px;
  margin-left: 160px;
  border-collapse: collapse;

  .table-thead {
    font-size: $fontSize_h4;

    th {
      background-color: $campari;
      color: $ramos-gin-fizz;

      td {
        vertical-align: middle; /* 垂直置中對齊 */
        text-align: center;
      }
    }
  }
  .form-check-input:checked {
    background-color: $toggle-on;
    border: solid $toggle-on;
  }
  button {
    border: none;
    background: none;
  }
  #flexSwitchCheckChecked:checked {
    background-color: $toggle-on;
    border: solid $toggle-on;
  }
}
</style>
