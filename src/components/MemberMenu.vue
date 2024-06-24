<template>
  <div>
    <nav>
      <ul class="member_nav" v-if="isLargeScreen">
        <li><router-link to="/member" class="link">帳戶資訊</router-link></li>
        <li><router-link to="/member_order" class="link">查看訂單</router-link></li>
        <li><router-link to="/member_reserve" class="link">查看預約</router-link></li>
        <li><router-link to="/member_voucher" class="link">優惠卷</router-link></li>
      </ul>
      <!-- 下拉式選單 -->
      <select v-else @change="navigate($event.target.value)" v-model="currentView">
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
      //追蹤當前要用什麼連接
      currentView: this.getCurrentView(),
      //追蹤螢幕大小
      isLargeScreen: window.innerWidth > 820
    }
  },
  methods: {
     //根據當前的nav 選擇連接
    navigate(view) {
      this.$router.push('/' + view);
    },
     //當小於820 時使用option
    checkScreenSize() {
      this.isLargeScreen = window.innerWidth > 820;
    },
    getCurrentView() {
      const routePath = this.$route.path;
      // 根據路徑設定初始的currentView
      if (routePath.includes('member_order')) {
        return 'member_order';
      } else if (routePath.includes('member_reserve')) {
        return 'member_reserve';
      } else if (routePath.includes('member_voucher')) {
        return 'member_voucher';
      } else {
        return 'member';
      }
    }
  },
  watch: {
    // 監聽路由變化更新currentView
    '$route'() {
      this.currentView = this.getCurrentView();
    }
  },
  mounted() {
    // 監聽螢幕大小
    window.addEventListener('resize', this.checkScreenSize);
  },
  // 解除監聽
  beforeDestroy() {
    window.removeEventListener('resize', this.checkScreenSize);
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
