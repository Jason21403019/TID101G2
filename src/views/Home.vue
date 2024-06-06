  <template>
        <section class="hm_wrapper">
        <div  :class="animation"  class="story1 home_Background_1">
          <span class="story1_span">
            <h2>in this city</h2>
            <h3>在這個城市裡，有一家餐酒館<br>名為「紙醉金迷」<br>它坐落在城市的中心<br>是城市的靈魂所在.....</h3>
          </span>
        </div>
        <div class="story2 homeBackground_3">
          <span class="story1_span2">
            <h2>wonderful journey</h2>
            <h3>在這裡....<br>人們可以品嚐到世界各地的頂級美酒<br>它每一杯都是心靈的享受<br>每一口都是一段奇妙的旅程</h3>
          </span>
        </div>
        <div class="story3 homeBackground_4">
          <span class="story1_span3">
            <h2>captivate Intoxicat</h2>
            <h3>著迷陶醉在美酒與夜色的夢境中<br>讓每位到訪者在這裡都能找到自己獨特的夢境</h3>
          </span>
        </div>
        <div :class="animation2"  class="story4 homeBackground_5"  @click="aboutPage">
          <span class="story1_span4" >
            <h2>intoxicating dreams</h2>
            <h3>歡迎來到紙醉金迷<br>讓我們一同迷失在美酒與夜色的奇妙之中<br>盡情享受這片醉人的夢境.....</h3>
          </span>
          </div>
        </section>
  </template>

<script>
// import { gsap } from 'gsap';
import { onMounted } from 'vue';
export default {
      name: 'Home',
      data () {
        return {
          animation:'homeBackground_1',
          animation2:'homeBackground_5',
          buttonText:''
        };
    },
    mounted() {
    this.startBackground_1();
    this.startBackground_2();
  },
    methods: { 
      startBackground_1(){
      setInterval(() => {
        this.animation = this.animation === 'homeBackground_1' ? 'homeBackground_2' : 'homeBackground_1';
      }, 1000);
      //一秒換一次
      },
      // 引導入口的動畫
      startBackground_2(){
      setInterval(() => {
        this.animation2 = this.animation2 === 'homeBackground_6' ? 'homeBackground_7' : 'homeBackground_6';
      }, 1000);
      //一秒換一次
      },
      // 按鈕跳轉到關於我們
      aboutPage() {
        location.href = '../views/AboutUs.vue';
      },
    getRatio(element) {
      const rect = element.getBoundingClientRect()
      return rect.top / window.innerHeight
    }

    }
  }
</script>
<style lang="scss" scoped>
section{
  background: $negroni;
  width: 100%;
  .story1{
    height: 240vh;
    display: grid;
    align-content: center;
    justify-content: start;
    align-items: center;
    justify-items: start;
  }

  .story2{
    height: 240vh;
    display: grid;
    align-content: center;
    justify-content: start;
    align-items: center;
    justify-items: end;

    .story1_span2{
      margin-top: 470px;
    }
  }

  .story3{
    height: 240vh;
    display: grid;
    align-content: center;
    justify-content: start;
    align-items: center;
    justify-items: center;
    
    .story1_span3{
      margin-bottom: 1000px;
    }
  }

  .story4{
    height: 240vh;
    display: grid;
    align-content: center;
    justify-content: start;
    align-items: center;
    justify-items: center;

    .story1_span4{
      margin-bottom: 1200px;
    }
  }
  span {
        // border: 1px solid red;
        position: absolute;
        z-index: 1;
        font-family: $fontfamily;
        text-align: center;
        margin: 0 150px;
        margin-bottom: 540px;
        letter-spacing: $letterspacing;
        line-height: $lineheight + 1.0em;
        h3{
          color: $whitelady;
          font-size: $fontSize_h3;
          z-index: 1;
        }
      }
  h2{
    font-family: $fontfamily-en2;
    color: $whitelady;
    font-size: $fontSize_h1;
    opacity: 25%;
  }
  // 動畫
  .home_Background_1{
    // 特效
    transition: 1s ease-in-out; 

  }
  // 圖片
  .homeBackground_1{
    background-image: url(../imgs/homePageImg/homePage_story1.svg); 
    background-size: cover;
    background-position: center; 
    height: 200vh;
  }
  .homeBackground_2{
    background-image: url(../imgs/homePageImg/homePage_story1b-01.svg);
    background-size: cover;
    background-position: center; 
    height: 200vh;
  }
  .homeBackground_3{
    // border: 2px solid greenyellow;
    background-image: url(../imgs/homePageImg/homePage_story2.svg);
    background-size: cover;
    background-position: center; 
    height: 120vh;

  }

  .homeBackground_4{
    background-image: url(../imgs/homePageImg/homePage_story3.svg);
    background-size: cover;
    background-position: center; 
    height: 200vh;
  }

  .homeBackground_5{
    transition: 0.5s ease-in-out; 
  }
  // 引導按鈕
  .homeBackground_6{
    background-image: url(../imgs/homePageImg/homePage_story4.png);
    background-size: cover;
    background-position: center; 
    height: 250vh;
  }
  .homeBackground_7{
    background-image: url(../imgs/homePageImg/homePage_story4_on.png);
    background-size: 100%;
    height: 250vh;
  }
  // 按鈕範圍
  .box_btn{
    // border: 2px solid greenyellow;
    width: 100%;
    button{
      // border: 2px solid greenyellow;
      width: 100%;
    }
  }

}


</style>