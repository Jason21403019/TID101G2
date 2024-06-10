<template>
  <div class="warper">
    <div class="menu1">
      <h1>Appetier開胃菜</h1>
      <img id="img1" :src="image1" @click="showLightbox(0)" />
      <img id="before-img1" src="../imgs/menuImg/menu_pc01.png" alt="" />
    </div>
    <div class="menu2">
      <h1>Drink Snacks喝酒菜</h1>
      <img id="img2" :src="image2" @click="showLightbox(1)" />
      <img id="before-img2-1" src="../imgs/menuImg/menu_pc07.png" alt="" />
      <img id="before-img2-2" src="../imgs/menuImg/menu_pc03.png" alt="" />
    </div>
    <div class="menu3">
      <h1>Chefs Selection主廚特選</h1>
      <img id="img3" :src="image3" @click="showLightbox(2)" />
      <img id="before-img3-1" src="../imgs/menuImg/menu_pc04.png" alt="" />
      <img id="before-img3-2" src="../imgs/menuImg/menu_pc02.png" alt="" />
    </div>
    <div class="menu4">
      <h1>Captivate Intoxicat紙醉金迷</h1>
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
      index.value = i
      visible.value = true
    }

    onMounted(() => {
      const container = document.querySelector('.warper')

      imagesLoaded(container, () => {
        //可以依此設計自己的動畫效果，這些只是範例
        const animations = [
          { id: '#before-img1', props: { x: -900, scale: 1.75, rotation: 180 } },
          { id: '#before-img2-1', props: { x: -450, rotation: 360 } },
          { id: '#before-img2-2', props: { x: 480, rotation: 180 } },
          { id: '#before-img3-1', props: { x: 500 } },
          { id: '#before-img3-2', props: { x: -200 } },
          { id: '#before-img4-1', props: { x: 190 } },
          { id: '#before-img4-2', props: { x: -290 } }
        ]

        animations.forEach((anim) => {
          gsap.to(anim.id, {
            duration: 1.5,
            ...anim.props,
            scrollTrigger: {
              trigger: anim.id,
              start: 'top 80%',
              end: 'bottom 20%',
              scrub: 1
            }
          })
        })
      })
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

  .menu1,
  .menu2,
  .menu3,
  .menu4 {
    position: relative;
  }
  img {
      max-width: 100%;
      height: auto; /* 確保圖片按比例縮放 */
    }
  #img1 #img2 #img3 #img4 {
    max-width: 100%;
    height: auto; /* 確保圖片按比例縮放 */
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
    right: -42rem;
    top: 28rem;
    width: 100%;
    height: auto;
  }

  #before-img4-1 {
    position: absolute;
    right: 35rem;
    top: 8rem;
    width: 100%;
    height: auto;
    transform: rotate(17deg);
  }

  #before-img4-2 {
    position: absolute;
    right: -40rem;
    top: 25rem;
    width: 100%;
    height: auto;
    transform: rotate(-17deg);
  }

  h1 {
    font-size: $fontSize_h3;
    font-family: $fontfamily-en2;
    letter-spacing: $letterspacing;
    color: $whitelady;
    line-height: $lineheight-en;
    margin: 20px 0;
  }
}

@media screen and (max-width: 820px) {
  #before-img1,
  #before-img2-1,
  #before-img2-2,
  #before-img3-1,
  #before-img3-2,
  #before-img4-1,
  #before-img4-2 {
    display: none; /* 768px 以下隱藏動畫綁定物件 */
  }
  h1 {
    font-size: $fontSize_p!important;
    font-family: $fontfamily-en2;
    letter-spacing: $letterspacing;
    color: $whitelady;
    line-height: $lineheight-en;
    margin: 20px 0;
  }

}
</style>
