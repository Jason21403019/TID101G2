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
                <span>20210517379430</span>
              </div>
              <div class="col-md-4 d-flex align-items-center">
                <h4 class="col-form-label me-2">建立日期:</h4>
                <span>2024/05/07</span>
              </div>
              <div class="col-md-4 d-flex align-items-center">
                <h4 class="col-form-label me-2">訂單狀態:</h4>
                <select v-model="orderData.status" class="form-control">
                  <option value="處理中">處理中</option>
                  <option value="已出貨">已出貨</option>
                  <option value="已完成">已完成</option>
                  <option value="已取消">已取消</option>
                  <option value="退換貨">退換貨</option>
                </select>
              </div>
            </div>

            <!-- 付款狀態 -->
            <div class="mb-3 d-flex payment-status-section">
              <div class="col-md-6 d-flex align-items-center">
                <h4 class="col-form-label me-2">付款狀態:</h4>
                <span>已付款</span>
              </div>
              <div class="col-md-6 d-flex align-items-center">
                <h4 class="col-form-label me-2">配送狀態:</h4>
                <span>配送中</span>
              </div>
            </div>

            <!-- 點擊取消時才會跳出 -->
            <div v-if="showCancelReason" class="mb-3 cancel">
              <div class="col-md-6 d-flex align-items-center">
                <h4 class="col-form-label me-2">取消原因:</h4>
                <span>價格太貴</span>
              </div>
              <div class="col-md-6 d-flex align-items-center">
                <h4 class="col-form-label me-2">其他因素:</h4>
                <span>.....</span>
              </div>
            </div>

            <!-- 會員資訊 -->
            <section class="memberInfo">
              <h3>會員資訊</h3>
              <div class="mb-3 d-flex align-items-center">
                <div class="col-md-4 d-flex align-items-center">
                  <h4 class="col-form-label me-2">會員編號:</h4>
                  <span>123456</span>
                </div>
                <div class="col-md-4 d-flex align-items-center">
                  <h4 class="col-form-label me-2">會員姓名:</h4>
                  <span>張三</span>
                </div>
                <div class="col-md-4 d-flex align-items-center">
                  <h4 class="col-form-label me-2">會員電話:</h4>
                  <span>0912345678</span>
                </div>
              </div>
            </section>

            <!-- 訂單明細 -->
            <section class="orderDetail">
              <h3>訂單明細</h3>
              <!-- <div v-for="(product, index) in orderData.products" :key="index"> -->
              <div>
                <div class="mb-3 row align-items-center">
                  <div class="col-md-6 d-flex align-items-center">
                    <h4 class="col-form-label me-2">商品編號:</h4>
                    <span>222222</span>
                  </div>
                  <div class="col-md-6 d-flex align-items-center">
                    <h4 class="col-form-label me-2">商品名稱:</h4>
                    <span>Mousseux 穆瑟 無酒精氣泡酒</span>
                  </div>
                </div>

                <div class="mb-3 row align-items-center">
                  <div class="col-md-6 d-flex align-items-center">
                    <h4 class="col-form-label me-2">商品品牌:</h4>
                    <span>Carl Jung 卡爾榮格</span>
                  </div>
                  <div class="col-md-6 d-flex align-items-center">
                    <h4 class="col-form-label me-2">商品規格:</h4>
                    <span>750ml</span>
                  </div>
                </div>

                <div class="mb-3 row align-items-center">
                  <div class="col-md-6 d-flex align-items-center">
                    <h4 class="col-form-label me-2">數量:</h4>
                    <span>3</span>
                  </div>
                  <div class="col-md-6 d-flex align-items-center">
                    <h4 class="col-form-label me-2">單價:</h4>
                    <span>900</span>
                  </div>
                </div>
              </div>
            </section>

            <!-- 金額明細 -->
            <section class="money">
              <h3>金額明細</h3>
              <div class="mb-3">
                <div class="d-flex align-items-center">
                  <h4 class="col-form-label me-2">小計:</h4>
                  <span>$ 45,000</span>
                </div>
                <div class="d-flex align-items-center">
                  <h4 class="col-form-label me-2">運費:</h4>
                  <span>$ 250</span>
                </div>
                <div class="d-flex align-items-center">
                  <h4 class="col-form-label me-2">優惠券:</h4>
                  <span>$ -250</span>
                </div>
                <div class="d-flex align-items-center">
                  <h4 class="col-form-label me-2">總金額:</h4>
                  <span>$ 45,000</span>
                </div>
              </div>
            </section>

            <!-- 收件人 -->
            <section class="recipient">
              <div class="mb-3 d-flex align-items-center">
                <h3 class="me-2">收件人資訊</h3>
                <button @click="toggleEdit">
                  <img src="../imgs/icon/icon_admin-edit.svg" alt="" width="20px" height="20px" />
                </button>
              </div>

              <div class="mb-3">
                <div class="row mb-3">
                  <label class="col-md-2 col-form-label">收件人姓名:</label>
                  <input
                    v-model="orderData.recipientName"
                    type="text"
                    class="form-control"
                    :disabled="!isEditable"
                    :class="{ 'editable-input': isEditable }"
                  />
                </div>

                <div class="row mb-3">
                  <label class="col-md-2 col-form-label">收件人電話:</label>
                  <input
                    v-model="orderData.recipientPhone"
                    type="text"
                    class="form-control"
                    :disabled="!isEditable"
                    :class="{ 'editable-input': isEditable }"
                  />
                </div>

                <div class="row mb-3">
                  <label class="col-md-2 col-form-label">收件人地址:</label>
                  <input
                    v-model="orderData.recipientAddress"
                    type="text"
                    class="form-control"
                    :disabled="!isEditable"
                    :class="{ 'editable-input': isEditable }"
                  />
                </div>

                <div class="row mb-3">
                  <label class="col-md-2 col-form-label">付款方式:</label>
                  <input
                    v-model="orderData.paymentMethod"
                    type="text"
                    class="form-control"
                    :disabled="!isEditable"
                    :class="{ 'editable-input': isEditable }"
                  />
                </div>

                <div class="row mb-3">
                  <label class="col-md-2 col-form-label">運送方式:</label>
                  <input
                    v-model="orderData.deliveryMethod"
                    type="text"
                    class="form-control"
                    :disabled="!isEditable"
                    :class="{ 'editable-input': isEditable }"
                  />
                </div>

                <div class="row mb-3">
                  <label class="col-md-2 col-form-label">訂單備註:</label>
                  <input
                    v-model="orderData.orderNote"
                    type="text"
                    class="form-control"
                    :disabled="!isEditable"
                    :class="{ 'editable-input': isEditable }"
                  />
                </div>
              </div>
            </section>
          </form>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
          <button type="button" class="btn btn-primary" @click="onSave">儲存</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    actionType: String,
    order: Object,
    onSave: Function,
    showCancelReason: Boolean
  },
  data() {
    return {
      orderData: {
        id: '',
        date: '',
        status: '',
        paymentStatus: '',
        deliveryStatus: '',
        memberId: '',
        memberName: '',
        memberPhone: '',
        subtotal: '',
        shippingFee: '',
        coupon: '',
        totalAmount: '',
        recipientName: '',
        recipientPhone: '',
        recipientAddress: '',
        paymentMethod: '',
        deliveryMethod: '',
        orderNote: '',
        products: [
          {
            id: '222222',
            name: 'Mousseux 穆瑟 無酒精氣泡酒',
            brand: 'Carl Jung 卡爾榮格',
            spec: '750ml',
            quantity: 1,
            price: 'NT$300'
          },
          {
            id: '333333',
            name: '紅酒',
            brand: '品牌B',
            spec: '500ml',
            quantity: 2,
            price: 'NT$200'
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
        if (newVal) {
          this.orderData = { ...newVal }
        } else {
          this.orderData = {
            id: '',
            date: '',
            status: '',
            paymentStatus: '',
            deliveryStatus: '',
            memberId: '',
            memberName: '',
            memberPhone: '',
            subtotal: '',
            shippingFee: '',
            coupon: '',
            totalAmount: '',
            recipientName: '',
            recipientPhone: '',
            recipientAddress: '',
            paymentMethod: '',
            deliveryMethod: '',
            orderNote: '',
            products: []
          }
        }
      }
    }
  },
  mounted() {
    this.modal = new bootstrap.Modal(document.getElementById('orderModal'))
  },
  methods: {
    show() {
      this.modal.show()
    },
    hide() {
      this.modal.hide()
    },
    onSave() {
      this.onSave(this.orderData)
      this.hide()
    },
    toggleEdit() {
      this.isEditable = !this.isEditable
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
  .form-control[data-v-b6d1be6c] {
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
