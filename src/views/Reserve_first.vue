<template>

<div class="wrapper">
        <div class="banner">
            <!-- <img src="../imgs/bookingImg/close-up-drink-bar2.jpg" alt=""> -->
        </div>

        <div class="title">
            <h1>紙醉金迷</h1>
            <h4>captivate Intoxicat</h4>
        </div>
        <div class="reserve">
            <div class="seat">
                <img src="../imgs/icon/icon_bag.svg" alt="">
                <h3>預約座位</h3>
            </div>
        </div>  
    

    <section class="notice">
        <h1>提醒事項</h1>
        <div class="sub_notice">
            <h5>消費方式<br/>
                (1)低消每位500元。<br/>
                (2)週五週六用餐時限為2小時(現場無客滿情況則不強制限時)。<br/>
                (3)店内禁用外食(慶生蛋糕除外)。<br/>
                (4)VIP包廂低消每位1000元。<br/>
                (5)特殊節日2/14、12/24、12/25、12/31低消每位1000元(用餐時限為2小時)。<br/>
                如訂位人數大於五位或需預訂半夜12點後，訂位時，請來電由店家協助。
            </h5>
        </div>

    </section>

    <div class="form">
         <!-- 當有錯誤信息的時候才會顯示 -->
         <p v-if="errorMessage" class="error" style="color: red;">{{ errorMessage }}</p>

        <div class="name">
            <p>
            <img src="../imgs/icon/icon_admin-person.svg" alt="">姓名
            </p> 
            <input type="text" id="name" v-model="name" placeholder="" required ><br/>
        </div>

        <div class="phone">
            <p>
                <img src="../imgs/icon/icon_Vector.svg" alt="" >電話
            </p>
            <input type="text" id="phone" v-model="phone" placeholder="" required><br/>
        </div>

        <div class="people">
            <p>
                <img src="../imgs/icon/icon_people.svg" alt="">用餐人數
            </p>
            <p class="text">
                可預約1-12位
            </p>
            <select class="guests " name="guests" v-model="guests" required>
                <option value="1">1 位</option>
                <option value="2">2 位</option>
                <option value="3">3 位</option>
                <option value="4">4 位</option>
                <option value="5">5 位</option>
                <option value="6">6 位</option>
                <option value="7">7 位</option>
                <option value="8">8 位</option>
                <option value="9">9 位</option>
                <option value="10">10 位</option>
                <option value="11">11 位</option>
                <option value="12">12 位</option>
            </select>
        </div>

       
        <div class="date_time">
            <p>
                <img src="../imgs/icon/icon_time.svg" alt="">用餐日期與時間</p>
            <div class="select">
                <div class="date">
                    <input type="date" id="date" v-model="date" required>
                </div>
                <div class="time" >
                    <input type="time" id="time" v-model="time" required>
                </div>
            </div>
        </div>

        <div class="note">
            <p>其他備註</p>
            <textarea name="note" id="note" cols="140" rows="15" placeholder="有特殊需求可以寫在這裡喔！"></textarea>
        </div>  
    </div>

    <div class="btn">
        <button @click="goToNextPage">
            <p>下一步</p>
        </button>
    </div>
</div>

 
 </template>   

 <script>
  export default {
  data() {
    return {
      name: '',
      phone: '',
      guests: 1,
      date: '',
      time: '',
      note: '',
      showPopup: false,
      errorMessage:''
    };
  },
  methods: {
    goToNextPage() {
      this.errorMessage='';

      if (!this.name) {
        this.errorMessage = '**請填寫姓名**';
      } else if (!this.phone) {
        this.errorMessage = '**請填寫聯絡電話**';
      } else if (!this.date) {
        this.errorMessage = '**請選擇用餐日期**';
      } else if (!this.time) {
        this.errorMessage = '**請選擇用餐時間**';
      } else if (!this.guests) {
        this.errorMessage = '**請選擇用餐人數**';
      } else {

        localStorage.setItem('reservationData', JSON.stringify({
            name: this.name,
            phone: this.phone,
            guests: this.guests,
            date: this.date,
            time: this.time,
            note: this.note
        }));
        this.$router.push('/reserve_sec');
      }
    }
  }
 };


</script>


<style lang="scss" scoped>

@mixin breakpoint($point) {
  @media screen and (max-width: $point) {
    @content;
  }
}


.wrapper{
    margin: 0 auto ;
    width: 100%;
    background-color: $whitelady;
    // border: 1px solid blue;



    .banner{
        width: 64%;
        height: 400px;
        margin: 0 auto;
        margin-top: 50px;
        // border: 1px solid green;
        background: url('../imgs/bookingImg/close-up-drink-bar2.jpg');


        @include breakpoint(1280px) {
        width: 80%;
        
        }

        @include breakpoint(820px) {
        width: 100%;
        
        }

        @include breakpoint(540px) {
        background-position:25% 0;
        }

        @include breakpoint(430px) {
        background-position:35% 0;
       
        }
    }

    .title{
        margin: 50px;
        text-align: center;
        // outline: 1px solid red;

        @include breakpoint(820px) {

            margin: 30px 0 20px 0;
        
        }

        

        //紙醉金迷
        h1{
            font-size:$fontSize_h1;
            color: $campari;
            font-family:$fontfamily;
            font-weight: bold;
        }

        //captivate Intoxicat
        h4{
            font-size:$fontSize_h3;
            color: $campari;
            font-family:$fontfamily-en;
            font-weight: bold;
        }
    }

    //預約座位
    .reserve{
        .seat{
            display: flex;
            justify-content: center;
            margin: 0 auto;
            padding: 10px;
            // border: 1px solid blue;
            width: 20%;
            border-bottom: 3px solid $campari;

            @include breakpoint(996px) {
            width: 50%;
            margin: 0 auto;
            // outline: 1px solid red;
            }

            @include breakpoint(430px) {
                width: 70%;
            }

            @include breakpoint(390px) {
            width: 60%;
          
            }
            

            //icon
              img{
                width: 40px;
                height: 50px;
                color:$campari;
                margin-right: 10px;
              // border: 1px solid red;

                   @include breakpoint(430px) {
                    width: 30px;
                    height: 30px;
             
                    }  
                }   

              //預約座位
              h3{
                font-size:$fontSize_h3 ;
                color: $campari;
                font-family:$fontfamily;
                font-weight: bold;
                margin-top: 10px;
              }
        }
          
    }
}


//備註
.notice{
    width: 64%;
    // border: 1px solid red;
    padding: 20px 20px;
    margin: 0 auto;

    @include breakpoint(1366px) {
        width: 80%;
    }

    @include breakpoint(1280px) {
        width: 85%;
    }

    @include breakpoint(820px) {
        width: 90%;
        margin-top: 30px;

    }

    @include breakpoint(430px) {
        width: 100%;
        margin-top: 30px;
    }
    //提醒事項
    h1{
        font-family:$fontfamily;
        font-size:$fontSize_h2;
        margin-bottom: 15px;
    
    }

    //消費方式細項
    .sub_notice{
        
        h5{
            font-family:$fontfamily;
            font-size:1.5rem;
            letter-spacing: $letterspacing;
            line-height: 45px;

            @include breakpoint(430px) {
                line-height: 30px;
            }

            @include breakpoint(390px) {
                line-height: 2
            }

            @include breakpoint(375px) {
                font-size:1.8rem;
            }
        }
    }

}


//訂位表格
.form{
    width: 64%;
    margin: 0 auto;
    // border: 1px solid red;
    padding: 30px 30px;

    @include breakpoint(1280px) {
        width: 85%;
    }

    @include breakpoint(820px) {
        width: 90%;
    }

    @include breakpoint(430px) {
       width: 100%;
    }
    

    p{
      font-family:$fontfamily;
    //font-size:$fontSize_h2;
      font-size: 2.625rem;
      margin:10px 0 10px 0;
      text-align: left;
      letter-spacing: $letterspacing;
      font-weight: bold;
      color: $campari;

      display:flex;
      justify-content: start;
      align-items: center;  
    }

    input{
        width: 100%;
        padding: 20px;
        border-radius:8px;
        border:2px solid $campari;
        margin-bottom: 20px;

        @include breakpoint(540px) {
            padding: 15px;
        }

    }

    img{
            width: 40px;
            height: 40px;
            margin-right: 10px;

            @include breakpoint(430px) {
                width: 30px;
                height: 30px;
             
            }  
        }

    .error{
        color: red;
        font-size: $fontSize_p;
        font-family:$fontfamily;
    }

   
  

    //用餐人數欄位
    .people{
        .text{
            font-family:$fontfamily;
            font-size:$fontSize_h5;
            color:#d3d3d3;

        }

        //select選單樣式
        .guests {
            width: 100%;
            padding: 20px;
            margin-bottom: 20px;
            font-size:$fontSize_h4;
            line-height: 1.5;
            border-color:$campari;
            border-radius: 8px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns="http://www.w3.org/2000/svg" width="292.362" height="292.362" viewBox="0 0 292.362 292.362"><path fill="%23333" d="M287.273 69.233L166.191 190.317c-7.592 7.589-17.748 11.781-28.49 11.781s-20.896-4.192-28.49-11.781L5.088 69.233C-1.696 62.44-1.696 51.426 5.088 44.631c6.789-6.789 17.803-6.789 24.591 0l112.021 112.02L262.681 44.631c6.789-6.789 17.803-6.789 24.591 0 6.784 6.789 6.784 17.803 0 24.602z"/></svg>') no-repeat right 10px center;
            background-size: 20px 20px;

            @include breakpoint(540px) {
              padding: 15px;

            }

           @include breakpoint(820px) {
              font-size:$fontSize_h3;
            }

        }

        // .guests:focus {
        //     outline: 2px solid $campari;
        //     border-color: $campari;
        //     border: 2px solid $campari;
        // }

    }


    //用餐日期與時間 欄位
    .date_time{

        input{
            font-size:$fontSize_h3;
            padding: 15px;

            @include breakpoint(540px) {
              font-size:$fontSize_h4;
                
            }

            @include breakpoint(430px) {
              font-size:$fontSize_h3;
                
            }

        }

        .select{
            display: flex;
            justify-content: center;
            width: 100%;
            margin: 0 auto;
            // outline: 1px solid blue;

            @include breakpoint(540px) {
                display: block;

            }

            .date{
                width: 50%;
                margin-right: 10px;  

                @include breakpoint(540px) {
                width: 100%;
                }
            }

            .time{
                width: 50%;
                input{
                    padding: 13px;
                }

                @include breakpoint(540px) {
                width: 100%;
                }
            }
        }
    }

    //其他備註 欄位
    .note{
        margin-bottom: 50px;
        textarea{
            width: 100%;  
        }

        textarea::placeholder{
          padding: 30px;
          font-size: $fontSize_h4;

          @include breakpoint(540px) {
            padding: 20px;
                
            }

        @include breakpoint(430px) {
            padding: 10px;
                
            }
        }
       
    }
}

.btn{
    width: 100%;
    display: flex;
    justify-content: center;

    button{
    width:20%;
    line-height: 2;
    border: none;
    margin-bottom: 50px;
    border-radius: 5px;
    background: $campari;

    @include breakpoint(540px) {
        width: 40%;
    }

    @include breakpoint(414px) {
        width: 50%;
    }

    @include breakpoint(375px) {
       line-height: 3;
       width: 40%;
    }


    p{
        text-align: center;
        color:$ramos-gin-fizz ;
        font-size: $fontSize_h3;
        letter-spacing: $letterspacing;
            
    }
  }
}



</style>