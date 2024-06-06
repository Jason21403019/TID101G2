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
    <p class="paragraph">{{ englishText }}</p>
    <!-- 跳轉心理測驗 -->
    <section ref="section3" class="aboutBackground_3">
      <span>
        <p>{{ englishText }}</p>
        <h2>{{ title2 }}</h2>
        <button @click="testPage">{{ buttonText }}</button>
      </span>
    </section>

    <!-- map -->
    <section class="aboutBackground_4">
      <iframe
        src="https://maps.google.com?output=embed&q=緯育TibaMe附設台北職訓中心"
        width="100%"
        height="530vh"
        frameborder="0"
      ></iframe>
      <div>
        <h3>{{ businessHours }}</h3>
        <h3>{{ email }}</h3>
        <h3>{{ phone }}</h3>
        <h3>{{ address }}</h3>
      </div>
    </section>
  </main>
</template>

<script>
import gsap from 'gsap'
// import ScrollTrigger from 'gsap/ScrollTrigger'
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
    const sections = [
      this.$refs.section1,
      // this.$refs.section2,
      this.$refs.section3
    ]

    sections.forEach((section, i) => {
      gsap.fromTo(
        section,
        {
          backgroundPosition: () => `50% ${i ? -window.innerHeight * getRatio(section) : '0'}px`
        },
        {
          backgroundPosition: () => `50% ${window.innerHeight * (1 - getRatio(section))}px`,
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
      this.$router.push('/questions')
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
  background-color: black;
  button {
    background-color: transparent;
    border-color: $irishcoffee;
    color: $irishcoffee;
    border-radius: 84px;
    font-size: 62px;
    padding: 1% 5%;
    letter-spacing: 10px;
  }
  h1 {
    color: $whitelady;
    font-size: 102px;
    padding-bottom: 4%;
  }
  h2 {
    color: $whitelady;
    font-size: 92px;
    font-family: $fontfamily;
    padding-bottom: 4%;
  }
  h3 {
    color: $whitelady;
    font-size: 32px;
    font-family: $fontfamily;
    line-height: 50px;
  }
  p {
    color: $whitelady;
    text-align: center;
    font-size: 56px;
    font-family: $fontfamily-en2;
    padding-bottom: 2%;
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
    .paragraph {
      background-color: #381b1d;
      padding: 5% 0;
    }
    .aboutBackground_3 {
      background-image: url(../imgs/aboutImg/about_pc03.png);
      background-color: #381b1d;
      opacity: 0.9;
    }
    .aboutBackground_4 {
      background-color: #381b1d;
      display: flex;
      flex-direction: column;
      text-align: left;
      padding: 0 5%;
      padding-top: 5%;
      // justify-content: left;
      /* line-height: 50px; */
      div {
        width: 100%;
        p {
          /* display: unset; */
          text-align: left;
          justify-content: left;
          /* line-height: 50px; */
        }
      }
    }
  }
}
</style>
