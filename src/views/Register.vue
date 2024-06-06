<template>
  <body class="ral__wrapper">
    <div class="ral__container">
      <div class="ral__btns">
        <button class="ral__btns-btn ral__container-registerbtn" :class="{ active: isRegister }" @click="showRegister">
          註冊
        </button>
        <button class="ral__btns-btn ral__container-loginbtn" :class="{ active: !isRegister }" @click="showLogin">登入</button>
      </div>
      <transition name="fade" mode="out-in">
        <div v-if="isRegister" class="register__container">
          <div class="register__container-title">
            <h3>會員募集中 <br />免費註冊會員拿500元折價券</h3>
          </div>
          <div class="register__container-name">
            <label for="name">姓名</label>
            <input id="name" type="text" placeholder="請輸入姓名" />
          </div>
          <div class="register__container-phone">
            <label for="phone">電話</label>
            <input id="phone" type="tel" placeholder="請輸入電話" />
          </div>
          <div class="register__container-email">
            <label for="email">電子郵件</label>
            <input id="email" type="email" placeholder="請輸入電子郵件" />
          </div>
          <div class="register__container-password">
            <label for="password">密碼</label>
            <input id="password" type="password" placeholder="請輸入密碼" />
          </div>
          <div class="register__container-confirmpassword">
            <label for="password">密碼</label>
            <input id="password" type="password" placeholder="請輸入密碼" />
          </div>
          <div class="register__container-haveaccount">
            <p>已經有帳號了嗎？<button @click="showLogin">登入</button></p>
          </div>
          <div class="register__container-submit">
            <button>註冊</button>
          </div>
        </div>
      </transition>
      <transition name="fade" mode="in-out">
        <div v-if="!isRegister" class="login__container">
          <div class="login__container-title">
            <h3>快速登入</h3>
          </div>
          <div class="login__container-googleaccount">
            <button class="login__googleaccount-btn">
              <img src="../imgs/icon/google.svg" alt="" />
              <span>使用Google帳號登入</span>
            </button>
          </div>
          <div class="login__container-email">
            <label for="email">電子郵件</label>
            <input id="email" type="email" placeholder="請輸入電子郵件" />
          </div>
          <div class="login__container-password">
            <label for="password">密碼</label>
            <input id="password" type="password" placeholder="請輸入密碼" />
          </div>
          <div class="login__container-noaccount">
            <p>沒有帳號嗎？<button @click="showRegister">註冊</button></p>
            <p>忘記密碼嗎？<button>重設密碼</button></p>
          </div>
          <div class="login__container-submit">
            <button>登入</button>
          </div>
        </div>
      </transition>
    </div>
  </body>
</template>

<script>
export default {
  name: 'RegisterAndLogin',
  data() {
    return {
      isRegister: true
    }
  },
  methods: {
    showRegister() {
      this.isRegister = true
    },
    showLogin() {
      this.isRegister = false
    }
  }
}
</script>

<style lang="scss" scoped>
.ral__wrapper {
  padding-top: 120px;
  background: rgba($color: $ramos-gin-fizz, $alpha: 0.5);
  line-height: $lineheight;
  font-family: $fontfamily;
  padding-bottom: 3rem;

  .ral__container {
    // border: 1px solid red;
    width: 50%;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;
    .ral__btns {
      display: flex;
      justify-content: space-evenly;
      width: 86%;
      margin: 0 auto;
      &-btn {
        outline: none;
        border: none;
        width: 300px;
        margin: 0.25rem;
        line-height: 70px;
        font-size: $fontSize_h3;
        @include border-radius(8px);
        cursor: pointer;
        transition: background 0.5s, color 0.5s;
      }
      &-btn.active {
        background-color: $irishcoffee;
        color: $campari;
      }
      &-btn:not(.active) {
        background-color: $ramos-gin-fizz;
        color: $campari;
      }
    }
    &-registerbtn {
      // border: 1px solid blue !important;
      background: $irishcoffee;
    }
    &-loginbtn {
      background: transparent;
      color: $campari;
      // border: 1px solid red !important;
    }
  }
  .fade-enter-active,
  .fade-leave-active {
    transition: opacity 0.1s;
  }
  .fade-enter,
  .fade-leave-to {
    opacity: 0;
  }
  .register__container {
    // border: 1px solid green;
    display: flex;
    flex-direction: column;
    align-items: center;
    background: $irishcoffee;
    width: 85%;
    margin: 0 auto;
    transition: background 0.5s, color 0.5s;
    @include border-radius(8px);

    &-title {
      h3 {
        padding: 1.5rem 2rem;
        // border: 1px solid red;
        text-align: center;
        font-size: $fontSize_h4;
        font-family: $fontfamily;
        color: $campari;
      }
    }
    &-name,
    &-phone,
    &-email,
    &-password,
    &-confirmpassword {
      display: flex;
      flex-direction: column;
      color: $campari;
      label {
        font-size: $fontSize_h4;
        padding-bottom: 0.5rem;
        padding: 0.5rem 0.25rem;
      }
      input {
        width: 350px;
        height: 30px;
        margin-bottom: 0.5rem;
        border: 1px solid green;
        padding: 1.5rem 1rem;
        border: none;
        outline: none;
        @include border-radius(8px);
        font-size: $fontSize_h4;
        background-color: $whitelady;
      }
      // border: 1px solid red;
    }
    &-haveaccount {
      margin-right: 11rem;
      margin-bottom: 2.5rem;
      // padding: 1rem 0;
      color: $campari;

      p {
        font-size: $fontSize_p;
        button {
          color: $campari;
          outline: none;
          border: none;
          background: transparent;
          cursor: pointer;
          text-decoration: underline;
        }
      }
    }
    &-submit {
      button {
        color: $campari;
        outline: none;
        border: none;
        width: 350px;
        margin: 0.25rem;
        line-height: 50px;
        font-size: $fontSize_h3;
        background: $whitelady;
        @include border-radius(8px);
        cursor: pointer;
        margin-bottom: 2rem;
      }
    }
  }
  .login__container {
    display: flex;
    flex-direction: column;
    align-items: center;
    background: $irishcoffee;
    transition: background 0.5s, color 0.5s;
    width: 85%;
    margin: 0 auto;
    @include border-radius(8px);
    &-title {
      h3 {
        padding: 1rem 2rem;
        // border: 1px solid red;
        text-align: center;
        font-size: $fontSize_h4;
        font-family: $fontfamily;
      }
    }
    &-googleaccount {
      // border: 1px solid red;
      &::after {
        content: '';
        display: block;
        width: 350px;
        height: 1px;
        background: $campari;
        margin: 1rem 0;
      }
      .login__googleaccount-btn {
        outline: none;
        border: none;
        width: 350px;
        padding: 0.5rem 0.75rem;
        font-size: $fontSize_h4;
        background: $whitelady;
        @include border-radius(8px);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        img {
          padding-top: 3px;
          width: 30px;
          height: 30px;
        }
        span {
          margin-left: 0.5rem;
        }
      }
    }

    &-email,
    &-password {
      display: flex;
      flex-direction: column;
      label {
        font-size: $fontSize_h4;
        padding-bottom: 0.5rem;
        padding: 0.5rem 0.25rem;
      }
      input {
        width: 350px;
        height: 30px;
        margin-bottom: 0.5rem;
        // border: 1px solid green;
        padding: 1.5rem 1rem;
        border: none;
        outline: none;
        @include border-radius(8px);
        font-size: $fontSize_h4;
        background-color: $whitelady;
        &::placeholder {
          color: $campari;
        }
      }
      // border: 1px solid red;
    }
    &-noaccount {
      margin-right: 11rem;
      // padding: 1rem 0;
      p {
        font-size: $fontSize_p;
        button {
          color: $campari;
          outline: none;
          border: none;
          background: transparent;
          cursor: pointer;
          text-decoration: underline;
        }
      }
    }
    &-submit {
      button {
        outline: none;
        border: none;
        width: 350px;
        margin: 0.25rem;
        line-height: 50px;
        font-size: $fontSize_h3;
        background: $whitelady;
        @include border-radius(8px);
        cursor: pointer;
        margin: 2rem;
      }
    }
  }
}
</style>
