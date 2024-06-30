<template>
  <div class="membernav">
    <MemberMenu />
    <!-- 會員資料 -->
    <div class="member_account">
      <h1>帳戶資訊</h1>
      <form @submit.prevent="saveSettings" class="tabe_account">
        <div class="form-row">
          <label for="name">名字:</label>
          <input type="text" id="name" v-model="memberfull_name" required />
        </div>
        <!-- <div class="form-row">
          <label for="birth">出生日期:</label>
          <input type="date" id="birth" v-model="memberbirth" required />
        </div> -->
        <div class="form-row">
          <label for="email">信箱:</label>
          <input type="email" id="email" v-model="memberemail" required />
        </div>
        <div class="form-row">
          <label for="phone">手機:</label>
          <input type="tel" id="phone" v-model="memberphone" required />
        </div>
        <div class="form-row">
          <label for="address">地址:</label>
          <input type="text" id="address" v-model="memberaddress" required />
        </div>
        <!-- 按鈕 -->
        <button type="submit">儲存</button>
      </form>
    </div>
  </div>
</template>

<script>
import MemberMenu from '../components/MemberMenu.vue'
import axios from 'axios'
import { useUserStore } from '../stores/user' //引入抓登入的會員編號的js

export default {
  name: 'Member',
  components: {
    MemberMenu
  },
  data() {
    return {
      // 會員專區資料

      memberfull_name: '',
      memberbirth: '',
      memberemail: '',
      memberphone: '',
      memberaddress: '',
      member_id: null
    }
  },
  //資料庫渲染
  async mounted() {
    await this.checkLogin()
    await this.fetchMemberData()
  },
  methods: {
    //先抓登入的會員編號
    async checkLogin() {
      const userStore = useUserStore()
      if (userStore.checkLoginStatus()) {
        this.member_id = userStore.isLoggedIn // 把存取在localStorage 抓出來
        // console.log('Logged in member ID:', this.member_id);
      } else {
        console.error('沒抓取到會員編號')
      }
    },

    fetchMemberData() {
      // 從後端撈資料
      this.checkLogin().then(() => {
        if (this.member_id) {
          axios
            .get(`${import.meta.env.VITE_PHP_PATH}Member.php`, {
              // axios.get('http://localhost:8087/TID101G2/public/api/Member.php', {
              params: {
                id: this.member_id
              }
            })
            .then((response) => {
              //渲染出資料
              if (response.data && response.data.length > 0) {
                const memberData = response.data[0]
                this.memberfull_name = memberData.full_name
                this.memberbirth = memberData.birth
                this.memberemail = memberData.email
                this.memberphone = memberData.phone
                this.memberaddress = memberData.address
              } else {
                console.error('No data found')
              }
            })
            .catch((error) => {
              console.error('Error fetching member data:', error)
            })
        } else {
          console.error('Member ID is not set')
        }
      })
    },
    saveSettings() {
      axios
        .post(`${import.meta.env.VITE_PHP_PATH}Member.php?id=${this.member_id}`, this.member)
        .then((response) => {
          alert('設置已保存！')
        })
        .catch((error) => {
          console.error('Error saving settings:', error)
        })
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
