<template>
  <main>
    <!-- logo-->
    <section class="parallax-section" id="section00">
      <!-- <img class="logo_1" src="/src/imgs/aboutImg/white-dream-illust-left-sp.png" alt="" /> -->

      <div class="parallax-content">
        <img class="logo" src="/src/imgs/logo/logo-w.png" alt="" />
      </div>
    </section>

    <!-- 訂位 -->
    <!-- 1 -->
    <section class="reserve">
      <section class="pSection ps1">
        <div class="container">
          <div class="pContent text1">
            <h1>Fredericka the Great</h1>
            <h2>紙醉金迷</h2>
          </div>
          <div class="pContent text1-1">
            <p>「紙醉金迷」以浪漫、神秘的氛圍和美酒品味為主題</p>
          </div>
        </div>

        <img
          class="pImage img1"
          src="/src/imgs/aboutImg/bar-stools-cyberpunk-bar-cyberpunk-city-neons-cybercity-background-opposite-colors.jpg"
          alt="Filler image"
        />
      </section>

      <!-- 2 -->
      <section class="pSection ps2">
        <div class="container cont2">
          <div class="pContent text2">
            <p>提供來自世界各地的頂級美酒和美食，以專業的服務，營造出愉悅的用餐體驗</p>
          </div>
        </div>

        <img
          class="pImage img2"
          src="/src/imgs/aboutImg/bar-tender-sprays-cocktail-glass-garnished-with-flower.jpg"
          alt="Filler image"
        />

        <img class="pImage img2-1" src="/src/imgs/aboutImg/about_pc02.png" alt="Filler image" />
      </section>

      <!-- 3 -->
      <section class="pSection ps3">
        <div class="container">
          <div class="pContent text3">
            <p class="t3">無論是與摯愛共度浪漫之夜，還是與好友聚會，「紙醉金迷」都是您的理想選擇</p>
            <button class="testbutton" @click="reservePage">立即訂位</button>
          </div>
        </div>
        <img
          class="pImage img3"
          src="/src/imgs/aboutImg/beer-mug-celebration-beer-beverage-light-colored-fire-celebration-concept-with-copy-space.jpg"
          alt="Filler image"
        />
      </section>
      <!-- <button class="testbutton_mobile" @click="testPage">立即訂位</button> -->
    </section>

    <!-- 緣由 -->
    <section class="parallax-section 4 aboutBackground_2" id="section1">
      <div class="parallax-content">
        <p>Fredericka the Great</p>
        <h1>探索紙醉金迷的美酒世界</h1>
        <h3>
          &darr;
          <!-- ↓ -->
        </h3>
      </div>
    </section>

    <!-- 商品 -->
    <article id="content" class="site-content" role="section">
      <article id="panels">
        <div id="panels-container" style="width: 300%">
          <article id="panel-1" class="panel full-screen red">
            <div class="container">
              <div class="row">
                <div class="col-6">
                  <img class="product_img1" src="/src/imgs/aboutImg/pexels-pixabay-159291.jpg" alt="" />
                  <img class="product_img2" src="/src/imgs/aboutImg/pexels-amar-16068126.jpg" alt="" />
                </div>
                <div class="col-6 d-flex flex-column">
                  <p class="product_text1">每一款都由專業品酒師挑選，帶給您卓越的品味體驗</p>
                  <p class="product_text1-1">
                    「紙醉金迷」專為品酒愛好者設計，提供濃郁的紅酒、清新的白酒和獨特的氣泡酒，以精緻的選品和卓越的品質聞名
                  </p>
                </div>
              </div>
            </div>
          </article>

          <article id="panel-2" class="panel full-screen orange">
            <div class="container">
              <div class="row">
                <div class="col-6">
                  <img class="product_img3" src="/src/imgs/aboutImg/pexels-ionelceban-2580989.jpg" alt="" />
                  <img
                    class="product_img4"
                    src="/src/imgs/aboutImg/pexels-photography-maghradze-ph-1659410-3960492.jpg"
                    alt=""
                  />
                </div>
                <div class="col-6 d-flex flex-column">
                  <p class="product_text2-0">
                    氣泡酒系列則以其令人陶醉的氣泡和清新怡人的口感聞名，為每一個特別時刻增添了活力和閃耀的氣息
                  </p>
                  <p class="product_text2">豐富的口感和多層次的香氣，感受著自然和酒莊工藝的融合</p>
                  <p class="product_text2-1">每一口都為您呈現來自大自然的豐富恩賜和釀酒師的匠心獨具，滿足不同口味的挑剔要求</p>
                </div>
              </div>
            </div>
          </article>

          <article id="panel-3" class="panel full-screen purple">
            <div class="container">
              <div class="row">
                <div class="col-6">
                  <img class="product_img5" src="/src/imgs/aboutImg/pexels-isabella-mendes-107313-340996.jpg" alt="" />
                  <img class="product_img6" src="/src/imgs/aboutImg/pexels-jerome031-5185740.jpg" alt="" />
                  <img class="product_img7" src="/src/imgs/aboutImg/pexels-thongtran95-12099381.jpg" alt="" />
                </div>
                <div class="col-6 d-flex flex-column">
                  <p class="product_text3">立即瀏覽我們的精選美酒，為您挑選了最佳的佳釀，期待與您分享每一瓶背後的故事和風味</p>
                  <p class="product_text3-1">任何珍貴的時刻，都能帶來無與倫比的酒類體驗</p>
                  <button class="testbutton" @click="productPage">選購商品</button>
                </div>
              </div>
            </div>
          </article>
        </div>
      </article>
    </article>

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

    // 商品
    let panelsSection = document.querySelector('#panels'),
      panelsContainer = document.querySelector('#panels-container'),
      tween
    document.querySelectorAll('.anchor').forEach((anchor) => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault()
        let targetElem = document.querySelector(e.target.getAttribute('href')),
          y = targetElem
        if (targetElem && panelsContainer.isSameNode(targetElem.parentElement)) {
          let totalScroll = tween.scrollTrigger.end - tween.scrollTrigger.start,
            totalMovement = (panels.length - 1) * targetElem.offsetWidth
          y = Math.round(tween.scrollTrigger.start + (targetElem.offsetLeft / totalMovement) * totalScroll)
        }
        gsap.to(window, {
          scrollTo: {
            y: y,
            autoKill: false
          },
          duration: 1
        })
      })
    })

    /* Panels */
    const panels = gsap.utils.toArray('#panels-container .panel')
    tween = gsap.to(panels, {
      // xPercent: -100 * ( panels.length - 1 ),
      x: () => -1 * (panelsContainer.scrollWidth - innerWidth),
      ease: 'none',
      scrollTrigger: {
        trigger: '#panels-container',
        pin: true,
        start: 'top top',
        scrub: 1,

        end: () => '+=' + (panelsContainer.scrollWidth - innerWidth)
      }
    })

    this.initScrollTriggers()
  },
  methods: {
    initScrollTriggers() {
      // logo
      // gsap.from('.logo_1', {
      //   xPercent: -5,
      //   duration: 1.5,
      //   ease: 'power1.out'
      // })

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
      // gsap.fromTo(
      //   '#section0 .parallax-content',
      //   { yPercent: 0 },
      //   {
      //     yPercent: -20,
      //     ease: 'power1.inOut',
      //     scrollTrigger: {
      //       trigger: '#section0',
      //       start: 'top center',
      //       end: 'bottom top',
      //       scrub: 1
      //     }
      //   }
      // )

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

      gsap.to('.img1', {
        y: -150,
        ease: 'none', // 不使用任何緩動效果，保持線性
        scrollTrigger: {
          trigger: '.ps1',

          scrub: 1
        }
      })

      gsap.to('.text1', {
        yPercent: -100,
        ease: 'ease',
        scrollTrigger: {
          trigger: '.pSection',
          // start: "top bottom", // the default values
          // end: "bottom top",
          scrub: true,
          scrub: 0.8
        }
      })

      gsap.to('.text1-1', {
        yPercent: -120,
        ease: 'power2.out',
        scrollTrigger: {
          trigger: '.pSection',
          // start: "top bottom", // the default values
          // end: "bottom top",
          scrub: true,
          scrub: 1
        }
      })

      gsap.to('.img2', {
        y: -150,
        ease: 'power1.inOut', // 不使用任何緩動效果，保持線性
        scrollTrigger: {
          trigger: '.pSection',

          scrub: 0.3
        }
      })

      gsap.to('.img2-1', {
        y: -200,
        ease: 'none', // 不使用任何緩動效果，保持線性
        scrollTrigger: {
          trigger: '.ps2',

          scrub: 1
        }
      })

      gsap.to('.text2', {
        yPercent: -120,
        ease: 'power1.inOut',
        scrollTrigger: {
          trigger: '.pSection',
          // start: "top bottom", // the default values
          // end: "bottom top",
          scrub: true,
          scrub: 0.6
        }
      })

      gsap.to('.img3', {
        y: -250,
        ease: 'none', // 不使用任何緩動效果，保持線性
        scrollTrigger: {
          trigger: '.ps3',

          scrub: 1
        }
      })

      gsap.to('.text3', {
        y: -250,
        ease: 'none', // 不使用任何緩動效果，保持線性
        scrollTrigger: {
          trigger: '.ps3',

          scrub: 1
        }
      })
    },

    // 心理測驗
    testPage() {
      this.$router.push('/quizgame')
    },
    productPage() {
      this.$router.push('/product')
    },
    reservePage() {
      this.$router.push('/reserve_first')
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
  @if $point == pc1 {
    @media (max-width: 1400px) {
      @content;
    }
  }
  @if $point == pc {
    @media (max-width: 1280px) {
      @content;
    }
  }
  @if $point == pc0 {
    @media (max-width: 1100px) {
      @content;
    }
  }
  @if $point == pc10 {
    @media (max-width: 1000px) {
      @content;
    }
  }
  @if $point == pc9 {
    @media (max-width: 900px) {
      @content;
    }
  } @else if $point == mobile {
    @media (max-width: 768px) {
      @content;
    }
  } @else if $point == mobile2 {
    @media (max-width: 650px) {
      @content;
    }
  } @else if $point == mobile3 {
    @media (max-width: 550px) {
      @content;
    }
  } @else if $point == mobile4 {
    @media (max-width: 500px) {
      @content;
    }
  } @else if $point == mobile5 {
    @media (max-width: 450px) {
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
  overflow-x: hidden;
}
main {
  font-family: $fontfamily;
  text-align: center;
  // background: $negroni;
  background: $negroni;
  p {
    line-height: 150%;
  }
}

button {
  background-color: transparent;
  border-color: $irishcoffee;
  color: $irishcoffee;
  border-radius: 84px;
  font-size: 62px;
  padding: 3% 5%;
  letter-spacing: 10px;
  margin: 0 auto;
}
h1 {
  line-height: 150%;
}
h2 {
  margin-bottom: 4%;
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

// #section0 {
//   background-image: url('/src/imgs/aboutImg/mv-02.png');
//   background-size: cover;
//   background-attachment: fixed; /* 背景固定，不随页面滚动 */
// }

#section1 {
  background-image: url('/src/imgs/aboutImg/bar1.png');
  background-size: cover;
  background-attachment: fixed; /* 背景固定，不随页面滚动 */
}

#section2 {
  background-image: url('/src/imgs/aboutImg/about_pc03.png');
  background-size: cover;
}

// 訂位
.reserve {
  background-image: url(/src/imgs/aboutImg/pexels-george-desipris-736188.jpg);
  background-repeat: no-repeat;
  background-size: cover;

  background-position: center;
  color: $whitelady;
  height: 2150px;
  @include breakpoint(pc10) {
    height: 1900px;
  }
  @include breakpoint(pc9) {
    height: 1750px;
  }
  @include breakpoint(mobile) {
    height: 1550px;
  }
  @include breakpoint(mobile2) {
    height: 1300px;
  }
  @include breakpoint(mobile3) {
    height: 1100px;
  }
}
.pSection {
  position: relative;
  padding-top: 200px;
  /* padding-bottom: 300px; */
  display: flex;
  // background-color: #c7c7c768;
  .testbutton {
    margin-top: 3%;
    width: 30%;
    margin-left: -22%;
    width: 140%;

    @include breakpoint(pc10) {
      font-size: 52px;
    }
    @include breakpoint(pc9) {
      font-size: 40px;
    }
    @include breakpoint(mobile) {
      font-size: 33px;
    }
    @include breakpoint(mobile2) {
      font-size: 30px;
    }
    @include breakpoint(mobile3) {
      font-size: 24px;
      width: 121%;
      margin-left: -12%;
    }
    @include breakpoint(mobile4) {
      font-size: 62px;
      margin: 0 auto;
      margin-left: 32%;
      margin-top: 76%;
      width: 283%;
    }

    @include breakpoint(mobile5) {
      padding: 16% 0;
    }
  }
  .testbutton:hover {
    background-color: $ramos-gin-fizz;
  }
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
  color: $whitelady;
  padding: 40px 60px;
  @include breakpoint(mobile3) {
    padding: 40px 10px;
  }
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
  width: 670px;
  top: 10%;
  right: 5%;
  @include breakpoint(pc) {
    width: 630px;
    right: 3%;
  }
  @include breakpoint(pc0) {
    width: 590px;
    // right: 2%;
  }
  @include breakpoint(pc10) {
    width: 540px;
  }
  @include breakpoint(pc9) {
    width: 490px;
  }
  @include breakpoint(mobile) {
    width: 420px;
  }
  @include breakpoint(mobile2) {
    width: 360px;
  }
  @include breakpoint(mobile3) {
    width: 300px;
  }
  @include breakpoint(mobile4) {
    width: 260px;
  }
}

.img2 {
  width: 340px;
  top: 0;
  left: 5%;
  margin-top: -24%;
  @include breakpoint(pc) {
    width: 310px;
  }
  @include breakpoint(pc0) {
    width: 270px;
  }
  @include breakpoint(pc10) {
    width: 220px;
  }
  @include breakpoint(pc9) {
    width: 180px;
  }
  @include breakpoint(mobile) {
    margin-top: -29%;
  }
  @include breakpoint(mobile2) {
    width: 160px;
  }
  @include breakpoint(mobile3) {
    width: 140px;
  }
  @include breakpoint(mobile4) {
    width: 130px;
  }
}

.img2-1 {
  width: 600px;
  top: 0;
  left: 16.5%;
  margin-top: 0%;
  @include breakpoint(pc) {
    width: 570px;
  }
  @include breakpoint(pc0) {
    width: 530px;
  }
  @include breakpoint(pc10) {
    width: 480px;
    margin-top: -1%;
  }
  @include breakpoint(pc9) {
    width: 440px;
    margin-top: -4%;
  }
  @include breakpoint(mobile) {
    width: 370px;
    margin-top: -9%;
  }
  @include breakpoint(mobile2) {
    width: 310px;
  }
  @include breakpoint(mobile3) {
    width: 270px;
  }
  @include breakpoint(mobile4) {
    width: 250px;
  }
}

.img3 {
  width: 620px;
  top: 8%;
  right: 5%;
  @include breakpoint(pc) {
    width: 590px;
  }
  @include breakpoint(pc0) {
    width: 550px;
  }
  @include breakpoint(pc10) {
    width: 500px;
    top: 0%;
  }
  @include breakpoint(pc9) {
    width: 460px;
  }
  @include breakpoint(mobile) {
    width: 410px;
    top: -16%;
  }
  @include breakpoint(mobile2) {
    width: 350px;
  }
  @include breakpoint(mobile3) {
    width: 310px;
    top: -23%;
  }
  @include breakpoint(mobile4) {
    width: 270px;
    top: -20%;
  }
  @include breakpoint(mobile5) {
    width: 260px;
    right: 3%;
  }
}

/* 文字 */
.text1 {
  width: 109%;
  margin-top: 8%;
  padding-left: 5%;
  font-size: 35px;
  @include breakpoint(pc1) {
    padding-left: 0%;
    margin-left: -13%;
  }
  @include breakpoint(pc0) {
    margin-top: 5%;
  }
  @include breakpoint(mobile) {
    margin-left: -10%;
  }
  @include breakpoint(mobile2) {
    margin-top: -11%;
  }
  @include breakpoint(mobile3) {
    margin-top: -49%;
    width: 111%;
  }
  @include breakpoint(mobile5) {
    margin-top: -61%;
    width: 106%;
  }
  h1 {
    font-family: $fontfamily-en2;
    // font-weight: bold;
    font-size: 55px;
    @include breakpoint(pc) {
      font-size: 50px;
    }
    @include breakpoint(pc10) {
      font-size: 39px;
    }
    @include breakpoint(pc9) {
      font-size: 32px;
    }
    @include breakpoint(mobile) {
      font-size: 27px;
    }
    @include breakpoint(mobile2) {
      font-size: 24px;
    }
  }
  h2 {
    font-family: $fontfamily;
    font-size: 70px;
    font-weight: bolder;
    @include breakpoint(pc) {
      font-size: 65px;
    }
    @include breakpoint(pc10) {
      font-size: 59px;
    }
    @include breakpoint(pc9) {
      font-size: 52px;
    }
    @include breakpoint(mobile) {
      font-size: 47px;
    }
    @include breakpoint(mobile2) {
      font-size: 40px;
    }
    @include breakpoint(mobile5) {
      font-size: 38px;
    }
  }
}

.text1-1 {
  width: 63%;
  margin-top: 20%;
  margin-left: 51%;

  font-size: 30px;
  @include breakpoint(pc1) {
    margin-left: 43%;
  }
  @include breakpoint(pc) {
    font-size: 27px;
    margin-top: 24%;
  }
  @include breakpoint(pc0) {
    margin-left: 35%;
    margin-top: 29%;
  }
  @include breakpoint(pc10) {
    width: 74%;
    font-size: 23px;
    margin-left: 46%;
    margin-top: 51%;
  }
  @include breakpoint(pc9) {
    width: 85%;
    font-size: 19px;
    margin-top: 54%;
  }
  @include breakpoint(mobile) {
    margin-top: 39%;
  }
  @include breakpoint(mobile2) {
    width: 100%;
    margin-top: 5%;
    font-size: 17px;
  }
  @include breakpoint(mobile3) {
    width: 129%;
    margin-top: 31%;
  }
  @include breakpoint(mobile4) {
    width: 99%;
  }
  @include breakpoint(mobile5) {
    width: 117%;
  }
}

.text2 {
  width: 70%;
  margin-top: -52%;
  margin-left: 112%;
  font-size: 30px;
  @include breakpoint(pc) {
    margin-left: 139%;
    font-size: 27px;
  }
  @include breakpoint(pc10) {
    width: 85%;
    margin-top: -61%;
    margin-left: 142%;
    font-size: 23px;
  }
  @include breakpoint(pc9) {
    font-size: 19px;
    margin-top: -88%;
    margin-left: 147%;
  }
  @include breakpoint(mobile) {
    width: 97%;
    margin-left: 137%;
    margin-top: -93%;
  }
  @include breakpoint(mobile2) {
    width: 111%;
    margin-left: 120%;
    margin-top: -97%;
    font-size: 17px;
  }
  @include breakpoint(mobile3) {
    margin-top: -116%;
    margin-left: 131%;
    width: 93%;
  }
  @include breakpoint(mobile3) {
    margin-left: 110%;
    width: 127%;
  }
  @include breakpoint(mobile4) {
    margin-left: 128%;
    margin-top: -144%;
    width: 104%;
  }
  @include breakpoint(mobile5) {
    margin-left: 112%;
    margin-top: -150%;
    width: 112%;
  }
}

.text3 {
  width: 96%;
  margin-top: 67%;
  // margin-top: 15%;
  padding-left: 18%;
  font-size: 30px;
  @include breakpoint(pc) {
    margin-top: 72%;
    font-size: 27px;
  }
  @include breakpoint(pc0) {
    margin-top: 84%;
    margin-left: -8%;
  }
  @include breakpoint(pc10) {
    margin-top: 62%;
    font-size: 23px;
  }
  @include breakpoint(pc9) {
    font-size: 19px;
  }
  @include breakpoint(mobile) {
    margin-top: 23%;
    margin-left: -13%;
  }
  @include breakpoint(mobile2) {
    margin-top: 11%;
    width: 104%;
    font-size: 17px;
  }
  @include breakpoint(mobile3) {
    width: 96%;
    margin-top: -7%;
    margin-left: -22%;
  }
  @include breakpoint(mobile4) {
    width: 104%;
    margin-top: 48%;
    margin-left: -21%;
  }
  @include breakpoint(mobile4) {
    width: 93%;
    margin-top: 56%;
    margin-left: -26%;
  }
  @include breakpoint(mobile5) {
    margin-top: 44%;
  }
}

// 緣由
.aboutBackground_2 {
  p {
    text-shadow: 3px -1px 0 #090909, 1px -1px 0 #090909, -1px 1px 0 #090909, 3px 1px 0 #090909;
  }
  h1 {
    color: $whitelady;
    font-size: 102px;
    padding-bottom: 4%;
    font-weight: bold;
    text-shadow: 3px -1px 0 #090909, 1px -1px 0 #090909, -1px 1px 0 #090909, 3px 1px 0 #090909;
    @include breakpoint(mobile) {
      font-size: 75px;
    }
    @include breakpoint(mobile5) {
      font-size: 61px;
      margin-bottom: 20%;
    }
  }
  h3 {
    color: $whitelady;
    font-size: 89px;

    font-family: $fontfamily;
    line-height: 50px;
    width: 70%;
    margin: 0 auto;
    margin-top: 0%;
    text-shadow: 3px -1px 0 #090909, 1px -1px 0 #090909, -1px 1px 0 #090909, 3px 1px 0 #090909;
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
    margin-top: 5%;
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
  color: $whitelady;
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

// 商品

.full-screen {
  display: block;
  width: 100%;
  height: 100vh;
  overflow: hidden;
  overflow-x: hidden; /* 禁止水平滚动条 */
  overflow-y: hidden; /* 禁止水平滚动条 */
}

#intro {
  display: flex;
  flex-direction: column;
  justify-content: center;
  overflow-x: hidden; /* 禁止水平滚动条 */
  overflow-y: hidden; /* 禁止水平滚动条 */
}

#masthead {
  position: fixed;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  z-index: 9999;
  overflow-x: hidden; /* 禁止水平滚动条 */
  overflow-y: hidden; /* 禁止水平滚动条 */
}

#panels {
  overflow-x: hidden; /* 禁止水平滚动条 */
  background: $negroni;
  font-size: 25px;
  @include breakpoint(pc10) {
    font-size: 22px;
  }
  @include breakpoint(mobile2) {
    font-size: 19px;
  }
  @include breakpoint(mobile2) {
    font-size: 17px;
  }
  .testbutton {
    margin-top: -61%;
    margin-left: 23%;
    width: 134%;
    padding: 7% 0;
    @include breakpoint(pc) {
      width: 140%;
      margin-top: -39%;
    }
    @include breakpoint(pc0) {
      width: 150%;
      margin-left: 13%;
    }
    @include breakpoint(pc10) {
      width: 197%;
      margin-left: -53%;
      margin-top: 16%;
      font-size: 52px;
    }
    @include breakpoint(mobile) {
      margin-left: -67%;
      font-size: 48px;
    }
    @include breakpoint(mobile2) {
      width: 209%;
      margin-top: 62%;
      margin-left: -100%;
    }
    @include breakpoint(mobile3) {
      width: 219%;
      margin-top: 119%;
      margin-left: -117%;
      font-size: 42px;
    }
    @include breakpoint(mobile4) {
      width: 268%;
      margin-top: 21%;
      margin-left: -18%;
      font-size: 42px;
    }
    @include breakpoint(mobile5) {
      width: 401%;
      margin-top: 85%;
      margin-left: -82%;
      font-size: 52px;
      padding: 22% 0;
    }
  }
  .testbutton:hover {
    background-color: $ramos-gin-fizz;
  }
}
#panels-container {
  overflow-x: hidden; /* 禁止水平滚动条 */
  overflow-y: hidden; /* 禁止水平滚动条 */
}

#panels #panels-container {
  height: 100vh;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: nowrap;
  flex-wrap: nowrap;
  padding: 0;
  overflow: hidden;
  // background-color: $whitelady;
  overflow-x: hidden; /* 禁止水平滚动条 */
  overflow-y: hidden; /* 禁止水平滚动条 */
}
#panels #panels-container .panel {
  position: relative;
  width: 100%;
  height: 100vh;
  // overflow: hidden;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  color: $whitelady;
  text-align: left;
  overflow-x: hidden; /* 禁止水平滚动条 */
  // border-right: 1px solid #f00;
  overflow-y: hidden; /* 禁止水平滚动条 */
}
#panels #panels-container .panel img {
  // max-width: 100%;
  // width: 100%;
  height: auto;
  // display: block;
  overflow-x: hidden; /* 禁止水平滚动条 */
  overflow-y: hidden; /* 禁止水平滚动条 */
}
#panels #panels-container .panel .panels-navigation {
  width: 100%;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  overflow-x: hidden; /* 禁止水平滚动条 */
  // -webkit-box-pack: end;
  // -ms-flex-pack: end;
  // justify-content: flex-end;
  overflow-y: hidden; /* 禁止水平滚动条 */
}
#panels #panels-container .panel .anchor-panel,
#panels #panels-container .panel .nav-panel {
  color: #000;
  text-transform: uppercase;
  margin-right: 2rem;
}
#panels #panels-container .panels-navigation {
  position: absolute;
  width: 100%;
  bottom: 2rem;
  right: 2rem;
}

// 圖片
.product_img1 {
  // background-attachment: fixed; /* 背景固定，不随页面滚动 */
  width: 630px;
  padding-top: 15%;
  margin-left: 31%;
  @include breakpoint(pc) {
    margin-left: 15%;
  }
  @include breakpoint(pc0) {
    width: 610px;
  }
  @include breakpoint(pc10) {
    width: 590px;
    margin-left: 0%;
  }
  @include breakpoint(pc9) {
    width: 560px;
  }
  @include breakpoint(mobile) {
    width: 455px;
  }
  @include breakpoint(mobile2) {
    width: 415px;
  }
  @include breakpoint(mobile3) {
    width: 375px;
  }
  @include breakpoint(mobile4) {
    width: 320px;
  }
  @include breakpoint(mobile5) {
    width: 300px;
    margin-top: 85%;
  }
}
.product_img2 {
  width: 310px;
  margin-top: -97%;
  margin-left: 304%;
  @include breakpoint(pc1) {
    width: 295px;
    margin-top: -103%;
  }
  @include breakpoint(pc) {
    margin-left: 334%;
    margin-top: -116%;
  }
  @include breakpoint(pc0) {
    width: 275px;
  }
  @include breakpoint(pc10) {
    width: 255px;
    margin-left: 333%;
    margin-top: -73%;
  }
  @include breakpoint(pc9) {
    width: 235px;
    margin-top: -59%;
  }
  @include breakpoint(mobile) {
    width: 235px;
    margin-top: -28%;
    margin-left: 320%;
  }
  @include breakpoint(mobile2) {
    width: 205px;
    margin-top: 36%;
    margin-left: 312%;
  }
  @include breakpoint(mobile3) {
    width: 215px;
    margin-top: 85%;
    margin-left: 243%;
  }
  @include breakpoint(mobile4) {
    width: 205px;
    margin-top: 145%;
    margin-left: 199%;
  }
  @include breakpoint(mobile5) {
    width: 220px;
    margin-top: 293%;
    margin-left: 199%;
  }
}
.product_img3 {
  width: 310px;
  margin-top: 16%;
  @include breakpoint(pc0) {
    width: 290px;
  }
  @include breakpoint(pc10) {
    width: 270px;
    margin-top: 32%;
  }
  @include breakpoint(mobile2) {
    width: 240px;
    margin-top: 62%;
    margin-left: 22%;
  }
  @include breakpoint(mobile4) {
    width: 220px;
    margin-top: 93%;
    margin-left: 1%;
  }
  @include breakpoint(mobile5) {
    width: 240px;
    margin-top: 174%;
    margin-left: 22%;
  }
}
.product_img4 {
  width: 460px;
  margin-top: 5%;
  margin-left: 243%;
  @include breakpoint(pc0) {
    width: 440px;
  }
  @include breakpoint(pc10) {
    width: 420px;
    margin-top: 45%;
  }
  @include breakpoint(mobile2) {
    width: 380px;
    margin-top: 97%;
    margin-left: 148%;
  }
  @include breakpoint(mobile3) {
    width: 360px;
    margin-top: 162%;
    margin-left: 122%;
  }
  @include breakpoint(mobile4) {
    width: 310px;
    margin-top: 275%;
    margin-left: 78%;
  }
  @include breakpoint(mobile5) {
    width: 340px;
    margin-top: 291%;
    margin-left: 60%;
  }
}
.product_img5 {
  width: 340px;
  margin-top: 47%;
  margin-left: -17%;
  @include breakpoint(pc0) {
    width: 320px;
  }
  @include breakpoint(pc10) {
    width: 300px;
  }
  @include breakpoint(mobile2) {
    width: 290px;
    margin-top: 30%;
    margin-left: -12%;
  }
  @include breakpoint(mobile3) {
    width: 270px;
    margin-top: 46%;
    margin-left: -12%;
  }
  @include breakpoint(mobile5) {
    width: 270px;
    margin-top: 141%;
    margin-left: -12%;
  }
}
.product_img6 {
  width: 375px;
  margin-top: -110%;
  margin-left: 265%;
  @include breakpoint(pc) {
    margin-top: -127%;
  }
  @include breakpoint(pc0) {
    width: 355px;
  }
  @include breakpoint(pc10) {
    width: 340px;
    margin-top: -108%;
  }
  @include breakpoint(mobile) {
    width: 285px;
    margin-left: 242%;
  }
  @include breakpoint(mobile2) {
    width: 268px;
    margin-top: 24%;
    margin-left: 212%;
  }
  @include breakpoint(mobile3) {
    width: 239px;
    margin-top: 71%;
    margin-left: 200%;
  }
  @include breakpoint(mobile4) {
    display: none;
  }
}
.product_img7 {
  display: none;
  @include breakpoint(mobile4) {
    display: block;
    width: 340px;
    margin-top: 208%;
    margin-left: 23%;
  }
  @include breakpoint(mobile5) {
    margin-top: 361%;
  }
}
// 文字
.product_text1 {
  width: 121%;
  padding-top: 22%;
  margin-left: 220%;
  @include breakpoint(pc1) {
    width: 170%;
    margin-left: 202%;
  }
  @include breakpoint(pc) {
    margin-left: 220%;
    width: 140%;
  }
  @include breakpoint(pc10) {
    width: 130%;
    margin-left: 239%;
    padding-top: 52%;
  }
  @include breakpoint(mobile2) {
    margin-left: 253%;
  }
  @include breakpoint(mobile3) {
    width: 220%;
    margin-left: 160%;
    padding-top: 260%;
  }
  @include breakpoint(mobile4) {
    width: 220%;
    margin-left: 145%;
    padding-top: 289%;
  }
  @include breakpoint(mobile5) {
    width: 235%;
    margin-left: 103%;
    padding-top: 352%;
  }
}
.product_text1-1 {
  width: 162%;
  padding-top: 124%;
  margin-left: 15%;
  @include breakpoint(pc1) {
    padding-top: 150%;
  }
  @include breakpoint(pc) {
    margin-left: -12%;
  }
  @include breakpoint(pc0) {
    width: 222%;
    margin-left: -33%;
    padding-top: 124%;
  }
  @include breakpoint(pc9) {
    margin-left: -49%;
    padding-top: 149%;
  }
  @include breakpoint(mobile2) {
    margin-left: -36%;
    padding-top: 179%;
  }
  @include breakpoint(mobile3) {
    width: 127%;
    margin-left: -4%;
    padding-top: 41%;
  }
  @include breakpoint(mobile4) {
    width: 127%;
    margin-left: -51%;
    padding-top: 42%;
  }
  @include breakpoint(mobile5) {
    width: 255%;
    margin-left: -29%;
    padding-top: 40%;
  }
}
.product_text2 {
  width: 129%;
  padding-top: 24%;
  margin-left: -76%;
  @include breakpoint(pc10) {
    padding-top: -4%;
  }
  @include breakpoint(mobile2) {
    width: 212%;
    padding-top: 104%;
    margin-left: 138%;
  }
  @include breakpoint(mobile3) {
    width: 212%;
    padding-top: 131%;
    margin-left: 168%;
  }
  @include breakpoint(mobile4) {
    width: 189%;
    padding-top: 271%;
    margin-left: 109%;
  }
  @include breakpoint(mobile5) {
    width: 298%;
    padding-top: 379%;
    margin-left: 51%;
  }
}
.product_text2-1 {
  width: 170%;
  padding-top: 22%;
  margin-left: -29%;
  @include breakpoint(pc1) {
    padding-top: 34%;
    margin-left: -40%;
  }
  @include breakpoint(mobile2) {
    width: 312%;
    padding-top: 86%;
    margin-left: -40%;
  }
  @include breakpoint(mobile3) {
    width: 253%;
    padding-top: 86%;
    margin-left: -40%;
  }
  @include breakpoint(mobile4) {
    width: 240%;
    padding-top: 60%;
    margin-left: -118%;
  }
  @include breakpoint(mobile5) {
    width: 295%;
    padding-top: 80%;
    margin-left: -75%;
  }
}
.product_text2-0 {
  width: 190%;
  padding-top: 43%;
  margin-left: 162%;
  @include breakpoint(pc10) {
    padding-top: 94%;
    margin-left: 153%;
  }
  @include breakpoint(mobile2) {
    display: none;
  }
}
.product_text3 {
  width: 94%;
  padding-top: 32%;
  margin-left: 50%;
  @include breakpoint(pc1) {
    margin-left: 46%;
  }
  @include breakpoint(pc) {
    margin-top: 44%;
    margin-left: 53%;
  }
  @include breakpoint(pc10) {
    width: 165%;
    margin-top: 141%;
    margin-left: -83%;
  }
  @include breakpoint(mobile) {
    margin-top: 181%;
  }
  @include breakpoint(mobile2) {
    width: 123%;
    margin-top: 200%;
    margin-left: -53%;
  }
  @include breakpoint(mobile4) {
    width: 291%;
    margin-top: 220%;
    margin-left: -34%;
  }
  @include breakpoint(mobile5) {
    width: 291%;
    margin-top: 343%;
    margin-left: -34%;
  }
}
.product_text3-1 {
  width: 113%;
  padding-top: 51%;
  margin-left: -113%;
  @include breakpoint(pc) {
    padding-top: 0%;
  }
  @include breakpoint(pc10) {
    display: none;
  }
}
article {
  overflow-y: hidden; /* 禁止水平滚动条 */
}
</style>
