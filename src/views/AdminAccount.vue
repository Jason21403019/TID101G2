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
    <admin-btn 
      modal 
      modal-target="#exampleModal" 
      modal-whatever="@fat"
    >
      <template #icon>
        <img src="../imgs/icon/icon_expand-w-67.svg" alt="addIcon" height="20" width="20" />
      </template>
      <template #text>新增</template>
    </admin-btn>
  </div>

  <!-- 彈跳視窗 -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">管理者新增</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">姓名:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">E-mail:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">手機:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">設定密碼:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">確認密碼:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">職位:</label>
              <select class="form-control" id="recipient-name">
                <option value="manager">主管</option>
                <option value="developer">員工</option>
              </select>
            </div>
            <div class="mb-3 d-flex align-items-center">
              <label for="flexSwitchCheckChecked" class="col-form-label me-2">啟用/停用:</label>
              <div class="form-check form-switch">
                <input id="flexSwitchCheckChecked" class="form-check-input" type="checkbox" checked />
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
          <button type="button" class="btn btn-primary">儲存</button>
        </div>
      </div>
    </div>
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
        每頁列表顯示<span class="main__list-number">6</span>筆
      </caption>
    </table>
  </section>
</template>

<script>
import AdminBreadcrumb from '../components/AdminBreadcrumb.vue'
import AdminBtn from '../components/AdminBtn.vue'
import Swal from 'sweetalert2'
import { variables } from '../js/AdminVariables.js'

export default {
  name: 'AdminAccount',
  components: {
    AdminBreadcrumb,
    AdminBtn
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
