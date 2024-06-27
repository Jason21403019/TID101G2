<template>
  <div class="AdminOrderPage">
    <AdminBreadcrumb :items="breadcrumbItems" />
    <!-- 標題 -->
    <div class="orderblock">
      <h1 class="orderblock-h1">{{ mainTitle }}</h1>
      <span class="orderblock-pipe"> | </span>
      <h1 class="orderblock-h1">{{ subTitle }}</h1>
    </div>

    <!-- 搜尋 -->
    <section class="searchBlock">
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
            <option value="已確認">已確認</option>
            <option value="已出貨">已出貨</option>
            <option value="已完成">已完成</option>
            <option value="已取消">已取消</option>
            <option value="退換貨">退換貨</option>
          </select>
        </template>
      </admin-select-input>

      <!-- 查詢日期 -->
      <div class="d-flex align-items-center">
        <admin-date-input
          start-date-id="dateInputField1"
          end-date-id="dateInputField2"
          :start-date="startDate"
          :end-date="endDate"
          @date-change="handleDateChange"
        >
          <template #label>訂單日期</template>
          <template #info>(最多查詢100天)</template>
        </admin-date-input>

        <admin-btn @click="searchOrders">
          <template #icon>
            <img src="../imgs/icon/icon_admin-search-w.svg" alt="addIcon" height="20" width="20" />
          </template>
          <template #text>查詢</template>
        </admin-btn>

        <admin-bulk-btn :handle-click="clearSearch" class="orderClear">
          <template #bulktext>清除條件</template>
        </admin-bulk-btn>
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
              <input v-model="selectAll" class="form-check-input" type="checkbox" @change="toggleAllCheckboxes" />
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
          <tr v-for="order in paginatedOrders" :key="order.orderId">
            <th scope="row">
              <input
                v-if="order.status !== '已取消' && order.status !== '已完成'"
                v-model="order.selected"
                class="form-check-input"
                type="checkbox"
                @change="checkIfAllSelected"
              />
            </th>
            <td>
              <button class="btn btn-link" @click="viewOrderDetails(order)">
                {{ order.id }}
              </button>
            </td>
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

    <ModalOrder
      ref="modal"
      :action-type="currentActionType"
      :order="currentOrder"
      :show-cancel-reason="showCancelReason"
      :on-save="handleSave"
    />
  </div>
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
      currentPage: 1,
      itemsPerPage: 6,
      currentActionType: '',
      currentOrder: {},
      showCancelReason: false,
      selectAll: false,
      selectedOrder: {},
      // 訂單狀態
      selectedOption: '',
      inputValue: '',
      selectedOrderStatus: '',
      startDate: '',
      endDate: '',
      isSearching: false // 添加 isSearching 標誌
    }
  },
  computed: {
    paginatedOrders() {
      const start = (this.currentPage - 1) * this.itemsPerPage
      const end = start + this.itemsPerPage

      return this.orders.slice(start, end)
    },
    totalPages() {
      return Math.ceil(this.orders.length / this.itemsPerPage)
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
      return this.orders.length
    },
    startItem() {
      return (this.currentPage - 1) * this.itemsPerPage + 1
    },
    endItem() {
      return Math.min(this.currentPage * this.itemsPerPage, this.totalItems)
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
    changePage(page) {
      if (page >= 1 && page <= this.totalPages) {
        this.currentPage = page
      }
    },
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
    // 點選訂單編號的檢視頁
    viewOrderDetails(order) {
      this.openModal('view', order)
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
    },
    // 查詢
    async searchOrders() {
      if (this.isSearching) return
      this.isSearching = true
      // console.log('searchOrders called')

      const adminOrderStore = useAdminOrderStore()
      const query = this.selectedOption === '2' ? this.selectedOrderStatus : this.inputValue
      const field = this.selectedOption === '2' ? 'status' : this.selectedOption === '' ? 'order.id' : 'member_name'

      if (this.startDate && this.endDate) {
        const diffTime = Math.abs(new Date(this.endDate) - new Date(this.startDate))
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24))

        if (diffDays > 100) {
          alert('日期範圍不能超過100天')
          this.isSearching = false

          return
        }
      }

      try {
        const result = await adminOrderStore.searchOrders(field, query, this.startDate, this.endDate)

        if (result.success) {
          this.orders = result.orders
          this.currentPage = 1 // 搜索後重置頁碼
        } else {
          alert('查詢失敗: ' + result.message)
        }
      } catch (error) {
        console.error('查詢過程中發生錯誤:', error)
        alert('查詢過程中發生錯誤，請稍後再試。')
      } finally {
        this.isSearching = false // 查詢完成後重置標誌位
      }
    },
    async clearSearch() {
      this.selectedOption = ''
      this.inputValue = ''
      this.selectedOrderStatus = ''
      this.startDate = ''
      this.endDate = ''
      await this.loadOrders()
      this.currentPage = 1 // 清除搜索後重置頁碼
    },
    handleDateChange({ startDate, endDate }) {
      this.startDate = startDate
      this.endDate = endDate
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss'; // 確保這一行在最上面
.AdminOrderPage {
  max-width: 1440px;
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
  .admin_btn {
    margin-top: 5px;
    margin-left: 5px;
    height: 35px;
  }
  .orderClear {
    margin-top: 5px;
    margin-left: 5px;
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
</style>
