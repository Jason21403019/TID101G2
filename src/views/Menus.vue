<template>
  <div class="warper">
    <div class="menu1">
      <h2>Appetier開胃菜</h2>
      <img id="img1" :src="image1" @click="showLightbox(0)" />
      <img id="before-img1" src="../imgs/menuImg/menu_pc01.png" alt="" />
    </div>
    <div class="menu2">
      <h2>Drink Snacks喝酒菜</h2>
      <img id="img2" :src="image2" @click="showLightbox(1)" />
      <img id="before-img2-1" src="../imgs/menuImg/menu_pc07.png" alt="" />
      <img id="before-img2-2" src="../imgs/menuImg/menu_pc03.png" alt="" />
    </div>
    <div class="menu3">
      <h2>Chefs Selection主廚特選</h2>
      <img id="img3" :src="image3" @click="showLightbox(2)" />
      <img id="before-img3-1" src="../imgs/menuImg/menu_pc04.png" alt="" />
      <img id="before-img3-2" src="../imgs/menuImg/menu_pc02.png" alt="" />
    </div>
    <div class="menu4">
      <h2>Captivate Intoxicat紙醉金迷</h2>
      <img id="img4" :src="image4" @click="showLightbox(3)" />
      <img id="before-img4-1" src="../imgs/menuImg/menu_pc08.png" alt="" />
      <img id="before-img4-2" src="../imgs/menuImg/menu_pc05.png" alt="" />
    </div>
    <vue-easy-lightbox :visible="visible" :imgs="imgs" :index="index" @hide="visible = false" />
  </div>
</template>

<script>
import VueEasyLightbox from 'vue-easy-lightbox'
import imagesLoaded from 'imagesloaded'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
import { gsap } from 'gsap'
import { ref, onMounted } from 'vue'
import Typewriter from 'typewriter-effect/dist/core'

import image1 from '../imgs/menuImg/food_menu_1-01.jpg'
import image2 from '../imgs/menuImg/food_menu_1-02.jpg'
import image3 from '../imgs/menuImg/food_menu_1-03.jpg'
import image4 from '../imgs/menuImg/food_menu_1-04.jpg'

gsap.registerPlugin(ScrollTrigger)

export default {
  name: 'MenuComponent',
  components: {
    VueEasyLightbox
  },
  setup() {
    const visible = ref(false)
    const index = ref(0)
    const imgs = ref([image1, image2, image3, image4])

    const showLightbox = (i) => {
      gsap.to(`#img${i+1}`, {
        scale: .95,
        duration: 0.1,
        yoyo: true,
        repeat: 1,
        onComplete: () => {
          index.value = i
          visible.value = true
        }
      })
    }

    onMounted(() => {
      const container = document.querySelector('.warper')

      imagesLoaded(container, () => {
        const animations = [
          { id: '#before-img1', props: { x: -900, scale: 1.75, rotation: 180 } },
          { id: '#before-img2-1', props: { x: -450, rotation: 360 } },
          { id: '#before-img2-2', props: { x: 480, rotation: 180 } },
          { id: '#before-img3-1', props: { x: 500 } },
          { id: '#before-img3-2', props: { x: -200 } },
          { id: '#before-img4-1', props: { x: -300 } },
          { id: '#before-img4-2', props: { x: 200 } }
        ]

        animations.forEach((anim) => {
          gsap.to(anim.id, {
            duration: 1.5,
            ...anim.props,
            scrollTrigger: {
              trigger: anim.id,
              start: 'top 90%',
              end: 'bottom 50%',
              scrub: 1,
            }
          })
        })
      })

      // 滾動動畫
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('fade-in');
          }
        });
      }, { threshold: 0.1 });

      document.querySelectorAll('.menu1, .menu2, .menu3, .menu4').forEach(menu => {
        observer.observe(menu);
      });

      // 標題打字機效果
      const titles = document.querySelectorAll('h2');
      titles.forEach(title => {
        new Typewriter(title, {
          strings: [title.textContent],
          autoStart: true,
          loop: true,
          delay: 200
        });
      });
    })

    return {
      visible,
      index,
      imgs,
      showLightbox,
      image1,
      image2,
      image3,
      image4
    }
  }
}
</script>

<style lang="scss" scoped>
.warper {
  overflow: hidden;
  display: flex;
  flex-direction: column;
  align-items: center;
  background: $negroni;
  padding: 100px;
  width: 100%;
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;

  .menu1,
  .menu2,
  .menu3,
  .menu4 {
    position: relative;
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 1s ease, transform 2.5s ease;

    &.fade-in {
      opacity: 1;
      transform: translateY(0);
    }
  }

  img {
    max-width: 100%;
    height: auto;
  }

  #img1, #img2, #img3, #img4 {
    max-width: 100%;
    height: auto;
    margin-bottom: 2rem;
    transition: transform 0.3s ease, opacity 0.3s ease;
  
    &:hover {
      transform: scale(1.05);
      opacity: 0.8;
    }
  }

  #before-img1 {
    position: absolute;
    right: -73rem;
    top: 8rem;
    width: 250px;
  }

  #before-img2-1 {
    position: absolute;
    right: -50rem;
    top: 30rem;
    width: 100%;
    height: auto;
    transform: rotate(-16deg);
  }

  #before-img2-2 {
    position: absolute;
    right: 59rem;
    top: 2rem;
    width: 100%;
    height: auto;
  }

  #before-img3-1 {
    position: absolute;
    right: 65rem;
    top: 10rem;
    width: 100%;
    height: auto;
    transform: rotate(25deg);
  }

  #before-img3-2 {
    position: absolute;
    right: -40rem;
    top: 30rem;
    width: 100%;
    height: auto;
    transform: rotate(-15deg);
  }

  #before-img4-1 {
    position: absolute;
    right: -40rem;
    top: 5rem;
    width: 100%;
    rotate: -15deg;
    height: auto;
  }

  #before-img4-2 {
    position: absolute;
    right: 30rem;
    top: 30rem;
    width: 100%;
    height: auto;
    transform: rotate(10deg);
  }
}

h2 {
  font-size: $fontSize_h3;
  font-family:$fontfamily-en2;
  margin-bottom: 2rem;
  color: $ramos-gin-fizz;
  text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
}

// 響應式設計
@media (max-width: 768px) {
  .warper {
    padding: 50px;
  }

  h2 {
    font-size: 1.5rem;
  }

  #before-img1,
  #before-img2-1,
  #before-img2-2,
  #before-img3-1,
  #before-img3-2,
  #before-img4-1,
  #before-img4-2 {
    display: none; // 在移動設備上隱藏裝飾圖片
  }
}
</style>
