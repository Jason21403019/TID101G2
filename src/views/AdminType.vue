<template>
  <AdminBreadcrumb :items="breadcrumbItems" />
  <!-- 標題 -->
  <div class="productblock">
    <h1 class="productblock-h1">{{ mainTitle }}</h1>
    <span class="productblock-pipe"> | </span>
    <h1 class="productblock-h1">{{ subTitle }}</h1>
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
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col">編輯</th>
          <th scope="col">刪除</th>
        </tr>
      </thead>
      <tbody class="table-tbody">
        <tr v-for="type in types" :key="type.id">
          <td>{{ type.id }}</td>
          <td>{{ type.note }}</td>
          <td></td>
          <td></td>
          <td></td>
          <td>
            <button @click="openModal('edit', type)">
              <img src="../imgs/icon/icon_admin-edit.svg" alt="editIcon" width="20px" height="20px" />
            </button>
          </td>
          <td>
            <button @click="handleDelete(type.id)">
            <img src="../imgs/icon/icon_delete.svg" alt="deleteIcon" width="20px" height="20px" />
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

  <ModalType ref="modal" :action-type="currentActionType" :type="currentType" :on-save="handleSave"></ModalType>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';
import AdminBreadcrumb from '../components/AdminBreadcrumb.vue';
import AdminBtn from '../components/AdminBtn.vue';
import ModalType from '../components/AdminModalType.vue';
import { variables } from '../js/AdminVariables.js';

export default {
  name: 'AdminType',
  components: {
    AdminBreadcrumb,
    AdminBtn,
    ModalType
  },
  data() {
    return {
      mainTitle: variables.productblock.product,
      subTitle: variables.productblock.typeList,
      breadcrumbItems: [
        { text: '首頁', link: '/admin', active: false },
        { text: variables.productblock.product, link: '', active: true },
        { text: variables.productblock.typeList, link: '/admin_type', active: false }
      ],
      currentActionType: 'add',
      currentType: {
        id: '',
        note: ''
      },
      types: []
    };
  },
  created() {
    this.fetchTypes();
  },
  methods: {
    fetchTypes() {
      let url = `${import.meta.env.VITE_PHP_PATH}AdminType.php`;
      console.log('Fetching types with URL:', url);
      axios.get(url)
        .then(response => {
          const data = response.data;
          console.log('API response data:', data);
          if (Array.isArray(data)) {
            this.types = data;
          } else {
            console.error('返回的數據不是一個陣列:', data);
            this.types = [];
            if (data.message) {
              Swal.fire('提示', data.message, 'info');
            }
          }
        })
        .catch(error => {
          console.error('Error fetching types:', error);
          this.types = [];
          Swal.fire('錯誤', '無法獲取類型數據。', 'error');
        });
    },
    openModal(action, type = null) {
      this.currentActionType = action;
      this.currentType = type ? { ...type } : { id: '', note: '' };
      this.$refs.modal.show();
    },
    handleSave(formData) {
      if (this.currentActionType === 'add') {
        // 新增邏輯
        axios.post(`${import.meta.env.VITE_PHP_PATH}adminType.php`, formData)
          .then(response => {
            const data = response.data;
            console.log('新增類型成功:', data);
            this.types.push(data);
            if(document.querySelector('.modal-backdrop.fade.show')) {
              document.querySelector('.modal-backdrop.fade.show').remove();
            }
          })
          .catch(error => {
            console.error('Error adding type:', error);
            Swal.fire('錯誤', '無法新增類型。', 'error');
          });
      } else {
        // 編輯邏輯
        axios.put(`${import.meta.env.VITE_PHP_PATH}adminType.php`, formData)
          .then(response => {
            const data = response.data;
            const index = this.types.findIndex(type => type.id === data.id);
            if (index !== -1) {
              this.types[index] = data; // 直接修改陣列中的元素
            }
          })
          .catch(error => {
            console.error('Error updating type:', error);
            Swal.fire('錯誤', '無法更新類型。', 'error');
          });
      }
    },
    handleDelete(typeId) {
  Swal.fire({
    title: '確定要刪除嗎？',
    text: "此操作無法撤銷！",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: '是的，刪除它！',
    cancelButtonText: '取消'
  }).then((result) => {
    if (result.isConfirmed) {
      axios.delete(`${import.meta.env.VITE_PHP_PATH}adminType.php`, { data: { id: typeId } })
        .then(response => {
          const data = response.data;
          this.fetchTypes();
          if (data.status === 'success') {
            this.types = this.types.filter(type => type.id !== typeId);
            Swal.fire('已刪除!', '該類型已被刪除。', 'success');
          } else {
            Swal.fire('已刪除', data.message || '刪除失敗', 'success');
          }
        })
        .catch(error => {
          Swal.fire('錯誤', '無法刪除類型。', 'error');
        });
    }
  });
}
    }
  }
</script>

<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss';

.productblock {
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

  #flexSwitchCheckChecked:checked {
    background-color: $toggle-on;
    border: solid $toggle-on;
  }
  button {
    border: none;
    background: none;
  }
}
</style>
