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
export default {
      name: 'MenuComponent',
      setup() {
        onMounted(() => {
          gsap.to('#before-img1', {
            duration: 1.5,
            x: -700,
            scale: 1.75,
            rotation: 180
          });
          gsap.to('#before-img2-1', {
            duration: 1.5,
            x: -300,
          });
          gsap.to('#before-img2-2', {
            duration: 1.5,
            x: 350,
          });
          gsap.to('#before-img3-1', {
            duration: 1.5,
            x:350,
          });
          gsap.to('#before-img3-2', {
            duration: 1.5,
            x:-100,
          });
          gsap.to('#before-img4-1', {
            duration: 1.5,
            x: 35,
          });
          gsap.to('#before-img4-2', {
            duration: 1.5,
            x: -100,
          });
        });
      }
    };
  </script>


<style lang="scss" scoped>
    .warper {
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: center;
        background: $negroni;
        padding:200px;

        .menu1, .menu2, .menu3, .menu4 {
            position: relative;
        }

        #before-img1 {
            position: absolute;
            right:-58rem;
            top: 8rem;
            width: 250px;
        }

        #before-img2-1 {
            position: absolute;
            right: -30rem;
            top: 30rem;
            width: 350px;
            height: 350px;
            transform: rotate(-16deg);
        }

        #before-img2-2 {
            position: absolute;
            right: 50rem;
            top: 2rem;
        }

        #before-img3-1 {
            position: absolute;
            right: 57rem;
            top: 10rem;
            width: 350px;
            height: 350px;
            transform: rotate(25deg);
        }

        #before-img3-2 {
            position: absolute;
            right: -31rem;
            top: 28rem;
        }

        #before-img4-1 {
            position: absolute;
            right: 24rem;
            top: 8rem;
            width: 550px;
            height: 550px;
            transform: rotate(17deg);
        }

        #before-img4-2 {
            position: absolute;
            right: -23rem;
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