<template>
  <section>
    <div class="loginpage">
      <div class="box">
        <div class="wrapper">
          <a draggable="true" data-link="/home" @dragstart="onDragStart">
            <img class="log_home" src="../imgs/loginImg/login_but-02.svg" width="125" height="125" />
          </a>

          <a draggable="true" data-link="/admin_login" @dragstart="onDragStart">
            <img class="log_admin" src="../imgs/loginImg/login_but-03.svg" width="125" height="125" />
          </a>
        </div>
        <div class="login" @dragover.prevent @drop="onDrop">
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
      // 拖移事件觸發後更換圖片
      // onImage: 'src/imgs/loginImg/login-on.jpg',
      // offImage: 'src/imgs/loginImg/login-off.jpg'
      onImage: new URL(`@/imgs/loginImg/login-on.jpg`, import.meta.url).href,
      offImage: new URL(`@/imgs/loginImg/login-off.jpg`, import.meta.url).href
    }
  },
  methods: {
    onDragStart(event) {
      // 原本的設定會只吃到第一個父層連結也就是home
      // event.dataTransfer.setData('link', event.target.closest('a').getAttribute('data-link'));

      // 透過抓到a標籤，找到裡面的data-link的屬性值，獲得要去路徑網址
      const link = event.target.closest('a').getAttribute('data-link')

      event.dataTransfer.setData('link', link)
    },
    onDrop(event) {
      const link = event.dataTransfer.getData('link')

      if (link) {
        this.onImage = this.offImage
        setTimeout(() => {
          this.$router.push(link)
        }, 300)
      }
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
    padding-top: 40px;
    z-index: 1;
  }
  .login {
    text-align: center;
    img {
      // mix-blend-mode: hard-light;
      position: relative;
    }
  }
  .log_home,
  .log_admin {
    cursor: grab;
    transition: transform 0.3s ease;
  }

  .log_home:hover,
  .log_admin:hover {
    cursor: grab;
    transform: scale(1.1);
  }
}
</style>
