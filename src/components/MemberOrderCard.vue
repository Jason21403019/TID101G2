<template>
  <div class="container">
    <main class="grid">
      <article>
        <div class="text">
          <p><strong>訂單編號:</strong> {{ order.id }}</p>
          <p><strong>成立時間:</strong> {{ order.order_date }}</p>
          <p><strong>訂單狀態:</strong> {{ order.status }}</p>
          <p><strong>購買產品:</strong> {{ order.product_details}}</p>
          <p><strong>總價:</strong> {{ order.total_amount }}</p>
          <p><strong>付款狀態:</strong> {{ order.payment_status }}</p>
          <p><strong>出貨狀態:</strong> {{ order.delivery_status }}</p>
          <!-- 根據配送狀態 來判斷該出現的按鈕 delivery_status:已完成>完成訂單或是退換貨｜ status:未處理>取消訂單-->
          <!-- <button class="btn btn-primary btn-block">取消訂單</button> -->
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">取消訂單</button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">確定取消該筆訂單嗎？</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                  <button type="button" class="btn btn-primary">確定取消</button>
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
    order: Object // 此設定是為了接受父層的傳過來得值，在memberorder中收到:order="order" 得值，傳到了該元件的orders: []中
  },
  data() {
    return {
      orders: [],
    };
  },

  // mounted() {
  //   this.fetchOrders();
  // },

  // methods: {
  //   fetchOrders() {
  //     axios.get('http://localhost/TID101G2/public/api/MemberOrder.php')
  //       .then(response => {
  //         this.orders = response.data;
  //       })
  //       .catch(error => {
  //         console.error("There was an error fetching the orders!", error);
  //       });
  //   },
  // },
};
</script>

<style lang="scss" scoped>


.grid > article {
  border: 1px solid $ramos-gin-fizz;
  box-shadow: 2px 2px 6px 0px rgba(0, 0, 0, 0.3);
  background-color: $ramos-gin-fizz;
  border-radius: 8px;
  transition: 0.3s;
  // padding-top: 20px;

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
  // padding-right: 10px;
  margin-right: 5px;
  margin-top: 5px;
}
p{
  font-size: $fontSize_p;
  letter-spacing: 2px
}


</style>
