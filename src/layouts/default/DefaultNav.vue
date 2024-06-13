<template>
  <header class="header">
    <div class="header__logoarea">
      <router-link to="/" class="header__logoarea-logo" @click="closeHamburger">
        <img v-if="black" :src="getNavLogoSrc" alt="" />
        <img v-else :src="getNavLogoSrc" alt="" />
      </router-link>
    </div>
    <div class="header__btnarea">
      <div class="header__btnarea-icons">
        <router-link to="/register" class="header__icons-icon" @click="closeHamburger">
          <img v-if="black" class="header__icons-icon-img1" :src="getNavMemberSrc" alt="" />
          <img v-else class="header__icons-icon-img1" :src="getNavMemberSrc" alt="" />
        </router-link>
        <router-link to="/cart" class="header__icons-icon" @click="closeHamburger">
          <img v-if="black" class="header__icons-icon-img2" :src="getNavCartSrc" alt="" />
          <img v-else class="header__icons-icon-img2" :src="getNavCartSrc" alt="" />
        </router-link>
      </div>
      <button class="h__btn" :class="hamburger__class" @click="toggleHamburger">
        <span class="hamburger__bar" :class="hanburgerBarColor"></span>
        <span class="hamburger__bar" :class="hanburgerBarColor"></span>
        <span class="hamburger__bar" :class="hanburgerBarColor"></span>
      </button>
      <div class="circle" :class="hamburger__class"></div>
      <div :class="['menu__nav', { active: isHamburgerOpen, 'nav-dark': isHamburgerOpen }]">
        <nav class="menu__nav-content">
          <ul class="menu__nav-ul">
            <li class="menu__nav-ul-item" :class="hamburger__class">
              <router-link to="/about_us" class="menu__link" @click="closeHamburger"><span>關於我們</span></router-link>
              <router-link to="/menus" class="menu__link" @click="closeHamburger"><span>菜單</span></router-link>
              <router-link to="/reserve_first" class="menu__link" @click="closeHamburger"><span>預約訂位</span></router-link>
              <router-link to="/product" class="menu__link" @click="closeHamburger"><span>熱門商品</span></router-link>
              <router-link to="/quizgame" class="menu__link" @click="closeHamburger"><span>測驗遊戲</span></router-link>
              <router-link to="/wine_column" class="menu__link" @click="closeHamburger"><span>酒品專欄</span></router-link>
              <router-link to="/questions" class="menu__link" @click="closeHamburger"><span>常見問題</span></router-link>
            </li>
          </ul>
          <div class="menu__nav-img">
            <img src="@/imgs/burger.png" alt="" />
          </div>
        </nav>
      </div>
    </div>
  </header>
</template>

<script>
import logoimg from '../../imgs/logo/logo-w.png'
import membertSrc from '../../imgs/icon/icon_member-on-w.svg'

export default {
  inclouds: [logoimg, membertSrc],
  name: 'DefaultNav',
  data() {
    return {
      isHamburgerOpen: false
    }
  },
  computed: {
    currentPath() {
      console.log(this.$route.name)

      return this.$route.name
    },
    black() {
      const blackRoutes = ['Reserve_first', 'Reserve_sec', 'Cart', 'Register']

      return blackRoutes.includes(this.currentPath)
    },
    getLogoSrc() {
      return this.black
        ? new URL('@/imgs/logo/logo.png', import.meta.url).href
        : new URL('@/imgs/logo/logo-w.png', import.meta.url).href
    },

    getMemberSrc() {
      return this.black
        ? new URL('@/imgs/icon/icon_member-on.svg', import.meta.url).href
        : new URL('@/imgs/icon/icon_member-on-w.svg', import.meta.url).href
    },

    getCartSrc() {
      return this.black
        ? new URL('@/imgs/icon/icon_cart-shopping.svg', import.meta.url).href
        : new URL('@/imgs/icon/icon_cart-shopping-w.svg', import.meta.url).href
    },
    getNavMemberSrc() {
      return this.isHamburgerOpen ? new URL('@/imgs/icon/icon_member-on-w.svg', import.meta.url).href : this.getMemberSrc
    },
    getNavCartSrc() {
      return this.isHamburgerOpen ? new URL('@/imgs/icon/icon_cart-shopping-w.svg', import.meta.url).href : this.getCartSrc
    },
    getNavLogoSrc() {
      return this.isHamburgerOpen ? new URL('@/imgs/logo/logo-w.png', import.meta.url).href : this.getLogoSrc
    },
    hamburger__class() {
      return this.isHamburgerOpen === true ? 'active' : ''
    },
    hanburgerBarColor() {
      return this.isHamburgerOpen === true ? 'h-white' : 'h-black'
    }
  },

  methods: {
    toggleHamburger() {
      this.isHamburgerOpen = !this.isHamburgerOpen
    },
    closeHamburger() {
      this.isHamburgerOpen = false
    }
  }
}
</script>

<style lang="scss" scoped>
.header {
  position: fixed;
  top: 0;
  width: 100%;
  display: flex;
  justify-content: space-between;
  z-index: 1000;
  padding: 0.7rem 0.5rem;
  .h-black {
    background: $negroni;
  }
  .h-white {
    background: $ramos-gin-fizz;
  }
  &__logoarea {
    width: 100px;
    height: 80px;
    padding-left: 1rem;
    &-logo {
      position: relative;
      z-index: 1000;
      cursor: pointer;
      img {
        width: 100%;
        // height: 100%;
      }
    }
  }
  &__btnarea {
    display: flex;
    flex-basis: 200px;
    justify-content: space-around;
    align-items: center;
    padding-right: 1rem;
    &-icons {
      display: flex;
      flex-basis: 200px;
      justify-content: space-around;
      align-items: center;
      // border: 1px solid red;
      cursor: pointer;
      .header__icons-icon {
        position: relative;
        z-index: 1000;
        &-img1 {
          width: 30px;
        }
        &-img2 {
          width: 30px;
          padding-top: 2px;
        }
      }
    }
  }
  .h__btn {
    cursor: pointer;
    border: none;
    outline: none;
    background-color: transparent;
    // border: 1px solid red;
    margin-left: 15px;
    margin-bottom: 5px;
    height: 35px;
    position: relative;
  }
  .circle {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    position: absolute;
    right: 1.9rem;
    top: 2.2rem;
    transform: scale(0);
    transition: transform 0.5s ease 0.2s;
    background: $negroni;

    z-index: -1;
    &.active {
      transform: scale(120);
    }
  }
}
.hamburger__bar {
  position: relative;
  z-index: 10;
  display: block;
  width: 25px;
  height: 3px;
  margin: 5.5px 3px;
  border-radius: 20px;
  background-color: $whitelady;
  transition: transform 0.4s;

  .active & {
    &:nth-child(1) {
      transform: translateY(9px) rotate(45deg);
    }

    &:nth-child(2) {
      opacity: 0;
    }

    &:nth-child(3) {
      transform: translateY(-9px) rotate(-45deg);
    }
  }
}

.menu__nav {
  // border: 1px solid red;
  position: relative;
  z-index: 9;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100vh;
  overflow-x: hidden;
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.5s ease-in;
  background-image: url('@/imgs/burger.png');
  background-size: 600px;
  background-position: right;
  background-repeat: no-repeat;
  @include breakpoint(1024px) {
    background-image: none;
  }

  &.active {
    width: 100%;
    opacity: 1;
    pointer-events: auto;
  }
  &.nav-dark .header__icons-icon img {
    content: url('@/imgs/icon/icon_member-on-w.svg');
  }

  &.nav-dark .header__icons-icon img {
    content: url('@/imgs/icon/icon_cart-shopping-w.svg');
  }
  &-content {
    position: relative;
    z-index: 999;
    display: flex;
    // border: 1px solid green;
    width: 100%;
    height: 100%;
  }
  &-ul {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    // border: 1px solid red;
    width: 100%;
    @include breakpoint(1024px) {
      display: flex;
      justify-content: center;
      align-items: center;
    }
    &-item {
      height: 100%;
      width: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      .menu__link {
        width: fit-content;
        // border: 1px solid green;
        font-family: $fontfamily;
        font-size: $fontSize_h3;
        text-decoration: none;
        text-align: center;
        color: $whitelady;
        display: flex;
        justify-content: center;
        align-items: center;
        color: rgba($color: $whitelady, $alpha: 0.5);

        &:hover {
          color: $whitelady;
        }
        &:nth-child(even) {
          transform: translateX(100px);
        }
        &:nth-child(odd) {
          transform: translateX(-100px);
        }
        &:nth-child(1) {
          position: relative;
          &::before {
            content: 'About';
            position: absolute;
            top: 2.4rem;
            font-size: $fontSize_h4;
          }
        }
        &:nth-child(2) {
          position: relative;
          &::before {
            content: 'Menu';
            position: absolute;
            top: 2.4rem;

            font-size: $fontSize_h4;
          }
        }
        &:nth-child(3) {
          position: relative;
          &::before {
            content: 'Booking';
            position: absolute;
            top: 2.4rem;

            font-size: $fontSize_h4;
          }
        }
        &:nth-child(4) {
          position: relative;
          &::before {
            content: 'Product';
            position: absolute;
            top: 2.4rem;

            font-size: $fontSize_h4;
          }
        }
        &:nth-child(5) {
          position: relative;
          &::before {
            content: 'QuizGame';
            position: absolute;
            top: 2.4rem;

            font-size: $fontSize_h4;
          }
        }
        &:nth-child(6) {
          position: relative;
          &::before {
            content: 'WineColumn';
            position: absolute;
            top: 2.4rem;
            font-size: $fontSize_h4;
          }
        }
        &:nth-child(7) {
          position: relative;
          &::before {
            content: 'Q&A';
            position: absolute;
            top: 2.4rem;

            font-size: $fontSize_h4;
          }
        }
      }
    }
  }
  &-img {
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 0;
    @include breakpoint(1024px) {
      opacity: 1;
    }
    img {
      @include breakpoint(1024px) {
        display: block;
        position: absolute;
        object-fit: contain;
        opacity: 1;
        top: 50%;
        right: 50%;
        transform: translate(50%, -50%);
        width: 100%;
        height: 100%;
        border: 1px solid red;
        z-index: -1;
        filter: opacity(0.1);
      }
    }
  }
}
@keyframes shaked {
  0% {
    transform: rotate(0deg);
  }
  25% {
    transform: rotate(10deg);
  }
  50% {
    transform: rotate(0deg);
  }
  75% {
    transform: rotate(-10deg);
  }
  100% {
    transform: rotate(0deg);
  }
}
</style>
