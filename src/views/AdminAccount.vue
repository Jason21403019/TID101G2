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
      <tbody class="table-tbody">
        <tr v-for="(admin, index) in admins" :key="admin.id">
          <th scope="row">{{ index + 1 }}</th>
          <td>{{ admin.name }}</td>
          <td>{{ admin.email }}</td>
          <td>{{ admin.phone }}</td>
          <td>{{ admin.position }}</td>
          <td>
            <div class="form-check form-switch">
              <input 
                :id="'flexSwitchCheckChecked' + admin.id" 
                class="form-check-input" 
                type="checkbox" 
                v-model="admin.active"
                @change="toggleStatus(admin)"
              />
            </div>
          </td>
          <td>
            <button @click="openModal('edit', admin)">
              <img src="../imgs/icon/icon_admin-edit.svg" alt="editIcon" width="20px" height="20px" />
            </button>
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

      // 彈跳視窗model
      actionType: 'add',
      modalTitle: '管理者新增',
      formFields: [
        { id: 'name', label: '姓名', type: 'input' ,name:'name'},
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
      // 要串資料庫的地方
      admins: [
        { id: 1, name: 'Tibame', email: 'Tibame@gmail.com', phone: '09123456789', position: '主管', active: true },
      ],
      isModalVisible: false,
      existingData: null
    };
  },
  methods: {
    // 彈跳視窗：是新增按鈕還是table的編輯按鈕
    openModal(action, data = null) {
      this.actionType = action;
      this.modalTitle = action === 'add' ? '管理者新增' : '管理者編輯';
      this.formData = data ? { ...data } : {
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
        const newAdmin = { ...formData, id: this.admins.length + 1 };
        this.admins.push(newAdmin);
      } else {
        // 編輯邏輯
        const index = this.admins.findIndex(admin => admin.id === formData.id);
        if (index !== -1) {
          this.admins.splice(index, 1, { ...formData });
        }
      }
      this.closeModal();
    },
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
  margin-right: 125px;
  margin-top: 190px;

  img {
    margin-right: 5px;
  }
}

.table td, .table th {
  vertical-align: middle;
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
      vertical-align: middle;
    }
  }
  .table-tbody {
    
    td {
      vertical-align: middle;
    }
    // table的toggle
    .form-check-input:checked {
      background-color: $toggle-on;
      border-color: $toggle-on;
    }
    button {
      border: none;
      background: none;
    }
  }
  // 彈跳視窗的toggle
  #flexSwitchCheckChecked:checked {
    background-color: $toggle-on;
    border: solid $toggle-on;
  }
}
</style>
