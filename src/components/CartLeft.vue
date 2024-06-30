<template>
    <section class="left">
          <!-- 訂單資訊 -->
          <div class="order">

              <div class="order-title">
                  <h2>訂單資訊</h2>
              </div>
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
          </div>



          <!-- 收件人資訊 -->
          <div class="ship_name">

              <div class="order-title2">
                  <h2>收件人資訊：</h2>
                  <div class="same">
                    <input type="checkbox" id="syncCheckbox" v-model="isSyncActive" @change="copyOrderInfo">
                    <label for="syncCheckbox">同訂購人資訊</label>
                  </div>
              </div>
              <!-- 姓名和電話 -->
              <div class="first">
                  <div class="name">
                      <p>姓名 *</p>
                      <input type="text" id="ship_name" v-model="shipName" @blur="validateName" required>
                  </div>

                  <div class="phone">
                      <p>連絡電話 *</p>
                      <input type="text" id="ship_phone" v-model="shipPhone" @blur="validatePhone" required>
                  </div>
              </div>

              <div class="email">
                  <p>電子郵件 *</p>
                  <input type="text" id="ship_email" v-model="shipEmail" @blur="validateEmail" required>
              </div>

              <div class="address_info">
                  <p>收件地址 *</p>
                  <input type="text" id="ship_address" v-model="shipAddress" @blur="validateAddress" required>
              </div>

              <div class="order_note">
                <p>訂單備註</p>
                <textarea name="" id="note" cols="30" rows="15" v-model="note" placeholder="若有其他備註事項，請在此填寫，謝謝您！"></textarea>
              </div>
              

          </div>

      </section>

</template>



<script>
import axios from 'axios';
import { useUserStore } from '../stores/user';   //引入抓登入的會員編號的js

export default {
    data() {
        return {
            orderName: '',
            orderPhone: '',
            orderEmail: '',
            orderAddress: '',
            shipName: '',     
            shipPhone: '',
            shipEmail: '',
            shipAddress: '',
            note: '',
            isSyncActive: false,
            member_id:null,
            
        };

    },

    watch: {
      shipName(newVal) {
        this.$emit('updateData', { shipName: newVal });
      },
      shipPhone(newVal) {
        this.$emit('updateData', { shipPhone: newVal });
      },
      shipEmail(newVal) {
        this.$emit('updateData', { shipEmail: newVal });
      },
      shipAddress(newVal) {
        this.$emit('updateData', { shipAddress: newVal });
      },
      note(newVal) {
        this.$emit('updateData', { note: newVal });
      },
  },

    async mounted() {
        await this.checkLogin();
        await this.fetchMemberData();
    },
    methods: {
        async checkLogin() {
            const userStore = useUserStore();
            if(userStore.checkLoginStatus()){
                this.member_id = userStore.isLoggedIn;
                console.log('logged in member_id: ',this.member_id);
            }else{
                console.log('not logged in');
            }
        },

        fetchMemberData() {

            this.checkLogin().then(() =>{
                if(this.member_id){
                    axios.get(`${import.meta.env.VITE_PHP_PATH}CartReceiver.php`, {

                    // axios.get('http://localhost:8087/TID101G2/public/api/cartreceiver.php', {
                        params: {
                            id: this.member_id
                        }
                    })
                    
                    .then((response) => {
                        if(response.data && response.data.length > 0) {
                            const memberData = response.data[0];
                            this.orderName = memberData.full_name;
                            this.orderPhone = memberData.phone;
                            this.orderEmail = memberData.email;
                            this.orderAddress = memberData.address;
                            
                        } else{
                            console.log('No member data found');
                        }
                    })
                    .catch((error) => {
                        console.error('Error fetching member info:', error);
                    });
                        
                }else {
                    console.log('No member_id found');
                }
            });

        },
        copyOrderInfo() {
            if (this.isSyncActive) {
                // 同步資料
                this.shipName = this.orderName;
                this.shipPhone = this.orderPhone;
                this.shipEmail = this.orderEmail;
                this.shipAddress = this.orderAddress;
            } else {
                // 重置收件人資訊
                this.shipName = '';
                this.shipPhone = '';
                this.shipEmail = '';
                this.shipAddress = '';
            }
        },

        validateName() {
            if (!/^[a-zA-Z\s\-\u4e00-\u9fff]+$/.test(this.shipName)) {
                alert('姓名不能含有數字及特殊符號！');
            } 
        },
        validatePhone() {
            if (!/^\d+$/.test(this.shipPhone)) {
                alert('電話必須為數字！');
            }
        },
        validateEmail() {
            if (this.shipEmail && !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.shipEmail)) {
                alert('電子郵件格式不正確！');
            }
        },

        validateFields() {
        if (!this.orderName || !this.orderPhone || !this.orderEmail || !this.orderAddress ||
            !this.shipName || !this.shipPhone || !this.shipEmail || !this.shipAddress) {
            return false;  // 如果任何一個欄位是空的，返回false
            }
        return true;  // 所有欄位都被正確填寫
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
                      margin-right: 10px;

                      @include breakpoint( 430px){
                        width: 15px;
                        height: 15px;
                      }
                  }

                  label{
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









