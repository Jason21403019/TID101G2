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

  <!-- 彈跳視窗 -->
  <AdminModal
    :title="modalTitle"
    :fields="formFields"
    :formData.sync="formData"
    :visible="isModalVisible"
    @save="handleSave"
    @close="closeModal"
  />
  
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
          <th scope="col">查閱</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">威士忌釀造的藝術</th>
          <td>酒類知識</td>
          <td>1</td>
          <td>2024-05-08 10:26:10</td>
          <td>
            <div class="form-check form-switch">
              <input id="flexSwitchCheckChecked" class="form-check-input" type="checkbox" checked />
            </div>
          </td>
          <td>
            <a href="">
              <img src="../imgs/icon/icon_admin-menu-dots.svg" alt="" width="20px" height="20ox" />
            </a>
          </td>
        </tr>

        <tr>
          <th scope="row">伏特加之行 - 清酒探索</th>
          <td>國外報導</td>
          <td>15</td>
          <td>2024-05-08 10:26:10</td>
          <td>
            <div class="form-check form-switch">
              <input id="flexSwitchCheckChecked" class="form-check-input" type="checkbox" checked />
            </div>
          </td>
          <td>
            <a href="">
              <img src="../imgs/icon/icon_admin-menu-dots.svg" alt="" width="20px" height="20ox" />
            </a>
          </td>
        </tr>
      </tbody>
      <caption>
        每頁列表顯示<span class="main__list-number">6</span>筆
      </caption>
    </table>
  </section>
</template>

<script>
import AdminBreadcrumb from '../components/AdminBreadcrumb.vue'
import AdminBtn from '../components/AdminBtn.vue'
import AdminModal from '../components/AdminModal.vue'
import { variables } from '../js/AdminVariables.js'

export default {
  name: 'AdminArticle',
  components: {
    AdminBreadcrumb,
    AdminBtn,
    AdminModal
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

      actionType: 'add',
      modalTitle: '文章新增',
      formFields: [
        {
          id: 'columnCategory',
          label: '專欄名稱',
          type: 'select',
          options: [
            { value: 'knowledge', text: 'Wine Knowledge 酒類知識' },
            { value: 'reports', text: 'Foreign Reports 國外報導' },
            { value: 'cocktail', text: 'Cocktail New World 調酒新世界' },
          ]
        },
        { id: 'title', label: '專欄標題', type: 'input' },
        { id: 'author', label: '作者', type: 'input' },
        { id: 'release', label: '發布時間', type: 'date' },
        // { id: 'content', label: '專欄內容', type: 'ckeditor' },
        { id: 'upload', label: '標題圖上傳', type: 'file' },
        { id: 'active', label: '顯示狀態', type: 'checkbox' }
      ],
      formData: {
        columnCategory: '',
        title: '',
        author: '',
        release: '',
        content: '',
        upload: '',
        active: true
      },
      existingData: {
        columnCategory: 'Wine Knowledge 酒類知識',
        title: '威士忌釀造的藝術',
        author: 'Jason Chang',
        release: '',
        content: '',
        upload: '',
        active: true
      },
      isModalVisible: false
    }
  },
  methods: {
    openModal(action, data = null) {
      this.actionType = action;
      this.modalTitle = action === 'add' ? '文章新增' : '文章編輯';
      this.formData = data || {
        columnCategory: '',
        title: '',
        author: '',
        release: '',
        content: '',
        upload: '',
        active: true
      };
      this.isModalVisible = true;
    },
    closeModal() {
      this.isModalVisible = false;
    },
    handleSave(formData) {
      if (this.actionType === 'add') {
        // 新增邏輯
        console.log('新增資料', formData);
      } else {
        // 編輯邏輯
        console.log('編輯資料', formData);
      }
      this.closeModal();
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
  margin-right: 95px;
  margin-top: 190px;

  img {
    margin-right: 5px;
  }
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

  #flexSwitchCheckChecked:checked {
    background-color: $toggle-on;
    border: solid $toggle-on;
  }

  .fa-solid.fa-pencil {
    color: $campari;
  }

}
</style>