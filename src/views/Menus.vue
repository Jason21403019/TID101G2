<template>
  <div class="warper">
    <div class="menu1">
        <h1>Appetier開胃菜</h1>
        <img src="../imgs/menuImg/food_menu_1-01.jpg" alt="" id="img1">
        <img src="../imgs/menuImg/menu_pc01.png" alt="" id="before-img1">
      </div>
      <div class="menu2">
        <h1>Drink Snacks喝酒菜</h1>
        <img src="../imgs/menuImg/food_menu_1-02.jpg" alt="">
        <img src="../imgs/menuImg/menu_pc07.png" alt="" id="before-img2-1">
        <img src="../imgs/menuImg/menu_pc03.png" alt="" id="before-img2-2">
      </div>
      <div class="menu3">
        <h1>Chefs Selection主廚特選</h1>
        <img src="../imgs/menuImg/food_menu_1-03.jpg" alt="">
        <img src="../imgs/menuImg/menu_pc04.png" alt="" id="before-img3-1">
        <img src="../imgs/menuImg/menu_pc02.png" alt="" id="before-img3-2">
      </div>
      <div class="menu4">
        <h1>Captivate Intoxicat紙醉金迷</h1>
        <img src="../imgs/menuImg/food_menu_1-04.jpg" alt="">
        <img src="../imgs/menuImg/menu_pc08.png" alt="" id="before-img4-1">
        <img src="../imgs/menuImg/menu_pc05.png" alt="" id="before-img4-2">
      </div>
  </div>
</template>

<script>
import { onMounted } from 'vue';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export default {
  name: 'MenuComponent',
  setup() {
    onMounted(() => {
      gsap.to('#before-img1', {
        duration: 1.5,
        x: -800,
        scale: 1.75,
        rotation: 180,
        scrollTrigger: {
          trigger: '#before-img1',
          start: 'top 80%', // 調整這裡
          end: 'bottom 20%', // 調整這裡
          scrub: 1,
          markers: true
        }
      });
      gsap.to('#before-img2-1', {
        duration: 1.5,
        x: -450,
        scrollTrigger: {
          trigger: '#before-img2-1',
          start: 'top 80%', // 調整這裡
          end: 'bottom 20%', // 調整這裡
          scrub: 1,
          markers: true
          
        }
      });
      gsap.to('#before-img2-2', {
        duration: 1.5,
        x: 480,
        scrollTrigger: {
          trigger: '#before-img2-2',
          start: 'top 80%', // 調整這裡
          end: 'bottom 20%', // 調整這裡
          scrub: 1,
          markers: true
        }
      });
      gsap.to('#before-img3-1', {
        duration: 1.5,
        x: 500,
        scrollTrigger: {
          trigger: '#before-img3-1',
          start: 'top 80%', // 調整這裡
          end: 'bottom 20%', // 調整這裡
          scrub: 1,
          markers: true
        }
      });
      gsap.to('#before-img3-2', {
        duration: 1.5,
        x: -200,
        scrollTrigger: {
          trigger: '#before-img3-2',
          start: 'top 80%', // 調整這裡
          end: 'bottom 20%', // 調整這裡
          scrub: 1,
          markers: true
        }
      });
      gsap.to('#before-img4-1', {
        duration: 1.5,
        x: 190,
        scrollTrigger: {
          trigger: '#before-img4-1',
          start: 'top 80%', // 調整這裡
          end: 'bottom 30%', // 調整這裡
          scrub: 1,
          markers: true
        }
      });
      gsap.to('#before-img4-2', {
        duration: 1.5,
        x: -290,
        scrollTrigger: {
          trigger: '#before-img4-2',
          start: 'top 80%', // 調整這裡
          end: 'bottom 50%', // 調整這裡
          scrub: 1,
          markers: true
        }
      });
    });
  }
};
</script>
<!-- <script>
import { onMounted } from 'vue'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

export default {
  name: 'MenuComponent',
  setup() {
    onMounted(() => {
      const animations = [
        { selector: '#before-img1', x: -800, scale: 1.75, rotation: 180, end: 'bottom 20%' },
        { selector: '#before-img2-1', x: -450, end: 'bottom 20%' },
        { selector: '#before-img2-2', x: 480, end: 'bottom 20%' },
        { selector: '#before-img3-1', x: 500, end: 'bottom 20%' },
        { selector: '#before-img3-2', x: -200, end: 'bottom 20%' },
        { selector: '#before-img4-1', x: 190, end: 'bottom 30%' },
        { selector: '#before-img4-2', x: -290, end: 'bottom 50%' }
      ]

      animations.forEach(animation => {
        gsap.to(animation.selector, {
          duration: 1.5,
          x: animation.x,
          scale: animation.scale || 1,
          rotation: animation.rotation || 0,
          scrollTrigger: {
            trigger: animation.selector,
            start: 'top center',
            end: animation.end,
            scrub: 1,
            markers: true
          }
        })
      })
    })
  }
}
</script> -->
<style lang="scss" scoped>
.warper {
  overflow: hidden;
  display: flex;
  flex-direction: column;
  align-items: center;
  background: $negroni;
  padding: 100px;

  .menu1,
  .menu2,
  .menu3,
  .menu4 {
    position: relative;
  }

  #before-img1 {
    position: absolute;
    right: -65rem;
    top: 8rem;
    width: 250px;
  }

  #before-img2-1 {
    position: absolute;
    right: -40rem;
    top: 30rem;
    width: 350px;
    height: 350px;
    transform: rotate(-16deg);
  }

  #before-img2-2 {
    position: absolute;
    right: 59rem;
    top: 2rem;
  }

  #before-img3-1 {
    position: absolute;
    right: 65rem;
    top: 10rem;
    width: 350px;
    height: 350px;
    transform: rotate(25deg);
  }

  #before-img3-2 {
    position: absolute;
    right: -37rem;
    top: 28rem;
  }

  #before-img4-1 {
    position: absolute;
    right: 35rem;
    top: 8rem;
    width: 550px;
    height: 550px;
    transform: rotate(17deg);
  }

  #before-img4-2 {
    position: absolute;
    right: -35rem;
    top: 25rem;
    transform: rotate(-17deg);
  }

  h1 {
    font-size: $fontSize_h3;
    font-style: $fontfamily-en2;
    letter-spacing: $letterspacing;
    color: $whitelady;
    line-height: $lineheight;
  }
}
</style>