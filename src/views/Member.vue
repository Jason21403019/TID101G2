<template>
  <div class="membernav">
    <MemberMenu />
    <!-- 會員資料 -->
    <div class="member_account">
      <h1>帳戶資訊</h1>
      <form @submit.prevent="saveSettings" class="tabe_account">
        <div class="form-row">
          <label for="name">名字:</label>
          <input type="text" id="name" v-model="name" required />
        </div>
        <div class="form-row">
          <label for="birthdate">出生日期:</label>
          <input type="date" id="birthdate" v-model="birthdate" required />
        </div>
        <div class="form-row">
          <label for="email">信箱:</label>
          <input type="email" id="email" v-model="email" required />
        </div>
        <div class="form-row">
          <label for="phone">手機:</label>
          <input type="tel" id="phone" v-model="phone" required />
        </div>
        <div class="form-row">
          <label for="address">地址:</label>
          <input type="text" id="address" v-model="address" required />
        </div>
        <!-- 按鈕 -->
        <button type="submit">儲存設定</button>
      </form>
    </div>
  </div>
</template>

<script>
import MemberMenu from '../components/MemberMenu.vue'

export default {
  name: 'Member',
  components: {
    MemberMenu
  }
}
</script>

<style lang="scss" scoped>
.membernav {
  background-color: $campari;
  padding-top: 100px;
  display: flex;
  .member_account {
    flex: 1;
    margin-left: 20px;
  }
  h1 {
    font-family: $fontfamily;
    color: $ramos-gin-fizz;
    font-size: $fontSize_h2;
    margin-bottom: 30px;
  }
  // input設定
  .tabe_account {
    color: $ramos-gin-fizz;
    margin-right: 40px;
    margin-bottom: 50px;
    display: flex;
    flex-direction: column;
    width: 50vw;
  }
  .form-row {
    display: flex;
    flex-direction: column;
    margin-bottom: 10px;
  }
  label {
    margin-bottom: 5px;
  }
  input {
    width: auto;
    height: 5vh;
    border: 0;
    border-radius: 4px;
  }
  button {
    margin-top: 20px;
    width: 13vw;
    background-color: $ramos-gin-fizz;
    color: $campari;
    padding: 5px;
    border-radius: 4px;
    font-weight: bold;
    font-family: $fontfamily;
    border: 0;
  }
  button:hover {
    background-color: $irishcoffee;
    color: $ramos-gin-fizz;
  }
}
</style>
