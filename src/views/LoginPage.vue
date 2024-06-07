<template>
  <section>
    <div class="loginpage">
      <div class="box">
        <div class="wrapper">
          <a draggable="true" @dragstart="onDragStart" data-link="/">
            <img class="log_home" src="../imgs/loginImg/login_but-02.svg" width="125" height="125" />
          </a>

          <a draggable="true" @dragstart="onDragStart" data-link="/admin_login">
            <img class="log_admin" src="../imgs/loginImg/login_but-03.svg" width="125" height="125" />
          </a>
        </div>
        <div class="login" @dragover.prevent @drop="onDrop">
          <img :src="onImage" width="800" />
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'login',
  data() {
    return {
      // 拖移事件觸發後更換圖片
      onImage: 'src/imgs/loginImg/login-on.jpg',
      offImage: 'src/imgs/loginImg/login-off.jpg'
    }
  },
  methods: {
    onDragStart(event) {
      // 原本的設定會只吃到第一個父層連結也就是home
      // event.dataTransfer.setData('link', event.target.closest('a').getAttribute('data-link'));

      //透過抓到a標籤，找到裡面的data-link的屬性值，獲得要去路徑網址
      const link = event.target.closest('a').getAttribute('data-link')
      event.dataTransfer.setData('link', link)
    },
    onDrop(event) {
      const link = event.dataTransfer.getData('link');
      if (link) {
        this.onImage = this.offImage;
        setTimeout(() => {
          this.$router.push(link); 
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
    padding-top: 60px;
    z-index: 1;
  }
  .login {
    text-align: center;
    img {
      // mix-blend-mode: hard-light;
      position: relative;
    }
  }
}
</style>
