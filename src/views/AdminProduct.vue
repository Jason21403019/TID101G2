<template>
  <AdminBreadcrumb :items="breadcrumbItems" />
  <!-- 標題 -->
  <div class="productblock">
    <h1 class="productblock-h1">{{ mainTitle }}</h1>
    <span class="productblock-pipe"> | </span>
    <h1 class="productblock-h1">{{ subTitle }}</h1>
  </div>
  <!-- 搜尋 -->
  <div class="d-flex align-items-center">
    <admin-input input-id="formGroupExampleInput1">
      <template #label>查詢條件</template>
      <template #select>
        <select class="form-select" aria-label="Default select example">
          <option selected>全部商品</option>
          <option value="1">商品類別</option>
        </select>
      </template>
    </admin-input>

      <admin-btn :handle-click="search" class="searchBtn">
        <template #icon>
          <img src="../imgs/icon/icon_admin-search-w.svg" alt="addIcon" height="20" width="20" />
        </template>
        <template #text>查詢</template>
      </admin-btn>

  </div>

  <!-- 按鈕 -->
  <div class="d-grid gap-2 d-md-flex justify-content-md-start">
    <admin-bulk-btn :handle-click="bulkCancel">
      <template #bulkicon>
        <img src="../imgs/icon/icon_delete.svg" alt="cancelIcon" height="20" width="20" />
      </template>
      <template #bulktext>多筆刪除</template>
    </admin-bulk-btn>
  </div>

  <section>
    <table class="table">
      <thead class="table-thead">
        <tr>
          <th scope="col"></th>
          <th scope="col">商品編號</th>
          <th scope="col">商品名稱</th>
          <th scope="col">商品類別</th>
          <th scope="col">商品售價</th>
          <th scope="col">銷售數量</th>
          <th scope="col">庫存數</th>
          <th scope="col">熱銷商品</th>
          <th scope="col">下架/上架</th>
          <th scope="col">查閱</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row"></th>
          <td>P001</td>
          <td>VINADA 無酒精氣泡酒</td>
          <td>無酒精紅酒</td>
          <td>NT$ 800 </td>
          <td>10</td>
          <td>50</td>
          <td>
            <div>
              <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
            </div>
          </td>
          <td>
            <div class="form-check form-switch">
              <input id="flexSwitchCheckChecked" class="form-check-input" type="checkbox" checked />
            </div>
          </td>
          <td>
            <a href="">
              <img src="../imgs/icon/icon_admin-menu-dots.svg" alt="" width="20px" height="20px" />
            </a>
          </td>
        </tr>

        <tr>
          <th scope="row"></th>
          <td>P001</td>
          <td>VINADA 無酒精氣泡酒</td>
          <td>無酒精紅酒</td>
          <td>NT$ 800 </td>
          <td>10</td>
          <td>50</td>
          <td>
            <div>
              <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
            </div>
          </td>
          <td>
            <div class="form-check form-switch">
              <input id="flexSwitchCheckChecked" class="form-check-input" type="checkbox" checked />
            </div>
          </td>
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
      mainTitle: variables.productblock.product,
      subTitle: variables.productblock.productList,
      breadcrumbItems: [
        { text: '首頁', link: '/admin', active: false },
        { text: variables.productblock.product, link: '', active: true },
        { text: variables.productblock.productList, link: '/admin_product', active: false }
      ]
    }
  },
}
</script>

<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss'; // 確保這一行在最上面

.productblock {
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
.d-flex{
  .searchBtn{
    margin-top: 40px;
    margin-left: 5px;
  }
}
.d-grid{
  margin-top: 100px;
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