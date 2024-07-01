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
          <input id="name" v-model="form.full_name" type="text" placeholder="請輸入姓名" />
        </div>
        <div class="register__container-phone">
          <label for="phone">電話</label>
          <input id="phone" v-model="form.phone" type="tel" placeholder="09123456789" />
        </div>
        <div class="register__container-email">
          <label for="email">電子郵件</label>
          <input id="email" v-model="form.email" type="email" placeholder="example@gmail.com" />
        </div>
        <div class="register__container-password">
          <label for="password">密碼</label>
          <input id="password" v-model="form.password" type="password" placeholder="請輸入密碼" />
          <p class="error-message" v-if="form.password && passwordError">密碼必須至少8位數，且包含英文及數字</p>
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
          <!-- <h3>快速登入</h3> -->
        </div>
        <div class="login__container-googleaccount">
          <button class="login__googleaccount-btn" @click="googleLogin">
            <img src="../imgs/icon/google.svg" alt="" />
            <span>使用Google登入</span>
          </button>
        </div>
        <div class="login__container-email">
          <label for="email">電子郵件</label>
          <input id="email" v-model="loginForm.email" type="email" placeholder="請輸入電子郵件" />
        </div>
        <div class="login__container-password">
          <label for="password">密碼</label>
          <input id="password" v-model="loginForm.password" type="password" placeholder="請輸入密碼" />
          <p class="error-message" v-if="loginForm.password && passwordError">密碼必須至少8位數，且包含英文及數字</p>
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
import axios from 'axios'
import ForgetPasswordPop from '@/components/ForgetPasswordPop.vue'
import Swal from 'sweetalert2'
import { googleAuthCodeLogin } from 'vue3-google-login'
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
        full_name: '',
        phone: '',
        email: '',
        password: '',
        birth: '',
        address: ''
      },
      loginForm: {
        email: '',
        password: ''
      },
      passwordError: false,
      phoneError: false,
      emailError: false
    }
  },
  watch: {
    'form.password': 'validatePasswords'
  },
  computed: {
    isLoggedIn() {
      return useUserStore().isLoggedIn
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
    toggleLogin() {
      useUserStore().toggleLogin()
    },
    validateEmail() {
      const emailPattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
      this.emailError = !emailPattern.test(this.form.email)
      if (!emailPattern.test(this.form.email)) {
        this.emailError = true
        Swal.fire({
          icon: 'error',
          title: '無效的輸入',
          text: '請輸入有效的電子郵件地址。',
          confirmButtonText: '確定'
        })
      } else {
        this.emailError = false
      }
    },
    validatePhone() {
      const phonePattern = /^[0][9]\d{8}$/
      this.phoneError = !phonePattern.test(this.form.phone)
      if (!phonePattern.test(this.form.phone)) {
        this.phoneError = true
        Swal.fire({
          icon: 'error',
          title: '無效的輸入',
          text: '請輸入有效的手機號碼。',
          confirmButtonText: '確定'
        })
      } else {
        this.phoneError = false
      }
    },
    validatePasswords() {
      const password = this.form.password
      const minLength = 8
      const hasNumber = /\d/
      const hasLetter = /[a-zA-Z]/

      if (typeof password !== 'string') {
        this.passwordError = 'Password must be a valid string'
        return
      }

      if (password.length < minLength) {
        this.passwordError = 'Password must be at least 8 characters long'
      } else if (!hasNumber.test(password)) {
        this.passwordError = 'Password must contain at least one number'
      } else if (!hasLetter.test(password)) {
        this.passwordError = 'Password must contain at least one letter'
      } else {
        this.passwordError = '' // 清除錯誤
      }
    },
    clearForm() {
      this.form = {
        full_name: '',
        phone: '',
        email: '',
        password: '',
        birth: '',
        address: ''
      }
    },
    async googleLogin() {
      try {
        const response = await googleAuthCodeLogin()
        if (response.code) {
          console.log('Google authorization code:', response.code)
          // 將授權碼發送到後端
          this.registerUser(response.code)
        } else {
          console.error('No authorization code provided')
        }
      } catch (error) {
        console.error('Google login error:', error)
      }
    },
    async registerUser(code) {
      if (!code) {
        console.error('No authorization code provided')
        return
      }
      axios
        .post(`${import.meta.env.VITE_PHP_PATH}GoogleLogin.php`, { code: code })
        .then((response) => {
          this.user = response.data

          console.log('User registered:', response)
        })
        .catch((error) => {
          console.error('Error registering user:', error)
        })
    },
    // async handleGoogleLogin() {
    //   try {
    //     const googleUser = await this.$gAuth.signIn()
    //     console.log(googleUser)
    //     // 這裡可以添加後端API呼叫，將googleUser資訊發送到後端處理
    //   } catch (error) {
    //     console.error('登入失敗:', error)
    //   }
    // },
    async login() {
      const userStore = useUserStore()

      if (!this.loginForm.email || !this.loginForm.password) {
        this.passwordError = 'Email 和 Password 是必填的'
        return
      }

      try {
        // const response = await axios.post('http://localhost:8087/TID101G2/public/api/Login.php', this.loginForm, {

        const response = await axios.post(`${import.meta.env.VITE_PHP_PATH}Login.php`, this.loginForm, {
          headers: {
            'Content-Type': 'application/json'
          }
        })

        const result = response.data

        if (result.success) {
          this.passwordError = null
          userStore.login(result.userid)
          this.$router.push('/member')
        } else {
          this.passwordError = result.message || 'Login failed'
        }
      } catch (err) {
        console.error('Error:', err)
        this.passwordError = 'An error occurred'
        alert(err)
      }
    },
    async register() {
      this.validatePasswords()
      this.validatePhone()
      this.validateEmail()

      if (this.emailError) {
        return
      }
      if (this.phoneError) {
        return
      }

      if (this.passwordError) {
        return
      }

      if (this.form.password !== this.form.confirmPassword) {
        this.passwordError = 'Passwords do not match'
        return
      }

      try {
        // const response = await axios.post('http://localhost:8087/TID101G2/public/api/Register.php', this.form, {

        const response = await axios.post(`${import.meta.env.VITE_PHP_PATH}Register.php`, this.form, {
          headers: {
            'Content-Type': 'application/json'
          }
        })

        const data = response.data

        if (data.success) {
          this.clearForm()
          Swal.fire({
            icon: 'success',
            title: '註冊成功',
            text: '您已成功註冊！',
            confirmButtonText: '確定'
          })
        } else {
          this.passwordError = data.message
        }
      } catch (error) {
        Swal.fire({
          icon: 'error',
          title: '註冊失敗',
          text: '註冊過程中出現錯誤，請稍後再試。',
          confirmButtonText: '確定'
        })
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.ral__wrapper {
  padding-top: 120px;
  background: rgba($color: $ramos-gin-fizz, $alpha: 0.8);
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
        margin: 0.25rem 0;
        line-height: 70px;
        font-size: $fontSize_h3;
        @include border-radius(8px);
        cursor: pointer;
        transition: background 0.5s, color 0.5s;
      }
      &-btn.active {
        background-color: $irishcoffee;
        color: $whitelady;
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
    .error-message {
      color: red;
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
        height: 40px;
        margin-bottom: 0.5rem;
        border: 1px solid green;
        padding: 1.15rem 1rem;
        border: none;
        outline: none;
        @include border-radius(8px);
        font-size: $fontSize_h5;
        background-color: $whitelady;
        // letter-spacing: $letterspacing;
        &::placeholder {
          color: rgba($color: $campari, $alpha: 0.5);
        }
      }
      // border: 1px solid red;
    }
    &-haveaccount {
      width: 350px;
      justify-content: flex-start;
      // margin-right: 3rem;
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
    .error-message {
      color: red;
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
      margin-top: 1.5rem;
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
          margin-right: 1rem;
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
        height: 40px;
        margin-bottom: 0.5rem;
        // border: 1px solid green;
        padding: 1.15rem 1rem;
        border: none;
        outline: none;
        @include border-radius(8px);
        font-size: $fontSize_h5;
        color: $campari;
        background-color: $whitelady;
        &::placeholder {
          color: rgba($color: $campari, $alpha: 0.5);
        }
      }
      // border: 1px solid red;
    }
    &-noaccount {
      width: 350px;
      justify-content: flex-start;
      // margin-right: 3rem;
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
