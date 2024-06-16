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
                      <input type="text" id="address" v-model="orderAddress" required>
                  </div>
              </div>

              <div class="order_note">

                  <p>訂單備註</p>
                  <textarea name="" id="" cols="30" rows="8" placeholder="若有其他備註事項，請在此填寫，謝謝您！"></textarea>
              </div>


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
                      <input type="text" id="ship_address" v-model="shipAddress" required>
                  </div>
              </div>
              

          </div>

      </section>

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
              "高雄市":["楠梓區","左營區","鼓山區","三民區","鹽埕區","前金區","新興區","苓雅區","前鎮區","旗津區","小港區","鳳山區","林園區","大寮區","大樹區","大社區","仁武區","鳥松區","岡山區","橋頭區","燕巢區","田寮區","阿蓮區","路竹區","湖內區","茄萣區","永安區","彌陀區","梓官區","旗山區","美濃區","六龜區","甲仙區","杉林區","內門區","茂林區","桃源區","那瑪夏區"],
              "新竹縣":["竹北市","竹東鎮","新埔鎮","關西鎮","湖口鄉","新豐鄉","峨眉鄉","寶山鄉","北埔鄉","芎林鄉","橫山鄉","尖石鄉","五峰鄉"],
              "新竹市":["東區","北區","香山區"],
              "苗栗縣":["苗栗市","苑裡鎮","通霄鎮","竹南鎮","頭份市","後龍鎮","卓蘭鎮","大湖鄉","公館鄉","銅鑼鄉","南庄鄉","頭屋鄉","三義鄉","西湖鄉","造橋鄉","三灣鄉","獅潭鄉","泰安鄉"],
              "彰化縣":["彰化市","鹿港鎮","和美鎮","員林市","溪湖鎮","二林鎮","田中鎮","北斗鎮","花壇鄉","芬園鄉","大村鄉","永靖鄉","伸港鄉","線西鄉","福興鄉","秀水鄉","埔心鄉","埔鹽鄉","大城鄉","芳苑鄉","竹塘鄉","社頭鄉","二水鄉","田尾鄉","埤頭鄉","溪州鄉"],
              "南投縣":["南投市","埔里鎮","草屯鎮","竹山鎮","集集鎮","名間鄉","鹿谷鄉","中寮鄉","魚池鄉","國姓鄉","水里鄉","信義鄉","仁愛鄉"],
              "雲林縣":["斗六市","斗南鎮","虎尾鎮","西螺鎮","土庫鎮","北港鎮","莿桐鄉","林內鄉","二崙鄉","仰山鄉","崙背鄉","麥寮鄉","東勢鄉","褒忠鄉","臺西鄉","元長鄉","四湖鄉","口湖鄉","水林鄉","古坑鄉"],
              "嘉義縣":["太保市","朴子市","布袋鎮","大林鎮","民雄鄉","溪口鄉","新港鄉","六腳鄉","東石鄉","義竹鄉","鹿草鄉","水上鄉","中埔鄉","竹崎鄉","梅山鄉","番路鄉","大埔鄉","阿里山鄉"],
              "屏東縣":[ "屏東市","潮州鎮","恆春鎮","萬丹鄉","長治鄉","麟洛鄉","九如鄉","里港鄉","鹽埔鄉","高樹鄉","萬巒鄉","內埔鄉","竹田鄉","新埤鄉","枋寮鄉","新園鄉","崁頂鄉","林邊鄉","南州鄉","佳冬鄉","琉球鄉","車城鄉","滿州鄉","枋山鄉","霧台鄉","瑪家鄉","泰武鄉","來義鄉","春日鄉","獅子鄉","牡丹鄉"],
              "宜蘭縣":["宜蘭市","羅東鎮","蘇澳鎮","頭城鎮","礁溪鄉","壯圍鄉","員山鄉","冬山鄉","五結鄉","三星鄉","大同鄉","南澳鄉"],
              "花蓮縣":["花蓮市","新城鄉","秀林鄉","吉安鄉","壽豐鄉","鳳林鎮","光復鄉","豐濱鄉","瑞穗鄉","萬榮鄉","富里鄉","卓溪鄉"],
              "台東縣":["台東市","成功鎮","關山鎮","長濱鄉","海端鄉","池上鄉","東河鄉","鹿野鄉","延平鄉","卑南鄉","金峰鄉","大武鄉","達仁鄉","綠島鄉","蘭嶼鄉","太麻里鄉"],
              "金門縣":["金沙鎮","金湖鎮","金城鎮","烈嶼鄉","烏坵鄉"],
              "澎湖縣":["馬公市","湖西鄉","白沙鄉","西嶼鄉","望安鄉","七美鄉"],
              "連江縣":["南竿鄉","北竿鄉","莒光鄉","東引鄉"],
          },
          selectedCounty: "",
          selectedDistrict: "",
          orderName: "",
          orderPhone: "",
          orderEmail: "",
          orderAddress: "",
          selectedCountyShip: "",
          selectedDistrictShip: "",
          shipName: "",
          shipPhone: "",
          shipEmail: "",
          shipAddress: "",
          privacyAccepted: false,

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
      },
      fetchDistrictsShip() {
        // 根據所選縣市加載對應的地區
        if (this.selectedCountyShip) {
            this.selectedDistrictShip = this.districts[this.selectedCountyShip][0];
        } else {
            this.selectedDistrictShip = "";
        }
      },

      validateOrderForm() {
      if (!this.orderName) {
        alert("未填寫姓名!");
        return;
      }
      if (!this.orderPhone) {
        alert("未填寫連絡電話!");
        return;
      }
      if (!this.orderEmail) {
        alert("未填寫電子郵件!");
        return;
      }
      if (!this.selectedCounty || !this.selectedDistrict || !this.orderAddress) {
        alert("未填寫完整收件地址!");
        return;
      }
      if (!this.shipName) {
        alert("未填寫收件人姓名!");
        return;
      }
      if (!this.shipPhone) {
        alert("未填寫收件人連絡電話!");
        return;
      }
      if (!this.shipEmail) {
        alert("未填寫收件人電子郵件!");
        return;
      }
      if (!this.selectedCountyShip || !this.selectedDistrictShip || !this.shipAddress) {
        alert("未填寫完整收件人地址!");
        return;
      }
      if (!this.privacyAccepted) {
        alert("請閱讀並同意隱私權政策及服務條款!");
        return;
      }

      // 所有驗證通過，可以提交表單
      alert("訂單已提交!");
    },
    copyOrderInfo() {
      this.shipName = this.orderName;
      this.shipPhone = this.orderPhone;
      this.shipEmail = this.orderEmail;
      this.selectedCountyShip = this.selectedCounty;
      this.selectedDistrictShip = this.selectedDistrict;
      this.shipAddress = this.orderAddress;
    },

  },

}
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

                        @include breakpoint( 430px){
                            padding: 10px;
                        }
                    }

                    // 縣/市
                    .ship_address {
                        width: 50%;

                        // outline: 1px solid blue;
                        select {
                            width: 95%;
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

        


      //訂購人資訊
      .ship_name {
          width: 100%;

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