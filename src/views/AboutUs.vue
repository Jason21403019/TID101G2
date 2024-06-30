<template>
  <main>
    <!-- logo-->
    <section class="parallax-section" id="section00">
      <!-- <img class="logo_1" src="/src/imgs/aboutImg/white-dream-illust-left-sp.png" alt="" /> -->

      <div class="parallax-content">
        <img class="logo" src="/src/imgs/logo/logo-w.png" alt="" />
      </div>
    </section>

    <!-- 緣由 -->
    <section class="parallax-section 4 aboutBackground_2" id="section1">
      <div class="parallax-content">
        <p>Fredericka the Great</p>
        <h1>紙醉金迷</h1>
        <h3>
          「紙醉金迷」以浪漫、神秘的氛圍和美酒品味為主題，吸引消費者，<br />提供來自世界各地的頂級美酒和美食，以專業的服務，營造出愉悅的用餐體驗
        </h3>
      </div>
    </section>

    <!-- 心理測驗 -->
    <section class="parallax-section aboutBackground_3" id="section2">
      <div class="parallax-content">
        <h2>Fredericka the Great</h2>
        <h1>尋找屬於您自己的故事</h1>
        <button class="testbutton" @click="testPage">開始測驗</button>
      </div>
    </section>

    <!-- map -->
    <section class="aboutBackground_4">
      <iframe
        src="https://maps.google.com?output=embed&q=緯育TibaMe附設台北職訓中心"
        width="100%"
        height="50%"
        frameborder="0"
      ></iframe>
      <div>
        <h3>營業時間：PM5:00~AM3:00</h3>
        <h3>信箱：captivate_Intoxicat@gmail.com</h3>
        <h3>電話：02-70638715</h3>
        <h3>地址：台北市中山區南京東路三段219號</h3>

        <a href="https://www.facebook.com/TibaMe/?locale=zh_TW"><img src="../imgs/aboutImg/facebook.png" alt="" /></a>
        <a href="https://www.instagram.com/tibame_wiedu/"><img src="../imgs/aboutImg/instagram.png" alt="" /></a>
        <a href="https://page.line.me/750htowt"><img src="../imgs/aboutImg/line.png" alt="" /></a>
      </div>
    </section>
  </main>
</template>

<script>
import gsap from 'gsap'
import ScrollTrigger from 'gsap/ScrollTrigger'

export default {
  mounted() {
    gsap.registerPlugin(ScrollTrigger)

    this.initScrollTriggers()
  },
  methods: {
    initScrollTriggers() {
      // logo
      gsap.from('.logo_1', {
        xPercent: -5,
        duration: 1.5,
        ease: 'power1.out'
      })

      // 首頁
      // 000
      gsap.fromTo(
        '#section00 .parallax-content',
        { yPercent: 0 },
        {
          duration: 2,
          yPercent: -20,
          ease: 'Power1.easeOut',
          scrollTrigger: {
            trigger: '#section00',
            start: 'top center',
            end: 'bottom top',
            scrub: 1
          }
        }
      )

      // 0
      gsap.fromTo(
        '#section0 .parallax-content',
        { yPercent: 0 },
        {
          yPercent: -20,
          ease: 'power1.inOut',
          scrollTrigger: {
            trigger: '#section0',
            start: 'top center',
            end: 'bottom top',
            scrub: 1
          }
        }
      )

      // GSAP ScrollTrigger Animation for Section 1
      gsap.fromTo(
        '#section1 .parallax-content',
        { yPercent: 0 },
        {
          yPercent: -20,
          ease: 'power1.inOut',
          scrollTrigger: {
            trigger: '#section1',
            start: 'top bottom',
            end: 'bottom top',
            scrub: 1
          }
        }
      )

      // GSAP ScrollTrigger Animation for Section 2
      gsap.fromTo(
        '#section2 .parallax-content',
        { yPercent: 0 },
        {
          yPercent: -20,
          ease: 'power1.inOut',
          scrollTrigger: {
            trigger: '#section2',
            start: 'top bottom',
            end: 'bottom top',
            scrub: 1
          }
        }
      )

      // GSAP ScrollTrigger to fade out section 1 as section 2 scrolls up
      gsap.to('#section1', {
        opacity: 0,
        scrollTrigger: {
          trigger: '#section2',
          start: 'top top',
          end: 'top bottom',
          scrub: true
        }
      })

      // 定位
      gsap.to('.pContent', {
        yPercent: -100,
        ease: 'Power3.easeOut',
        scrollTrigger: {
          trigger: '.pSection',
          // start: "top bottom", // the default values
          // end: "bottom top",
          scrub: true
        }
      })

      gsap.to('.pImage', {
        yPercent: 50,
        ease: 'power1.inOut',
        scrollTrigger: {
          trigger: '.pSection',
          // start: "top bottom", // the default values
          // end: "bottom top",
          scrub: true
        }
      })

      gsap.to('.img2-1', {
        y: -150,
        ease: 'none', // 不使用任何緩動效果，保持線性
        scrollTrigger: {
          trigger: '.pSection',

          scrub: 2
        }
      })
    },

    // 心理測驗
    testPage() {
      this.$router.push('/quizgame')
    },
    getRatio(element) {
      const rect = element.getBoundingClientRect()
      return rect.top / window.innerHeight
    }
  }
}
</script>

<style lang="scss" scoped>
@mixin breakpoint($point) {
  @if $point == pc {
    @media (max-width: 1280px) {
      @content;
    }
  } @else if $point == mobile {
    @media (max-width: 768px) {
      @content;
    }
  }
}

body {
  // background-color: white;
  text-align: center;
  font-family: $fontfamily;
  margin: 0;
  padding: 0;
  height: 100%;
}
main {
  font-family: $fontfamily;
  text-align: center;
  // background: $negroni;
  background: $negroni;
}

button {
  background-color: transparent;
  border-color: $irishcoffee;
  color: $irishcoffee;
  border-radius: 84px;
  font-size: 62px;
  padding: 1% 5%;
  letter-spacing: 10px;
  margin: 0 auto;
}

// logo
.logo {
  margin-top: 55%;
  width: 550px;
  @include breakpoint(pc) {
    width: 450px;
  }

  @include breakpoint(mobile) {
    width: 320px;
  }
}
.logo_1 {
  width: 800px;
  position: absolute;
  left: 0; /* 將圖片靠左對齊 */
  top: 50%; /* 可根據需要調整垂直位置 */
  transform: translateY(-50%); /* 將圖片垂直置中 */
}
.parallax-section {
  position: relative;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden; /* 隐藏内容溢出 */
  background-size: cover; /* 背景图片始终覆盖整个section */
  background-position: center; /* 背景图片居中对齐 */
}

.parallax-content {
  text-align: center;
  // color: rgba(159, 159, 159, 0.363);
  position: relative; /* 确保内容在前景 */
  z-index: 1; /* 确保内容在前景 */
}

.parallax-content h1 {
  font-size: 3rem;
  margin-bottom: 1rem;
}

.parallax-content p {
  font-size: 1.5rem;
  margin-bottom: 2rem;
}

.parallax-content img {
  max-width: 100%;
  height: auto;
}

#section00 {
  background-image: url('/src/imgs/aboutImg/about_pc01.png');
  background-size: cover;
  /* background-attachment: fixed; 背景固定，不随页面滚动 */
}

#section0 {
  background-image: url('/src/imgs/aboutImg/mv-02.png');
  background-size: cover;
  background-attachment: fixed; /* 背景固定，不随页面滚动 */
}

#section1 {
  background-image: url('/src/imgs/aboutImg/about_pc02.png');
  background-size: cover;
  background-attachment: fixed; /* 背景固定，不随页面滚动 */
}

#section2 {
  background-image: url('/src/imgs/aboutImg/about_pc03.png');
  background-size: cover;
}

// 訂位
.reserve {
  // background: $negroni;
}
.pSection {
  position: relative;
  padding-top: 200px;
  /* padding-bottom: 300px; */
  display: flex;
  // background-color: #c7c7c768;
}
// .ps1 {
//   padding-top: 5%;
// }

.container {
  padding: 5%;
  width: 50%;
  margin: 0;
  margin: 0 0 auto 0; /* 左邊為0，右邊為auto */
  /* max-width: 1070px; */
  /* padding-left: 15%; */
  position: relative;
  z-index: 1;
}

.pContent {
  width: 65%;
  /* background-color: rgba(77, 37, 37, 0.116); */
  color: white;
  padding: 40px 60px;
}

.pImage {
  width: 70%;
  position: absolute;
  top: 0;
  right: 0;
  max-height: 900px;
}

/* 圖片 */
.img1 {
  width: 690px;
  top: 5%;
  right: 5%;
}

.img2 {
  width: 340px;
  top: 0;
  left: 5%;
  margin-top: -24%;
}

.img2-1 {
  width: 600px;
  top: 0;
  left: 16.5%;
  margin-top: 15%;
}

.img3 {
  width: 620px;
  top: 17%;
  right: 5%;
}

/* 文字 */
.text1 {
  width: 109%;
  margin-top: 8%;
  padding-left: 5%;
  font-size: 35px;
  h1 {
    font-family: $fontfamily-en2;
    // font-weight: bold;
    font-size: 55px;
  }
  h2 {
    font-family: $fontfamily;
    font-size: 70px;
    font-weight: bolder;
  }
}

.text1-1 {
  width: 63%;
  margin-top: 20%;
  margin-left: 51%;
  /* padding-left: 58%; */
  /* padding-right: 50%; */
  font-size: 30px;
}

.text2 {
  width: 70%;
  margin-top: -52%;
  margin-left: 112%;
  font-size: 30px;
}

.text3 {
  width: 96%;
  margin-top: 70%;
  padding-left: 18%;
  font-size: 30px;
}

// 緣由
.aboutBackground_2 {
  h1 {
    color: $whitelady;
    font-size: 102px;
    padding-bottom: 4%;
    font-weight: bold;
    @include breakpoint(mobile) {
      font-size: 75px;
    }
  }
  h3 {
    color: $whitelady;
    font-size: 32px;
    font-family: $fontfamily;
    line-height: 50px;
    width: 70%;

    margin: 0 auto;

    @include breakpoint(mobile) {
      font-size: 22px;
    }
  }

  p {
    color: $whitelady;
    text-align: center;
    font-size: 56px;
    font-family: $fontfamily-en2;
    padding-bottom: 2%;
    padding: 0 1%;
    @include breakpoint(pc) {
      font-size: 50px;
    }
    @include breakpoint(mobile) {
      font-size: 40px;
    }
  }
}

// 心理測驗
.aboutBackground_3 {
  // opacity: 0.9;
  text-align: center;
  background-position: bottom;
  .testbutton {
    margin-top: 3%;
  }
  .testbutton:hover {
    background-color: $ramos-gin-fizz;
  }
  h2 {
    color: $whitelady;
    text-align: center;
    font-size: 56px;
    font-family: $fontfamily-en2;
    padding-bottom: 2%;
    padding: 0 1%;
    @include breakpoint(pc) {
      font-size: 50px;
    }
    @include breakpoint(mobile) {
      font-size: 40px;
    }
  }
  h1 {
    color: $whitelady;
    font-size: 92px;
    font-family: $fontfamily;
    font-weight: bold;
    padding-bottom: 4%;
    @include breakpoint(mobile) {
      padding: 0 2%;
      font-size: 48px;
    }
  }
}

// map

.aboutBackground_4 {
  color: white;
  display: flex;
  flex-direction: column;
  text-align: left;
  padding: 0 5%;
  padding-top: 5%;
  justify-content: left;
  line-height: 50px;
  position: relative;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background-position: center center;
  background-size: cover;
  // border-radius: 10px;

  @include breakpoint(mobile) {
    height: 80vh;
  }
  h3 {
    font-size: 32px;
    font-family: $fontfamily;
    line-height: 50px;
    width: 70%;
    margin: 0;
    width: 100%;
    @include breakpoint(mobile) {
      font-size: 17px;
      // }
      // @include breakpoint(mobile2) {
      //   font-size: 20px;
      // }
    }
  }
  iframe {
    border-radius: 10px;
    @include breakpoint(pc) {
      // height: '480vh';
    }

    @include breakpoint(mobile) {
      // height: 300vh;
    }
  }
  div {
    width: 100%;
    padding: 3% 0;
    p {
      display: unset;
      text-align: left;
      justify-content: left;

      line-height: 50px;
    }
    img {
      padding-top: 3%;
      padding-right: 3%;
    }
  }
}
</style>
