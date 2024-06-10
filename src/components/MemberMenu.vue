<template>
  <div>
    <nav>
      <ul class="member_nav">
        <li><router-link to="/member" class="link">帳戶資訊</router-link></li>
        <li><router-link to="/member_order" class="link">查看訂單</router-link></li>
        <li><router-link to="/member_reserve" class="link">查看預約</router-link></li>
        <li><router-link to="/member_voucher" class="link">優惠卷</router-link></li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  name: 'MemberMenu',
  data() {
    return {
      currentView: 'member'
    }
  }
}
</script>

<style lang="scss" scoped>
.member_nav {
  border-radius: 4px;
  background-color: $ramos-gin-fizz;
  margin: 20px 50px;
}
nav ul {
  list-style-type: none;
  
}
.link {
  display: block; /* 塊級顯示，方便整個 li 區域都能點擊 */
  color: $blackvevet; /* 使用變量定義的顏色 */
  padding: 15px 16px;
  border-bottom: 1px solid $blackvevet;
  width: 20vw;
  text-align: center;
  font-size: $fontSize_h4;
  font-family: $fontfamily;
  font-weight: bold;
  text-decoration: none; /* 移除下劃線 */
}

.link:hover {
  color: $irishcoffee;
}
</style>
