<template>
  <div>
    <nav>
      <ul>
        <li @click="currentView = 'accountInfo'">帳戶資訊</li>
        <li @click="currentView = 'viewOrders'">查看訂單</li>
        <li @click="currentView = 'viewReservations'">查看預約</li>
        <li @click="currentView = 'coupons'">優惠卷</li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  name: 'MemberMenu',
  data() {
    return {
      currentView: 'accountInfo'
    }
  }
}
</script>

<style lang="scss" scoped>
nav ul {
  list-style-type: none;
  padding: 20px 50px;
}

nav li {
  background-color: $ramos-gin-fizz;
  color: $blackvevet;
  padding: 15px 16px;
  border-bottom: 1px solid $blackvevet;
  width: 20vw;
  text-align: center;
  font-size: $fontSize_h4;
  font-family: $fontfamily;
  font-weight: bold;
  
}

nav li:hover {
  color: $irishcoffee;
}
</style>
