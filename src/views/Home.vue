<template>
  <div data-scroll-container class="container">
    <div class="hero">
      <div data-scroll data-scroll-speed="3" class="copy">
        <!-- 第一段 -->
        <blockquote>
          <h2>in this city</h2>

          在這個城市裡，有一家餐酒館<br />名為「紙醉金迷」<br />它坐落在城市的中心<br />是城市的靈魂所在.....
        </blockquote>
      </div>
      <div class="image-wrapper">
        <img
          src="../imgs/aboutImg/bar-stools-cyberpunk-bar-cyberpunk-city-neons-cybercity-background-opposite-colors (1).jpg"
          alt=""
        />
      </div>
    </div>
    <!-- 第二段 -->
    <div class="section-0" data-scroll data-scroll-speed="2">
      <h2>wonderful journey</h2>

      <p data-scroll data-scroll-direction="horizontal" data-scroll-speed="-2">在這裡人們可以品嚐到世界各地的頂級美</p>
      <p data-scroll data-scroll-direction="horizontal" data-scroll-speed="2">
        它每一杯都是心靈的享受，每一口都是一段奇妙的旅程
      </p>
    </div>

    <div class="section-1">
      <div class="image-mask"></div>
    </div>
    <!-- 第三段 -->
    <div class="section-2">
      <div id="pinSection" class="pinned-quote">
        <h2>captivate Intoxica</h2>

        <blockquote data-scroll data-scroll-sticky data-scroll-target="#pinSection">
          墜落在酒色的夢境中<br />讓每位到訪者都能找到自己獨特的夢境
        </blockquote>
      </div>

      <div class="images-container">
        <img src="../imgs/aboutImg/bar-tender-sprays-cocktail-glass-garnished-with-flower.jpg" alt="" />
        <img src="../imgs/aboutImg/pexels-thongtran95-12099381-2.jpg" alt="" />
        <!-- <img src="../imgs/aboutImg/pexels-thongtran95-12099381.jpg" alt="" />
        <img src="../imgs/aboutImg/refreshing-citrus-cocktails-illuminate-summer-night-generated-by-ai2.jpg" alt="" /> -->
      </div>
    </div>
    <!-- 第四段 -->
    <div class="section-3">
      <div class="image-wrapper">
        <img
          src="../imgs/aboutImg/beer-mug-celebration-beer-beverage-light-colored-fire-celebration-concept-with-copy-space.jpg"
          alt=""
        />
      </div>
      <div class="copy">
        <blockquote data-scroll-speed="3" data-scroll>
          <h2>intoxicating dreams</h2>
          讓我們迷失在美酒與夜色中<br />享受這醉人的夢境.....
        </blockquote>
        <a class="testbutton" @click="handleClick('/reserve_first')">立即訂位</a>
      </div>
    </div>
  </div>
</template>

<script>
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
import LocomotiveScroll from 'locomotive-scroll'
import Typewriter from 'typewriter-effect/dist/core'

export default {
  methods: {
    handleClick(link) {
      this.onImage = this.offImage
      setTimeout(() => {
        this.$router.push(link)
      }, 300)
    }
  },
  mounted() {
    gsap.registerPlugin(ScrollTrigger)

    const scroller = new LocomotiveScroll({
      el: document.querySelector('[data-scroll-container]'),
      smooth: true
    })

    scroller.on('scroll', ScrollTrigger.update)

    ScrollTrigger.scrollerProxy('.container', {
      scrollTop(value) {
        return arguments.length ? scroller.scrollTo(value, 0, 0) : scroller.scroll.instance.scroll.y
      },
      getBoundingClientRect() {
        return { top: 0, left: 0, width: window.innerWidth, height: window.innerHeight }
      },
      pinType: document.querySelector('.container').style.transform ? 'transform' : 'fixed'
    })

    // 標題打字機效果
    const titles = document.querySelectorAll('h2')
    titles.forEach((title) => {
      new Typewriter(title, {
        strings: [title.textContent],
        autoStart: true,
        loop: true,
        delay: 200
      })
    })
    // const typewriterOptions = {
    //   loop: true,
    //   delay: 75,
    //   deleteSpeed: 50
    // }

    // document.querySelectorAll('h2').forEach((h2) => {
    //   new Typewriter(h2, typewriterOptions).typeString(h2.textContent).pauseFor(1000).deleteAll().start()
    // })

    // ScrollTrigger 停止 恢复 LocomotiveScroll
    ScrollTrigger.create({
      trigger: '.copy',
      scroller: '.container',
      start: 'top bottom',
      end: 'bottom top',
      onEnter: () => scroller.stop(),
      onLeave: () => scroller.start(),
      onEnterBack: () => scroller.stop(),
      onLeaveBack: () => scroller.start()
    })

    ScrollTrigger.addEventListener('refresh', () => scroller.update())
    ScrollTrigger.refresh()
  },
  beforeDestroy() {
    scroller.destroy()
    ScrollTrigger.getAll().forEach((trigger) => trigger.kill())
  }
}
</script>

<style lang="scss" scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: $fontfamily;
}

.container {
  // width: 100%;
  max-width: 100%;
  margin: 0 auto;
  background: $negroni;

  .hero {
    display: grid;
    grid-template-columns: 60% 40%;
    height: 100vh;

    .copy {
      display: grid;
      align-content: center;
      padding: 0 1rem;
      height: 100%;

      //第一段
      blockquote {
        font-family: $fontfamily;
        padding-left: 50px;
        color: $ramos-gin-fizz;
        font-size: $fontSize_h3;
        font-weight: 400;
        line-height: $lineheight;

        h2 {
          font-family: $fontfamily-en2;
          font-weight: 400;
          color: $irishcoffee;
        }
      }
    }

    .image-wrapper {
      height: 100vh;
      width: 100%;
      // border-radius: 100px;
      opacity: 0.6;

      img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        // border-radius: 25px;
        opacity: 0.6;
      }
    }
  }

  //第二段
  .section-0 {
    margin-top: 20vh;
    text-align: center;
    h2 {
      font-size: $fontSize_h3;
      font-family: $fontfamily-en2;
      color: $irishcoffee;
      font-weight: 400;
      @include breakpoint(820px) {
        font-size: 1.25rem;
        // text-align: center;
        margin: 0 auto;
      }
    }

    p {
      font-family: $fontfamily;
      padding-left: 50px;
      color: $ramos-gin-fizz;
      font-size: $fontSize_h3;
      font-weight: 400;
      line-height: $lineheight;

      @include breakpoint(820px) {
        font-size: 1.25rem;
        // text-align: center;
        // margin: 15px;
      }
    }
  }

  //第二段圖
  .section-1 {
    height: 100vh;
    display: grid;
    place-content: center;
    padding: 0 1rem;

    .image-mask {
      width: 80vw;
      height: 80vh;
      background: url('../imgs/aboutImg/bar1.png');
      // background-attachment: fixed;
      background-size: cover;
      background-position-x: 50%;
      background-position-y: 90%;
      background-size: 100%;
      border-radius: 25px;
      opacity: 0.4;

      img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        opacity: 0.4;
      }
    }

    blockquote {
      font-size: 9vmin;
      font-weight: 300;
    }
  }
  //第三段
  .section-2 {
    height: calc(90vh + 32px + 16px);
    display: grid;
    grid-template-columns: 1fr 2fr;
    grid-template-columns: 40% 60%;

    h2 {
      font-size: $fontSize_h3;
      font-family: $fontfamily-en2;
      color: $irishcoffee;
      font-weight: 400;
      padding-left: 50px;
    }
    blockquote {
      font-family: $fontfamily;
      padding-left: 50px;
      color: $ramos-gin-fizz;
      font-size: $fontSize_h3;
      font-weight: 400;
      line-height: $lineheight;
    }

    .images-container {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      padding: 0 10px;
      gap: 2px;
      margin-top: 16px;
      opacity: 0.4;

      img {
        width: 100%;
        max-height: 75vh;
        height: 100%;
        align-self: stretch;
        object-fit: cover;
        // border-radius: 25px;
      }
    }
  }
  // 第四段
  .section-3 {
    height: 100vh;
    display: grid;
    grid-template-columns: 40% 60%;
    position: relative;
    @include breakpoint(820px) {
      height: 50vh;
      // width: 50%;
    }

    .image-wrapper {
      height: 100%;
      width: 100%;
      opacity: 0.4;

      img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        @include breakpoint(820px) {
          height: 50%;
          // width: 50%;
        }
      }
    }

    .copy {
      font-size: 8vmin;
      height: 100vh;
      width: 100%;
      display: grid;
      align-content: center;
      @include breakpoint(820px) {
        align-content: normal;
      }

      blockquote {
        font-family: $fontfamily;
        padding-left: 50px;
        color: $ramos-gin-fizz;
        font-size: $fontSize_h3;
        font-weight: 400;
        line-height: $lineheight;
        h2 {
          font-family: $fontfamily-en2;
          font-weight: 400;
          color: $irishcoffee;
        }
      }
      .testbutton {
        display: block;
        background-color: bisque;
        width: 15vw;
        height: 8vh;
        border-radius: 50px;
        text-align: center;
        line-height: 8vh;
        text-decoration: none;

        margin-left: 50px;
        margin-top: 20px;
        font-family: $fontfamily;
        font-size: $fontSize_h4;
        font-weight: 800;
        color: $campari;

        @include breakpoint(820px) {
          display: none;
        }
      }
      .testbutton:hover {
        background-color: $irishcoffee;
        color: $ramos-gin-fizz;
      }
    }

    .copyright {
      position: absolute;
      bottom: 5%;
      left: 50%;
      font-size: 4vmin !important;
    }
  }
}
</style>
