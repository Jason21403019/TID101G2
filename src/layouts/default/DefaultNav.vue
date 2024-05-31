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
          <router-link to="/" class="menu__link item1">關於我們</router-link>
          <router-link to="/" class="menu__link item2">菜單</router-link>
          <router-link to="/" class="menu__link item3">預約訂位</router-link>
          <router-link to="/" class="menu__link item4">熱門商品</router-link>
          <router-link to="/" class="menu__link item5">測驗遊戲</router-link>
          <router-link to="/" class="menu__link item6">酒品專欄</router-link>
          <router-link to="/question" class="menu__link item7">常見問題</router-link>
        </li>
      </ul>
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
  background-color: $irishcoffee;
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
    // border: 1px solid red;
    margin-left: 15px;
    margin-bottom: 2px;
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
  background-color: $irishcoffee;
  &.active {
    transform: translateX(0);
  }
  &-content {
    border: 1px solid red;
    width: 100%;
    height: 100%;
  }
  &-ul {
    display: flex;
    position: relative;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
    &-item {
      .menu__link {
        font-family: $fontfamily;
        font-size: $fontSize_h2;
        text-decoration: none;
        text-align: center;
      }
      .item1 {
        color: $whitelady;
        position: relative;
        top: -110px;
        transform: skewY(-20deg);
        &:before {
          content: 'AboutUs';
          font-size: $fontSize_h3;
          text-align: center;
          top: 50px;
          left: 10%;
          // transform: translate(-50%, -50%) skewY(20deg);
          position: absolute;
        }
      }
    }
  }
}
</style>
