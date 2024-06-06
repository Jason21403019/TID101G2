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
          <th scope="col">類別名稱</th>
          <th scope="col">備註</th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col">編輯</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">無酒精紅酒</th>
          <td>後台在看：這頁只有做一個分類名稱,多一個備註讓列表不會太空</td>
          <td></td>
          <td></td>
          <td></td>
          <td>
            <a href="">
              <img src="../imgs/icon/icon_admin-edit.svg" alt="" width="20px" height="20ox" />
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
  name: 'AdminType',
  components: {
    AdminBreadcrumb,
    AdminBtn,
    AdminModal
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

      actionType: 'add',
      modalTitle: '類別新增',
      formFields: [
        { id: 'name', label: '名稱', type: 'input' },
        { id: 'memo', label: '備註', type: 'textarea' },
      ],
      formData: {
        name: '',
        memo: '',
      },
      existingData: {
        name: '無酒精紅酒',
        memo: '後台在看：這頁只有做一個分類名稱,多一個備註讓列表不會太空',
      },
      isModalVisible: false
    };
  },
  methods: {
    openModal(action, data = null) {
      this.actionType = action;
      this.modalTitle = action === 'add' ? '類別新增' : '類別編輯';
      this.formData = data || {
        name: '',
        memo: '',
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

  #flexSwitchCheckChecked:checked {
    background-color: $toggle-on;
    border: solid $toggle-on;
  }
  
  .fa-solid.fa-pencil {
    color: $campari;
  }
}
</style>