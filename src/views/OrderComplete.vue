<template>
  <div class="popup">
    <div class="popup__content">
      <div class="order">
        <img src="../imgs/icon/icon_checkbox-w.svg" alt="" />
        <p>感謝您的訂購，以下是您本次購物的明細</p>
      </div>

      <div class="place">
        <h3>訂單編號：{{ orderDetails.order_id }}</h3>
      </div>
      
    <!-- <div class="scroll_container" >
      <div class="product" v-for="product in orderDetails.products" :key="product.id">
          <div class="item_details">
       
              <div class="text">
                <h5>{{ product.name }}</h5>
                <div class="text_down">
                    <p>{{ product.details }}</p>
                </div>
              </div> 
          </div>
          <div class="price">
              <p>NT$ {{ product.price * product.quantity }}</p>
          </div>     
      </div>

    </div> -->

    <div class="order_info">
      <!-- <h3>收件資訊</h3> -->
      <h4>收件人:{{ orderDetails.receiverName }}</h4>
      <h4>聯絡電話:{{ orderDetails.receiverPhone }}</h4>
      <h4>地址:{{ orderDetails.receiverAddress }}</h4>
    </div>

    <div class="pay_info">

          <div class="status">
              <h5>付款狀態</h5>
              <p>已付款</p>
          </div>

          <div class="pay_method">
              <h5>付款方式</h5>
              <p>信用卡</p>
          </div>

          <div class="ship">
              <h5>送貨方式</h5>
              <p>宅配</p>
          </div>

          <div class="subtotal">
              <h5>小計</h5>
              <p>$ {{ orderDetails.subtotal }}</p>
          </div>

          <div class="ship_fee">
              <h5>運費</h5>
              <p>$250</p>
          </div>

          <div class="ship_discount">
              <h5>折抵</h5>
              <p>-$ {{ orderDetails.discount }}</p>
          </div>

          <div class="total_price">
              <h5>總計額</h5>
              <p class="twd">TWD $ {{ orderDetails.total }}</p>
          </div>

    </div>



    </div>

  </div>
</template>


<script>
import axios from 'axios';

export default {
  data() {
    return {
      orderDetails: {
        id: '',
        products: [],
        subtotal: 0,
        discount: 0,
        total: 0,
        receiverName: '',
        receiverPhone: '',
        receiverAddress: '',
      },
      member_id: null,
      error: null,
    };
  },

  created() {
    this.fetchOrderDetails();
  },
  
  methods: {
    async fetchOrderDetails() {
      const memberId = localStorage.getItem('isLoggedIn');
      if (!memberId) {
        console.error('No member ID found');
        return;
      }

      const url = `${import.meta.env.VITE_PHP_PATH}OrderComplete.php?member_id=${memberId}`;

      // const url = `http://localhost:8087/TID101G2/public/api/OrderComplete.php?member_id=${memberId}`;
      console.log('Fetching order details from:', url);
// 
      try {
        const response = await axios.get(url);
        console.log('Received data:', response.data);
        this.orderDetails = response.data;
        if (response.data && Object.keys(response.data).length) {
          this.orderDetails = response.data;
          console.log('Order Details fetched successfully:', this.orderDetails);
        } else {
          this.error = 'No order details found'; // 處理沒有數據的情況
        }
      } catch (error) {
        console.error('Error fetching order details:', error);
        this.error = 'Failed to fetch order details'; // 處理請求錯誤
      }
    },
  },  

};
</script>





<style lang="scss" scoped>
.popup {
padding: 50px;
width: 50%;
margin: 0 auto;
margin-top: 100px;

@include breakpoint(1280px) {
  width: 60%;
}

@include breakpoint(820px) {
    width: 80%;
}

@include breakpoint(540px) {
    width: 100%;
}

@include breakpoint(430px){
    padding: 20px;
}

@include breakpoint(375px){
     padding: 10px;
}

p {
  font-family: $fontfamily;
  color: $campari;
  //  text-align: center;
}

.popup__content {
  background-color: $ramos-gin-fizz;
  padding: 0 0 50px 0;

  @include breakpoint(430px) {
    padding: 0 0 30px 0;
  }

  .order {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: $campari;
    border-bottom: 10px solid #fff;
    padding: 20px;

    @include breakpoint(430px) {
      padding: 10px;
    }

    img {
      width: 30px;
      height: 30px;
      margin-right: 5px;

      @include breakpoint(430px){
          width: 20px;
          height: 20px;
          margin-right: 10px;
      }
    }

    p {
      line-height: 2;
      color: $ramos-gin-fizz;
      letter-spacing: $letterspacing;
      font-size: $fontSize_h4;

      @include breakpoint(768px) {
      font-size: $fontSize_h5;
      }

      @include breakpoint(430px) {
      font-size: $fontSize_p;
      line-height: 1.5;
      }

    }
  }
  .place {
    // outline: 1px solid palegreen;
    text-align: center;
    padding: 20px;

    @include breakpoint(430px){
        padding: 10px;
    }

    h3 {
      font-size: $fontSize_h3;
      font-family: $fontfamily;
      color: $campari;
      margin-bottom: 10px;

      @include breakpoint(430px){
          font-size: 1.5rem;
      }
    }


  }

  .scroll_container {

      overflow-y: scroll;
      width: 85%;
      height: 300px;
      margin: 0 auto;
      margin-bottom: 30px;
    
  
    .product {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px;
      border:1px solid $campari;
      border-radius: 4px;
      background-color: $whitelady;
      width: 95%;
      margin: 0 auto;
      margin-bottom: 20px;

      @include breakpoint(390px){
        width: 100%;
      }

      h5{
        font-family:$fontfamily;
        font-size: $fontSize_h5;

        @include breakpoint(390px){
          font-size: $fontSize_p;
        }
      }

      p{
        font-family:$fontfamily;
        font-size: $fontSize_p;
      }
        .item_details{
          // outline: 1px solid red;
          width: 100%;

          .text_down{
            margin-top: 10px;
          }
        }
        .price{
          width: 30%;
          //  outline:1px solid red;
          margin-left: 20px;
          text-align: center;

          @include breakpoint(390px){
            // margin-left: 0;
            width: 40%;
          }
        }
    }

  }

  .order_info{

    width: 85%;
    margin: 0 auto;
    padding: 10px;
    border-top: 1px dashed $campari;
    border-bottom: 1px dashed $campari;
    // border-radius: 4px 4px 0 0;

    h4{
      font-family: $fontfamily;
      font-size: $fontSize_p;
      color:$campari;
      letter-spacing:$letterspacing;
      line-height: 1.5;
      // font-weight: bold;
    }
  }

  .pay_info{
    // outline: 1px solid red;
    width: 85%;
    margin: 0 auto;
    padding: 10px;
    border-bottom:1px dashed $campari;
  
    // border-radius:0 0 4px 4px;

    h5{
      font-family: $fontfamily;
      font-size: $fontSize_p;
      letter-spacing:$letterspacing;
      color: $campari;
      line-height: 1.5;
      // font-weight: bold;
    }

    p{
      font-family: $fontfamily;
      font-size: $fontSize_p;
      color: $campari;
      letter-spacing:3px;
      
    }
   
    .status{
      display: flex;
      justify-content: space-between;
    }

    .pay_method{
      display: flex;
      justify-content: space-between;
    }

    .ship{
      display: flex;
      justify-content: space-between;
    }

    .subtotal{
      display: flex;
      justify-content: space-between;
    }

    .ship_fee{
      display: flex;
      justify-content: space-between;
    }

    .ship_discount{
      display: flex;
      justify-content: space-between;
    }

    .total_price{
      display: flex;
      justify-content: space-between;
    }
  }
}
}
</style>