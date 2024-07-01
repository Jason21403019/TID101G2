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
          <th scope="col">刪除</th>
        </tr>
      </thead>
      <tbody class="table-tbody">
        <tr v-for="category in categories" :key="category.id">
          <td>{{ category.id }}</td>
          <td>{{ category.note }}</td>
          <td>
            <button @click="openModal('edit', category)">
              <img src="../imgs/icon/icon_admin-edit.svg" alt="editIcon" width="20px" height="20px" />
            </button>
          </td>
          <td>
            <button @click="deleteClass(category.id)">
              <img src="../imgs/icon/icon_delete.svg" alt="deleteIcon" width="20px" height="20px" />
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
  <ModalCategory ref="modal" :action-type="currentActionType" :category="currentCategory" @save="handleSave"></ModalCategory>
</template>

<script>
import axios from 'axios'
import AdminBreadcrumb from '../components/AdminBreadcrumb.vue'
import AdminBtn from '../components/AdminBtn.vue'
import ModalCategory from '../components/AdminModalCategory.vue'
import { variables } from '../js/AdminVariables.js'
import Swal from 'sweetalert2';


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
        id: '',
        note: ''
      },
      categories: []
    }
  },
  created() {
    this.fetchCategories()
  },
  methods: {
    fetchCategories() {
      axios.get(`${import.meta.env.VITE_PHP_PATH}adminarticle_class.php`)
        .then(response => {
          this.categories = response.data
        })
        .catch(error => {
          console.error('Error fetching categories:', error)
        })
    },
    openModal(action, category = null) {
      this.currentActionType = action
      this.currentCategory = category ? { ...category } : { id: '', note: '' }
      this.$refs.modal.show()
    },
    handleSave(formData) {
      if (this.currentActionType === 'add') {
        axios.post(`${import.meta.env.VITE_PHP_PATH}adminarticle_class.php`, formData)
          .then(response => {
            this.fetchCategories()
          })
          .catch(error => {
            console.error('Error adding category:', error)
          })
      } else {
        const originalId = this.currentCategory.id
        axios.put(`${import.meta.env.VITE_PHP_PATH}adminarticle_class.php?id=${originalId}`, formData)
          .then(response => {
            this.fetchCategories()
          })
          .catch(error => {
            console.error('Error updating category:', error)
          })
      }
    },
    deleteClass(categoryId) {
    Swal.fire({
    title: '確定要刪除嗎？',
    text: '刪除後將無法恢復！',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: '刪除',
    cancelButtonText: '取消'
  }).then((result) => {
    if (result.isConfirmed) {
      // 使用者確認刪除
      axios.delete(`${import.meta.env.VITE_PHP_PATH}adminarticle_class.php?id=${categoryId}`)
        .then(response => {
          // 刪除成功後重新整理類別列表
          this.fetchCategories();
          Swal.fire(
            '已刪除!',
            '此類別已成功刪除',
            'success'
          )
        })
        .catch(error => {
          console.error('刪除類別時發生錯誤：', error);
          Swal.fire(
            '發生錯誤!',
            '刪除類別時發生錯誤',
            'error'
          )
        });
    }
  } )
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