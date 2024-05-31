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
                
                    <img src="@/imgs/icon/icon_bag.svg" alt="">
               
                <h3>預約座位</h3>
            </div>
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
                如訂位人數大於五位或需預訂半夜12點後，訂位時，請來電 ，由店家協助。
            </h5>
        </div>

    </section>

    <div class="form">
        <div class="name">
            <p>姓名</p>
            <input type="text" id="name" placeholder=""><br/>
        </div>
        <label for="phone"><img src="@/assets/imgs/icons/telephone.png" alt="">電話</label>
        <input type="text" id="phone" placeholder=""><br/>

        <label for="people"><img src="@/assets/imgs/icons/people.png" alt="">用餐人數</label>
        <select id="guests" name="guests" required><br/>
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
        </select>
        <div class="date_time">
            <div class="date">
                <label for="date">日期</label>
                <input type="date" id="date">
            </div>

            <div class="time">
                <label for="time">時間</label>
                <input type="time" id="time">
            </div>

        </div>
        

        
    </div>







 </template>   

 <script>

</script>


<style lang="scss" scoped>

.wrapper{
    margin: 0 auto;
    // border: 1px solid blue;
    .banner{
        width: 64%;
        height: 400px;
        margin: 0 auto;
        margin-top: 100px;
        border: 1px solid green;
        background: url('../imgs/bookingImg/close-up-drink-bar2.jpg');
    }

    .title{
        margin-top: 50px;
        text-align: center;
        h1{
            font-size:$fontSize_h1;
            color: $campari;
            font-family:$fontfamily;
            font-weight: bold;
        }

        h4{
            font-size:$fontSize_h3;
            color: $campari;
            font-family:$fontfamily-en;
            font-weight: bold;
        }
    }

    .reserve{
        // border: 1px solid red;

        .seat{
            display: flex;
            justify-content: center;
            margin: 30px 0;
            // height: 30px;

              img{
              width: 20px;
              height: 30px;
              color:$campari;
              margin-right: 10px;
              }  

              h3{
                font-size:$fontSize_h3 ;
                color: $campari;
                font-family:$fontfamily;
                font-weight: bold;
              }
        }
          
    }
}

.notice{
    border: 1px solid red;
    margin-bottom: 50px;
    h1{
        font-family:$fontfamily;
        font-size:$fontSize_h3;
        margin-bottom: 15px;
    }

    .sub_notice{

        h5{
            font-family:$fontfamily;
            font-size:$fontSize_h4;
            letter-spacing: $letterspacing;
            line-height: 30px;
        }
    }

}

.form{
    width: 100%;
    border: 1px solid red;
    display: inline-block;
    label{
        
        width: 90%;
        font-family:$fontfamily;
        font-size:$fontSize_h3 ;
        // outline: 1px solid blue;
        input{
            width: 90%;
        }
    }
}




</style>