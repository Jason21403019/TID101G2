<template>
  <header class="header" :class="{ '-black': currentPath === 'Home' || currentPath === 'Home' }">
    <div class="header__logoarea">
      <routerlink to="/" class="header__logoarea-logo">
        <img src="../../imgs/logo/logo-w.png" alt="" />
      </routerlink>
    </div>
    <div class="header__btnarea">
      <div class="header__btnarea-icons">
        <router-link to="/" class="header__icons-icon">
          <img class="header__icons-icon-img1" src="../../imgs/icon/icon_member-on-w.svg" alt="" />
        </router-link>
        <router-link to="/" class="header__icons-icon">
          <img class="header__icons-icon-img2" src="../../imgs/icon/icon_cart-shopping-w.svg" alt="" />
        </router-link>
      </div>
      <button class="h__btn" :class="hamburger__class" @click="toggleHamburger">
        <span class="hamburger__bar"></span>
        <span class="hamburger__bar"></span>
        <span class="hamburger__bar"></span>
      </button>
      <div class="circle" :class="hamburger__class"></div>
      <div :class="['menu__nav', { active: isHamburgerOpen }]">
        <nav class="menu__nav-content">
          <ul class="menu__nav-ul">
            <li class="menu__nav-ul-item" :class="hamburger__class">
              <router-link to="/about_us" class="menu__link" @click="closeHamburger"
                ><span class="item1">關於我們</span></router-link
              >
              <router-link to="/menus" class="menu__link" @click="closeHamburger"><span class="item2">菜單</span></router-link>
              <router-link to="/reserve_first" class="menu__link" @click="closeHamburger"
                ><span class="item3">預約訂位</span></router-link
              >
              <router-link to="/" class="menu__link" @click="closeHamburger"><span class="item4">熱門商品</span></router-link>
              <router-link to="/" class="menu__link" @click="closeHamburger"><span class="item5">測驗遊戲</span></router-link>
              <router-link to="/wine_column" class="menu__link" @click="closeHamburger"
                ><span class="item6">酒品專欄</span></router-link
              >
              <router-link to="/questions" class="menu__link" @click="closeHamburger"
                ><span class="item7">常見問題</span></router-link
              >
            </li>
          </ul>
          <div class="menu__nav-img">
            <img src="../../imgs/burger.png" alt="" />
          </div>
        </nav>
      </div>
    </div>
  </header>
</template>

<script>
export default {
  name: 'DefaultNav',
  data() {
    return {
      isHamburgerOpen: false
    }
  },
  computed: {
    currentPath() {
      console.log(this.$route)

      return this.$route.name
    },
    hamburger__class() {
      return this.isHamburgerOpen === true ? 'active' : ''
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
  background: rgba(0, 0, 0, 0.07);
  box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
  backdrop-filter: blur(8.2px);
  -webkit-backdrop-filter: blur(8.2px);
  padding: 0.7rem 0.5rem;
  &__logoarea {
    width: 100px;
    height: 80px;
    padding-left: 1rem;
    &-logo {
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
      .header__icons-icon {
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
    margin-bottom: 2px;
    height: 35px;
    position: relative;
  }
  .circle {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    position: absolute;
    right: 1rem;
    top: 0.8rem;
    transform: scale(0);
    transition: transform 0.8s ease;
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
  transition: opacity 1s ease-in;

  &.active {
    width: 100%;
    opacity: 1;
    pointer-events: auto;
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
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    &-item {
      // border: 1px solid red;
      height: 70%;
      width: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      .menu__link {
        // border: 1px solid green;
        font-family: $fontfamily;
        font-size: $fontSize_h3;
        text-decoration: none;
        text-align: center;
        color: $whitelady;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin: 0.15rem 14rem;
        padding: 1.25rem 3rem;
        // border: 1px solid red;
        color: rgba($color: $whitelady, $alpha: 0.5);

        &:hover {
          color: $whitelady;
        }
        &:nth-child(even) {
          transform: translateX(100px);
        }
        &:nth-child(odd) {
          transform: translateX(-50px);
        }
        &:nth-child(1) {
          transform: rotate(-8deg) translateX(-80px);
        }
        &:nth-child(2) {
          transform: rotate(7deg) translateX(220px) translateY(-40px);
        }
        &:nth-child(3) {
          transform: rotate(9deg) translate(-50px, 30px);
        }
        &:nth-child(4) {
          transform: rotate(-6deg) translate(220px, 40px);
        }
        &:nth-child(5) {
          transform: rotate(-9deg) translate(-60px, 10px);
        }
        &:nth-child(6) {
          transform: rotate(4deg) translateX(230px) translateY(30px);
        }
        &:nth-child(7) {
          transform: rotate(9deg) translateX(-60px) translateY(40px);
        }
        .item1 {
          position: relative;
          // top: -5rem;
          // left: -5rem;
          &::before {
            content: 'About';
            position: absolute;
            top: 2.4rem;
            left: 2rem;
            font-size: $fontSize_h4;
          }
          // border: 1px solid blue;
        }
        .item2 {
          position: relative;
          // top: -4rem;
          // left: 5rem;
          &::before {
            content: 'Menu';
            position: absolute;
            top: 2.4rem;
            left: 0.2rem;
            font-size: $fontSize_h4;
          }
          // border: 1px solid blue;
        }
        .item3 {
          position: relative;
          // top: -3rem;
          // left: -5rem;
          &::before {
            content: 'Booking';
            position: absolute;
            top: 2.4rem;
            left: 1.3rem;
            font-size: $fontSize_h4;
          }
          // border: 1px solid blue;
        }
        .item4 {
          position: relative;
          // top: -2rem;
          // left: 5rem;
          &::before {
            content: 'Product';
            position: absolute;
            top: 2.4rem;
            left: 1.5rem;
            font-size: $fontSize_h4;
          }
          // border: 1px solid blue;
        }
        .item5 {
          position: relative;
          // top: -1rem;
          // left: -5rem;
          &::before {
            content: 'QuizGame';
            position: absolute;
            top: 2.4rem;
            left: 0.8rem;
            font-size: $fontSize_h4;
          }
          // border: 1px solid blue;
        }
        .item6 {
          position: relative;
          // top: 0rem;
          // left: 5rem;
          &::before {
            content: 'WineColumn';
            position: absolute;
            top: 2.4rem;
            font-size: $fontSize_h4;
          }
          // border: 1px solid blue;
        }
        .item7 {
          position: relative;
          // top: 2rem;
          // left: -5rem;
          &::before {
            content: 'Q&A';
            position: absolute;
            top: 2.4rem;
            left: 2.3rem;
            font-size: $fontSize_h4;
          }
          // border: 1px solid blue;
        }
      }
    }
  }
  &-img {
    flex: 1;
    padding-top: 7rem;
    padding-left: 5rem;
    width: 50%;
    // border: 1px solid red;
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
