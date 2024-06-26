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
    <admin-select-input input-id="formGroupExampleInput1" :selected-option="selectedOption">
      <template #label>查詢條件</template>
      <template #select>
        <select v-model="selectedOption" class="form-select" aria-label="Default select example">
          <option selected value="">訂單編號</option>
          <option value="1">會員姓名</option>
          <option value="2">訂單狀態</option>
        </select>
      </template>
      <!-- 如果切換到訂單狀態時，變更input視窗為下拉式 -->
      <template #input="{ inputId }">
        <input v-if="selectedOption !== '2'" :id="inputId" v-model="inputValue" type="text" class="form-control" />
        <select v-else v-model="selectedOrderStatus" class="form-select">
          <option value="">選擇訂單狀態</option>
          <option value="processing">處理中</option>
          <option value="shipped">已出貨</option>
          <option value="completed">已完成</option>
          <option value="cancelled">已取消</option>
          <option value="returns_exchanges">退換貨</option>
        </select>
      </template>
    </admin-select-input>

    <!-- 查詢日期 -->
    <div class="d-flex align-items-center">
      <admin-date-input start-date-id="dateInputField1" end-date-id="dateInputField2">
        <template #label>訂單日期</template>
        <template #info>(最多查詢100天)</template>
      </admin-date-input>

      <admin-btn>
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
            <input
              v-if="order.status !== '已取消' && order.status !== '已完成'"
              v-model="order.selected"
              class="form-check-input"
              type="checkbox"
              @change="checkIfAllSelected"
            />
          </th>
          <td>{{ order.id }}</td>
          <td>{{ order.order_date }}</td>
          <td>{{ order.full_name }}</td>
          <td>{{ order.receiver }}</td>
          <td>{{ order.status }}</td>
          <td>{{ order.payment_status }}</td>
          <td>
            <button v-if="order.status !== '已取消' && order.status !== '已完成'" @click="openModal('edit', order)">
              <img src="../imgs/icon/icon_admin-edit.svg" alt="" width="20px" height="20px" />
            </button>
          </td>
          <td>
            <button v-if="order.status !== '已取消' && order.status !== '已完成'" @click="confirmCancelOrder(order)">
              <img src="../imgs/icon/icon_admin-square.svg" alt="" width="20px" height="20px" />
            </button>
          </td>
        </tr>
      </tbody>
      <!-- <caption>
        每頁列表顯示<span class="main__list-number">6</span
        >筆
      </caption> -->
    </table>
  </section>

  <ModalOrder
    ref="modal"
    :action-type="currentActionType"
    :order="currentOrder"
    :show-cancel-reason="showCancelReason"
    :on-save="handleSave"
  />
</template>

<script>
import AdminBreadcrumb from '../components/AdminBreadcrumb.vue'
import AdminBtn from '../components/AdminBtn.vue'
import AdminBulkBtn from '../components/AdminBulkBtn.vue'
import AdminDateInput from '../components/AdminDateInput.vue'
import AdminSelectInput from '../components/AdminSelectInput.vue'
import ModalOrder from '../components/AdminModalOrder.vue'
import Swal from 'sweetalert2'
import { useAdminOrderStore } from '../stores/adminOrder'
import { variables } from '../js/AdminVariables.js'

export default {
  name: 'AdminOrder',
  components: {
    AdminBreadcrumb,
    AdminSelectInput,
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
      orders: [],
      currentActionType: '',
      currentOrder: {},
      showCancelReason: false,
      selectAll: false,
      selectedOrder: {},
      // 訂單狀態
      selectedOption: '',
      inputValue: '',
      selectedOrderStatus: ''
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
  async mounted() {
    // console.log('Component mounted')
    await this.loadOrders()
  },
  methods: {
    // 讀取資料庫的資料渲染在table上
    async loadOrders() {
      const adminOrderStore = useAdminOrderStore()
      const result = await adminOrderStore.fetchOrders()

      if (result.success) {
        this.orders = result.orders
      }
    },
    openModal(actionType, order) {
      this.currentActionType = actionType
      this.currentOrder = order
      this.showCancelReason = actionType === 'cancel'
      this.$refs.modal.show()
    },
    async handleSave(order) {
      await this.loadOrders()
    },
    // 取消單筆訂單
    async confirmCancelOrder(order) {
      const adminOrderStore = useAdminOrderStore()

      Swal.fire({
        title: '確認取消',
        text: '您確定要取消此訂單嗎？',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '確定',
        cancelButtonText: '否'
      }).then(async (result) => {
        if (result.isConfirmed) {
          // 呼叫 cancelOrder 方法來更新資料庫中的訂單狀態
          const updateResult = await adminOrderStore.cancelOrder(order.id)

          if (updateResult.success) {
            // 更新表格中的訂單狀態
            order.status = '已取消'
            // 顯示已取消的確認消息
            Swal.fire('已取消', '該訂單已被取消', 'success')
          } else {
            // 顯示錯誤消息
            Swal.fire('失敗', '訂單取消失敗', 'error')
          }
        }
      })
    },
    toggleAllCheckboxes() {
      this.orders.forEach((order) => {
        order.selected = this.selectAll
      })
    },
    // 多筆取消
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
        confirmButtonText: '確定!',
        cancelButtonText: '取消'
      }).then(async (result) => {
        if (result.isConfirmed) {
          const adminOrderStore = useAdminOrderStore()

          for (const order of selectedOrders) {
            const updateResult = await adminOrderStore.cancelOrder(order.id)

            if (updateResult.success) {
              order.status = '已取消'
            }
          }
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
