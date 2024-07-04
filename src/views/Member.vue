<template>
  <div class="membernav">
    <MemberMenu />
    <!-- 會員資料 -->
    <div class="member_account">
      <h1>帳戶資訊</h1>
      <form @submit.prevent="saveSettings" class="tabe_account">
        <div class="form-row">
          <label for="name">名字:</label>
          <input type="text" id="name" v-model="memberName" required />
        </div>
        <!-- <div class="form-row">
          <label for="birth">出生日期:</label>
          <input type="date" id="birth" v-model="memberBirth" required />
        </div> -->
        <div class="form-row">
          <label for="email">信箱:</label>
          <input type="email" id="email" v-model="memberEmail" @blur="validateEmail" required />
        </div>
        <div class="form-row">
          <label for="phone">手機:</label>
          <input type="tel" id="phone" v-model="memberPhone" @blur="validatePhone" required />
        </div>
        <div class="form-row">
          <label for="address">地址:</label>
          <input type="text" id="address" v-model="memberAddress" required />
        </div>
        <!-- 按鈕 -->
        <div>{{ statusMessage }}</div>
        <button type="submit">儲存</button>
      </form>
    </div>
  </div>
</template>

<script>
import MemberMenu from '../components/MemberMenu.vue'
import axios from 'axios'
import { useUserStore } from '../stores/user'

export default {
  name: 'Member',
  components: {
    MemberMenu
  },
  data() {
    return {
      memberName: '',
      // memberBirth: '',
      memberEmail: '',
      memberPhone: '',
      memberAddress: '',
      member_id: null,
      statusMessage: '' //顯示儲存狀態
    }
  },
  async mounted() {
    await this.checkLogin()
    if (this.member_id) {
      await this.fetchMemberData()
    }
  },

  methods: {
    async checkLogin() {
      const userStore = useUserStore()
      if (userStore.checkLoginStatus()) {
        this.member_id = userStore.isLoggedIn
      } else {
        console.error('沒抓取到會員編號')
      }
    },
    //帶入登入會員的資料
    async fetchMemberData() {
      axios
        .get(`${import.meta.env.VITE_PHP_PATH}Members.php`, {
          params: {
            id: this.member_id
          }
        })
        .then((response) => {
          if (response.data && response.data.length > 0) {
            const memberData = response.data[0]
            console.log(memberData)
            this.memberName = memberData.full_name
            // this.memberBirth = memberData.birth
            this.memberEmail = memberData.email
            this.memberPhone = memberData.phone
            this.memberAddress = memberData.address
          } else {
            console.error('No data found')
          }
        })
        .catch((error) => {
          console.error('Error fetching member data:', error)
        })
    },
    // 儲存
    saveSettings() {
      axios
        .post(`${import.meta.env.VITE_PHP_PATH}Memberu.php?id=${this.member_id}`, {
          fullName: this.memberName,
          email: this.memberEmail,
          // birth: this.memberBirth,
          phone: this.memberPhone,
          address: this.memberAddress
        })
        .then((response) => {
          alert('儲存成功！')
        })
        .catch((error) => {
          console.error('Error saving settings:', error)
          alert('儲存失敗')
        })
    },
    //電話正規化
    validatePhone() {
      if (!/^\d+$/.test(this.memberPhone)) {
        alert('電話必須為數字！')
      }
    },
    validateEmail() {
      if (this.shipEmail && !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.shipEmail)) {
        alert('電子郵件格式不正確！')
      }
    }
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
    padding-left: 10px;
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
