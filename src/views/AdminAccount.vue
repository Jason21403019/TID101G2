<template>
  <AdminBreadcrumb :items="breadcrumbItems" />

  <div class="adminblock">
    <h1 class="adminblock-h1">{{ mainTitle }}</h1>
    <span class="adminblock-pipe"> | </span>
    <h1 class="adminblock-h1">{{ subTitle }}</h1>
  </div>

  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <AdminBtnAdd :click="openForm" />
  </div>

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
            <a href="">
              <img src="../imgs/icon/icon_admin-edit.svg" alt="" width="20px" height="20ox" />
            </a>
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
        每頁列表顯示<span class="main__list-number">6</span
        >筆
      </caption>
    </table>
  </section>
</template>

<script>
import AdminBreadcrumb from '../components/AdminBreadcrumb.vue'
import AdminBtnAdd from '../components/AdminBtnAdd.vue'
import Swal from 'sweetalert2'
import { variables } from '../js/AdminVariables.js'

export default {
  name: 'AdminAccount',
  components: {
    AdminBreadcrumb,
    AdminBtnAdd
  },
  data() {
    return {
      mainTitle: variables.adminblock.admin,
      subTitle: variables.adminblock.account,
      breadcrumbItems: [
        { text: '首頁', link: '/admin', active: false },
        { text: variables.adminblock.admin, link: '', active: true },
        { text: variables.adminblock.account, link: '/admin_account', active: false }
      ]
    }
  },
  methods: {
    async openForm() {
      const { value: formValues } = await Swal.fire({
        title: '管理者新增',
        html: `
          <form id="swal-form">
            <div class="swal2-input-group">
              <label for="swal-input1">姓名</label>
              <input id="swal-input1" class="swal2-input" placeholder="請輸入姓名">
            </div>
            <div class="swal2-input-group">
              <label for="swal-input2">E-mail</label>
              <input id="swal-input2" class="swal2-input" placeholder="請輸入 E-mail">
            </div>
            <div class="swal2-input-group">
              <label for="swal-input3">手機</label>
              <input id="swal-input3" class="swal2-input" placeholder="請輸入手機號碼">
            </div>
            <div class="swal2-input-group">
              <label for="swal-input4">設定密碼</label>
              <input id="swal-input4" type="password" class="swal2-input" placeholder="如修改密碼請直接輸入,如沒有修改則無變更">
            </div>
            <div class="swal2-input-group">
              <label for="swal-input5">確認密碼</label>
              <input id="swal-input5" type="password" class="swal2-input" placeholder="如修改密碼請直接輸入,如沒有修改則無變更">
            </div>
            <div class="swal2-input-group">
              <label for="swal-input6">職位</label>
              <select id="swal-input6" class="swal2-input">
                <option value="主管">主管</option>
                <option value="員工">員工</option>
              </select>
            </div>
            <div class="swal2-input-group">
              <label for="swal-input7">啟用/停用</label>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="swal-input7" checked>
              </div>
            </div>
          </form>
          `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: '儲存',
        cancelButtonText: '取消',
        preConfirm: () => {
          return {
            name: document.getElementById('swal-input1').value,
            email: document.getElementById('swal-input2').value,
            phone: document.getElementById('swal-input3').value,
            password: document.getElementById('swal-input4').value,
            confirmPassword: document.getElementById('swal-input5').value,
            position: document.getElementById('swal-input6').value,
            active: document.getElementById('swal-input7').checked
          }
        }
      })

      if (formValues) {
        Swal.fire({
          icon: 'success',
          title: '儲存成功',
          confirmButtonText: '確定'
        })
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
    font-size: $fontSize_h2;
  }
  &-pipe {
    font-size: $fontSize_h2;
    margin: 0 20px;
  }
}
.d-grid {
  margin-right: 95px;
  margin-top: 140px;
}

.table {
  width: 85%;
  margin-top: 20px;
  margin-left: 160px;
  .table-thead {
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
.swal-form {
  // z-index: 3;
  .swal2-input {
    pointer-events: auto; /* 確保輸入框可以被點擊和輸入 */
    opacity: 1; /* 確保輸入框是可見的 */
  }
}
// sweet2
// .swal2-popup.swal2-modal.swal2-show {
//   width: 600px !important; /* 確保 SweetAlert2 彈窗的寬度 */
// }

// .swal2-input-group {
//   display: flex;
//   align-items: center;
//   margin-bottom: 10px;
// }

// .swal2-input-group label {
//   width: 100px; /* 調整標籤的寬度 */
//   margin-right: 10px;
// }

// .swal2-input-group input,
// .swal2-input-group select {
//   flex: 1;
// }

// .swal2-input {
//   width: 100% !important; /* 確保輸入框寬度為 100% */
// }
</style>
