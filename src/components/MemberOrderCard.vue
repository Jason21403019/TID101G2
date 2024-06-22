<template>
  <div class="container">
    <main class="grid">
      <article>
        <div class="text">
          <p><strong>訂單編號:</strong> {{ order.id }}</p>
          <p><strong>成立時間:</strong> {{ order.order_date }}</p>
          <p><strong>訂單狀態:</strong> {{ order.status }}</p>
          <p><strong>購買產品:</strong> {{ order.product_details }}</p>
          <p><strong>總價:</strong> {{ order.total_amount }}</p>
          <p><strong>付款狀態:</strong> {{ order.payment_status }}</p>
          <p><strong>出貨狀態:</strong> {{ order.delivery_status }}</p>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">取消訂單</button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modal">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">確定取消該筆訂單嗎？</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                  <button type="button" class="btn btn-primary" @click="cancelOrder">確定取消</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </article>
    </main>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'MemberOrderCard',
  props: {
    order: Object
  },
  data() {
    return {
      orders: [],
    };
  },
  methods: {
    cancelOrder() {
      axios.post('./api/MemberOrder.php', { orderId: this.order.id })
        .then(response => {
          console.log('訂單取消成功', response);
          this.order.status = '取消中'; // 更新訂單狀態
          // 關閉模態視窗
          const modalElement = this.$refs.modal;
          const modalInstance = bootstrap.Modal.getInstance(modalElement);
          if (modalInstance) {
            modalInstance.hide();
          }
        })
        .catch(error => {
          console.error('取消訂單失敗', error);
        });
    }
  }
};
</script>

<style lang="scss" scoped>
/* Your styles */
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

.btn-primary{
  color: $ramos-gin-fizz;
  font-weight: bold;
  background-color: $irishcoffee;
  border: none;
  margin-right: 5px;
  margin-top: 5px;
}

p{
  font-size: $fontSize_p;
  letter-spacing: 2px
}
</style>
