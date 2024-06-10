<template>
  <AdminBreadcrumb :items="breadcrumbItems" />
  <!-- 標題 -->
  <div class="orderblock">
    <h1 class="orderblock-h1">{{ mainTitle }}</h1>
    <span class="orderblock-pipe"> | </span>
    <h1 class="orderblock-h1">{{ subTitle }}</h1>
  </div>

  <!-- 搜尋 -->
  <section>
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

    <!-- 查詢日期 -->
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
  </section>

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
          <th scope="col">
            <input class="form-check-input" type="checkbox" v-model="selectAll" @change="toggleAllCheckboxes" />
          </th>
          <th scope="col">訂單編號</th>
          <th scope="col">訂單日期</th>
          <th scope="col">會員姓名</th>
          <th scope="col">收件人姓名</th>
          <th scope="col">訂單狀態</th>
          <th scope="col">付款狀態</th>
          <th scope="col">編輯</th>
          <th scope="col">取消</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="order in orders" :key="order.orderId">
          <th scope="row">
            <input class="form-check-input" type="checkbox" v-model="order.selected" @change="checkIfAllSelected" />
          </th>
          <td>{{ order.orderId }}</td>
          <td>{{ order.orderDate }}</td>
          <td>{{ order.memberName }}</td>
          <td>{{ order.recipientName }}</td>
          <td>{{ order.orderStatus }}</td>
          <td>{{ order.paymentStatus }}</td>
          <td>
            <button @click="openModal('edit', selectedOrder)">
              <img src="../imgs/icon/icon_admin-edit.svg" alt="" width="20px" height="20px" />
            </button>
          </td>
          <td>
            <button @click="confirmCancelOrder(order)">
              <img src="../imgs/icon/icon_admin-square.svg" alt="" width="20px" height="20px" />
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

  <ModalOrder
    ref="modal"
    :action-type="currentActionType"
    :order="currentOrder"
    :show-cancel-reason="showCancelReason"
    @save="handleSave"
  />
</template>

<script>
import AdminBreadcrumb from '../components/AdminBreadcrumb.vue'
import AdminBtn from '../components/AdminBtn.vue'
import AdminBulkBtn from '../components/AdminBulkBtn.vue'
import AdminDateInput from '../components/AdminDateInput.vue'
import AdminInput from '../components/AdminInput.vue'
import ModalOrder from '../components/AdminModalOrder.vue'
import Swal from 'sweetalert2'
import { variables } from '../js/AdminVariables.js'

export default {
  name: 'AdminOrder',
  components: {
    AdminBreadcrumb,
    AdminInput,
    AdminDateInput,
    AdminBtn,
    AdminBulkBtn,
    ModalOrder
  },
  data() {
    return {
      mainTitle: variables.orderblock.order,
      subTitle: variables.orderblock.orderList,
      breadcrumbItems: [
        { text: '首頁', link: '/admin', active: false },
        { text: variables.orderblock.order, link: '', active: true },
        { text: variables.orderblock.orderList, link: '/admin_order', active: false }
      ],
      // 假資料
      orders: [
        {
          orderId: '20210517379430',
          orderDate: '2024/06/09',
          memberName: '張哲菘',
          recipientName: '許阿mei',
          orderStatus: '處理中',
          paymentStatus: '已付款'
        },
        {
          orderId: '20210517379431',
          orderDate: '2024/06/10',
          memberName: '張哲菘',
          recipientName: '許阿mei',
          orderStatus: '處理中',
          paymentStatus: '已付款'
        }
      ],
      currentActionType: '',
      currentOrder: {},
      showCancelReason: false,
      selectAll: false
    }
  },
  watch: {
    orders: {
      handler() {
        // 檢查是否所有的 order.selected 都是 true，若是則勾選表頭的複選框
        this.selectAll = this.orders.every((order) => order.selected)
      },
      deep: true
    }
  },
  methods: {
    openModal(actionType, order) {
      this.currentActionType = actionType
      this.currentOrder = order
      this.showCancelReason = actionType === 'cancel'
      this.$refs.modal.show()
    },
    handleSave(order) {
      // 編輯訂單的邏輯
      console.log('編輯訂單', order)
      // 更新訂單數據的邏輯
    },
    confirmCancelOrder(order) {
      Swal.fire({
        title: '確認取消',
        text: '您確定要取消此訂單嗎？',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '是的，取消!',
        cancelButtonText: '否'
      }).then((result) => {
        if (result.isConfirmed) {
          // 更新訂單狀態
          order.orderStatus = '已取消'
          // 顯示已取消的確認消息
          Swal.fire('已取消', '該訂單已被取消', 'success').then(() => {
            // 打開模態窗口
            this.openModal('cancel', order)
          })
        }
      })
    },
    toggleAllCheckboxes() {
      this.orders.forEach((order) => {
        order.selected = this.selectAll
      })
    },
    // 確認並更新選定的訂單狀態
    bulkCancel() {
      const selectedOrders = this.orders.filter((order) => order.selected)

      if (selectedOrders.length === 0) {
        Swal.fire('未選擇任何項目', '請選擇要取消的訂單', 'warning')

        return
      }

      Swal.fire({
        title: '確認取消',
        text: `您確定要取消選中的${selectedOrders.length}個訂單嗎？`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '取消!',
        cancelButtonText: '取消'
      }).then((result) => {
        if (result.isConfirmed) {
          selectedOrders.forEach((order) => {
            order.orderStatus = '已取消'
          })
          this.selectAll = false // 重置selectAll狀態
          Swal.fire('已取消', '選中的訂單狀態已更新為已取消', 'success')
        }
      })
    }
  }
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
.searchDay {
  font-size: $fontSize_p;
}
.d-grid {
  margin-top: 50px;
  margin-left: 160px;
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
  button {
    border: none;
    background: none;
  }
  #flexSwitchCheckChecked:checked {
    background-color: $toggle-on;
    border: solid $toggle-on;
  }
}
</style>
