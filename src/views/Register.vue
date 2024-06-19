<template>
  <body class="ral__wrapper">
    <div class="ral__container">
      <div class="ral__btns">
        <button class="ral__btns-btn ral__container-registerbtn" :class="{ active: isRegister }" @click="showRegister">
          註冊
        </button>
        <button class="ral__btns-btn ral__container-loginbtn" :class="{ active: !isRegister }" @click="showLogin">登入</button>
      </div>
      <div v-if="isRegister" class="register__container">
        <div class="register__container-title">
          <h3>會員募集中 <br />免費註冊會員拿500元折價券</h3>
        </div>
        <div class="register__container-name">
          <label for="name">姓名</label>
          <input id="name" v-model="form.name" type="text" placeholder="請輸入姓名" />
        </div>
        <div class="register__container-phone">
          <label for="phone">電話</label>
          <input id="phone" v-model="form.phone" type="tel" placeholder="請輸入電話" />
        </div>
        <div class="register__container-email">
          <label for="email">電子郵件</label>
          <input id="email" v-model="form.email" type="email" placeholder="請輸入電子郵件" />
        </div>
        <div class="register__container-password">
          <label for="password">密碼</label>
          <input id="password" v-model="form.password" type="password" placeholder="請輸入密碼" />
        </div>
        <div class="register__container-confirmpassword">
          <label for="password">確認密碼</label>
          <input id="confirmPassword" v-model="form.confirmPassword" type="password" placeholder="請再次輸入密碼" />
        </div>
        <div class="register__container-haveaccount">
          <p>已經有帳號了嗎？<button @click="showLogin">登入</button></p>
        </div>
        <div class="register__container-submit">
          <button type="submit" @click.prevent="register">註冊</button>
        </div>
      </div>
      <div v-if="!isRegister" class="login__container">
        <div class="login__container-title">
          <h3>快速登入</h3>
        </div>
        <div class="login__container-googleaccount">
          <button class="login__googleaccount-btn">
            <img src="../imgs/icon/google.svg" alt="" />
            <span>使用Google登入</span>
          </button>
        </div>
        <div class="login__container-email">
          <label for="email">電子郵件</label>
          <input id="email" v-model="email" type="email" placeholder="請輸入電子郵件" />
        </div>
        <div class="login__container-password">
          <label for="password">密碼</label>
          <input id="password" v-model="password" type="password" placeholder="請輸入密碼" />
        </div>
        <div class="login__container-noaccount">
          <p>沒有帳號嗎？<button @click="showRegister">註冊</button></p>
          <p>忘記密碼嗎？<button @click="showFirstPopup = true">重設密碼</button></p>
          <ForgetPasswordPop :isvible="showFirstPopup" @close-popup="showFirstPopup = false" />
        </div>
        <div class="login__container-submit">
          <button type="submit" @click.prevent="login">登入</button>
        </div>
      </div>
    </div>
  </body>
</template>

<script>
import ForgetPasswordPop from '@/components/ForgetPasswordPop.vue'
import { mapActions } from 'pinia'
import { useUserStore } from '@/stores/user'

export default {
  name: 'RegisterAndLogin',
  components: { ForgetPasswordPop },
  data() {
    return {
      isRegister: true,
      showFirstPopup: false,
      email: '',
      password: '',
      error: null,
      form: {
        name: '',
        phone: '',
        email: '',
        password: '',
        confirmPassword: ''
      }
    }
  },
  methods: {
    ...mapActions(useUserStore, ['login']),
    showRegister() {
      this.isRegister = true
    },
    showLogin() {
      this.isRegister = false
    },
    async login() {
      const userStore = useUserStore()

      if (!this.email || !this.password) {
        this.error = 'Email 和 Password 是必填的'

        return
      }

      try {
        const response = await fetch('/public/api/Login.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            email: this.email,
            password: this.password
          })
        })
        // const result = await response.json() // 將回應轉換為JSON

        // if (result.success) {
        //   this.error = null
        //   userStore.login() // 使用 Pinia 的 login action
        //   this.$router.push('/member') // 導向會員頁面
        // } else {
        //   this.error = result.message || 'Login failed' //
        // }
        if (response) {
          this.error = null
          console.log('Login successful')
          userStore.login() // 使用 Pinia 的 login action
          this.$router.push('/member') // 導向會員頁面
        } else {
          this.error = 'Login failed'
        }
      } catch (err) {
        console.error('Error:', err)
        this.error = 'An error occurred'
      }
    },
    async register() {
      // 簡單驗證
      if (this.form.password !== this.form.confirmPassword) {
        alert('密碼與確認密碼不一致')

        return
      }

      try {
        const response = await fetch('/public/api/Register.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(this.form)
        })

        const result = await response.json()

        if (result.success) {
          alert('註冊成功')
        } else {
          alert('註冊失敗: ' + result.message)
        }
      } catch (error) {
        alert('註冊失敗: ' + error.message)
      }
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
    @include breakpoint(920px) {
      width: 80%;
    }
    @include breakpoint(570px) {
      width: 90%;
    }
    @include breakpoint(500px) {
      width: 100%;
    }
    .ral__btns {
      display: flex;
      justify-content: space-evenly;
      width: 86%;
      margin: 0 auto;
      @include breakpoint(500px) {
        width: 100%;
      }
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
      letter-spacing: $letterspacing;
    }
    &-loginbtn {
      background: transparent;
      color: $campari;
      letter-spacing: $letterspacing;
      // border: 1px solid red !important;
    }
  }
  .register__container {
    // border: 1px solid green;
    display: flex;
    flex-direction: column;
    align-items: center;
    background: $irishcoffee;
    width: 86%;
    margin: 0 auto;
    transition: background 0.5s, color 0.5s;
    @include border-radius(8px);
    @include breakpoint(500px) {
      width: 98%;
    }
    &-title {
      h3 {
        padding: 1.5rem 2rem;
        // border: 1px solid red;
        text-align: center;
        font-size: $fontSize_h4;
        font-family: $fontfamily;
        color: $campari;
        letter-spacing: $letterspacing;
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
        letter-spacing: $letterspacing;
      }
      input {
        width: 350px;
        height: 20px;
        margin-bottom: 0.5rem;
        border: 1px solid green;
        padding: 1.15rem 1rem;
        border: none;
        outline: none;
        @include border-radius(8px);
        font-size: $fontSize_h4;
        background-color: $whitelady;
        letter-spacing: $letterspacing;
        &::placeholder {
          color: rgba($color: $campari, $alpha: 0.5);
        }
      }
      // border: 1px solid red;
    }
    &-haveaccount {
      margin-right: 3rem;
      margin-bottom: 2rem;
      // padding: 1rem 0;
      color: $campari;

      p {
        letter-spacing: $letterspacing;
        font-size: $fontSize_p;
        button {
          color: $campari;
          letter-spacing: $letterspacing;
          display: inline-block;
          text-align: center;
          outline: none;
          border: none;
          background: transparent;
          cursor: pointer;
          text-decoration: underline;
          text-underline-offset: 3px;
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
        letter-spacing: $letterspacing;
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
    @include breakpoint(500px) {
      width: 98%;
    }
    &-title {
      h3 {
        padding: 1rem 2rem;
        // border: 1px solid red;
        text-align: center;
        font-size: $fontSize_h4;
        letter-spacing: $letterspacing;
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
        font-size: $fontSize_p;
        letter-spacing: $letterspacing;
        background: $whitelady;
        @include border-radius(8px);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        letter-spacing: $letterspacing;
        color: $campari;
        img {
          padding-top: 3px;
          width: 30px;
          height: 30px;
        }
        span {
          margin-left: 0.5rem;
          color: $campari;
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
        letter-spacing: $letterspacing;
        color: $campari;
      }
      input {
        width: 350px;
        height: 30px;
        margin-bottom: 0.5rem;
        // border: 1px solid green;
        padding: 1.15rem 1rem;
        border: none;
        outline: none;
        @include border-radius(8px);
        font-size: $fontSize_h5;
        letter-spacing: $letterspacing;
        color: $campari;
        background-color: $whitelady;
        &::placeholder {
          color: rgba($color: $campari, $alpha: 0.5);
        }
      }
      // border: 1px solid red;
    }
    &-noaccount {
      margin-right: 3rem;
      // padding: 1rem 0;
      p {
        font-size: $fontSize_p;
        letter-spacing: $letterspacing;
        color: $campari;
        button {
          color: $campari;
          outline: none;
          border: none;
          background: transparent;
          cursor: pointer;
          text-decoration: underline;
          letter-spacing: $letterspacing;
          color: $campari;
          text-align: center;
          text-decoration: underline;
          text-underline-offset: 3px;
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
        letter-spacing: $letterspacing;
        color: $campari;
        @include border-radius(8px);
        cursor: pointer;
        margin: 2rem;
      }
    }
  }
}
</style>
