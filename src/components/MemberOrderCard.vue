<template>
  <div class="container">
    <main class="grid">
      <article>
        <div class="text">
          <p><strong>訂單編號:</strong> {{ orderId }}</p>
          <p><strong>成立時間:</strong> {{ orderTime }}</p>
          <p><strong>訂單狀態:</strong> {{ orderStatus }}</p>
          <p><strong>總價:</strong> {{ totalPrice }}</p>
          <p><strong>配送狀態:</strong> {{ shippingStatus }}</p>
          <p><strong>付款狀態:</strong> {{ paymentStatus }}</p>
          <p><strong>出貨狀態:</strong> {{ fulfillmentStatus }}</p>
          <!-- 根據配送狀態 來判斷該出現的按鈕 delivery_status:已完成>完成訂單或是退換貨｜ status:未處理>取消訂單-->
          <!-- <button class="btn btn-primary btn-block">取消訂單</button> -->
          <!-- 取消訂單的彈跳視窗套件 -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">取消訂單</button>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">...</div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
          <butto class="btn btn-primary btn-block">完成訂單</butto>
          <butto class="btn btn-primary btn-block">退換貨</butto>
        </div>
      </article>
    </main>
  </div>
</template>

<script>
export default {
  name: 'MemberOrderCard',

  props: {
    orderId: {
      type: String,
      required: true
    },
    orderTime: {
      type: String,
      required: true
    },
    orderStatus: {
      type: String,
      required: true
    },
    totalPrice: {
      type: Number,
      required: true
    },
    shippingStatus: {
      type: String,
      required: true
    },
    paymentStatus: {
      type: String,
      required: true
    },
    fulfillmentStatus: {
      type: String,
      required: true
    }
  }
}
</script>

<style lang="scss" scoped>
// .grid {
//   display: grid;
//   grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
//   grid-template-rows: repeat(auto-fill, 250px);
//   grid-gap: 20px;
//   align-items: stretch;
//   padding-right: 20px;

// }

.grid > article {
  border: 1px solid $ramos-gin-fizz;
  box-shadow: 2px 2px 6px 0px rgba(0, 0, 0, 0.3);
  background-color: $ramos-gin-fizz;
  border-radius: 8px;
  transition: 0.3s;
  // padding-top: 20px;
}
.grid > article:hover {
  transform: scale(1.05, 1.05);
  box-shadow: 2px 2px 6px 0px rgba(84, 2, 2, 0.3);
}

.grid .text {
  padding: 20px;
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
  // padding-right: 10px;
  margin-right: 5px;
  margin-top: 5px;
}
</style>
