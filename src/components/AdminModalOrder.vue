<template>
  <div id="orderModal" class="modal modal-lg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 id="exampleModalLabel" class="modal-title fs-5">訂單資訊</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <form>
            <!-- 訂單表頭 -->
            <div class="mb-3 d-flex align-items-center">
              <div class="col-md-5 d-flex align-items-center">
                <h4 class="col-form-label me-2">訂單編號:</h4>
                <span>{{ orderData.order_id }}</span>
              </div>
              <div class="col-md-4 d-flex align-items-center">
                <h4 class="col-form-label me-2">建立日期:</h4>
                <span>{{ orderData.order_date }}</span>
              </div>
              <div class="col-md-4 d-flex align-items-center">
                <h4 class="col-form-label me-2">訂單狀態:</h4>
                <span v-if="actionType === 'view'">{{ orderData.order_status }}</span>
                <select v-else v-model="orderData.order_status" class="form-control orderStatus">
                  <option value="已確認">已確認</option>
                  <option value="已出貨">已出貨</option>
                  <option value="已完成">已完成</option>
                  <option value="已取消">已取消</option>
                  <option value="退換貨">退換貨</option>
                </select>
              </div>
            </div>
            <!-- 付款方式/物流方式 -->
            <div class="mb-3 d-flex align-items-center">
              <div class="col-md-5 d-flex align-items-center">
                <h4 class="col-form-label me-2">付款方式:</h4>
                <span>{{ orderData.payment_method }}</span>
              </div>
              <div class="col-md-5 d-flex align-items-center">
                <h4 class="col-form-label me-2">運送方式:</h4>
                <span>{{ orderData.delivery_method }}</span>
              </div>
            </div>
            <!-- 付款狀態 -->
            <div class="mb-3 d-flex payment-status-section">
              <div class="col-md-6 d-flex align-items-center">
                <h4 class="col-form-label me-2">付款狀態:</h4>
                <span>{{ orderData.payment_status }}</span>
              </div>
              <div class="col-md-6 d-flex align-items-center">
                <h4 class="col-form-label me-2">配送狀態:</h4>
                <span>{{ orderData.delivery_status }}</span>
              </div>
            </div>

            <!-- 點擊取消時才會跳出 -->
            <!-- <div v-if="orderData.order_status === '已取消' && actionType === 'view'" class="mb-3 cancel">
              <div class="col-md-6 d-flex align-items-center">
                <h4 class="col-form-label me-2">取消原因:</h4>
                <span>價格太貴</span>
              </div>
              <div class="col-md-6 d-flex align-items-center">
                <h4 class="col-form-label me-2">其他因素:</h4>
                <span>.....</span>
              </div>
            </div> -->

            <!-- 會員資訊 -->
            <section class="memberInfo">
              <h3>會員資訊</h3>
              <div class="mb-3 d-flex align-items-center">
                <div class="col-md-4 d-flex align-items-center">
                  <h4 class="col-form-label me-2">會員編號:</h4>
                  <span>{{ orderData.member_id }}</span>
                </div>
                <div class="col-md-4 d-flex align-items-center">
                  <h4 class="col-form-label me-2">會員姓名:</h4>
                  <span>{{ orderData.member_name }}</span>
                </div>
                <div class="col-md-4 d-flex align-items-center">
                  <h4 class="col-form-label me-2">會員電話:</h4>
                  <span>{{ orderData.member_phone }}</span>
                </div>
              </div>
            </section>

            <!-- 訂單明細 -->
            <section class="orderDetail">
              <h3>訂單明細</h3>
              <div v-for="(product, index) in orderData.products" :key="index">
                <div class="mb-3 row align-items-center">
                  <div class="col-md-6 d-flex align-items-center">
                    <h4 class="col-form-label me-2">商品編號:</h4>
                    <span>{{ product.product_id }}</span>
                  </div>
                  <div class="col-md-6 d-flex align-items-center">
                    <h4 class="col-form-label me-2">商品名稱:</h4>
                    <span>{{ product.product_name }}</span>
                  </div>
                </div>

                <div class="mb-3 row align-items-center">
                  <div class="col-md-6 d-flex align-items-center">
                    <h4 class="col-form-label me-2">商品品牌:</h4>
                    <span>{{ product.product_brand }}</span>
                  </div>
                  <div class="col-md-6 d-flex align-items-center">
                    <h4 class="col-form-label me-2">商品規格:</h4>
                    <span>{{ product.product_spec }}</span>
                  </div>
                </div>

                <div class="mb-3 row align-items-center">
                  <div class="col-md-6 d-flex align-items-center">
                    <h4 class="col-form-label me-2">數量:</h4>
                    <span>{{ product.product_quantity }}</span>
                  </div>
                  <div class="col-md-6 d-flex align-items-center">
                    <h4 class="col-form-label me-2">單價:</h4>
                    <span>{{ product.product_price }}</span>
                  </div>
                </div>
                <hr v-if="index < orderData.products.length - 1" />
              </div>
            </section>

            <!-- 金額明細 -->
            <section class="money">
              <h3>金額明細</h3>
              <div class="mb-3">
                <div class="d-flex align-items-center">
                  <h4 class="col-form-label me-2">小計:</h4>
                  <span>$ {{ orderData.subtotal }}</span>
                </div>
                <div class="d-flex align-items-center">
                  <h4 class="col-form-label me-2">運費:</h4>
                  <span v-if="orderData.shipping_fee">$ {{ orderData.shipping_fee }}</span>
                  <span v-else>{{ orderData.shipping_fee }}</span>
                </div>
                <div class="d-flex align-items-center">
                  <h4 class="col-form-label me-2">優惠券:</h4>
                  <span v-if="orderData.discount">$ {{ orderData.discount }}</span>
                  <span v-else>{{ orderData.discount }}</span>
                </div>
                <div class="d-flex align-items-center">
                  <h4 class="col-form-label me-2">總金額:</h4>
                  <span>$ {{ orderData.total_amount }}</span>
                </div>
              </div>
            </section>

            <!-- 收件人 -->
            <section class="recipient">
              <div class="mb-3 d-flex align-items-center">
                <h3 class="me-2">收件人資訊</h3>
                <button v-if="actionType !== 'view'" @click="toggleEdit">
                  <img src="../imgs/icon/icon_admin-edit.svg" alt="" width="20px" height="20px" />
                </button>
              </div>

              <div class="mb-3">
                <div class="mb-3 d-flex align-items-center">
                  <label class="col-md-2 col-form-label me-3">收件人姓名:</label>
                  <span v-if="!isEditable">{{ orderData.receiver }}</span>
                  <input v-else v-model="orderData.receiver" type="text" class="form-control" />
                </div>

                <div class="mb-3 d-flex align-items-center">
                  <label class="col-md-2 col-form-label me-3">收件人電話:</label>
                  <span v-if="!isEditable">{{ orderData.receiver_phone }}</span>
                  <input v-else v-model="orderData.receiver_phone" type="text" class="form-control" />
                </div>

                <div class="mb-3 d-flex align-items-center">
                  <label class="col-md-2 col-form-label me-3">收件人Email:</label>
                  <span v-if="!isEditable">{{ orderData.receiver_email }}</span>
                  <input v-else v-model="orderData.receiver_email" type="text" class="form-control" />
                </div>

                <div class="mb-3 d-flex align-items-center">
                  <label class="col-md-2 col-form-label me-3">收件人地址:</label>
                  <span v-if="!isEditable">{{ orderData.receiver_address }}</span>
                  <input v-else v-model="orderData.receiver_address" type="text" class="form-control" />
                </div>

                <div class="mb-3 d-flex align-items-center">
                  <label class="col-md-2 col-form-label me-3">訂單備註:</label>
                  <span v-if="!isEditable">{{ orderData.note }}</span>
                  <input v-else v-model="orderData.note" type="text" class="form-control" />
                </div>
              </div>
            </section>
          </form>
        </div>

        <div class="modal-footer" v-if="actionType !== 'view'">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
          <button type="button" class="btn btn-primary" @click="handleSave">儲存</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Swal from 'sweetalert2'
import { useAdminOrderStore } from '../stores/adminOrder'

export default {
  props: {
    actionType: {
      type: String,
      required: true
    },
    order: {
      type: Object,
      required: true
    },
    onSave: {
      type: Function,
      required: true
    },
    showCancelReason: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      orderData: {
        order_id: '',
        order_date: '',
        order_status: '',
        delivery_status: '',
        payment_method: '',
        delivery_method: '',
        subtotal: '',
        shipping_fee: '',
        discount: '',
        total_amount: '',
        note: '',
        member_id: '',
        member_name: '',
        member_phone: '',
        member_email: '',
        payment_status: '',
        receiver: '',
        receiver_phone: '',
        receiver_email: '',
        receiver_address: '',
        products: [
          {
            product_id: '',
            product_name: '',
            product_brand: '',
            product_spec: '',
            order_quantity: '',
            product_price: ''
          }
        ]
      },
      modal: null,
      isEditable: false
    }
  },
  watch: {
    order: {
      immediate: true,
      handler(newVal) {
        if (newVal && newVal.id) {
          this.fetchOrderDetails(newVal.id)
        }
      }
    },
    // 確保檢視頁不會被編輯頁影響
    actionType: {
      immediate: true,
      handler(newVal) {
        if (newVal === 'view') {
          this.isEditable = false
        }
      }
    }
  },
  mounted() {
    this.modal = new bootstrap.Modal(document.getElementById('orderModal'))
    // 添加事件監聽器，當 modal 被隱藏時調用 resetEditable 方法
    document.getElementById('orderModal').addEventListener('hidden.bs.modal', this.resetEditable)
  },
  beforeUnmount() {
    // 當組件即將被銷毀時，移除事件監聽器
    document.getElementById('orderModal').removeEventListener('hidden.bs.modal', this.resetEditable)
  },
  methods: {
    async fetchOrderDetails(orderId) {
      const adminOrderStore = useAdminOrderStore()
      const result = await adminOrderStore.fetchOrderDetails(orderId)

      if (result.success) {
        this.orderData = {
          ...result.orderDetails,
          products: result.orderDetails.products || []
        }
      } else {
        console.error(result.message)
      }
    },
    show() {
      this.modal.show()
    },
    hide() {
      this.modal.hide()
    },
    async handleSave() {
      const adminOrderStore = useAdminOrderStore()
      const result = await adminOrderStore.editOrderRecipient(this.orderData.order_id, {
        receiver: this.orderData.receiver,
        receiver_phone: this.orderData.receiver_phone,
        receiver_email: this.orderData.receiver_email,
        receiver_address: this.orderData.receiver_address,
        note: this.orderData.note,
        order_status: this.orderData.order_status // 包括訂單狀態
      })

      if (result.success) {
        Swal.fire({
          icon: 'success',
          title: '成功',
          text: '訂單資訊更新成功'
        })
        this.onSave(this.orderData)
        this.isEditable = false // 成功儲存後將狀態設置為不可編輯
      } else {
        Swal.fire({
          icon: 'error',
          title: '失敗',
          text: '訂單資訊更新失敗'
        })
        console.error('訂單資訊更新失敗', result.message)
      }
      this.hide()
    },
    toggleEdit() {
      event.preventDefault() // 防止默認行為
      this.isEditable = !this.isEditable
    },
    // 確保按下close和關閉時,把toggle修正
    resetEditable() {
      this.isEditable = false
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss'; // 確保這一行在最上面

.modal-header {
  font-size: $fontSize_h4;
  background-color: $babypowder;
  color: $campari;
}
.modal-body {
  font-size: $fontSize_h4;
  background-color: $babypowder;
  color: $campari;

  h3 {
    font-size: $fontSize_h4;
  }
  .form-control {
    width: 40%;
  }
  // 付款狀態底色
  .payment-status-section,
  .cancel {
    background-color: rgba(56, 27, 29, 0.3);
  }

  // 會員
  .memberInfo {
    border-bottom: 2px solid $blackvevet;
  }
  // 訂單
  .orderDetail {
    margin-top: 10px;
    border-bottom: 2px solid $blackvevet;
  }
  // 金額
  .money {
    margin-top: 10px;
    border-bottom: 2px solid $blackvevet;
  }
  // 收件人
  .recipient {
    margin-top: 10px;

    .form-control {
      width: 80%;
    }
    button {
      border: none;
      background: none;
    }
  }
  // 收件人的input框
  .editable-input {
    border: 2px solid $campari;
    background-color: $babypowder;
  }
  input:disabled {
    background-color: #e9ecef; /* 禁用時的背景顏色 */
  }
}

.modal-footer {
  background-color: $babypowder;
  .btn-primary {
    background-color: $campari;
    color: $ramos-gin-fizz;
    border: 1px solid $campari;
  }
}
</style>
