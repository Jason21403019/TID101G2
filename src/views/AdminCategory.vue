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
          <th scope="col">名稱</th>
          <th scope="col">備註</th>
          <th scope="col">編輯</th>
        </tr>
      </thead>
      <tbody class="table-tbody">
        <tr v-for="category in categories" :key="category.id">
          <td>{{ category.name }}</td>
          <td>{{ category.memo }}</td>
          <td>
            <button @click="openModal('edit', category)">
              <img src="../imgs/icon/icon_admin-edit.svg" alt="editIcon" width="20px" height="20px" />
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
  <ModalCategory :actionType="currentActionType" ref="modal" :category="currentCategory" :onSave="handleSave"></ModalCategory>
</template>

<script>
import AdminBreadcrumb from '../components/AdminBreadcrumb.vue'
import AdminBtn from '../components/AdminBtn.vue'
import ModalCategory from '../components/AdminModalCategory.vue'
import { variables } from '../js/AdminVariables.js'

export default {
  name: 'AdminCategory',
  components: {
    AdminBreadcrumb,
    AdminBtn,
    ModalCategory
  },
  data() {
    return {
      mainTitle: variables.articleblock.wine,
      subTitle: variables.articleblock.categoryList,
      breadcrumbItems: [
        { text: '首頁', link: '/admin', active: false },
        { text: variables.articleblock.wine, link: '', active: true },
        { text: variables.articleblock.categoryList, link: '/admin_category', active: false }
      ],

      currentActionType: 'add',
      currentCategory: {
        name: '',
        memo: ''
      },
      categories: [
        {
          id: 1,
          name: 'Category 1',
          memo: '備註 1'
        },
        {
          id: 2,
          name: 'Category 2',
          memo: '備註 2'
        }
      ]
    }
  },
  methods: {
    openModal(action, category = null) {
      this.currentActionType = action
      this.currentCategory = category ? { ...category } : { name: '', memo: '' }
      this.$refs.modal.show()
    },
    handleSave(formData) {
      if (this.currentActionType === 'add') {
        // 新增邏輯
        const newCategory = { ...formData, id: this.categories.length + 1 }
        this.categories.push(newCategory)
      } else {
        // 編輯邏輯
        const index = this.categories.findIndex((category) => category.id === formData.id)
        if (index !== -1) {
          this.categories.splice(index, 1, { ...formData })
        }
      }
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

  .table-thead {
    font-size: $fontSize_h4;

    th {
      background-color: $campari;
      color: $ramos-gin-fizz;
    }
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
