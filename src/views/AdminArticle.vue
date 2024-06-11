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
    <admin-bulk-btn :handle-click="bulkCancel">
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
          <th scope="col">分類名稱</th>
          <th scope="col">專欄標題</th>
          <th scope="col">點擊次數</th>
          <th scope="col">發布時間</th>
          <th scope="col">顯示</th>
          <th scope="col">編輯</th>
          <th scope="col">刪除</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(article, index) in articles" :key="index">
          <th scope="row">
            <input v-model="article.selected" class="form-check-input" type="checkbox" @change="checkIfAllSelected" />
          </th>
          <td>{{ article.category }}</td>
          <td>{{ article.title }}</td>
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
import AdminBulkBtn from '../components/AdminBulkBtn.vue'
import ModalArticle from '../components/AdminModalArticle.vue'
import Swal from 'sweetalert2'
import { variables } from '../js/AdminVariables.js'

export default {
  name: 'AdminArticle',
  components: {
    AdminBreadcrumb,
    AdminBtn,
    AdminBulkBtn,
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
          category: 'Wine Knowledge 酒類知識',
          title: '威士忌釀造的藝術',
          clicks: 123,
          publishDate: '2023-05-01',
          show: true
        }
      ]
    }
  },
  watch: {
    articles: {
      handler() {
        // 檢查是否所有的 article.selected 都是 true，若是則勾選表頭的複選框
        this.selectAll = this.articles.every((article) => article.selected)
      },
      deep: true
    }
  },
  methods: {
    openModal(action, article = null) {
      this.currentActionType = action
      this.currentArticle = article ? { ...article } : { category: '', title: '', clicks: 0, publishDate: '', show: true }
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
    // 單顆按鈕點刪除時
    deleteArticle(index) {
      Swal.fire({
        title: '確認刪除',
        text: '您確定要刪除此項目嗎？',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '刪除!',
        cancelButtonText: '取消'
      }).then((result) => {
        if (result.isConfirmed) {
          this.articles.splice(index, 1)
          Swal.fire('已刪除', '該項目已被刪除', 'success')
        }
      })
    },
    // 當我的tbody中input全勾，全選勾會被勾起來
    toggleAllCheckboxes() {
      this.articles.forEach((article) => {
        article.selected = this.selectAll
      })
    },
    // 當複選框勾起來時，是否刪除的警告訊息
    bulkCancel() {
      const selectedArticles = this.articles.filter((article) => article.selected)

      if (selectedArticles.length === 0) {
        Swal.fire('未選擇任何項目', '請選擇要刪除的項目', 'warning')

        return
      }

      Swal.fire({
        title: '確認刪除',
        text: `您確定要刪除選中的${selectedArticles.length}個項目嗎？`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '刪除!',
        cancelButtonText: '取消'
      }).then((result) => {
        if (result.isConfirmed) {
          selectedArticles.forEach((article) => {
            const index = this.articles.indexOf(article)

            if (index !== -1) {
              this.articles.splice(index, 1)
            }
          })
          this.selectAll = false // 重置selectAll狀態
          Swal.fire('已刪除', '選中的項目已被刪除', 'success')
        }
      })
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
