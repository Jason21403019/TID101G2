<template>
  <div class="container">
    <main class="grid">
      <article>
        <div class="text">
          <p><strong>訂單編號:</strong> {{ order.id }}</p>
          <p><strong>成立時間:</strong> {{ order.order_date }}</p>
          <p><strong>訂單狀態:</strong> {{ order.status }}</p>
          <p><strong>購買產品:</strong> {{ order.name }}</p>
          <p><strong>總價:</strong> {{ order.total_amount }}</p>
          <p><strong>付款狀態:</strong> {{ order.payment_status }}</p>
          <p><strong>出貨狀態:</strong> {{ order.delivery_status }}</p>

          <!-- 取消訂單按鈕 -->
          <button
            type="submit"
            class="btn btn-primary"
            :disabled="isButtonDisabled('cancel')"
            @click.prevent="confirmCancellation"
          >
            取消訂單
          </button>

          <!-- 退換貨按鈕 -->
          <button
            type="submit"
            class="btn btn-primary"
            :disabled="isButtonDisabled('returnExchange')"
            @click.prevent="confirmReturnExchange"
          >
            退換貨
          </button>
        </div>
      </article>
    </main>
  </div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'

export default {
  name: 'MemberOrderCard',
  props: {
    order: Object
  },
  data() {
    return {
      processingAction: false
    }
  },
  methods: {
    // 確定按鈕是否應該禁用
    isButtonDisabled(action) {
      return this.order.status !== '未處理' || this.processingAction
    },
    // 取消訂單彈跳視窗
    confirmCancellation() {
      Swal.fire({
        title: '確定取消該筆訂單嗎？',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '確定取消',
        cancelButtonText: '取消',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          this.processingAction = true
          this.changeOrderStatus('已取消')
        }
      })
    },
    // 退換貨彈跳視窗
    confirmReturnExchange() {
      Swal.fire({
        title: '確定要進行退換貨操作嗎？',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: '確定',
        cancelButtonText: '取消',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          this.processingAction = true
          this.changeOrderStatus('退換貨中')
        }
      })
    },
    // 更新訂單狀態
    changeOrderStatus(newStatus) {
      axios
        .post(`${import.meta.env.VITE_PHP_PATH}MemberOrder.php`, {
          orderId: this.order.id,
          newStatus
        })
        .then((response) => {
          if (response.data && response.data.success) {
            console.log('訂單狀態更新成功', response)
            this.order.status = newStatus
            Swal.fire('成功', '訂單狀態已更新', 'success')
          } else {
            throw new Error(response.data.error || '訂單狀態更新失敗')
          }
        })
        .catch((error) => {
          console.error('更新訂單狀態失敗', error)
          Swal.fire('錯誤', error.message, 'error')
        })
        .finally(() => {
          this.processingAction = false
        })
    }
  }
}
</script>

<style lang="scss" scoped>
.grid > article {
  border: 1px solid $ramos-gin-fizz;
  box-shadow: 2px 2px 6px 0px rgba(0, 0, 0, 0.3);
  background-color: $ramos-gin-fizz;
  border-radius: 8px;
  transition: 0.3s;
}

.grid .text {
  padding-top: 10px;
  padding-left: 10px;
  padding-bottom: 10px;
  color: $blackvevet;
  font-family: $fontfamily;
  font-weight: bold;
  line-height: $lineheight;
  letter-spacing: $letterspacing - 0.175rem;
}

.btn-primary {
  color: $ramos-gin-fizz;
  font-weight: bold;
  background-color: $irishcoffee;
  border: none;
  margin-right: 5px;
  margin-top: 5px;
}

p {
  font-size: $fontSize_p;
  letter-spacing: 2px;
}
</style>
