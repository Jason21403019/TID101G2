<template>
  <header class="header">
    <div class="header__logoarea">
      <routerlink to="/" class="header__logoarea-logo">
        <img src="../../imgs/logo/logo-w.png" alt="" />
      </routerlink>
    </div>
    <div class="header__btnarea">
      <div class="header__btnarea-icons">
        <router-link to="/" class="header__icons-icon">會員</router-link>
        <router-link to="/" class="header__icons-icon">購物車</router-link>
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
          <router-link to="/" class="header__link item1">關於我們</router-link>
          <router-link to="/" class="header__link item2">菜單</router-link>
          <router-link to="/" class="header__link item3">預約訂位</router-link>
          <router-link to="/" class="header__link item4">熱門商品</router-link>
          <router-link to="/" class="header__link item5">測驗遊戲</router-link>
          <router-link to="/" class="header__link item6">酒品專欄</router-link>
          <router-link to="/" class="header__link item7">常見問題</router-link>
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
.header {
  display: flex;
  justify-content: space-between;
  background-color: $irishcoffee;
  &__logoarea {
    width: 80px;
    height: 80px;
    padding-left: 1rem;
    &-logo {
      img {
        width: 100%;
        height: 100%;
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
    }
  }
  .h__btn {
    cursor: pointer;
    border: none;
    outline: none;
    background-color: transparent;
    z-index: 10;
  }

  .hamburger__bar {
    display: block;
    width: 25px;
    height: 3px;
    margin: 5px auto;
    border-radius: 20px;
    background-color: $ramos-gin-fizz;
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
  position: fixed;
}
</style>
