<template>
  <div class="AdminAccountPage">
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
          <tr v-for="(admin, index) in paginatedAdmins" :key="admin.id">
            <th scope="row">{{ (currentPage - 1) * itemsPerPage + index + 1 }}</th>
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
                  @change="toggleAdminStatus(admin)"
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
      </table>

      <!-- 分頁和每頁顯示數量 -->
      <div class="row align-items-center">
        <div class="col-sm-4">
          <div class="dataTables_info">顯示第 {{ startItem }} 至 {{ endItem }} 項結果，共 {{ totalItems }} 項</div>
        </div>
        <div class="col-sm-8">
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end moveRight">
              <li class="page-item" :class="{ disabled: currentPage === 1 }">
                <a class="page-link" href="#" @click.prevent="changePage(currentPage - 1)" aria-label="Previous">
                  <span aria-hidden="true">&lt;</span>
                </a>
              </li>
              <li class="page-item" v-for="page in totalPages" :key="page" :class="{ active: currentPage === page }">
                <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
              </li>
              <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                <a class="page-link" href="#" @click.prevent="changePage(currentPage + 1)" aria-label="Next">
                  <span aria-hidden="true">&gt;</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </section>

    <ModalAccount
      ref="modal"
      :action-type="currentActionType"
      :admin="currentAdmin"
      :original-admin="originalAdmin"
      :roles="filteredRoles"
      :on-save="handleSave"
    ></ModalAccount>
  </div>
</template>

<script>
import AdminBreadcrumb from '../components/AdminBreadcrumb.vue'
import AdminBtn from '../components/AdminBtn.vue'
import ModalAccount from '../components/AdminModalAccount.vue'
import Swal from 'sweetalert2'
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
      admins: [],
      originalAdmin: null,
      roles: ['老闆', '主管', '員工'], // 所有角色選項
      filteredRoles: ['老闆', '主管', '員工'], // 根據條件過濾後的角色選項
      currentPage: 1,
      itemsPerPage: 6
    }
  },
  computed: {
    paginatedAdmins() {
      const start = (this.currentPage - 1) * this.itemsPerPage
      const end = start + this.itemsPerPage

      return this.admins.slice(start, end)
    },
    totalPages() {
      return Math.ceil(this.admins.length / this.itemsPerPage)
    },
    pagesToShow() {
      const pages = []
      const totalPages = this.totalPages
      const currentPage = this.currentPage

      if (totalPages <= 3) {
        for (let i = 1; i <= totalPages; i++) {
          pages.push(i)
        }
      } else {
        if (currentPage > 1) {
          pages.push(currentPage - 1)
        }
        pages.push(currentPage)
        if (currentPage < totalPages) {
          pages.push(currentPage + 1)
        }
        if (currentPage > 2) {
          pages.unshift(1)
        }
        if (currentPage < totalPages - 1) {
          pages.push(totalPages)
        }
      }

      return pages
    },
    totalItems() {
      return this.admins.length
    },
    startItem() {
      return (this.currentPage - 1) * this.itemsPerPage + 1
    },
    endItem() {
      return Math.min(this.currentPage * this.itemsPerPage, this.totalItems)
    }
  },
  async mounted() {
    await this.loadAdmins()
  },
  methods: {
    changePage(page) {
      if (page >= 1 && page <= this.totalPages) {
        this.currentPage = page
      }
    },
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
      const adminStore = useAdminStore()
      // 抓當前登入者
      const currentUser = adminStore.adminUser

      // 檢查權限：如果當前用戶是主管，且要編輯的用戶是老闆
      if (action === 'edit' && currentUser.job === '主管' && admin.job === '老闆') {
        Swal.fire({
          title: '操作失敗',
          text: '您無權編輯此用戶',
          icon: 'error',
          confirmButtonText: '確定'
        })

        return
      }

      // 如果是編輯操作，找到 originalAdmin
      if (action === 'edit') {
        this.originalAdmin = this.admins.find((a) => a.id === admin.id)
      } else {
        this.originalAdmin = null
      }

      this.currentActionType = action
      this.currentAdmin = admin
        ? { ...admin }
        : { id: null, name: '', email: '', phone: '', password: '', position: '', status: false }
      // 重置isEditing和isAdding的狀態
      this.$refs.modal.resetStatus()
      // 過濾角色選項
      if (currentUser.job === '老闆') {
        this.filteredRoles = this.roles
        // console.log(this.filteredRoles)
      } else if (currentUser.job === '主管') {
        this.filteredRoles = this.roles.filter((role) => role !== '老闆')
      }

      if (action === 'edit' && currentUser.job === '主管' && currentUser.id === this.currentAdmin.id) {
        this.filteredRoles = this.filteredRoles.filter((role) => role !== '員工')
      }
      // 重置職位選項
      if (action === 'add') {
        this.currentAdmin.job = '' // 確保職位選項初始化為空
      }
      this.$refs.modal.show()
    },

    async handleSave(formData) {
      const adminStore = useAdminStore()
      const params = { ...formData }

      if (this.currentActionType === 'add') {
        // 新增邏輯
        const result = await adminStore.createAdmin(params)

        if (result.success) {
          this.admins.push(result.newAdmin)
        } else {
          console.error('Failed to create admin:', result.message)
        }
        this.$refs.modal.myModal.hide()

        return result
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
        this.$refs.modal.myModal.hide()

        return result
      }
    },
    async toggleAdminStatus(admin) {
      const adminStore = useAdminStore()
      const currentUser = adminStore.adminUser

      if (currentUser.id === admin.id) {
        await Swal.fire({
          title: '操作失敗',
          text: '您無權停權自己',
          icon: 'error',
          confirmButtonText: '確定'
        })
        admin.admin_status = !admin.admin_status // 恢復原狀態

        return
      }

      if (currentUser.job === admin.job) {
        await Swal.fire({
          title: '操作失敗',
          text: '您無權停權他人',
          icon: 'error',
          confirmButtonText: '確定'
        })
        admin.admin_status = !admin.admin_status // 恢復原狀態

        return
      }

      if (!adminStore.canSuspend(admin)) {
        await Swal.fire({
          title: '操作失敗',
          text: '您無權停權此用戶',
          icon: 'error',
          confirmButtonText: '確定'
        })
        admin.admin_status = !admin.admin_status // 恢復原狀態

        return
      }

      const action = admin.admin_status ? '啟用' : '停用'
      const confirmation = await Swal.fire({
        title: `您確定要${action}此帳號嗎？`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '確定',
        cancelButtonText: '取消'
      })

      if (confirmation.isConfirmed) {
        const updatedAdmin = { ...admin, admin_status: admin.admin_status ? 1 : 0 }
        const result = await adminStore.updateAdmin(updatedAdmin)

        if (!result.success) {
          await Swal.fire({
            title: '更新失敗',
            text: '更新管理員狀態失敗: ' + result.message,
            icon: 'error',
            confirmButtonText: '確定'
          })
        } else {
          this.admins = this.admins.map((a) => (a.id === updatedAdmin.id ? result.updatedAdmin : a))
          await Swal.fire({
            title: `${action}成功`,
            text: `此帳號已成功${action}`,
            icon: 'success',
            confirmButtonText: '確定'
          })
        }
      } else {
        admin.admin_status = !admin.admin_status // 恢復原狀態
      }
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss'; // 確保這一行在最上面
.AdminAccountPage {
  max-width: 1440px;

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
  // 分頁
  .moveRight {
    margin-right: 50px;
  }
  .dataTables_info {
    margin-left: 160px;
    margin-top: -20px;
  }
  .page-link {
    outline: none;
    border: none;
    background-color: transparent;
    color: $campari;
    &:hover {
      color: $irishcoffee;
    }
    &:focus {
      box-shadow: none;
    }
  }
  .page-link.active,
  .active > .page-link {
    background-color: transparent;
    color: $campari;
    border: none;
    text-decoration: underline;
  }
}
</style>
