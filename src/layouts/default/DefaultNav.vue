<template>
  <header class="header" :style="{ top: navTop }">
    <div class="header__logoarea">
      <router-link to="/home" class="header__logoarea-logo" @click="closeHamburger">
        <img v-if="black" :src="getNavLogoSrc" alt="" />
        <img v-else :src="getNavLogoSrc" alt="" />
      </router-link>
    </div>
    <div class="header__btnarea">
      <div class="header__btnarea-icons">
        <!-- 背景底色不同icon顏色變換 -->
        <router-link to="/register" v-if="!isLoggedIn" class="header__icons-icon register" @click="toggleSubmenu">
          <img v-if="black" class="header__icons-icon-img1" :src="getNavMemberSrc" alt="" />
          <img v-else class="header__icons-icon-img1" :src="getNavMemberSrc" alt="" />
        </router-link>

        <!-- 登入後顯示的按鈕 -->
        <button v-else class="header__icons-icon afterLogin" @click="memberAndLogout">
          <img class="header__icons-icon-img1" :src="getAfterLoginSrc" alt="Logout Icon" />
        </button>

        <!-- 購物車 -->
        <router-link to="/cart" class="header__icons-icon carts" @click="closeHamburger">
          <img v-if="black" class="header__icons-icon-img2" :src="getNavCartSrc" alt="" />
          <img v-else class="header__icons-icon-img2" :src="getNavCartSrc" alt="" />
        </router-link>

        <!-- 會員中心與登出 -->
        <div v-show="memberAndLogout" class="logoutMenu" :class="{ show: isDropdownVisible }">
          <router-link to="/member" class="logoutMenu-item" @click="closeMemberMenu"> 會員中心 </router-link>
          <button type="submit" @click="logout" class="logoutMenu-item">登出</button>
        </div>
      </div>
      <!-- 登入 -->
      <!-- <div v-show="showSubmenu" class="header__icons-icon submenu">
        <router-link to="/register" class="header__icons-icon-img1 login" @click.stop="handleRegisterClick"> 登入 </router-link>
      </div> -->

      <!-- hamburger -->
      <button class="h__btn" :class="hamburger__class" @click="toggleHamburger">
        <span class="hamburger__bar" :class="hanburgerBarColor"></span>
        <span class="hamburger__bar" :class="hanburgerBarColor"></span>
        <span class="hamburger__bar" :class="hanburgerBarColor"></span>
      </button>
      <!-- circle -->
      <div class="circle" :class="hamburger__class"></div>

      <!-- navBar -->
      <div :class="['menu__nav', { active: isHamburgerOpen, 'nav-dark': isHamburgerOpen }]">
        <nav class="menu__nav-content">
          <ul class="menu__nav-ul">
            <li class="menu__nav-ul-item" :class="hamburger__class">
              <router-link to="/about_us" class="menu__link" @click="closeHamburger"><span>關於我們</span></router-link>
              <router-link to="/menus" class="menu__link" @click="closeHamburger"><span>菜單</span></router-link>
              <router-link to="/reserve_first" class="menu__link" @click="closeHamburger"><span>預約訂位</span></router-link>
              <router-link to="/product" class="menu__link" @click="closeHamburger"><span>全部商品</span></router-link>
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
import { useUserStore } from '../../stores/user'

export default {
  inclouds: [logoimg, membertSrc],
  name: 'DefaultNav',
  data() {
    return {
      isHamburgerOpen: false,
      lastPos: 0,
      navTop: '0px',
      showSubmenu: false,
      dropdownVisible: false,
      isDropdownVisible: false
    }
  },
  computed: {
    // ...mapState(useUserStore, ['isLoggedIn']),
    isLoggedIn() {
      const userStore = useUserStore()

      // console.log(userStore)
      // console.log(userStore.isLoggedIn)

      return userStore.isLoggedIn
    },
    currentPath() {
      // console.log(this.$route.name)

      return this.$route.name
    },
    // 哪一個頁面是淺色的，使用路徑抓取
    black() {
      const blackRoutes = ['Reserve_first', 'Reserve_sec', 'Cart', 'Register']

      return blackRoutes.includes(this.currentPath)
    },
    getLogoSrc() {
      return this.black
        ? new URL('@/imgs/logo/logo.png', import.meta.url).href
        : new URL('@/imgs/logo/logo-w.png', import.meta.url).href
    },
    getLoginSrc() {
      return this.black
        ? new URL('@/imgs/icon/icon_member-off.svg', import.meta.url).href
        : new URL('@/imgs/icon/icon_member-off-w.svg', import.meta.url).href
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
    getAfterLoginSrc() {
      return this.black
        ? new URL('@/imgs/icon/icon_member-off.svg', import.meta.url).href
        : new URL('@/imgs/icon/icon_member-off-w.svg', import.meta.url).href
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
      return this.isHamburgerOpen ? 'h-white' : this.black ? 'h-black' : 'h-black-on-light'
    },

    closeDropdown() {
      this.dropdownVisible = !this.dropdownVisible
    }
  },
  mounted() {
    window.addEventListener('scroll', this.handleScroll)
  },
  beforeUnmount() {
    window.removeEventListener('scroll', this.handleScroll)
  },

  methods: {
    // ...mapActions(useUserStore, ['logout']),
    logout() {
      const userStore = useUserStore()

      userStore.logout()
      this.$router.push('/home')
      this.memberAndLogout()
    },
    toggleHamburger() {
      this.isHamburgerOpen = !this.isHamburgerOpen
    },
    closeHamburger() {
      this.isHamburgerOpen = false
    },
    closeMemberMenu() {
      this.isDropdownVisible = false
    },
    toggleSubmenu() {
      this.showSubmenu = !this.showSubmenu
    },
    handleRegisterClick() {
      this.showSubmenu = false // 關閉 submenu
      this.closeHamburger() // 如果還需要進行其他處理，如關閉漢堡菜單
    },
    memberAndLogout() {
      if (useUserStore.isLoggedIn == null) {
        this.isDropdownVisible = !this.isDropdownVisible
      }
    },

    handleScroll() {
      const currentPos = window.scrollY

      if (currentPos > this.lastPos) {
        this.navTop = '-100px'
      } else {
        this.navTop = '0px'
      }
      this.lastPos = currentPos
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
  transition: top 0.5s;
  pointer-events: none;
  .h-black {
    background: $negroni;
  }
  .h-white {
    background: $whitelady;
  }
  .h-black-on-light {
    background: $whitelady;
  }
  &__logoarea {
    width: 100px;
    height: 80px;
    padding-left: 1rem;
    pointer-events: auto;
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
    pointer-events: auto;
    // border: 1px solid green;
    position: relative;
    &-icons {
      display: flex;
      flex-basis: 200px;
      justify-content: space-around;
      align-items: center;
      // border: 1px solid green;
      position: relative;
      cursor: pointer;
      button {
        border: none;
        background: none;
        outline: none;
        cursor: pointer;
      }
      .logoutMenu {
        position: absolute;
        width: 170px;
        height: fit-content;
        top: 30px;
        right: 75px;
        display: none;
        flex-direction: column;
        align-items: center !important;
        padding: 0.5rem 0.5rem;
        @include border-radius(8px);
        background: $negroni;
        font-size: $fontSize_p;
        &-item {
          color: $blackvevet;

          &:nth-child(1) {
            margin-bottom: 0.65rem;
            text-decoration: none;
            width: 100%;
            font-family: $fontfamily;
            text-align: center;
            background: $ramos-gin-fizz;
            @include border-radius(4px);
          }
          &:nth-child(2) {
            width: 100%;
            font-family: $fontfamily;
            @include border-radius(4px);
            color: $negroni;
            text-align: center;
            background: $ramos-gin-fizz;
          }
        }
      }
      .logoutMenu.show {
        display: flex;
      }
      .register {
        // border: 1px solid red;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .carts {
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .header__icons-icon {
        position: relative;
        z-index: 1000;
        cursor: pointer;
        &-img1 {
          width: 30px;
        }
        &-img2 {
          width: 30px;
          padding-top: 2px;
        }
      }
    }
    .login {
      position: absolute;
      left: -75px;
      top: 55px;
      width: 120px !important;
      height: 50px;
      background: $negroni;
      @include border-radius(8px);
      color: $ramos-gin-fizz;
      font-size: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      text-decoration: none;
      font-size: $fontSize_p;
    }
  }
  .h__btn {
    cursor: pointer;
    border: none;
    outline: none;
    background-color: transparent;
    // border: 1px solid red;
    margin-left: 15px;
    // margin-bottom: 5px;
    height: 35px;
    position: relative;
  }
  .circle {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    position: absolute;
    right: 1.35rem;
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
          transform: translateX(120px);
        }
        &:nth-child(odd) {
          transform: translateX(-120px);
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
