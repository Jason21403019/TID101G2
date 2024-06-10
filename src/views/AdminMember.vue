<template>
  <AdminBreadcrumb :items="breadcrumbItems" />
  <!-- 標題 -->
  <div class="memberblock">
    <h1 class="memberblock-h1">{{ mainTitle }}</h1>
    <span class="memberblock-pipe"> | </span>
    <h1 class="memberblock-h1">{{ subTitle }}</h1>
  </div>

  <!-- 搜尋 -->
  <div>
    <admin-input input-id="formGroupExampleInput1">
      <template #label>查詢條件</template>
      <template #select>
        <select class="form-select" aria-label="Default select example">
          <option selected>會員姓名</option>
          <option value="1">會員編號</option>
          <option value="2">會員手機</option>
        </select>
      </template>
    </admin-input>

    <!-- 日期 -->
    <div class="d-flex align-items-center">
      <admin-date-input start-date-id="dateInputField1" end-date-id="dateInputField2">
        <template #label>選擇日期</template>
      </admin-date-input>

      <admin-btn :handle-click="search">
        <template #icon>
          <img src="../imgs/icon/icon_admin-search-w.svg" alt="addIcon" height="20" width="20" />
        </template>
        <template #text>查詢</template>
      </admin-btn>
    </div>
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
          <th scope="col">最後登入時間</th>
          <th scope="col">停用/啟用</th>
          <th scope="col">查看</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="member in members" :key="member.id">
          <th scope="row">{{ member.id }}</th>
          <td>{{ member.name }}</td>
          <td>{{ member.email }}</td>
          <td>{{ member.phone }}</td>
          <td>{{ member.address }}</td>
          <td>{{ member.lastLogin }}</td>
          <td>
            <div class="form-check form-switch">
              <input
                :id="'flexSwitchCheckChecked' + member.id"
                v-model="member.status"
                class="form-check-input"
                type="checkbox"
              />
            </div>
          </td>
          <td>
            <button @click="viewMember(member)">
              <img src="../imgs/icon/icon_admin-eye.svg" alt="" width="20px" height="20px" />
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

  <!-- 會員彈跳 -->
  <div
    id="memberModal"
    ref="memberModal"
    class="modal fade"
    tabindex="-1"
    aria-labelledby="memberModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 id="memberModalLabel" class="modal-title fs-5">會員查看</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <h4 class="col-form-label">姓名:</h4>
            <p class="form-control">{{ currentMember.name }}</p>
          </div>
          <div class="mb-3">
            <h4 class="col-form-label">生日:</h4>
            <p class="form-control">{{ currentMember.birthday }}</p>
          </div>
          <div class="mb-3">
            <h4 class="col-form-label">手機:</h4>
            <p class="form-control">{{ currentMember.phone }}</p>
          </div>
          <div class="mb-3">
            <h4 class="col-form-label">Email:</h4>
            <p class="form-control">{{ currentMember.email }}</p>
          </div>
          <div class="mb-3">
            <h4 class="col-form-label">地址:</h4>
            <p class="form-control">{{ currentMember.address }}</p>
          </div>
          <div class="mb-3">
            <h4 class="col-form-label">建立時間:</h4>
            <p class="form-control">{{ currentMember.createdAt }}</p>
          </div>
          <div class="mb-3">
            <h4 class="col-form-label">最後登入:</h4>
            <p class="form-control">{{ currentMember.lastLogin }}</p>
          </div>
          <div class="mb-3">
            <h4 class="col-form-label">停用/啟用:</h4>
            <div class="form-check form-switch">
              <input
                :id="'flexSwitchCheckChecked' + currentMember.id"
                v-model="currentMember.status"
                class="form-check-input"
                type="checkbox"
              />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AdminBreadcrumb from '../components/AdminBreadcrumb.vue'
import AdminBtn from '../components/AdminBtn.vue'
import AdminDateInput from '../components/AdminDateInput.vue'
import AdminInput from '../components/AdminInput.vue'
import { variables } from '../js/AdminVariables.js'

export default {
  name: 'AdminMember',
  components: {
    AdminBreadcrumb,
    AdminInput,
    AdminDateInput,
    AdminBtn
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
      currentMember: {},
      members: [
        {
          id: 'M001',
          name: 'AAA',
          email: 'AAA@gmail.com',
          phone: '09123456789',
          address: '這裡是地址',
          lastLogin: '2024/06/01/13:11',
          status: true,
          birthday: '1990-01-01',
          createdAt: '2024/01/01/12:00'
        }
      ]
    }
  },
  methods: {
    viewMember(member) {
      this.currentMember = member
      this.showModal()
    },
    showModal() {
      const modalElement = this.$refs.memberModal

      if (modalElement) {
        const modal = new bootstrap.Modal(modalElement)

        modal.show()
      } else {
        console.error('memberModal reference is not found.')
      }
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
#memberModal {
  .modal-header {
    font-size: $fontSize_h4;
    background-color: $babypowder;
    color: $campari;
  }
  .modal-body {
    font-size: $fontSize_h4;
    background-color: $babypowder;
    color: $campari;

    // 彈跳視窗的toggle
    .form-check-input:checked {
      background-color: $toggle-on;
      border: solid $toggle-on;
    }
  }
  .modal-footer {
    background-color: $babypowder;
    .btn-primary {
      background-color: $campari;
      color: $ramos-gin-fizz;
    }
  }
}
</style>
