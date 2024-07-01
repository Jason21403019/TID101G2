<template>
  <div v-if="isvible" class="fp__pupup">
    <div v-if="showFirstPopup" class="popup fp__pupup-first">
      <h2>重設密碼</h2>
      <p>請輸入您的信箱，我們會寄送重設密碼信件給您</p>
      <input v-model="email" class="fp__pupup-first-input" type="email" placeholder="請輸入註冊時的電子郵件" />
      <button class="fp__pupup-first-nextbtn" @click="goToSecondPopup">下一步</button>
      <button class="fp__pupup-first-closebtn" @click="closePopup">
        <img src="@/imgs/icon/icon_close-w.svg" alt="close" />
      </button>
    </div>
    <div v-if="showSecondPopup" class="popup fp__pupup-second">
      <h2>重設密碼</h2>
      <p>請輸入新的密碼</p>
      <input v-model="newPassword" class="fp__pupup-second-input1" type="password" placeholder="請輸入新密碼" />
      <input v-model="confirmPassword" class="fp__pupup-second-input2" type="password" placeholder="請再次輸入密碼" />
      <button class="fp__pupup-second-nextbtn" @click="goToThirdPopup">下一步</button>
      <button class="fp__pupup-second-closebtn" @click="closePopup">
        <img src="@/imgs/icon/icon_close-w.svg" alt="close" />
      </button>
    </div>
    <div v-if="showThirdPopup" class="popup fp__pupup-third">
      <h2>重設密碼成功</h2>
      <p>您的密碼已成功重設</p>
      <button class="fp__pupup-third-comfirmbtn" @click="closePopup">確認</button>
      <button class="fp__pupup-second-closebtn" @click="closePopup">
        <img src="@/imgs/icon/icon_close-w.svg" alt="close" />
      </button>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'WineColumnCategory',
  props: {
    isvible: {
      type: Boolean,
      default: false
    }
  },
  emits: ['closePopup'],
  data() {
    return {
      email: '',
      newPassword: '',
      confirmPassword: '',
      showFirstPopup: true,
      showSecondPopup: false,
      showThirdPopup: false
    }
  },
  watch: {
    isvible() {
      if (this.isvible) {
        this.showFirstPopup = true
        this.showSecondPopup = false
        this.showThirdPopup = false
      }
    }
  },
  methods: {
    goToSecondPopup() {
      if (this.email !== '') {
        // try {
        // const response = await axios.post(`${import.meta.env.VITE_PHP_PATH}CkeckEmail.php`, {
        //   email: this.email
        // })
        // console.log(response.data)
        // if (response.data.exists) {
        this.showFirstPopup = false
        this.showSecondPopup = true
        //   } else {
        //     alert('此信箱不存在')
        //   }
        // } catch (error) {
        // console.log(error)
        // alert('檢查信箱時發生錯誤！')
        // }
      } else {
        alert('請輸入信箱')
      }
    },
    goToThirdPopup() {
      if (this.newPassword === this.confirmPassword) {
        this.showSecondPopup = false
        this.showThirdPopup = true
      }
    },
    closePopup() {
      this.$emit('closePopup')
    }
  }
}
</script>

<style lang="scss" scoped>
.fp__pupup {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background: rgba(0, 0, 0, 0.5);
  z-index: 10;
  .popup {
    position: absolute;
    // border: 1px solid red;
    width: 500px;
    height: 500px;
    background: white;
    @include border-radius(8px);
    padding: 1rem;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: $campari;
    box-shadow: 0px 0px 10px 5px $irishcoffee;
    @include breakpoint(530px) {
      width: 370px;
      height: 350px;
    }
  }
  .fp__pupup-first {
    h2 {
      margin-bottom: 0.5rem;
      font-size: $fontSize_h3;
      padding: 1rem 0;
    }
    p {
      font-size: $fontSize_p;
    }
    &-input {
      margin: 1rem 0;
      padding: 0.5rem;
      border: 1px solid $campari;
      @include border-radius(8px);
      outline: none;
      width: 350px;
      margin-bottom: 2rem;
      background: $whitelady;
      @include breakpoint(530px) {
        width: 300px;
      }
    }
    &-nextbtn {
      outline: none;
      border: none;
      width: 300px;
      margin: 0.25rem;
      line-height: 50px;
      font-size: $fontSize_h3;
      @include border-radius(8px);
      background: $negroni;
      color: $ramos-gin-fizz;
      cursor: pointer;
      transition: background 0.5s, color 0.5s;
    }
    &-closebtn {
      outline: none;
      border: none;
      width: 40px;
      @include border-radius(8px);
      cursor: pointer;
      background: none;
      cursor: pointer;
      display: flex;
      justify-content: center;
      align-items: center;
      position: absolute;
      top: -2.5rem;
      right: 0;
      img {
        width: 100%;
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
      }
    }
  }
  .fp__pupup-second {
    h2 {
      margin-bottom: 0.5rem;
      font-size: $fontSize_h3;
      padding: 1rem 0;
    }
    p {
      font-size: $fontSize_p;
    }
    &-input1 {
      margin: 1rem 0;
      padding: 0.5rem;
      border: 1px solid $campari;
      @include border-radius(8px);
      outline: none;
      width: 350px;
      margin-bottom: 2rem;
      background: $whitelady;
      @include breakpoint(530px) {
        width: 300px;
      }
    }
    &-input2 {
      padding: 0.5rem;
      border: 1px solid $campari;
      @include border-radius(8px);
      outline: none;
      width: 350px;
      margin-bottom: 2rem;
      background: $whitelady;
      @include breakpoint(530px) {
        width: 300px;
      }
    }
    &-nextbtn {
      outline: none;
      border: none;
      width: 300px;
      margin: 0.25rem;
      line-height: 50px;
      font-size: $fontSize_h3;
      @include border-radius(8px);
      background: $negroni;
      color: $ramos-gin-fizz;
      cursor: pointer;
      transition: background 0.5s, color 0.5s;
    }
    &-closebtn {
      outline: none;
      border: none;
      width: 40px;
      @include border-radius(8px);
      cursor: pointer;
      background: none;
      cursor: pointer;
      display: flex;
      justify-content: center;
      align-items: center;
      position: absolute;
      top: -2.5rem;
      right: 0;
      img {
        width: 100%;
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
      }
    }
  }
  .fp__pupup-third {
    h2 {
      margin-bottom: 0.5rem;
      font-size: $fontSize_h3;
      padding: 1rem 0;
    }
    p {
      font-size: $fontSize_p;
      margin-bottom: 2rem;
    }
    &-comfirmbtn {
      outline: none;
      border: none;
      width: 300px;
      margin: 0.25rem;
      line-height: 50px;
      font-size: $fontSize_h3;
      @include border-radius(8px);
      background: $negroni;
      color: $ramos-gin-fizz;
      cursor: pointer;
      transition: background 0.5s, color 0.5s;
    }
    &-closebtn {
      outline: none;
      border: none;
      width: 40px;
      @include border-radius(8px);
      cursor: pointer;
      background: none;
      cursor: pointer;
      display: flex;
      justify-content: center;
      align-items: center;
      position: absolute;
      top: -2.5rem;
      right: 0;
      img {
        width: 100%;
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
      }
    }
  }
}
</style>
