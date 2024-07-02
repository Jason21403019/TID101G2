<template>
  <div class="AdminMemberPage">
    <AdminBreadcrumb :items="breadcrumbItems" />
    <!-- 標題 -->
    <div class="memberblock">
      <h1 class="memberblock-h1">{{ mainTitle }}</h1>
      <span class="memberblock-pipe"> | </span>
      <h1 class="memberblock-h1">{{ subTitle }}</h1>
    </div>

    <!-- 搜尋 -->
    <div class="d-flex align-items-center">
      <!-- 下拉式選單組件 -->
      <admin-input v-model="searchQuery" input-id="formGroupExampleInput1">
        <template #label>查詢條件</template>
        <template #select>
          <select v-model="searchField" class="form-select" aria-label="Default select example">
            <option value="full_name">會員姓名</option>
            <option value="id">會員編號</option>
            <option value="phone">會員手機</option>
            <option value="email">會員E-mail</option>
          </select>
        </template>
      </admin-input>
      <!-- 查詢組件 -->
      <admin-btn @click="search">
        <template #icon>
          <img src="../imgs/icon/icon_admin-search-w.svg" alt="addIcon" height="20" width="20" />
        </template>
        <template #text>查詢</template>
      </admin-btn>
      <!-- 清除條件 -->
      <admin-bulk-btn :handle-click="clearSearch">
        <template #bulktext>清除條件</template>
      </admin-bulk-btn>
    </div>

    <!-- table欄位 -->
    <section>
      <table class="table">
        <thead class="table-thead">
          <tr>
            <th scope="col">會員編號</th>
            <th scope="col">姓名</th>
            <th scope="col">生日</th>
            <th scope="col">E-mail</th>
            <th scope="col">手機</th>
            <th scope="col">地址</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="member in paginatedMembers" :key="member.id">
            <th scope="row">{{ member.id }}</th>
            <td>{{ member.full_name }}</td>
            <td>{{ member.birth }}</td>
            <td>{{ member.email }}</td>
            <td>{{ member.phone }}</td>
            <td>{{ member.address }}</td>
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
                <a class="page-link" href="#" aria-label="Previous" @click.prevent="changePage(currentPage - 1)">
                  <span aria-hidden="true">&lt;</span>
                </a>
              </li>
              <li v-for="page in totalPages" :key="page" class="page-item" :class="{ active: currentPage === page }">
                <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
              </li>
              <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                <a class="page-link" href="#" aria-label="Next" @click.prevent="changePage(currentPage + 1)">
                  <span aria-hidden="true">&gt;</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import AdminBreadcrumb from '../components/AdminBreadcrumb.vue'
import AdminBtn from '../components/AdminBtn.vue'
import AdminBulkBtn from '../components/AdminBulkBtn.vue'
import AdminInput from '../components/AdminInput.vue'
import Swal from 'sweetalert2'
import { useAdminMemberStore } from '../stores/adminMember'
import { variables } from '../js/AdminVariables.js'

export default {
  name: 'AdminMember',
  components: {
    AdminBreadcrumb,
    AdminInput,
    AdminBtn,
    AdminBulkBtn
  },
  data() {
    return {
      mainTitle: variables.memberblock.member,
      subTitle: variables.memberblock.memberList,
      breadcrumbItems: [
        { text: '首頁', link: '/admin', active: false },
        { text: variables.memberblock.member, link: '', active: true },
        { text: variables.memberblock.memberList, link: '/admin_member', active: false }
      ],
      searchField: 'full_name',
      searchQuery: '',
      members: [],
      currentPage: 1,
      itemsPerPage: 6
    }
  },
  computed: {
    paginatedMembers() {
      const start = (this.currentPage - 1) * this.itemsPerPage
      const end = start + this.itemsPerPage

      return this.members.slice(start, end)
    },
    totalPages() {
      return Math.ceil(this.members.length / this.itemsPerPage)
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
      return this.members.length
    },
    startItem() {
      return (this.currentPage - 1) * this.itemsPerPage + 1
    },
    endItem() {
      return Math.min(this.currentPage * this.itemsPerPage, this.totalItems)
    }
  },
  async mounted() {
    await this.loadMembers()
  },
  methods: {
    changePage(page) {
      if (page >= 1 && page <= this.totalPages) {
        this.currentPage = page
      }
    },
    // 讀取資料庫的資料渲染在table上
    async loadMembers() {
      const adminMemberStore = useAdminMemberStore()
      const result = await adminMemberStore.fetchMembers()

      if (result.success) {
        this.members = result.members
      }
    },
    async search() {
      const adminMemberStore = useAdminMemberStore()

      // 檢查是否有輸入查詢條件
      if (!this.searchQuery) {
        await this.loadMembers() // 呼叫 loadMembers 方法
        // console.log('沒有輸入查詢條件，顯示所有會員')

        return
      }
      const result = await adminMemberStore.searchMembers(this.searchField, this.searchQuery)

      if (result.success) {
        this.members = result.members
        this.currentPage = 1 // 搜索後重置頁碼
      } else {
        Swal.fire({
          title: '查無資料',
          text: result.message,
          icon: 'info',
          confirmButtonText: '確定'
        })
      }
    },
    async clearSearch() {
      this.searchField = 'full_name'
      this.searchQuery = ''
      await this.loadMembers()
      this.currentPage = 1 // 清除搜索後重置頁碼
    }
  }
}
</script>
<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss'; // 確保這一行在最上面

// 標題
.AdminMemberPage {
  .memberblock {
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
  .admin_btn {
    margin-top: 39px;
    margin-left: 5px;
    height: 35px;
  }
  .admin_bulkbtn {
    margin-top: 39px;
    margin-left: 5px;
    height: 35px;
  }
  // table
  .table td,
  .table th {
    vertical-align: middle;
  }
  .table {
    width: 85%;
    margin-top: 100px;
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
    // table的toggle
    .form-check-input:checked {
      background-color: $toggle-on;
      border-color: $toggle-on;
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
// #memberModal {
//   .modal-header {
//     font-size: $fontSize_h4;
//     background-color: $babypowder;
//     color: $campari;
//   }
//   .modal-body {
//     font-size: $fontSize_h4;
//     background-color: $babypowder;
//     color: $campari;

//     // 彈跳視窗的toggle
//     .form-check-input:checked {
//       background-color: $toggle-on;
//       border: solid $toggle-on;
//     }
//   }
//   .modal-footer {
//     background-color: $babypowder;
//     .btn-primary {
//       background-color: $campari;
//       color: $ramos-gin-fizz;
//     }
//   }
// }
</style>
