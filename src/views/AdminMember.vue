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
        <tr>
          <th scope="row">M001</th>
          <td>AAA</td>
          <td>AAA@gmail.com</td>
          <td>09123456789</td>
          <td>台北市中山區南京東路三段219號5樓</td>
          <td>2024/06/01/13:11</td>
          <td>
            <div class="form-check form-switch">
              <input id="flexSwitchCheckChecked" class="form-check-input" type="checkbox" checked />
            </div>
          </td>
          <td>
            <a href="">
              <img src="../imgs/icon/icon_admin-eye.svg" alt="" width="20px" height="20px" />
            </a>
          </td>
        </tr>

        <tr>
          <th scope="row">M002</th>
          <td>BBB</td>
          <td>BBB@gmail.com</td>
          <td>09123456789</td>
          <td>台北市中山區南京東路三段219號5樓</td>
          <td>2024/06/01/13:12</td>
          <td>
            <div class="form-check form-switch">
              <input id="flexSwitchCheckChecked" class="form-check-input" type="checkbox" checked />
            </div>
          </td>
          <td>
            <a href="">
              <img src="../imgs/icon/icon_admin-eye.svg" alt="" width="20px" height="20px" />
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
import AdminBtn from '../components/AdminBtn.vue'
import AdminDateInput from '../components/AdminDateInput.vue'
import AdminInput from '../components/AdminInput.vue'
import Swal from 'sweetalert2'
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
      ]
    }
  },
  methods: {
    async search() {
      const { value: formValues } = await Swal.fire({
        title: '會員查看',
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

      // if (formValues) {
      //   Swal.fire({
      //     icon: 'success',
      //     title: '儲存成功',
      //     confirmButtonText: '確定'
      //   })
      // }
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss'; // 確保這一行在最上面

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
</style>
