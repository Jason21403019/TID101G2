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
                            <select >
                                <option value="">選擇縣市</option>
                                <!-- <option v-for="county in counties" :key="county" :value="county">{{ county }}</option> -->
                            </select>
                        </div>

                        <div class="district">
                            <p>地區</p>
                            <select>
                                <option value="">選擇地區</option>
                                <!-- <option v-for="district in districts[selectedCounty]" :key="district" :value="district">{{ district }}</option> -->
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
                            <select >
                                <option value="">選擇縣市</option>
                                <!-- <option v-for="county in counties" :key="county" :value="county">{{ county }}</option> -->
                            </select>
                        </div>

                        <div class="district">
                            <p>地區</p>
                            <select>
                                <option value="">選擇地區</option>
                                <!-- <option v-for="district in districts[selectedCounty]" :key="district" :value="district">{{ district }}</option> -->
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
    </div>
</template>



<style lang="scss" scoped>
.wrapper{
    width: 100%;
    background-color:$campari;
    outline: 1px solid red;

    //左半邊
    .left{
        width: 50%;
        padding-top: 30px;
        margin-top: 30px;
        outline: 1px solid #fff;
      
           
       //訂單資訊
        .order-title{
            width: 100%;
            // outline: 1px solid #000;
            background-color:$ramos-gin-fizz;

            h2{
                font-size:$fontSize_h2;
                font-family:$fontfamily;
                letter-spacing:$letterspacing;
                color:$campari;
                font-weight: bold;
                padding: 20px;
                margin-left: 10px;
            }
        }

        input{
            border-radius: 4px;
            padding: 15px;
            width: 100%;
        }

        p{
            font-family:$fontfamily;
            font-size: $fontSize_h3;
            margin: 10px 0 10px 10px;
            color:$whitelady;

        }

        //姓名和電話
        .first{
            width: 100%;
            outline: 1px solid #000;
            display: flex;
            justify-content: center;
            padding: 20px;



            .name{
                width: 100%;
                // outline: 1px solid green;
                margin-right: 20px;

            }

            .phone{
                width: 100%;
            }
        }

        .email{
            width: 100%;
            padding: 20px;
        }

        .address_info{
            width: 100%;
            padding: 20px;

          //收件地址
            .sec{
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
                // outline: 1px solid #fff;
                padding: 10px;

                select{
                    width: 100%;
                    padding: 20px;
                    border-radius: 4px;
                    

                    appearance: none;
                    -webkit-appearance: none;
                    -moz-appearance: none;
                    background: url('../imgs/icon/icon_option-w.svg') no-repeat 95% 50%;
                    border-color:$ramos-gin-fizz;
                    background-size: 20px 20px;
                    // background:$ramos-gin-fizz;
                    color:$ramos-gin-fizz;
                    font-size:$fontSize_h4;
                    
                }   
                // 縣/市
                .ship_address{
                    width: 50%;
                    // outline: 1px solid blue;
                   select{
                       width: 99%;
                   }
                }
                // 地區
                .district{
                    width: 50%;
                    // border: 1px solid blue;
                    select{
                       width: 99%;
                       margin-left: 5px;
                   }
                }
            }
        }

            .address{
                padding: 10px;
                width: 100%;
            }

        .order_note{
            width: 100%;
            padding: 30px;

            textarea{
                width: 100%;
                padding: 20px;
                border-radius: 4px;
            }
        }

   

    //訂購人資訊
       .ship_name{
           width: 100%;

           .order-title2{
              display: flex;
              align-items: center;
              background-color:$ramos-gin-fizz;

              h2{
                font-size:$fontSize_h2;
                font-family:$fontfamily;
                letter-spacing:$letterspacing;
                color:$campari;
                font-weight: bold;
                padding: 20px;
                margin-left: 10px;
              }

              .checkbox{
                display: flex;
                align-items: center;
                justify-content: center;
                input{
                    width: 20px;
                    height: 20px;
                    border-radius:50%;
                }
                p{
                    font-family:$fontfamily;
                    font-size: $fontSize_h3;
                    color:$campari;
                    font-weight: bold;
                }
              }
            }

            .privacy{
                display: flex;
                align-items: center;
                margin-left: 30px;
                padding: 10px;
                input{
                    width: 20px;
                    height: 20px;
                }

                p{
                    font-size:$fontSize_h4;
                    letter-spacing:$letterspacing;
                }
            }
           
       }
    }

    //右半邊
  }


</style>