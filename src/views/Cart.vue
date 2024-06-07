<template>
  <div class="wrapper">
      <!-- 左邊區塊 -->
      <!-- 訂單資訊 -->
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
                      <input type="text" id="name" required>
                  </div>

                  <div class="phone">
                      <p>連絡電話 *</p>
                      <input type="text" id="phone" required>
                  </div>
              </div>

              <div class="email">
                  <p>電子郵件 *</p>
                  <input type="text" id="email" required>
              </div>

              <div class="address_info">
                  <p>收件地址 *</p>
                  <div class="sec">
                      <div class="ship_address">
                          <p>縣 / 市</p>
                          <select  v-model="selectedCounty" @change="fetchDistricts">
                              <option value="">選擇縣市</option>
                              <option v-for="county in counties" :key="county" :value="county">{{ county }}</option> 
                          </select>
                      </div>

                      <div class="district">
                          <p>地區</p>
                          <select v-model="selectedDistrict">
                              <option value="">選擇地區</option>
                              <option v-for="district in districts[selectedCounty]" :key="district" :value="district">{{ district }}</option>
                          </select>
                      </div>
                  </div>
                  <div class="address">
                      <p>地址 *</p>
                      <input type="text" id="address" required>
                  </div>
              </div>

              <div class="order_note">

                  <p>訂單備註</p>
                  <textarea name="" id="" cols="30" rows="10" placeholder="若有其他備註事項，請在此填寫，謝謝您！"></textarea>
              </div>


          </div>



          <!-- 收件人資訊 -->
          <div class="ship_name">

              <div class="order-title2">
                  <h2>收件人資訊：</h2>
                  <div class="checkbox">
                      <input type="checkbox">
                      <p>同訂購人資訊</p>
                  </div>
              </div>
              <!-- 姓名和電話 -->
              <div class="first">
                  <div class="name">
                      <p>姓名 *</p>
                      <input type="text" id="name" required>
                  </div>

                  <div class="phone">
                      <p>連絡電話 *</p>
                      <input type="text" id="phone" required>
                  </div>
              </div>

              <div class="email">
                  <p>電子郵件 *</p>
                  <input type="text" id="email" required>
              </div>

              <div class="address_info">
                  <p>收件地址 *</p>
                  <div class="sec">
                      <div class="ship_address">
                          <p>縣 / 市</p>
                          <select v-model="selectedCounty" @change="fetchDistricts">
                              <option value="">選擇縣市</option>
                              <option v-for="county in counties" :key="county" :value="county">{{ county }}</option>
                          </select>
                      </div>

                      <div class="district">
                          <p>地區</p>
                          <select v-model="selectedDistrict">
                              <option value="">選擇地區</option>
                              <option v-for="district in districts[selectedCounty]" :key="district" :value="district">{{ district }}</option>
                          </select>
                      </div>
                  </div>
                  <div class="address">
                      <p>地址 *</p>
                      <input type="text" id="address" required>
                  </div>
              </div>
              <div class="privacy">
                  <input type="checkbox">
                  <p>我已閱讀並同意<a href="">隱私權政策</a>及<a href="">服務條款</a>。</p>
              </div>

          </div>

      </section>

      <!-- 右半邊 -->
      <section class="right">
          <!-- 商品卡片 -->
          <div class="item_container">
              <div class="product">
                  <div class="item_details">
                      <!-- 照片 -->
                      <div class="pic">
                          <img src="../imgs/productsImg/sparkling wine/PIERRE ZERO.png" alt="">
                      </div>
                      <!-- 標題&數量按鈕 -->
                      <div class="text">
                          <h4>PIERRE ZERO <br />夏朵內無酒精氣泡白酒 12瓶</h4>
                          <div class="text_down">
                              <p>200mL/瓶</p>
                              <div class="btn">
                                  <button>-</button>
                                  <p>1</p>
                                  <button>+</button>
                              </div>
                          </div>
                      </div>
                      <!-- 金額 -->
                      <div class="price">
                          <p>$ 4,560</p>
                      </div>
                  </div>
                  <!-- 刪除 -->
                  <div class="delete">
                      <button>
                          <img class="img" src="../imgs/icon/icon_delete.svg" alt="">
                      </button>
                  </div>
              </div>
          </div>

          <div class="item_container">
              <div class="product">
                  <div class="item_details">
                      <!-- 照片 -->
                      <div class="pic">
                          <img src="../imgs/productsImg/sparkling wine/Noughty.jpg" alt="">
                      </div>
                      <!-- 標題&數量按鈕 -->
                      <div class="text">
                          <h4>PIERRE ZERO 夏凡酒莊 <br />義大利無酒精雞尾酒風味飲 12瓶</h4>
                          <div class="text_down">
                              <p>750mL/瓶</p>
                              <div class="btn">
                                  <button>-</button>
                                  <p>1</p>
                                  <button>+</button>
                              </div>
                          </div>
                      </div>
                      <!-- 金額 -->
                      <div class="price">
                          <p>$ 11,760</p>
                      </div>
                  </div>
                  <!-- 刪除 -->
                  <div class="delete">
                      <button>
                          <img class="img" src="../imgs/icon/icon_delete.svg" alt="">
                      </button>
                  </div>
              </div>
          </div>

          <div class="item_container">
              <div class="product">
                  <div class="item_details">
                      <!-- 照片 -->
                      <div class="pic">
                          <img src="../imgs/productsImg/sparkling wine/Oddbird WHITE.png" alt="">
                      </div>
                      <!-- 標題&數量按鈕 -->
                      <div class="text">
                          <h4>Oddbird 非鳥<br/>解放白中白 無酒精氣泡酒 12瓶</h4>
                          <div class="text_down">
                              <p>750mL/瓶</p>
                              <div class="btn">
                                  <button>-</button>
                                  <p>1</p>
                                  <button>+</button>
                              </div>
                          </div>
                      </div>
                      <!-- 金額 -->
                      <div class="price">
                          <p>$ 14,460</p>
                      </div>
                  </div>
                  <!-- 刪除 -->
                  <div class="delete">
                      <button>
                          <img class="img" src="../imgs/icon/icon_delete.svg" alt="">
                      </button>
                  </div>
              </div>
          </div>

          <!-- 優惠券 -->
          <div class="coupon">
              <div class="title">
                  <h3>優惠券</h3>
                  <a href="">選擇優惠券</a>
              </div>

              <div class="coupon_status">
                  <div class="status">
                          <h4>已選取</h4>
                      <div class="like_btn">
                          <h5>貼心免運券</h5>
                      </div>
                  </div>
                  <a href="">變更</a>    
              </div>
          </div>

          <div class="pay">
              <div class="pay_title">
                  <h3>付款方式</h3>
              </div>

              <div class="pay_method">
                  <input type="radio">
                  <h5>信用卡</h5>
              </div>
          </div>

          <div class="ship">
              <div class="ship_title">
                  <h3>物流方式</h3>
              </div>

              <div class="ship_method">
                  <input type="radio">
                  <h5>宅配</h5>
              </div>
          </div>

          <div class="total">
              <div class="subtotal">
                  <h5>小計</h5>
                  <h5>$45,000</h5>
              </div>

              <div class="ship_fee">
                  <h5>運費</h5>
                  <h5>$250</h5>
              </div>

              <div class="ship_discount">
                  <h5>運費折抵</h5>
                  <h5>-$250</h5>
              </div>

              <div class="total_price">
                  <h3>總計額</h3>
                  <h3 class="twd">TWD $45,000</h3>
              </div>

              <div class="btn_submit">
                  <button type="submit">
                      提交訂單
                  </button>
              </div>

          </div>

      </section>
  </div>
</template>


<script>
export default {
  data() {
      return {
          counties: ["基隆市", "台北市", "新北市", "桃園市", "新竹市", "新竹縣", "苗栗縣", "台中市", "彰化縣", "南投縣", "雲林縣", "嘉義市", "嘉義縣", "台南市", "高雄市", "屏東縣", "台東縣", "花蓮縣", "宜蘭縣", "澎湖縣", "金門縣", "連江縣"],
          districts: {
              "基隆市": ["仁愛區", "信義區", "中正區", "中山區", "安樂區", "暖暖區", "七堵區"],
              "台北市": ["中正區", "大同區", "中山區", "松山區", "大安區", "萬華區", "信義區", "士林區", "北投區", "內湖區", "南港區", "文山區"],
              "桃園市":["桃園區", "中壢區", "八德區", "平鎮區", "大溪區", "楊梅區", "龜山區", "蘆竹區", "大園區", "觀音區", "新屋區", "龍潭區", "復興區"],
              "新北市":["板橋區","三重區","中和區","永和區","新莊區","新店區","土城區","蘆洲區","樹林區","汐止區","鶯歌區","三峽區","淡水區","瑞芳區","五股區","泰山區","林口區","深坑區","石碇區","坪林區","三芝區","石門區","八里區","平溪區","雙溪區","貢寮區","金山區","萬里區","烏來區"],
              "台中市":["中區","東區","西區","南區","北區","西屯區","南屯區","北屯區","豐原區","大里區","太平區","清水區","沙鹿區","大甲區","東勢區","梧棲區","烏日區","神岡區","大肚區","大雅區","后里區","霧峰區","潭子區","龍井區","外埔區","和平區","石岡區","大安區","新社區"],
              "台南市":["中西區","東區","南區","北區","安平區","安南區","永康區","歸仁區","新化區","左鎮區","玉井區","楠西區","南化區","仁德區","關廟區","龍崎區","官田區","麻豆區","佳里區","西港區","七股區","將軍區","學甲區","北門區","新營區","後壁區","白河區","東山區","六甲區","下營區","柳營區","鹽水區","善化區","大內區","山上區","新市區","安定區"],
              "高雄市":["楠梓區","左營區","鼓山區","三民區","鹽埕區","前金區","新興區","苓雅區","前鎮區","旗津區","小港區","鳳山區","林園區","大寮區","大樹區","大社區","仁武區","鳥松區","岡山區","橋頭區","燕巢區","田寮區","阿蓮區","路竹區","湖內區","茄萣區","永安區","彌陀區","梓官區","旗山區","美濃區","六龜區","甲仙區","杉林區","內門區","茂林區","桃源區","那瑪夏區"]
              // 其他縣市的地區列表
          },
          selectedCounty: "",
          selectedDistrict: ""
      };
  },
  methods: {
      fetchDistricts() {
          // 根據所選縣市加載對應的地區
          if (this.selectedCounty) {
              this.selectedDistrict = this.districts[this.selectedCounty][0];
          } else {
              this.selectedDistrict = "";
          }
      }
  }
};
</script>



<style lang="scss" scoped>
.wrapper {
  width: 100%;
  background-color: $campari;
  // outline: 1px solid red;
  display: flex;
  padding-top: 150px;

  //左半邊
  .left {
      width: 50%;
      padding-top: 50px;
      margin-top: 30px;
      // border-right: 3px solid $whitelady;

      border: 1px solid #fff;
      //訂單資訊
      .order-title {
          width: 100%;
          // outline: 1px solid #000;
          background-color: $ramos-gin-fizz;

          h2 {
              font-size: $fontSize_h2;
              font-family: $fontfamily;
              letter-spacing: $letterspacing;
              color: $campari;
              font-weight: bold;
              padding: 20px;
              margin-left: 10px;
          }
      }

      input {
          border-radius: 4px;
          padding: 15px;
          width: 100%;
      }

      p {
          font-family: $fontfamily;
          font-size: $fontSize_h3;
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
      }

      .address_info {
          width: 100%;
          padding: 20px;

          //收件地址
          .sec {
              display: flex;
              justify-content: center;
              align-items: center;
              width: 100%;
              // outline: 1px solid #fff;
              padding: 10px;

              //縣市option
              select {
                  width: 100%;
                  padding: 20px;
                  border-radius: 4px;


                  appearance: none;
                  -webkit-appearance: none;
                  -moz-appearance: none;
                  background: url('../imgs/icon/icon_option.svg') no-repeat right 10px center;
                  background-size: 20px 20px;
                  color: $campari;
                  background-color:$whitelady;
              }

              // 縣/市
              .ship_address {
                  width: 50%;

                  // outline: 1px solid blue;
                  select {
                      width: 99%;
                  }
              }

              // 地區
              .district {
                  width: 50%;

                  // border: 1px solid blue;
                  select {
                      width: 99%;
                      margin-left: 5px;
                  }
              }
          }
      }

      .address {
          padding: 10px;
          width: 100%;
      }

      .order_note {
          width: 100%;
          padding: 30px;

          textarea {
              width: 100%;
              padding: 20px;
              border-radius: 4px;
          }

      }


      //訂購人資訊
      .ship_name {
          width: 100%;

          .order-title2 {
              display: flex;
              align-items: center;
              background-color: $ramos-gin-fizz;

              h2 {
                  font-size: $fontSize_h2;
                  font-family: $fontfamily;
                  letter-spacing: $letterspacing;
                  color: $campari;
                  font-weight: bold;
                  padding: 20px;
                  margin-left: 10px;
              }

              .checkbox {
                  display: flex;
                  align-items: center;
                  justify-content: center;

                  input {
                      width: 20px;
                      height: 20px;
                      border-radius: 50%;
                  }

                  p {
                      font-family: $fontfamily;
                      font-size: $fontSize_h3;
                      color: $campari;
                      font-weight: bold;
                  }
              }
          }

          .privacy {
              display: flex;
              align-items: center;
              margin-left: 30px;
              padding: 10px;

              input {
                  width: 20px;
                  height: 20px;
              }

              p {
                  font-size: $fontSize_h4;
                  letter-spacing: $letterspacing;
              }
          }

      }
  }

  //右半邊
  .right {
      width: 50%;
      padding-top: 50px;
      margin-top: 30px;
      background-color: $whitelady;

      //商品
      .item_container{
          width: 100%;
          margin-bottom: 60px;
          // outline: 1px solid #000;

          .product {
              // outline: 1px solid yellow;
              width: 80%;

              display: flex;
              align-items: center;

              margin-left: 70px;

              .item_details{
                  display: flex;
                  align-items: center;
                  justify-content: space-between;
                  // border: 1px solid yellow;
                  width: 100%;
                  background-color: #fff;
                  border: 1px solid $irishcoffee;
                  border-radius: 8px;
                  padding: 10px;

                  //商品圖片
                  .pic {

                      width: 20%;
                      text-align: center;
                      // outline: 1px solid purple;

                      img {
                          width: 100%;
                      }
                  }

                  //商品名稱
                  .text {
                      // outline: 1px solid blue;
                      width: 60%;
                      padding: 10px;

                      h4 {
                          font-size: $fontSize_h4;
                          font-family: $fontfamily;
                          // letter-spacing: $letterspacing;
                          color: $blackvevet;
                          line-height: 1.5;
                          margin-bottom: 10px;
                      }

                      .text_down {
                          display: flex;
                          justify-content: space-evenly;
                          align-items: center;
                          // padding: 10px;

                          p {
                              font-size: $fontSize_p;
                              color: #d3d3d3;
                          }

                          .btn {
                              display: flex;
                              align-items: center;
                              // outline: 1px solid red;
                              width: 20%;
                              margin: 0 auto;
                              margin-left: 110px;

                              button {
                                  width: 100%;
                                  border: none;
                                  border: 1px solid $blackvevet;
                                  margin-right: 10px;
                                  background-color: transparent;
                                  font-size: $fontSize_p;


                              }

                              p {
                                  font-size: $fontSize_h4;
                                  color: $blackvevet;
                                  letter-spacing: $letterspacing
                              }
                          }
                      }

                  }

                  .price {
                      width: 20%;

                      p {
                          color:$blackvevet;
                          font-size: 1.35rem;
                          text-align: center;
                          font-weight: bold;
                          padding: 10px;
                      }
                  }
              }
          }

          //垃圾桶
          .delete {
              // outline: 1px solid orange;
              width: 10%;
              text-align: center;
              margin-left: 30px;

              button {
                  border: none;
                  background-color: transparent;

                  img {
                      width: 90%;

                  }
              }
          }
      }

      //優惠券
      .coupon{
          width: 100%;
          // outline: 1px solid red;
          padding: 50px 0;
        
          .title{
              display: flex;
              justify-content: space-between;
              align-items: center;
              border-bottom: 4px solid $blackvevet;
              padding: 20px 100px;
              margin-bottom: 10px;

              h3{
                  font-size: $fontSize_h3;
                  font-family:$fontfamily;
                  letter-spacing:$letterspacing;
                  font-weight: bold;
              }

              a{
                  font-size: 1.5rem;
                  color:$irishcoffee;
                  font-weight: bold;

              }
          }

          .coupon_status{
              display: flex;
              justify-content: space-between;
              align-items: center;
              padding: 20px 20px;
              .status{
                  display: flex;
                  // outline: 1px solid orange;
                  h4{
                      font-size:1.5rem;
                      font-family:$fontfamily;
                      padding: 10px 0 10px 80px;
                  }

                  .like_btn{
                      border:1px solid $blackvevet;
                      background-color:$ramos-gin-fizz;
                      // line-height: 1.5;
                      padding: 15px;
                      margin-left: 20px;
                      border-radius: 4px;

                      h5{
                          font-size:$fontSize_h4;
                          font-weight: bold;
                          color:$campari;
                          letter-spacing:$letterspacing;
                          font-family:$fontfamily;
                      }
                  }
              }

              a{
              font-size: 1.5rem;
              color:$irishcoffee;
              font-weight: bold;
              margin-right: 80px;
             }
          }
      }

      //付款方式
      .pay{
          // outline: 1px solid orange;
          width: 100%;
          padding: 50px 0;

          .pay_title{
              border-bottom:4px solid $blackvevet;
              width: 100%;
              padding: 20px 100px; 
              
              h3{
                  font-size: $fontSize_h3;
                  font-family:$fontfamily;
                  font-weight: bold;
                  letter-spacing: $letterspacing;
              }

          }

          .pay_method{
              display: flex;
              align-items: center;
              padding: 20px 100px;

              input{
                  // outline:1px solid red;
                  width: 30px;
                  height: 30px;
                  margin-right: 20px;
              }

              h5{

                  font-family:$fontfamily;
                  font-size:1.5rem;
                  letter-spacing:$letterspacing;


              }
          }
      }

      //運送方式
      .ship{
          // outline: 1px solid orange;
          width: 100%;
          padding: 50px 0;

          .ship_title{
              border-bottom:4px solid $blackvevet;
              width: 100%;
              padding: 20px 100px; 
              
              h3{
                  font-size: $fontSize_h3;
                  font-family:$fontfamily;
                  font-weight: bold;
                  letter-spacing: $letterspacing;
              }

          }

          .ship_method{
              display: flex;
              align-items: center;
              padding: 20px 100px;

              input{
                  // outline:1px solid red;
                  width: 30px;
                  height: 30px;
                  margin-right: 20px;
              }

              h5{
                  font-family:$fontfamily;
                  font-size:1.5rem;
                  letter-spacing:$letterspacing;
              }
          }
      }

      //總計
      .total{
          // outline:1px solid red;
          padding: 50px 0;

          h5{
              padding: 20px 100px;
              font-size: 1.5rem;
              font-weight: bold;
              font-family:$fontfamily;
              color:$blackvevet;
          }

          h3{
              font-family:$fontfamily;
              font-size:$fontSize_h3;
              font-weight: bold;
              padding: 20px 100px;
          }

          .subtotal{
              display: flex;
              justify-content: space-between;
              align-items: center;
             
          }

          .ship_fee{
              display: flex;
              justify-content: space-between;
              align-items: center;
          }

          .ship_discount{
              display: flex;
              justify-content: space-between;
              align-items: center;
          }

          .total_price{
              display: flex;
              justify-content: space-between;
              align-items: center;

              .twd{
                  color:$irishcoffee;
              }

          }

          .btn_submit{
              border: none;
              background-color: transparent;
              width: 100%;
              text-align: right;
              padding: 30px 80px;

              button{
                  width: 20%;
                  background-color:$campari;
                  color:$whitelady;
                  font-size: $fontSize_h3;
                  letter-spacing:$letterspacing;
                  font-family:$fontfamily;
                  line-height: 2;
                  border-radius:4px;

                  &:hover{
                      cursor: pointer;
                      color:$blackvevet;
                      background-color:$ramos-gin-fizz;
                      transition: all ease-in-out .3s;
                      border:none;
                  }
              }
          }

      }

  }
}
</style>