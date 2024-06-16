<template>
  <div>
    <nav>
      <!-- 使用 v-if 根據屏幕寬度選擇渲染導航方式 -->
      <ul class="member_nav" v-if="isLargeScreen">
        <li><router-link to="/member" class="link">帳戶資訊</router-link></li>
        <li><router-link to="/member_order" class="link">查看訂單</router-link></li>
        <li><router-link to="/member_reserve" class="link">查看預約</router-link></li>
        <li><router-link to="/member_voucher" class="link">優惠卷</router-link></li>
      </ul>
      <select v-else v-model="currentView" @change="navigate">
        <option value="member">帳戶資訊</option>
        <option value="member_order">查看訂單</option>
        <option value="member_reserve">查看預約</option>
        <option value="member_voucher">優惠卷</option>
      </select>
    </nav>
  </div>
</template>

<script>
export default {
  name: 'MemberMenu',
  data() {
    return {
      //當大於820 時使用ul
      currentView: 'member',
      isLargeScreen: window.innerWidth > 820
    }
  },
  methods: {
    //根據當前的nav 選擇連接
    navigate() {
      this.$router.push('/' + this.currentView)
    },
    //當小於820 時使用option
    checkScreenSize() {
      this.isLargeScreen = window.innerWidth > 820
    }
  },
  // 監聽頁面
  mounted() {
    window.addEventListener('resize', this.checkScreenSize)
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.checkScreenSize)
  }
}
</script>

<style lang="scss" scoped>
// 下拉式
nav select {
  border-radius: 4px;
  border: 0px;
  background-color: $ramos-gin-fizz;
  padding: 10px;
  font-size: $fontSize_h4;
  font-family: $fontfamily;
  font-weight: bold;
  color: $blackvevet;
  width: 100%;
  max-width: 20vw;
  margin: 55px;
}

nav select:hover {
  cursor: pointer;
}

.member_nav {
  border-radius: 4px;
  background-color: $ramos-gin-fizz;
  margin: 20px 50px;
}
// 展開
nav ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.link {
  display: block;
  color: $blackvevet;
  padding: 15px 16px;
  border-bottom: 1px solid $blackvevet;
  text-align: center;
  font-size: $fontSize_h4;
  font-family: $fontfamily;
  font-weight: bold;
  text-decoration: none;
  width: 20vw;
}

.link:hover {
  color: $irishcoffee;
}
</style>
