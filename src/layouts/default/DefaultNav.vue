<template>
  <header class="header">
    <div class="header__logo">
      <img src="../../imgs/logo/logo-w.png" alt="" />
    </div>
    <nav class="header__nav">
      <ul class="header__list">
        <li class="header__item">
          <router-link to="/" class="header__link">關於我們</router-link>
          <router-link to="/" class="header__link">菜單</router-link>
          <router-link to="/" class="header__link">預約訂位</router-link>
          <router-link to="/" class="header__link">熱門商品</router-link>
          <router-link to="/" class="header__link">測驗遊戲</router-link>
          <router-link to="/" class="header__link">酒品專欄</router-link>
          <router-link to="/" class="header__link">常見問題</router-link>
        </li>
      </ul>
    </nav>
    <div class="header__icons">
      <router-link to="/" class="header__icons-icon">會員</router-link>
      <router-link to="/" class="header__icons-icon">購物車</router-link>
      <div class="header__hamburgers">
        <div class="header__hamburger-bars">
          <span class="header__hamburger-bar"></span>
          <span class="header__hamburger-bar"></span>
          <span class="header__hamburger-bar"></span>
        </div>
      </div>
    </div>
  </header>
</template>

<script></script>

<style lang="scss">
.header {
  border: 1px solid red;
  background: $irishcoffee;
  align-items: center;
  display: flex;
  &__logo {
    width: 80px;
    height: 80px;
    img {
      width: 100%;
      height: 100%;
    }
  }
  &__nav {
    display: none;
  }
  &__icons {
    display: flex;
    &-icon {
      line-height: 80px;
      cursor: pointer;
      margin: 0 10px;
    }
  }
  &__hamburgers {
    border: 1px solid red;
    cursor: pointer;
    z-index: 4;

    &-bar {
      display: block;
      width: 25px;
      height: 3px;
      margin: 5px auto;
      background: $ramos-gin-fizz;
    }
  }
}
</style>
