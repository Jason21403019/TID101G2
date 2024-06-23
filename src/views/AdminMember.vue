<template>
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
    <admin-input input-id="formGroupExampleInput1" v-model="searchQuery">
      <template #label>查詢條件</template>
      <template #select>
        <select class="form-select" aria-label="Default select example" v-model="searchField">
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
    <admin-bulk-btn :handleClick="clearSearch">
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
          <th scope="col">E-mail</th>
          <th scope="col">手機</th>
          <th scope="col">地址</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="member in members" :key="member.id">
          <th scope="row">{{ member.id }}</th>
          <td>{{ member.full_name }}</td>
          <td>{{ member.email }}</td>
          <td>{{ member.phone }}</td>
          <td>{{ member.address }}</td>
        </tr>
      </tbody>
      <!-- <caption>
        每頁列表顯示<span class="main__list-number">6</span
        >筆
      </caption> -->
    </table>
  </section>
</template>

<script>
import AdminBreadcrumb from '../components/AdminBreadcrumb.vue'
import AdminBtn from '../components/AdminBtn.vue'
import AdminBulkBtn from '../components/AdminBulkBtn.vue'
import AdminInput from '../components/AdminInput.vue'
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
      members: []
    }
  },
  async mounted() {
    // console.log('Component mounted')
    await this.loadMembers()
  },
  methods: {
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

      // console.log('Search with:', this.searchField, this.searchQuery)
      const result = await adminMemberStore.searchMembers(this.searchField, this.searchQuery)

      // console.log('search result:', result)

      if (result.success) {
        this.members = result.members
      }
    },
    async clearSearch() {
      this.searchField = 'full_name'
      this.searchQuery = ''
      await this.loadMembers()
    }
  }
}
</script>
<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss'; // 確保這一行在最上面

// 標題
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
