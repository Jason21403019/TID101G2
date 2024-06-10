<template>
  <AdminBreadcrumb :items="breadcrumbItems" />
  <!-- 標題 -->
  <div class="articleblock">
    <h1 class="articleblock-h1">{{ mainTitle }}</h1>
    <span class="articleblock-pipe"> | </span>
    <h1 class="articleblock-h1">{{ subTitle }}</h1>
  </div>

  <!-- 按鈕 -->
  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
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
          <th scope="col">專欄標題</th>
          <th scope="col">分類名稱</th>
          <th scope="col">點擊次數</th>
          <th scope="col">發布時間</th>
          <th scope="col">顯示</th>
          <th scope="col">編輯</th>
          <th scope="col">刪除</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(article, index) in articles" :key="index">
          <td>{{ article.title }}</td>
          <td>{{ article.category }}</td>
          <td>{{ article.clicks }}</td>
          <td>{{ article.publishDate }}</td>
          <td>
            <div class="form-check form-switch">
              <input :id="'flexSwitchCheckChecked' + index" v-model="article.show" class="form-check-input" type="checkbox" />
            </div>
          </td>
          <td>
            <button @click="openModal('edit', article)">
              <img src="../imgs/icon/icon_admin-edit.svg" alt="編輯" width="20px" height="20px" />
            </button>
          </td>
          <td>
            <button @click="deleteArticle(index)">
              <img src="../imgs/icon/icon_delete.svg" alt="刪除" width="20px" height="20px" />
            </button>
          </td>
        </tr>
      </tbody>
      <caption>
        每頁列表顯示<span class="main__list-number">6</span
        >筆
      </caption>
    </table>
  </section>

  <!-- 彈跳視窗 -->
  <ModalArticle ref="modal" :action-type="currentActionType" :article="currentArticle" :on-save="handleSave"></ModalArticle>
</template>

<script>
import AdminBreadcrumb from '../components/AdminBreadcrumb.vue'
import AdminBtn from '../components/AdminBtn.vue'
import ModalArticle from '../components/AdminModalArticle.vue'
import { variables } from '../js/AdminVariables.js'

export default {
  name: 'AdminArticle',
  components: {
    AdminBreadcrumb,
    AdminBtn,
    ModalArticle
  },
  data() {
    return {
      mainTitle: variables.articleblock.wine,
      subTitle: variables.articleblock.articleList,
      breadcrumbItems: [
        { text: '首頁', link: '/admin', active: false },
        { text: variables.articleblock.wine, link: '', active: true },
        { text: variables.articleblock.articleList, link: '/admin_article', active: false }
      ],

      currentActionType: 'add',
      currentArticle: {
        title: '',
        category: '',
        clicks: 0,
        publishDate: '',
        show: true
      },
      articles: [
        {
          title: '文章標題 1',
          category: '分類 1',
          clicks: 123,
          publishDate: '2023-05-01',
          show: true
        }
      ]
    }
  },
  methods: {
    openModal(action, article = null) {
      this.currentActionType = action
      this.currentArticle = article ? { ...article } : { title: '', category: '', clicks: 0, publishDate: '', show: true }
      this.$refs.modal.show()
    },
    handleSave(formData) {
      if (this.currentActionType === 'add') {
        // 新增邏輯
        const newArticle = { ...formData, id: this.articles.length + 1 }

        this.articles.push(newArticle)
      } else {
        // 編輯邏輯
        const index = this.articles.findIndex((article) => article.id === formData.id)

        if (index !== -1) {
          this.articles.splice(index, 1, { ...formData })
        }
      }
    },
    deleteArticle(index) {
      this.articles.splice(index, 1)
    }
  }
}
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
  margin-right: 55px;
  margin-top: 190px;
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
