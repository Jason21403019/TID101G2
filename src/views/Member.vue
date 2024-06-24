<template>
  <div class="membernav">
    <MemberMenu />
    <!-- 會員資料 -->
    <div class="member_account">
      <h1>帳戶資訊</h1>
      <form @submit.prevent="saveSettings" class="tabe_account">
        <div class="form-row">
          <label for="name">名字:</label>
          <input type="text" id="name" v-model="member.full_name" required />
        </div>
        <div class="form-row">
          <label for="birthdate">出生日期:</label>
          <input type="date" id="birthdate" v-model="member.birthdate" required />
        </div>
        <div class="form-row">
          <label for="email">信箱:</label>
          <input type="email" id="email" v-model="member.email" required />
        </div>
        <div class="form-row">
          <label for="phone">手機:</label>
          <input type="tel" id="phone" v-model="member.phone" required />
        </div>
        <div class="form-row">
          <label for="address">地址:</label>
          <input type="text" id="address" v-model="member.address" required />
        </div>
        <!-- 按鈕 -->
        <button type="submit">儲存</button>
      </form>
    </div>
  </div>
</template>

<script>
import MemberMenu from '../components/MemberMenu.vue'
import axios from 'axios';

export default {
  name: 'Member',
  components: {
    MemberMenu
  },
  data() {
    return {
      // 會員專區資料
      member: {
        full_name: '',
        birthdate: '',
        email: '',
        phone: '',
        address: ''
      }
    };
  },
  //資料庫渲染
  async mounted() {
    await this.fetchMemberData();
  },
  methods: {
    fetchMemberData() {
      // 實際上要獲得的會員ID
      const memberId = 'M001'; 
      // 抓到那個會員ID得值
      axios.get('http://localhost/TID101G2/public/api/Member.php?id=${memberId}')
        .then(response => {
      if (response.data.length > 0) {
        const memberData = response.data[0];  // 取第一條數據
        this.member.full_name = memberData.full_name || memberData.name;
        this.member.birthdate = memberData.birth;
        this.member.email = memberData.email;
        this.member.phone = memberData.phone;
        this.member.address = memberData.address;
      } else {
        console.error('No data found');
      }
    })
    .catch(error => {
      console.error('Error fetching member data:', error);
    });
},
    saveSettings() {
      // 發送 請求 更新會員資料
      axios.post('http://localhost/TID101G2/public/api/Member.php', this.member)
      .then(response => {
        alert('設置已保存！');
      })
      .catch(error => {
        console.error('Error saving settings:', error);
      });
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
