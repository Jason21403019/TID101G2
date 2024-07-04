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
        <div class="login" :style="backgroundStyle">
          <!-- Empty div used for background image -->
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
      offImage: new URL(`@/imgs/loginImg/login-off.jpg`, import.meta.url).href,
      currentImage: '' // Current background image URL
    }
  },
  computed: {
    backgroundStyle() {
      return {
        backgroundImage: `url(${this.currentImage})`,
        backgroundSize: 'cover', // Cover the entire div
        backgroundPosition: 'center', // Center the background image
        width: '100%', // Full width
        height: '100vh' // Full viewport height
      }
    }
  },
  methods: {
    handleClick(link) {
      this.currentImage = this.offImage // Switch to offImage as background
      setTimeout(() => {
        this.$router.push(link) // Navigate after a short delay
      }, 300)
    }
  },
  mounted() {
    this.currentImage = this.onImage // Set initial background image
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
