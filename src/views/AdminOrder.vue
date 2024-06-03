<template>
  <AdminBreadcrumb :items="breadcrumbItems" />
  <!-- 標題 -->
  <div class="orderblock">
    <h1 class="orderblock-h1">{{ mainTitle }}</h1>
    <span class="orderblock-pipe"> | </span>
    <h1 class="orderblock-h1">{{ subTitle }}</h1>
  </div>
  <!-- 搜尋 -->
  <div>
    <admin-input input-id="formGroupExampleInput1">
      <template #label>查詢條件</template>
      <template #select>
        <select class="form-select" aria-label="Default select example">
          <option selected>訂單編號</option>
          <option value="1">會員姓名</option>
          <option value="2">未付款</option>
          <option value="3">已付款</option>
          <option value="4">未出貨</option>
          <option value="5">已出貨</option>
        </select>
      </template>
    </admin-input>

    <div class="d-flex align-items-center">
      <admin-date-input start-date-id="dateInputField1" end-date-id="dateInputField2">
        <template #label>訂單日期</template>
        <template #info>(最多查詢100天)</template>
      </admin-date-input>
  
      <admin-btn :handle-click="search">
        <template #icon>
          <img src="../imgs/icon/icon_admin-search-w.svg" alt="addIcon" height="20" width="20" />
        </template>
        <template #text>查詢</template>
      </admin-btn>
    </div>
  </div>
  <!-- 按鈕 -->
  <div class="d-grid gap-2 d-md-flex justify-content-md-start">
    <admin-bulk-btn :handle-click="bulkCancel">
      <template #bulkicon>
        <img src="../imgs/icon/icon_admin-square.svg" alt="cancelIcon" height="20" width="20" />
      </template>
      <template #bulktext>多筆取消</template>
    </admin-bulk-btn>
  </div>

  <section>
    <table class="table">
      <thead class="table-thead">
        <tr>
          <th scope="col"></th>
          <th scope="col">訂單編號</th>
          <th scope="col">訂單日期</th>
          <th scope="col">會員姓名</th>
          <th scope="col">收件人姓名</th>
          <th scope="col">訂單狀態</th>
          <th scope="col">付款狀態</th>
          <th scope="col">查看</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row"></th>
          <td>20210517379430</td>
          <td>2024/05/10</td>
          <td>不熬夜</td>
          <td>不熬夜</td>
          <td>處理中</td>
          <td>未付款</td>
          <td>
            <a href="">
              <img src="../imgs/icon/icon_admin-menu-dots.svg" alt="" width="20px" height="20px" />
            </a>
          </td>
        </tr>

        <tr>
          <th scope="row"></th>
          <td>20210517379430</td>
          <td>2024/05/10</td>
          <td>不熬夜</td>
          <td>不熬夜</td>
          <td>處理中</td>
          <td>未付款</td>
          <td>
            <a href="">
              <img src="../imgs/icon/icon_admin-menu-dots.svg" alt="" width="20px" height="20px" />
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
import AdminInput from '../components/AdminInput.vue'
import AdminDateInput from '../components/AdminDateInput.vue'
import AdminBtn from '../components/AdminBtn.vue'
import AdminBulkBtn from '../components/AdminBulkBtn.vue'
import { variables } from '../js/AdminVariables.js'

export default {
  name: 'AdminOrder',
  components: {
    AdminBreadcrumb,
    AdminInput,
    AdminDateInput,
    AdminBtn,
    AdminBulkBtn
  },
  data() {
    return {
      mainTitle: variables.orderblock.order,
      subTitle: variables.orderblock.orderList,
      breadcrumbItems: [
        { text: '首頁', link: '/admin', active: false },
        { text: variables.orderblock.order, link: '', active: true },
        { text: variables.orderblock.orderList, link: '/admin_order', active: false }
      ]
    }
  },
}
</script>

<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss'; // 確保這一行在最上面

.orderblock {
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
.searchDay{
  font-size: $fontSize_p;
}
.d-grid{
  margin-top: 50px;
  margin-left: 160px;
}
.table {
  width: 85%;
  margin-top: 10px;
  margin-left: 160px;
  .table-thead{
    font-size: $fontSize_h4;
    th{
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