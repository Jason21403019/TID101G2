<!-- <template>
    <section>
        <div class="loginpage">
        <div class="logo">
            <img src="../imgs/logo/logo-w.png" style="width: 150px;">
        </div>
        <div class="wrapper">
            <a href="./login_page.vue"><p>前台</p></a>
            <a href="./admin_login.vue"><p>後台</p></a>
        </div>
        <div class="login">
            <img src="../imgs/burger.png" style="width: 20vw;">
        </div>
    </div>
    </section>
</template>

<script>
export default {
  name: 'login'
}
</script>
<style lang="scss" scoped>
section{
    .loginpage {
        // background-image: url(../imgs/loginImg/login_on.jpg);
        // background-repeat: no-repeat;
        // background-size: cover;
        background: $negroni;
        width: 100%;
        height: 100vh;
        }
        .loginpage .logo {
        text-align: center;
        padding-top: 20px;

        }
        .wrapper{
            display: flex;
            justify-content: space-evenly;
            margin-top: 30px;
        }
        a{
            display: inline-block;
            text-emphasis: none;
            color: $campari ;
            border-radius: 100%;
            background-color: $ramos-gin-fizz;
        }
        p{
            line-height: 6;
            text-align: center;
            font-size: 30px;
            margin: 0 80px;
        }
        .login{
            text-align: center;
        }
}


</style> -->
<template>
    <section>
      <div class="loginpage">
        <div class="logo">
          <img src="../imgs/logo/logo-w.png" style="width: 150px;">
        </div>
        <div class="wrapper">
          <a href="./login_page.vue" 
             draggable="true" 
             @dragstart="onDragStart" 
             data-link="./login_page.vue">
            <p>前台</p>
          </a>
          <a href="./admin_login.vue" 
             draggable="true" 
             @dragstart="onDragStart" 
             data-link="./admin_login.vue">
            <p>後台</p>
          </a>
        </div>
        <div class="login" 
             @dragover.prevent 
             @drop="onDrop">
          <img src="../imgs/burger.png" style="width: 20vw;">
        </div>
      </div>
    </section>
  </template>
  
  <script>
  export default {
    name: 'login',
    methods: {
      onDragStart(event) {
        event.dataTransfer.setData('link', event.target.getAttribute('data-link'));
      },
      onDrop(event) {
        const link = event.dataTransfer.getData('link');
        if (link) {
          window.location.href = link;
        }
      }
    }
  }
  </script>
  
  <style lang="scss" scoped>
  section {
    .loginpage {
      // background-image: url(../imgs/loginImg/login_on.jpg);
      // background-repeat: no-repeat;
      // background-size: cover;
      background: $negroni;
      width: 100%;
      height: 100vh;
    }
    .loginpage .logo {
      text-align: center;
      padding-top: 20px;
    }
    .wrapper {
      display: flex;
      justify-content: space-evenly;
      margin-top: 30px;
    }
    a {
      display: inline-block;
      text-emphasis: none;
      color: $campari;
      border-radius: 100%;
      background-color: $ramos-gin-fizz;
    }
    p {
      line-height: 6;
      text-align: center;
      font-size: 30px;
      margin: 0 80px;
    }
    .login {
      text-align: center;
    }
  }
  </style>
  