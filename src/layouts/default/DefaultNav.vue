<template>
  <header class="header">
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
      <button
        v-if="!isHamburgerOpen"
        :class="['h__btn', 'hamburger__open', { active: isHamburgerOpen }]"
        @click="toggleHamburger"
      >
        <span class="hamburger__bar"></span>
        <span class="hamburger__bar"></span>
        <span class="hamburger__bar"></span>
      </button>
      <button v-else :class="['h__btn', 'hamburger__close', { active: !isHamburgerOpen }]" @click="toggleHamburger">
        <span class="hamburger__bar"></span>
        <span class="hamburger__bar"></span>
      </button>
    </div>
  </header>
  <div v-show="isHamburgerOpen" :class="['menu__nav', { active: isHamburgerOpen }]">
    <nav class="menu__nav-content">
      <ul class="menu__nav-ul">
        <li class="menu__nav-ul-item">
          <router-link to="/" class="menu__link"><span class="item1">關於我們</span></router-link>
          <router-link to="/" class="menu__link"><span class="item2">菜單</span></router-link>
          <router-link to="/" class="menu__link"><span class="item3">預約訂位</span></router-link>
          <router-link to="/" class="menu__link"><span class="item4">熱門商品</span></router-link>
          <router-link to="/" class="menu__link"><span class="item5">測驗遊戲</span></router-link>
          <router-link to="/" class="menu__link"><span class="item6">酒品專欄</span></router-link>
          <router-link to="/question" class="menu__link"><span class="item7">常見問題</span></router-link>
        </li>
      </ul>
      <div class="menu__nav-img">
        <img src="../../imgs/burger.png" alt="" />
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  name: 'DefaultNav',
  data() {
    return {
      isHamburgerOpen: false
    }
  },

  methods: {
    toggleHamburger() {
      this.isHamburgerOpen = !this.isHamburgerOpen
    }
  }
}
</script>

<style lang="scss">
body {
  position: relative;
}
.header {
  display: flex;
  justify-content: space-between;
  background: $negroni;
  &__logoarea {
    width: 100px;
    height: 80px;
    padding-left: 1rem;
    &-logo {
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
        }
      }
    }
  }
  .h__btn {
    cursor: pointer;
    border: none;
    outline: none;
    background-color: transparent;
    z-index: 10;
    border: 1px solid red;
    margin-left: 15px;
    margin-bottom: 2px;
    height: 35px;
    &::after {
      content: '';
      display: block;
      position: relative;
      width: 10px;
      height: 10px;
      top: -1rem;
      left: 0.5rem;
      border-radius: 20px;
      border: 1px solid red;
      background: $negroni;
      z-index: -1;
    }
    &.active::after {
      width: 100vw;
      height: 100vh;
      top: 0;
      left: 0;
      border-radius: 50%;
      background: $negroni;
      z-index: 9;
    }
  }

  .hamburger__bar {
    display: block;
    width: 25px;
    height: 3px;
    margin: 5.5px 3px;
    border-radius: 20px;
    background-color: $whitelady;
    transition: all 1s ease-in-out;
  }
  .hamburger__open.active .hamburger__bar:nth-child(1) {
    transform: translateY(8px) rotate(45deg);
  }

  .hamburger__open.active .hamburger__bar:nth-child(2) {
    opacity: 0;
  }

  .hamburger__open.active .hamburger__bar:nth-child(3) {
    transform: translateY(-8px) rotate(-45deg);
  }

  .hamburger__close .hamburger__bar:nth-child(1) {
    transform: translateY(1px) rotate(45deg);
  }

  .hamburger__close .hamburger__bar:nth-child(2) {
    transform: translateY(-8px) rotate(-45deg);
  }
}

.menu__nav {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100vh;
  background: $negroni;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.5s ease, visibility 0.5s ease;
  &.active {
    opacity: 1;
    visibility: visible;
    transition: opacity 0.5s ease, visibility 0.5s ease;
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    // background: $negroni;
    z-index: 8;
  }
  &-content {
    display: flex;
    border: 1px solid green;
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
      border: 1px solid red;
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
        margin: 0 12rem;
        color: rgba($color: $whitelady, $alpha: 0.5);
        &:hover {
          color: $whitelady;
        }
        .item1 {
          position: relative;
          top: -5rem;
          left: -5rem;
          &::before {
            content: 'About';
            position: absolute;
            top: 1.8rem;
            left: 1.6rem;
            font-size: $fontSize_h4;
          }
          // border: 1px solid blue;
        }
        .item2 {
          position: relative;
          top: -4rem;
          left: 5rem;
          &::before {
            content: 'Menu';
            position: absolute;
            top: 1.8rem;
            left: 0.2rem;
            font-size: $fontSize_h4;
          }
          // border: 1px solid blue;
        }
        .item3 {
          position: relative;
          top: -3rem;
          left: -5rem;
          &::before {
            content: 'Booking';
            position: absolute;
            top: 1.8rem;
            left: 1.3rem;
            font-size: $fontSize_h4;
          }
          // border: 1px solid blue;
        }
        .item4 {
          position: relative;
          top: -2rem;
          left: 5rem;
          &::before {
            content: 'Product';
            position: absolute;
            top: 1.8rem;
            left: 1.5rem;
            font-size: $fontSize_h4;
          }
          // border: 1px solid blue;
        }
        .item5 {
          position: relative;
          top: -1rem;
          left: -5rem;
          &::before {
            content: 'QuizGame';
            position: absolute;
            top: 1.8rem;
            left: 0.8rem;
            font-size: $fontSize_h4;
          }
          // border: 1px solid blue;
        }
        .item6 {
          position: relative;
          top: 0rem;
          left: 5rem;
          &::before {
            content: 'WineColumn';
            position: absolute;
            top: 1.8rem;
            font-size: $fontSize_h4;
          }
          // border: 1px solid blue;
        }
        .item7 {
          position: relative;
          top: 2rem;
          left: -5rem;
          &::before {
            content: 'Q&A';
            position: absolute;
            top: 1.8rem;
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
    border: 1px solid red;
  }
}
</style>
