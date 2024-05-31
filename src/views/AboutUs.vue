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

    <!-- 跳轉心理測驗 -->
    <section ref="section3" class="aboutBackground_3">
      <span>
        <p>{{ englishText }}</p>
        <h2>{{ title2 }}</h2>
        <button @click="testPage">{{ buttonText }}</button>
      </span>
    </section>

    <!-- 練習 -->

    <!-- map -->
    <section class="aboutBackground_4">
      <div></div>
      <span>
        <h3>{{ businessHours }}</h3>
        <h3>{{ email }}</h3>
        <h3>{{ phone }}</h3>
        <h3>{{ address }}</h3>
      </span>
    </section>
  </main>
</template>

<script>
import { gsap } from 'gsap'

export default {
  name: 'About',

  data() {
    return {
      about_logo: 'about_logo',
      logoSrc: '../imgs/logo/logo-w.png',
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
    const sections = [
      this.$refs.section1,
      // this.$refs.section2,
      this.$refs.section3
    ]

    sections.forEach((section, i) => {
      gsap.fromTo(
        section,
        {
          backgroundPosition: () => `50% ${i ? -window.innerHeight * this.getRatio(section) : '0'}px`
        },
        {
          backgroundPosition: () => `50% ${window.innerHeight * (1 - this.getRatio(section))}px`,
          ease: 'ease-out',
          scrollTrigger: {
            trigger: section,
            start: () => (i ? 'top bottom' : 'top top'),
            end: 'bottom top',
            scrub: true,
            invalidateOnRefresh: true,
            markers: true
          }
        }
      )
    })
  },

  methods: {
    testPage() {
      location.href = './Home.vue'
    },

    getRatio(element) {
      const rect = element.getBoundingClientRect()

      return rect.top / window.innerHeight
    }
  }
}
</script>

<style lang="scss" scoped>
body {
  button {
    background-color: transparent;
    border-color: #fcf0d8;
    color: #fcf0d8;
    border-radius: 84px;
  }
  h1 {
    font-size: 102px;
  }
  h2 {
    font-size: 92px;
  }
  p {
    text-align: center;
    font-size: 56px;
    font-family: 'Fredericka the Great', serif;
  }
  main {
    width: 100vw;
    section {
      position: relative;
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      width: 100%;
      height: 100vh;
      text-align: center;
      /* line-height: 100px; */
      display: flex;
      align-items: center;
      justify-content: center;
      span {
        position: absolute;
        z-index: 1;
      }
    }
    .aboutBackground_1 {
      background-image: url(../imgs/aboutImg/about_pc01.png);

      display: flex;
      align-items: center;
      justify-content: center;
      img {
        width: 20%;
      }
    }
    .aboutBackground_2 {
      background-image: url(../imgs/aboutImg/about_pc02.png);
    }
    .aboutBackground_3 {
      background-image: url(../imgs/aboutImg/about_pc03.png);
      button {
        font-size: 62px;
        padding: 1% 5%;
        letter-spacing: 10px;
      }
    }
    .aboutBackground_4 {
      /* display: unset; */
      text-align: left;
      justify-content: left;
      /* line-height: 50px; */
      p {
        /* display: unset; */
        text-align: left;
        justify-content: left;
        /* line-height: 50px; */
      }
    }
  }
}
</style>
