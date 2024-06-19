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
          <td>{{ admin.employee_name }}</td>
          <td>{{ admin.email }}</td>
          <td>{{ admin.phone }}</td>
          <td>{{ admin.job }}</td>
          <td>
            <div class="form-check form-switch">
              <input
                :id="'flexSwitchCheckChecked' + admin.id"
                v-model="admin.admin_status"
                class="form-check-input"
                type="checkbox"
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
        每頁列表顯示<span class="main__list-number">6</span
        >筆
      </caption>
    </table>
  </section>

  <ModalAccount ref="modal" :action-type="currentActionType" :admin="currentAdmin" :on-save="handleSave"></ModalAccount>
</template>

<script>
import AdminBreadcrumb from '../components/AdminBreadcrumb.vue'
import AdminBtn from '../components/AdminBtn.vue'
import ModalAccount from '../components/AdminModalAccount.vue'
import { useAdminStore } from '../stores/admin'
import { variables } from '../js/AdminVariables.js'

export default {
  name: 'AdminAccount',
  components: {
    AdminBreadcrumb,
    AdminBtn,
    ModalAccount
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

      currentActionType: 'add',
      currentAdmin: {
        employee_name: '',
        email: '',
        phone: '',
        password: '',
        job: '',
        status: false
      },
      admins: []
    }
  },
  async mounted() {
    await this.loadAdmins()
  },
  methods: {
    // 讀取資料庫的資料渲染在table上
    async loadAdmins() {
      const adminStore = useAdminStore()
      const result = await adminStore.fetchAdmins()

      if (result.success) {
        this.admins = result.admins
      }
    },
    // 打開視窗時的初始
    openModal(action, admin = null) {
      this.currentActionType = action
      this.currentAdmin = admin
        ? { ...admin }
        : { id: 'null', name: '', email: '', phone: '', password: '', position: '', status: false }
      this.$refs.modal.show()
    },

    async handleSave(formData) {
      const adminStore = useAdminStore()
      const params = { ...formData }

      if (this.currentActionType === 'add') {
        // 新增邏輯
        const result = await adminStore.createAdmin(params)

        console.log(result)
        if (result.success) {
          this.admins.push(result.newAdmin)
        } else {
          console.error('Failed to create admin:', result.message)
        }
      } else {
        // 編輯邏輯
        const result = await adminStore.updateAdmin(params)

        if (result.success) {
          const index = this.admins.findIndex((admin) => admin.id === formData.id)

          if (index !== -1) {
            this.admins.splice(index, 1, result.updatedAdmin)
          }
        } else {
          console.error('Failed to update admin:', result.message)
        }
      }
      this.$refs.modal.hide()
    },
    async toggleAdminStatus(admin) {
      const adminStore = useAdminStore()
      const updatedAdmin = { ...admin, admin_status: admin.admin_status ? 1 : 0 }
      const result = await adminStore.updateAdmin(updatedAdmin)

      if (!result.success) {
        console.error('Failed to update admin status:', result.message)
      } else {
        this.admins = this.admins.map((a) => (a.id === updatedAdmin.id ? result.updatedAdmin : a))
      }
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
