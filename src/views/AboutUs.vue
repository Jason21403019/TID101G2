<template>
  <main class="wrapper">
    <!-- logo -->
    <section :id="about_logo" ref="section1" class="aboutBackground_1">
      <img class="logo-w" :src="logoSrc" alt="" />
    </section>

    <!-- 緣由 -->
    <section ref="section2" class="aboutBackground_2">
      <span>
        <p>{{ englishText }}</p>
        <h1>{{ title1 }}</h1>
        <h3 v-html="content"></h3>
      </span>
    </section>
    <!-- <p class="paragraph">{{ englishText }}</p> -->
    <!-- 跳轉心理測驗 -->
    <section ref="section3" class="aboutBackground_3">
      <span>
        <p>{{ englishText }}</p>
        <h2>{{ title2 }}</h2>
        <button class="testbutton" @click="testPage">{{ buttonText }}</button>
      </span>
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
        <h3>{{ businessHours }}</h3>
        <h3>{{ email }}</h3>
        <h3>{{ phone }}</h3>
        <h3>{{ address }}</h3>

        <a href="https://www.facebook.com/TibaMe/?locale=zh_TW"><img src="../imgs/aboutImg/facebook.png" alt="" /></a>
        <a href="https://www.instagram.com/tibame_wiedu/"><img src="../imgs/aboutImg/instagram.png" alt="" /></a>
        <a href="https://page.line.me/750htowt"><img src="../imgs/aboutImg/line.png" alt="" /></a>
      </div>
    </section>
  </main>
</template>

<script>
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
gsap.registerPlugin(ScrollTrigger)

export default {
  name: 'About',
  data() {
    return {
      logoSrc: './src/imgs/logo/logo-w.png',
      englishText: 'Fredericka the Great',
      title1: '紙醉金迷',
      content:
        '「紙醉金迷」以浪漫、神秘的氛圍和美酒品味為主題，吸引消費者，<br>提供來自世界各地的頂級美酒和美食，以專業的服務，營造出愉悅的用餐體驗。',
      title2: '尋找屬於您自己的故事',
      buttonText: '開始測驗',
      businessHours: '營業時間：PM5:00~AM3:00',
      email: '信箱：captivate_Intoxicat@gmail.com',
      phone: '電話：02-70638715',
      address: '地址：台北市中山區南京東路三段219號'
    }
  },

  mounted() {
    const sections = [this.$refs.section2]

    sections.forEach((section, i) => {
      gsap.fromTo(
        section,
        {
          backgroundPosition: () => `50% ${i ? -window.innerHeight * this.getRatio(section) : '0'}px`
        },
        {
          backgroundPosition: () => `50% ${window.innerHeight * (1 - this.getRatio(section))}px`,

          ease: 'none',
          scrollTrigger: {
            trigger: section,
            start: () => (i ? 'top bottom' : 'top top'),
            end: 'bottom top',
            scrub: true,
            invalidateOnRefresh: true
          }
        }
      )
    })
  },
  methods: {
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
// } @else if $point == mobile2 {
//   @media (max-width: 430px) {
//     @content;
//   }
// } @else if $point == mobile3 {
//   @media (max-width: 375px) {
//     @content;
//   }
// }

body {
  background-color: black;
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
  h1 {
    color: $whitelady;
    font-size: 102px;
    padding-bottom: 4%;
    font-weight: bold;
    @include breakpoint(mobile) {
      font-size: 75px;
    }
    // @include breakpoint(mobile2) {
    //   font-size: 75px;
    // }
  }
  h2 {
    color: $whitelady;
    font-size: 92px;
    font-family: $fontfamily;
    font-weight: bold;
    padding-bottom: 4%;
    @include breakpoint(mobile) {
      padding: 0 2%;
      font-size: 48px;
    }
    // @include breakpoint(mobile2) {
    //   font-size: 55px;
    // }
    // @include breakpoint(mobile3) {
    //   font-size: 50px;
    // }
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
    // @include breakpoint(mobile2) {
    //   font-size: 40px;
    // }
  }
  main {
    width: 100%;
    font-family: $fontfamily;
  }
  //   section {
  //     position: relative;
  //     background-repeat: no-repeat;
  //     background-size: cover;
  //     background-position: center;
  //     width: 100%;
  //     height: 100vh;
  //     text-align: center;
  //     /* line-height: 100px; */
  //     display: flex;
  //     align-items: center;
  //     justify-content: center;
  span {
    position: absolute;
    z-index: 1;
  }
}
//   }

section {
  position: relative;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background-position: center center;
  background-size: cover;
  // z-index: -1;
}
// .bg {
//   position: absolute;
//   top: 0;
//   left: 0;
//   width: 100%;
//   height: 100%;
//   z-index: -1;
//   background-size: cover;
//   background-position: center;
//   background-repeat: no-repeat;
// }

.aboutBackground_1 {
  background-image: url(../imgs/aboutImg/about_pc01.png);

  // display: flex;
  align-items: center;
  justify-content: center;
  img {
    width: 550px;
    @include breakpoint(pc) {
      width: 450px;
    }
    // @include breakpoint(pc2) {
    //   width: 450px;
    // }
    @include breakpoint(mobile) {
      width: 275px;
    }
    // @include breakpoint(mobile2) {
    //   width: 300px;
    // }
    // @include breakpoint(mobile3) {
    //   width: 275px;
    // }
    // width: 40%;
  }
}
.aboutBackground_2 {
  background-image: url(../imgs/aboutImg/about_pc02.png);
  text-align: center;
}
.paragraph {
  background-color: #381b1d;
  padding: 5% 0;
}
.aboutBackground_3 {
  background-image: url(../imgs/aboutImg/about_pc03.png);
  background-color: #381b1d;
  opacity: 0.9;
  text-align: center;
  background-position: bottom;
  .testbutton {
    margin-top: 3%;
  }
  .testbutton:hover {
    background-color: $ramos-gin-fizz;
  }
}
.aboutBackground_4 {
  background-color: #381b1d;
  display: flex;
  flex-direction: column;
  text-align: left;
  padding: 0 5%;
  padding-top: 5%;
  justify-content: left;
  line-height: 50px;
  border-radius: 10px;

  @include breakpoint(mobile) {
    height: 80vh;
  }
  h3 {
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
