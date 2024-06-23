<template>
    <section class="right">
        <!-- 商品卡片 -->

        <div class="scroll_container">
            <div class="item_container" v-for="item in items" :key="item.id">
                <div class="product">
                    <div class="item_details">
                        <!-- 照片 -->
                        <div class="pic">
                            <img :src="item.picture" alt="">
                        </div>
                        <!-- 標題&數量按鈕 -->
                        <div class="text">
                            <h4>{{ item.name }}</h4>
                            <div class="text_down">
                                <p>{{ item.details }}</p>
                                <div class="btn ">
                                    <button @click="decrement(item.id)">－</button>
                                    <p>{{ item.count }}</p>
                                    <button @click="increment(item.id)">＋</button>
                                </div>
                            </div>
                        </div>
                        <!-- 金額 -->
                        <div class="price">
                            <p>$ {{ item.price }}</p>
                        </div>
                    </div>
                    <!-- 刪除 -->
                    <div class="delete">
                        <button  @click=" removeItem(item.id)">
                            <img class="img" src="../imgs/icon/icon_delete.svg" alt="">
                        </button>
                    </div>
                </div>
            </div>

        </div>

        

        <!-- 優惠券 -->
        <div class="coupon">
            <div class="title">
                <h3>優惠券</h3>
                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" v-model="selectedCoupon" @change="applyDiscount">
                    <option value="0">選擇優惠券</option>
                    <option value="1">貼心免運券-折抵$250</option>
                    <option value="2">註冊折扣券-折抵$500</option>
                </select>

            </div>
        </div>

        <div class="pay">
            <div class="pay_title">
                <h3>付款方式</h3>
            </div>

            <div class="pay_method">
                <input type="radio" checked>
                <h5>信用卡</h5>
            </div>
        </div>

        <div class="ship">
            <div class="ship_title">
                <h3>物流方式</h3>
            </div>

            <div class="ship_method">
                <input type="radio" checked>
                <h5>宅配</h5>
            </div>
        </div>

        <div class="total">
            <div class="subtotal">
                <h5>小計</h5>
                <h5>${{ subtotal }}</h5>
            </div>

            <div class="ship_fee">
                <h5>運費</h5>
                <h5>$250</h5>
            </div>

            <div class="ship_discount">
                <h5>折抵</h5>
                <h5>-${{ discount }}</h5>
            </div>

            <div class="total_price">
                <h3>總計額</h3>
                <h3 class="twd">TWD ${{ total }}</h3>
            </div>

            <div class="btn_submit">
                <button type="submit" @click="confirmOrder">
                    提交訂單
                </button>
            </div>

            <div class="privacy">
                  <!-- <input type="checkbox"> -->
                  <p>確認付款後，即視為同意<a>條款與規則</a></p>
              </div>

        </div>

    </section>

    
</template>


<script>
import axios from 'axios';
import Swal from 'sweetalert2';
import 'sweetalert2/src/sweetalert2.scss';

export default {
  data() {
    return {
        items: [],
        subtotal: 0,  // 商品總額
        total: 0,  // 折扣後的總金額
        discount: 0,
        shippingFee: 250,  // 優惠券折扣的金額
        selectedCoupon: '0',  // 保存選擇的優惠券ID
    };
  },
  created() {
    this.fetchCartItems();
  },

  methods: {
  fetchCartItems() {
    // axios.get('/public/api/cartproduct.php', {

    axios.get('http://localhost:8087/TID101G2/public/api/cartproduct.php', {
      params: {
        member_id: 'M001'
      }
    })
    .then(response => {
      this.items = response.data;
      this.items.forEach(item => {
        item.price = item.unitPrice * item.count;
      });
      this.calculateTotal();
    })
    .catch(error => {
      console.error('There was an error fetching the cart items!', error);
    });
  },

  calculateTotal() {
    this.subtotal = this.items.reduce((sum, item) => sum + item.price, 0);
    this.total = this.subtotal + this.shippingFee - this.discount;// 更新總金額以反映任何折扣
  },

  applyDiscount() {
    const couponDiscounts = { '1': 250, '2': 500 };
    this.discount = couponDiscounts[this.selectedCoupon] || 0;
    this.total = this.subtotal - this.discount; // 直接從小計減去折扣來更新總計
    this.calculateTotal();  // 重新計算總金額以反映折扣
  },

  increment(itemId) {
    const item = this.items.find(item => item.id === itemId);
    if (item) {
      if (item.count < item.stock) {
        item.count++;
        item.price = item.unitPrice * item.count;
        this.calculateTotal();
      } else {
        Swal.fire({
          icon: 'error',
          title: '錯誤',
          text: '已超過庫存數量!',
        });
      }
    }
  },

  decrement(itemId) {
    const item = this.items.find(item => item.id === itemId);
    if (item && item.count > 1) {
      item.count--;
      item.price = item.unitPrice * item.count;
      this.calculateTotal();
    }
  },

  removeItem(itemId) {
    this.items = this.items.filter(item => item.id !== itemId);
    this.calculateTotal();
  },

  confirmOrder() {
    Swal.fire({
      title: "提交訂單嗎?",
      text: "請確認商品和訂單資訊無誤",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "確定",
      cancelButtonText: "取消"
    }).then((result) => {
      if (result.isConfirmed) {
        this.submitOrder();
      }
    });
  },

  submitOrder() {
    Swal.fire({
      title: '訂單處理中',
      html: '頁面跳轉中...',
      timer: 3000,
      timerProgressBar: true,
      didOpen: () => {
        Swal.showLoading();
      }
    }).then(result => {
      if (result.dismiss === Swal.DismissReason.timer) {
        this.$router.push('/creditcard');
      }
    });
  }
 }
};


</script>


<style lang="scss" scoped>
.right {
    width: 50%;
    padding-top: 50px;
    margin-top: 30px;
    background-color: $whitelady;

    @include breakpoint(820px) {
        width: 100%;
    }

    .scroll_container {
        overflow-y: scroll;
        width: 85%;
        height: 500px;
        margin: 0 auto;

        //商品
        .item_container {
            width: 100%;
            margin-bottom: 60px;
            //   outline: 1px solid #000;
            

            @include breakpoint(430px) {
                margin-bottom: 30px;
            }

            .product {
                // outline: 1px solid yellow;
                width: 95%;
                display: flex;
                align-items: center;


                @include breakpoint(1024px) {
                    width: 100%;
                    margin-left: 0px;
                }

                @include breakpoint(820px){
                    width: 90%;
                }


                .item_details {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    width: 100%;
                    background-color: #fff;
                    border: 1px solid $irishcoffee;
                    border-radius: 8px;
                    padding: 10px 0;
                    // outline: 1px solid red;

                    @include breakpoint(430px) {
                        padding: 5px;
                    }


                    //商品圖片
                    .pic {
                        width: 20%;
                        //   outline: 1px solid purple;


                        @include breakpoint(820px) {
                            width: 25%;
                        }

                        @include breakpoint(430px) {
                            width: 35%;
                        }

                        @include breakpoint(390px) {
                            width: 30%;
                        }

                        @include breakpoint(375px){
                            width: 25%;
                        }


                        img {
                            width: 100%;

                        }
                    }

                    //商品名稱
                    .text {
                        // outline: 1px solid yellowgreen;
                        width: 60%;
                        padding: 10px;

                        @include breakpoint(1280px) {
                            padding: 0;
                        }

                        @include breakpoint(820px) {
                            width: 70%;
                            margin-left: 20px;
                        }

                        @include breakpoint(430px) {
                            width: 95%;
                        }

                       



                        h4 {
                            font-size: $fontSize_h4;
                            font-family: $fontfamily;
                            color: $blackvevet;
                            line-height: 1.5;
                            margin-bottom: 10px;

                            @include breakpoint(1024px) {
                                font-size: 1.1rem;
                            }

                            @include breakpoint(820px) {
                                font-size:1.5rem;
                            }

                            @include breakpoint(430px) {
                                font-size: $fontSize_h5;
                            }

                            @include breakpoint(390px) {
                                font-size: $fontSize_p;
                            }
                        }

                        .text_down {
                            display: flex;
                            justify-content: space-evenly;
                            align-items: center;
                            // outline: 1px solid blue;
                            width: 100%;

                            @include breakpoint(820px){
                                margin-top: 15px;
                            }

                            @include breakpoint(430px){
                                margin-top: 10px;
                            }

                            p {
                                font-size: $fontSize_p;
                                color: #d3d3d3;

                                @include breakpoint(820px){
                                    font-size: $fontSize_h5;
                                }

                                @include breakpoint(430px){
                                    font-size: $fontSize_p;
                                }
                            }

                            // +1-1的按鈕
                            .btn {
                                display: flex;
                                align-items: center;
                                justify-content: space-between;
                                //   outline: 1px solid blue;
                                width: 30%;
                                margin: 0 auto;
                                margin-left: 90px;


                                @include breakpoint(1024px) {
                                    margin-left: 50px;
                                }

                                @include breakpoint(820px) {
                                    margin-left: 100px;
                                }

                                @include breakpoint(430px) {
                                    width: 30%;
                                    margin-left: 30px;
                                }

                                @include breakpoint(390px) {
                                    width: 30%;
                                    margin-left: 20px;
                                }

                                @include breakpoint(375px){
                                    margin-left: 10px;
                                }


                                button {
                                    width: 35px;
                                    height: 30px;
                                    border: none;
                                    border: 1px solid $blackvevet;
                                    background-color: transparent;
                                    font-size: $fontSize_p;
                                    text-align: center;
                                    margin: 0 auto;

                                    @include breakpoint(1280px){
                                        width: 25px;
                                        height: 25px;
                                        padding: 0;
                                    }

                                    @include breakpoint(1024px) {
                                        padding: 0;
                                    }

                                    @include breakpoint(820px) {
                                        width: 20px;
                                        height: 20px;
                                    }

                                    @include breakpoint(430px) {
                                        width: 15px;
                                        height:15px;
                                    }

                                    @include breakpoint(375px) {
                                        // width: 20px;
                                        // height: 20px;
                                    }

                                }

                                p {
                                    width: 33.3%;
                                    flex: none;
                                    //   border: 1px solid red;
                                    text-align: center;
                                    font-size: $fontSize_h4;
                                    color: $blackvevet;

                                    @include breakpoint(430px) {
                                        font-size: $fontSize_h5;
                                    }
                                }
                            }
                        }
                    }

                    .price {
                        width: 20%;
                        //   outline: 1px solid pink;

                        @include breakpoint(1024px) {
                            width: 30%;
                        }

                        @include breakpoint(430px) {
                            width: 35%;
                        }

                        @include breakpoint(390px){
                            width: 30%;
                        }



                        p {
                            color: $blackvevet;
                            font-size: $fontSize_h4;
                            text-align: center;
                            font-weight: bold;

                            @include breakpoint(1024px) {
                                padding: 0;
                                font-size: 1.2rem;
                            }

                            @include breakpoint(820px){
                                font-size: $fontSize_h3;
                            }

                            @include breakpoint(430px) {
                                font-size: $fontSize_h5;
                            }

                            @include breakpoint(390px){
                                font-size: 1rem;
                            }

                            @include breakpoint(375px) {
                                font-size: $fontSize_p;
                            }
                        }
                    }
                }
            }

            //垃圾桶
            .delete {
                // outline: 1px solid orange;
                width: 10%;
                text-align: center;
                margin-left: 40px;

                @include breakpoint(1024px){
                    margin-left: 30px;
                }

                @include breakpoint(820px){
                    margin-left: 40px;
                }

                @include breakpoint(430px) {
                    margin-left: 20px;
                    width: 15%;
                }

                @include breakpoint(390px){
                    width: 10%;
                }


                button {
                    border: none;
                    background-color: transparent;


                    img {
                        width: 90%;

                        @include breakpoint(430px){
                            width: 100%;
                        }

                    }
                }
            }
        }

    }

    //優惠券
    .coupon {
        width: 100%;
        //   outline: 1px solid red;
        padding: 50px 0;

        @include breakpoint(430px) {
            padding: 30px 0;
        }

        .title {
            padding: 20px 80px;
            margin-bottom: 10px;


            @include breakpoint(1280px) {
                padding: 10px 50px;
            }

            @include breakpoint(430px) {
                padding: 10px 30px;
            }

            h3 {
                font-size: $fontSize_h3;
                font-family: $fontfamily;
                letter-spacing: $letterspacing;
                font-weight: bold;
                margin-bottom: 15px;

                @include breakpoint(430px) {
                    font-size: 1.5rem;
                }
            }


            .btn{
                background-color:$irishcoffee;
                font-family:$fontfamily;
                color: $campari;
                font-size: 1.5rem;
                font-weight: bold;
                // letter-spacing: $letterspacing;
                text-align: center;
            }
        }

    }


    .pay {
        // outline: 1px solid orange;
        width: 100%;
        padding: 50px 0;

        @include breakpoint(430px) {
            padding: 30px 0;
        }

        .pay_title {
            border-bottom: 4px solid $blackvevet;
            width: 100%;
            padding: 20px 80px;

            @include breakpoint(1280px) {
                padding: 10px 50px;
            }

            @include breakpoint(430px) {
                padding: 10px 30px;
            }

            //付款方式
            h3 {
                font-size: $fontSize_h3;
                font-family: $fontfamily;
                font-weight: bold;
                letter-spacing: $letterspacing;

                @include breakpoint(430px) {
                    font-size: 1.5rem;
                }
            }

        }

        .pay_method {
            display: flex;
            align-items: center;
            padding: 20px 80px;

            @include breakpoint(1280px) {
                padding: 20px 60px;
            }

            @include breakpoint(430px) {
                padding: 10px 30px;
            }

            input {
                // outline:1px solid red;
                width: 20px;
                height: 20px;
                margin-right: 20px;

                @include breakpoint(430px) {
                    margin-right: 10px;
                }
            }


            //信用卡
            h5 {
                font-family: $fontfamily;
                font-size: 1.5rem;
                letter-spacing: $letterspacing;

                @include breakpoint(430px) {
                    font-size: 1.5rem;
                }

            }
        }
    }

    //運送方式
    .ship {
        // outline: 1px solid orange;
        width: 100%;
        padding: 50px 0;

        @include breakpoint(430px) {
            padding: 30px 0;
        }

        //物流方式
        .ship_title {
            border-bottom: 4px solid $blackvevet;
            width: 100%;
            padding: 20px 80px;

            @include breakpoint(1280px) {
                padding: 10px 50px;
            }

            @include breakpoint(430px) {
                padding: 10px 30px;
            }

            h3 {
                font-size: $fontSize_h3;
                font-family: $fontfamily;
                font-weight: bold;
                letter-spacing: $letterspacing;

                @include breakpoint(430px) {
                    font-size: 1.5rem;
                }
            }

        }

        .ship_method {
            display: flex;
            align-items: center;
            padding: 20px 80px;

            @include breakpoint(1280px) {
                padding: 20px 60px;
            }

            @include breakpoint(430px) {
                padding: 10px 30px;
            }


            input {
                // outline:1px solid red;
                width: 20px;
                height: 20px;
                margin-right: 20px;

                @include breakpoint(430px) {
                    margin-right: 10px;
                }
            }

            //宅配
            h5 {
                font-family: $fontfamily;
                font-size: 1.5rem;
                letter-spacing: $letterspacing;


            }
        }
    }

    //總計
    .total {
        // outline:1px solid red;
        padding: 50px 0;

        @include breakpoint(430px) {
            padding: 30px 0;
        }

        h5 {
            padding: 20px 80px;
            font-size: 1.5rem;
            font-weight: bold;
            font-family: $fontfamily;
            color: $blackvevet;

            @include breakpoint(1280px) {
                padding: 10px 50px;
            }

            @include breakpoint(430px) {
                padding: 10px 30px;
            }

            @include breakpoint(390px) {
                font-size: 1.3rem;
            }
        }

        h3 {
            font-family: $fontfamily;
            font-size: $fontSize_h3;
            font-weight: bold;
            padding: 20px 80px;

            @include breakpoint(1280px) {
                padding: 10px 50px;
            }

            @include breakpoint(430px) {
                padding: 10px 30px;
                font-size: 1.9rem;

            }

            @include breakpoint(414px){
                font-size: 1.8rem;
            }

            @include breakpoint(390px) {
                font-size: 1.7rem;
            }

            @include breakpoint(375px) {
                font-size: 1.6rem;
            }
        }

        .subtotal {
            display: flex;
            justify-content: space-between;
            align-items: center;

        }

        .ship_fee {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .ship_discount {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total_price {
            display: flex;
            justify-content: space-between;
            align-items: center;

            .twd {
                color: $irishcoffee;
            }

        }

        .btn_submit {
            border: none;
            background-color: transparent;
            width: 100%;
            text-align: right;
            padding: 30px 80px;

            @include breakpoint(1280px) {
                padding: 50px 50px;
            }

            @include breakpoint(430px) {
                padding: 30px 30px;
            }

            button {
                width: 40%;
                background-color: $campari;
                color: $whitelady;
                font-size: $fontSize_h3;
                letter-spacing: $letterspacing;
                font-family: $fontfamily;
                border-radius: 4px;
                padding: 10px;


                @include breakpoint(1024px) {
                    width: 50%;
                }

                @include breakpoint(820px) {
                    width: 40%;
                }

                @include breakpoint(430px) {
                    width: 55%;
                    font-size: 1.5rem;
                }

                &:hover {
                    cursor: pointer;
                    color: $blackvevet;
                    background-color: $ramos-gin-fizz;
                    transition: all ease-in-out .3s;
                    border: none;
                }
            }
        }

        .privacy {
              text-align: center;
              margin-left: 150px;
              padding: 10px;
           

              @include breakpoint(1024px) {
                  margin-left: 130px;
                       
             }

             @include breakpoint(768px){
                  margin-left: 200px;
             } 

              @include breakpoint(430px){
                    margin-left: 50px;
                    padding: 0;
                    width: 100%;
                    align-items: start;
              }

              @include breakpoint(375px){
                    width: 90%;
              }


              p {
                  font-size: $fontSize_h4;
                  letter-spacing: $letterspacing;

                  @include breakpoint( 1024px) {
                    font-size: $fontSize_h5;             
                  }

                  @include breakpoint(820px) {
                      margin-left: 20px;
                      font-size: $fontSize_h4;
                   }

                   @include breakpoint(430px){
                        font-size: $fontSize_p;
                        padding: 0;
                        margin: 0 0 10px 5px;
                   }

                   @include breakpoint(375px){
                        margin-left: 15px;
                        letter-spacing: 2px;
                   }

              }

          }

    }

}
</style>