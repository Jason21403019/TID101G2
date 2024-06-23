<template>
    <section class="left">
          <!-- 訂單資訊 -->
          <div class="order">

              <div class="order-title">
                  <h2>訂單資訊</h2>
              </div>
            <!-- <div v-if="orderName && orderPhone && orderEmail && orderAddress"> -->
              <!-- 姓名和電話 -->
              <div class="first">
                  <div class="name">
                      <p>姓名 *</p>
                      <input type="text" id="name" v-model="orderName" required>
                  </div>

                  <div class="phone">
                      <p>連絡電話 *</p>
                      <input type="text" id="phone"  v-model="orderPhone" required>
                  </div>
              </div>

              <div class="email">
                  <p>電子郵件 *</p>
                  <input type="text" id="email" v-model="orderEmail" required>
              </div>

              <div class="address_info">
                  <p>地址 *</p>
                  <input type="text" id="address" v-model="orderAddress" required> 
              </div>
            <!-- </div> -->
          </div>



          <!-- 收件人資訊 -->
          <div class="ship_name">

              <div class="order-title2">
                  <h2>收件人資訊：</h2>
                  <div class="same">
                      <input type="radio" @click="copyOrderInfo">
                      <p>同訂購人資訊</p>
                  </div>
              </div>
              <!-- 姓名和電話 -->
              <div class="first">
                  <div class="name">
                      <p>姓名 *</p>
                      <input type="text" id="ship_name" v-model="shipName" required>
                  </div>

                  <div class="phone">
                      <p>連絡電話 *</p>
                      <input type="text" id="ship_phone" v-model="shipPhone" required>
                  </div>
              </div>

              <div class="email">
                  <p>電子郵件 *</p>
                  <input type="text" id="ship_email" v-model="shipEmail" required>
              </div>

              <div class="address_info">
                  <p>收件地址 *</p>
                  <input type="text" id="ship_address" v-model="shipAddress" required>
              </div>

              <div class="order_note">
                <p>訂單備註</p>
                <textarea name="" id="" cols="30" rows="15" placeholder="若有其他備註事項，請在此填寫，謝謝您！"></textarea>
              </div>
              

          </div>

      </section>

</template>



<script>
import axios from 'axios';

export default {
    data() {
        return {
            orderName: '',
            orderPhone: '',
            orderEmail: '',
            orderAddress: '',
            // shipName: '',     
            // shipPhone: '',
            // shipEmail: '',
            // shipAddress: ''
        };
    },
    mounted() {
        this.fetchMemberData();
    },
    methods: {
        async fetchMemberData() {
            try {
                const response = await axios.get('http://localhost:8087/TID101G2/public/api/cartreceiver.php', {
                    params: {
                        member_id: 'M001'  // 替換為特定會員ID或通過某種方式動態獲取
                    }
                });
                this.orderName = response.data.full_name;
                this.orderPhone = response.data.phone;
                this.orderEmail = response.data.email;
                this.orderAddress = response.data.address;
            } catch (error) {
                console.error('Error fetching member info:', error);
            }
        }
    }
};
</script>






<style lang="scss" scoped>
.left {
      width: 50%;
      padding-top: 50px;
      margin-top: 30px;
      background-color: $campari;

      @include breakpoint( 820px) {
           width: 100%;       
      }

      @include breakpoint( 430px){
            margin-top: 0;
      }

      border: 1px solid #fff;

      //訂單資訊

      .order{
        // outline:5px solid blue;
        margin-bottom: 150px;

        @include breakpoint( 430px){
            margin-bottom: 50px;
        }
      }
            .order-title {
                width: 100%;
                // outline: 1px solid #000;
                background-color: $ramos-gin-fizz;

                h2 {
                    font-size: $fontSize_h3;
                    font-family: $fontfamily;
                    letter-spacing: $letterspacing;
                    color: $campari;
                    font-weight: bold;
                    padding: 20px;
                    margin-left: 10px;

                    @include breakpoint( 430px){
                        padding: 10px;
                    }

                }
            }

            input {
                border-radius: 4px;
                padding: 15px;
                width: 100%;
                // outline:1px solid red;

                @include breakpoint( 430px){
                    padding: 5px;
                }
            }

            p {
                font-family: $fontfamily;
                font-size: $fontSize_h4;
                margin: 10px 0 10px 10px;
                color: $whitelady;

            }

            //姓名和電話
            .first {
                width: 100%;
                // outline: 1px solid #000;
                display: flex;
                justify-content: center;
                padding: 20px;

                @include breakpoint( 430px){
                    padding: 10px;
                }

                .name {
                    width: 100%;
                    // outline: 1px solid green;
                    margin-right: 20px;

                }

                .phone {
                    width: 100%;
                }
            }

            .email {
                width: 100%;
                padding: 20px;

                @include breakpoint( 430px){
                    padding: 10px;
                }
            }

            .address_info {
                width: 100%;
                padding: 20px;

                @include breakpoint( 430px){
                    padding: 10px;
                }

               
            }



      //訂購人資訊
      .ship_name {
          width: 100%;

          .order_note {
                width: 100%;
                padding: 30px;


                @include breakpoint( 430px){
                    padding: 0;
                    width: 90%;
                    margin: 0 auto;
                }

                textarea {
                    width: 100%;
                    padding: 20px;
                    border-radius: 4px;

                    
                }

            }

          .order-title2 {
              display: flex;
              align-items: center;
              background-color: $ramos-gin-fizz;

            //   outline: 1px solid red;

              h2 {
                  font-size: $fontSize_h3;
                  font-family: $fontfamily;
                  letter-spacing: $letterspacing;
                  color: $campari;
                  font-weight: bold;
                  padding: 20px;
                  margin-left: 10px;

                  @include breakpoint( 1024px) {
                      margin-left: 5px;             
                  }

                  @include breakpoint( 820px) {
                      margin-left: 20px;
                  }

                  @include breakpoint( 430px){
                      font-size:1.5rem;
                      padding: 0;
                      margin-left: 35px;
                  }

                  @include breakpoint(390px){
                      margin-left: 15px;
                      font-size: 1.5rem;
                  }

                  @include breakpoint(375px){
                      margin-left: 15px;
                  }
              }

              .same{
                  display: flex;
                  align-items: center;
                  justify-content: center;

                  input {
                      width: 20px;
                      height: 20px;

                      @include breakpoint( 430px){
                        width: 15px;
                        height: 15px;
                      }
                  }

                  p {
                      font-family: $fontfamily;
                      font-size: $fontSize_h3;
                      color: $campari;
                      font-weight: bold;

                      @include breakpoint( 430px){
                        font-size:1.5rem;
                      }
                  }
              }
          }

      }
  }

    
</style>