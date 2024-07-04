<template>
  <section>
    <div class="loginpage">
      <div class="box">
        <div class="wrapper">
          <a @click="handleClick('/home')" data-link="/home">
            <img class="log_home" src="../imgs/loginImg/login_but-02.svg" width="125" height="125" />
          </a>
          <p style="color: #fff">點擊冰塊進入頁面</p>
          <a @click="handleClick('/admin_login')" data-link="/admin_login">
            <img class="log_admin" src="../imgs/loginImg/login_but-03.svg" width="125" height="125" />
          </a>
        </div>
        <div class="login">
          <img :src="onImage" width="590" />
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'Login',
  data() {
    return {
      onImage: new URL(`@/imgs/loginImg/login-on.jpg`, import.meta.url).href,
      offImage: new URL(`@/imgs/loginImg/login-off.jpg`, import.meta.url).href
    }
  },
  methods: {
    handleClick(link) {
      this.onImage = this.offImage // 更换图片以显示动画或视觉反馈
      setTimeout(() => {
        this.$router.push(link) // 跳转到相应页面
      }, 300) // 短暂延迟以显示动画效果
    }
  }
}
</script>

<style lang="scss" scoped>
section {
  background: #000;
  height: 100vh;
  .wrapper {
    display: flex;
    justify-content: space-evenly;
    padding-top: 100px;
    z-index: 1;
  }
  .login {
    text-align: center;
    overflow: hidden;
    img {
      display: flex;
      @media (max-width: 767px) {
        margin: 0 auto;
        display: block;
        width: 100vw;
      }
    }
  }
  .log_home,
  .log_admin {
    cursor: pointer;
    transition: transform 0.3s ease;
  }

  .log_home:hover,
  .log_admin:hover {
    transform: scale(1.1);
  }
}
</style>
