<template>
  <section class="hm_wrapper">
    <div :class="animation" class="story1 homeBackground_1" ref="story1">
      <span class="story1_span">
        <h2>in this city</h2>
        <h3>在這個城市裡，有一家餐酒館<br />名為「紙醉金迷」<br />它坐落在城市的中心<br />是城市的靈魂所在.....</h3>
        <!-- 滾動提示 -->
        <div class="scroll_icon"></div>
      </span>
    </div>
    <div class="story2 homeBackground_3" ref="story2">
      <span class="story1_span2">
        <h2>wonderful journey</h2>
        <h3>在這裡....<br />人們可以品嚐到世界各地的頂級美酒<br />它每一杯都是心靈的享受<br />每一口都是一段奇妙的旅程</h3>
      </span>
    </div>
    <div class="story3 homeBackground_4" ref="story3">
      <span class="story1_span3">
        <h2>captivate Intoxicat</h2>
        <h3>著迷陶醉在美酒與夜色的夢境中<br />讓每位到訪者在這裡都能找到自己獨特的夢境</h3>
      </span>
    </div>
    <div @click="aboutPage">
      <div :class="animation2" class="story4 homeBackground_5" ref="story4">
        <span class="story1_span4">
          <h2>intoxicating dreams</h2>
          <h3>歡迎來到紙醉金迷<br />讓我們一同迷失在美酒與夜色的奇妙之中<br />盡情享受這片醉人的夢境.....</h3>
        </span>
      </div>
    </div>
  </section>
</template>

<script>
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

export default {
  name: 'Home',
  data() {
    return {
      animation: 'homeBackground_1',
      animation2: 'homeBackground_5',
      buttonText: ''
    }
  },
  mounted() {
    this.startBackground_1()
    this.startBackground_2()
    this.inScrollTrigger()
  },
  methods: {
    startBackground_1() {
      setInterval(() => {
        this.animation = this.animation === 'homeBackground_1' ? 'homeBackground_2' : 'homeBackground_1'
      }, 1000)
    },
    startBackground_2() {
      setInterval(() => {
        this.animation2 = this.animation2 === 'homeBackground_6' ? 'homeBackground_7' : 'homeBackground_6'
      }, 1000)
    },
    // 進入關於我們
    aboutPage() {
      // window.location.href = '/about_us';
      this.$router.push('/about_us')
    },
    //特效GSAP
    inScrollTrigger() {
      gsap.registerPlugin(ScrollTrigger)

      const story1 = this.$refs.story1
      const story2 = this.$refs.story2
      const story3 = this.$refs.story3
      const story4 = this.$refs.story4

      // gsap.from(story1, {
      //   scrollTrigger: {
      //     trigger: story1,
      //     start: "top 0%",
      //     end: "top 20%",
      //     scrub: 1,
      //     toggleActions: "play none none reverse"
      //   },
      //   opacity: 0,
      //   duration: 1
      // });

      gsap.from(story2, {
        scrollTrigger: {
          // 觸發滾動事件的元素
          trigger: story2,
          // 開始位置
          start: 'top 50%',
          // 結束位置
          end: 'top 20%',
          scrub: 3,
          toggleActions: 'play none none reverse'
        },
        //透明度
        opacity: 0,
        //時間
        duration: 5
      })

      gsap.from(story3, {
        scrollTrigger: {
          trigger: story3,
          start: 'top 80%',
          end: 'top 20%',
          scrub: 1,
          toggleActions: 'play none none reverse'
        },
        opacity: 0,
        duration: 5
      })

      gsap.from(story4, {
        scrollTrigger: {
          trigger: story4,
          start: 'top 80%',
          end: 'top 20%',
          scrub: 1,
          toggleActions: 'play none none reverse'
        },
        opacity: 0,
        duration: 1
      })
    }
  }
}
</script>

<style lang="scss" scoped>
section {
  background: $negroni;
  width: 100%;
  .story1 {
    height: 240vh;
    display: grid;
    align-content: center;
    justify-content: start;
    align-items: center;
    justify-items: start;
  }

  .story2 {
    height: 240vh;
    display: grid;
    align-content: center;
    justify-content: start;
    align-items: center;
    justify-items: end;

    .story1_span2 {
      margin-top: 470px;
    }
  }

  .story3 {
    height: 240vh;
    display: grid;
    align-content: center;
    justify-content: start;
    align-items: center;
    justify-items: center;

    .story1_span3 {
      margin-bottom: 1000px;
    }
  }

  .story4 {
    height: 240vh;
    display: grid;
    align-content: center;
    justify-content: start;
    align-items: center;
    justify-items: center;
    cursor: pointer;

    .story1_span4 {
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
    line-height: $lineheight + 1em;
    h3 {
      color: $whitelady;
      font-size: $fontSize_h3;
      z-index: 1;
    }
  }
  h2 {
    font-family: $fontfamily-en2;
    color: $whitelady;
    font-size: $fontSize_h1;
    opacity: 25%;
  }
  // 動畫
  .home_Background_1 {
    // 特效
    transition: 1s ease-in-out;
  }
  // 圖片
  .homeBackground_1 {
    background-image: url(../imgs/homePageImg/homePage_story1.svg);
    background-size: cover;
    background-position: center;
    height: 200vh;
  }
  .homeBackground_2 {
    background-image: url(../imgs/homePageImg/homePage_story1b-01.svg);
    background-size: cover;
    background-position: center;
    height: 200vh;
  }
  .homeBackground_3 {
    // border: 2px solid greenyellow;
    background-image: url(../imgs/homePageImg/homePage_story2.svg);
    background-size: cover;
    background-position: center;
    height: 120vh;
  }

  .homeBackground_4 {
    background-image: url(../imgs/homePageImg/homePage_story3.svg);
    background-size: cover;
    background-position: center;
    height: 200vh;
  }

  .homeBackground_5 {
    transition: 0.5s ease-in-out;
    cursor: pointer;
  }
  // 引導按鈕
  .homeBackground_6 {
    background-image: url(../imgs/homePageImg/homePage_story4.png);
    background-size: cover;
    background-position: center;
    height: 250vh;
  }
  .homeBackground_7 {
    background-image: url(../imgs/homePageImg/homePage_story4_on.png);
    background-size: cover;
    background-position: center;
    height: 250vh;
  }
  // 按鈕範圍
  .box_btn {
    // border: 2px solid greenyellow;
    width: 100%;
    cursor: pointer;
    button {
      // border: 2px solid greenyellow;
      width: 100%;
      cursor: pointer;
    }
  }

  //滾動提示
  .scroll_icon {
    position: absolute;
    top: 140%;
    left: 50%;
    transform: translate(-50%, -50%);
    border: 1px solid $ramos-gin-fizz;
    width: 50px;
    height: 90px;
    border-radius: 90px;
    background-color: rgba($color: $ramos-gin-fizz, $alpha: 0.6);
    animation: scrolldown 1.2s 1s linear 2;
  }

  .scroll_icon::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 50%;
    width: 10px;
    height: 10px;
    background-color: #fff;
    animation: scrollDown 2s 1s linear 5;
    opacity: 0;
  }
}

@keyframes scrolldown {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 1;
  }
}

@keyframes scrollDown {
  0% {
    top: 46%;
    opacity: 1;
  }
  100% {
    top: 54%;
    opacity: 0;
  }
}
</style>
