<template>
  <AdminBreadcrumb :items="breadcrumbItems" />
  <!-- 標題 -->
  <div class="adminblock">
    <h1 class="adminblock-h1">{{ mainTitle }}</h1>
    <span class="adminblock-pipe"> | </span>
    <h1 class="adminblock-h1">{{ subTitle }}</h1>
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
          <th scope="col">項次</th>
          <th scope="col">姓名</th>
          <th scope="col">E-mail</th>
          <th scope="col">手機</th>
          <th scope="col">職位</th>
          <th scope="col">停用/啟用</th>
          <th scope="col">編輯</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>主管</td>
          <td>Tibame@gmail.com</td>
          <td>09123456789</td>
          <td>主管</td>
          <td></td>
          <td>
            <button @click="openModal('edit', existingData)">
              <img src="../imgs/icon/icon_admin-edit.svg" alt="" width="20px" height="20px" />
            </button>
          </td>
        </tr>

        <tr>
          <th scope="row">2</th>
          <td>員工</td>
          <td>Tibame@gmail.com</td>
          <td>09123456789</td>
          <td>員工</td>
          <td>
            <div class="form-check form-switch">
              <input id="flexSwitchCheckChecked" class="form-check-input" type="checkbox" checked />
            </div>
          </td>
          <td>
            <a href="">
              <img src="../imgs/icon/icon_admin-edit.svg" alt="" width="20px" height="20px" />
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
  name: 'AdminAccount',
  components: {
    AdminBreadcrumb,
    AdminBtn,
    AdminModal
  },
  data() {
    return {
      mainTitle: variables.adminblock.admin,
      subTitle: variables.adminblock.account,
      breadcrumbItems: [
        { text: '首頁', link: '/admin', active: false },
        { text: variables.adminblock.admin, link: '', active: true },
        { text: variables.adminblock.account, link: '/admin_account', active: false }
      ],

      actionType: 'add',
      modalTitle: '管理者新增',
      formFields: [
        { id: 'name', label: '姓名', type: 'input' },
        { id: 'email', label: 'E-mail', type: 'input' },
        { id: 'phone', label: '手機', type: 'input' },
        { id: 'password', label: '設定密碼', type: 'password' },
        { id: 'confirmPassword', label: '確認密碼', type: 'password' },
        {
          id: 'position',
          label: '職位',
          type: 'select',
          options: [
            { value: 'manager', text: '主管' },
            { value: 'developer', text: '員工' }
          ]
        },
        { id: 'active', label: '停用/啟用', type: 'checkbox' }
      ],
      formData: {
        name: '',
        email: '',
        phone: '',
        password: '',
        confirmPassword: '',
        position: 'manager',
        active: true
      },
      existingData: {
        name: '主管',
        email: 'Tibame@gmail.com',
        phone: '09123456789',
        position: 'manager',
        active: true
      },
      isModalVisible: false
    };
  },
  methods: {
    openModal(action, data = null) {
      this.actionType = action;
      this.modalTitle = action === 'add' ? '管理者新增' : '管理者編輯';
      this.formData = data || {
        name: '',
        email: '',
        phone: '',
        password: '',
        confirmPassword: '',
        position: 'manager',
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
@import '../../node_modules/bootstrap/scss/bootstrap.scss'; // 確保這一行在最上面

.adminblock {
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
