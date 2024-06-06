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

        <!-- 右半邊 -->
        <section class="right">
            <!-- 商品卡片 -->
            <ul>
                <div class="product">  
                    <li>
                        <!-- 照片 -->
                        <div class="pic">
                            <img src="../imgs/productsImg/sparkling wine/PIERRE ZERO.png" alt="">
                        </div>
                        <!-- 標題&數量按鈕 -->
                        <div class="text">
                            <h4>PIERRE ZERO <br/>夏朵內無酒精氣泡白酒 12瓶</h4>
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
                    </li>
                    <!-- 刪除 -->
                    <div class="delete">
                        <button>
                            <img class="img" src="../imgs/icon/icon_delete.svg" alt="">
                        </button>
                    </div>
                </div>
            </ul>
        </section>
    </div>
</template>



<style lang="scss" scoped>
.wrapper{
    width: 100%;
    background-color:$campari;
    // outline: 1px solid red;
    display: flex;

    //左半邊
    .left{
        width: 50%;
        padding-top: 50px;
        margin-top: 30px;
        border-right:3px solid $whitelady;
        // outline: 1px solid #fff;
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
            // outline: 1px solid #000;
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
    .right{
        width: 50%;
        padding-top: 50px;
        margin-top: 30px;
        background-color: $whitelady;

        ul{
            width: 100%;
            outline:1px solid #000;
             
            .product{
                // outline: 1px solid yellow;
                width: 80%;
                
                display: flex;
                align-items: center;
                
                margin-left: 70px;
                li{
                    display: flex;
                    align-items:center;
                    justify-content: space-between;
                    border: 1px solid yellow;
                    width: 100%;
                    background-color: #fff;
                    border: 1px solid $irishcoffee;
                    border-radius: 8px;
                    padding: 10px;

                    //商品圖片
                    .pic{

                        width: 30%;
                        text-align: center;
                        outline: 1px solid purple;

                        img{
                            width: 80%;
                        }
                    }

                    //商品名稱
                    .text{
                        outline: 1px solid blue;
                        width: 70%;

                        h4{
                            font-size:$fontSize_p;
                            font-family:$fontfamily;
                            letter-spacing:$letterspacing;
                            color:#000;
                            line-height: 1.2;
                           margin-bottom: 10px;
                        }

                        .text_down{
                            display: flex;
                            justify-content:space-evenly;
                            align-items: center;
                            padding: 10px;
                            p{
                                font-size:$fontSize_p;
                                color: #d3d3d3;
                            }

                            .btn{
                                display: flex;
                                align-items: center;
                                // outline: 1px solid red;
                                width: 20%;
                                margin: 0 auto;
                                margin-left: 130px;
                                
                                button{
                                    width: 100%;
                                    border: none;
                                    border:1px solid #000;
                                    margin-right: 10px;
                                    background-color: transparent;
                                    font-size: $fontSize_h5;
                                    
                                    
                                }

                                p{
                                    font-size: $fontSize_h4;
                                    color:#000;
                                    letter-spacing:$letterspacing
                                }
                            }
                        }

                    }

                    .price{
                        width: 20%;
                        p{
                            font-size: 1.5rem;
                            text-align: center;
                            font-weight: bold;
                        }
                    }
                }

                
                
            }

            .delete{
                outline: 1px solid orange;
                width: 10%;
                text-align: center;
                margin-left: 30px;

                button{
                    img {
                        width: 60%;
                        
                    }
                }
            }
        }
    }    
  }


</style> 