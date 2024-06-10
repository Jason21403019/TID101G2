<template>
  <section class="memberorder">
    <MemberMenu />
    <div class="member_order">
      <div class="content">
        <h1>查看訂單</h1>
        <ul class="title">
          <li>訂單編號</li>
          <li>日期</li>
          <li>預訂單狀態</li>
          <li>總價</li>
          <li>配送狀態</li>
          <li>付款狀態</li>
        </ul>
        <ul class="orderInfo">
          <li>{{ orderNumber }}</li>
          <li>{{ orderTime }}</li>
          <li>{{ orderProcessing }}</li>
          <li>{{ orderPrice }}</li>
          <li>{{ orderDelivery }}</li>
          <li class="unpaidbtn">{{ Unpaid }}</li>
        </ul>
        <button @click="handleButtonClick">取消訂單</button>

        <ul class="orderInfo">
          <li>{{ orderNumber }}</li>
          <li>{{ orderTime }}</li>
          <li>{{ orderProcessing }}</li>
          <li>{{ orderPrice }}</li>
          <li>已出貨</li>
          <li class="unpaidbtn">已付款</li>
        </ul>
        <button @click="handleButtonClick">再次購買</button>

        <ul class="orderInfo">
          <li>{{ orderNumber }}</li>
          <li>{{ orderTime }}</li>
          <li>{{ orderProcessing }}</li>
          <li>{{ orderPrice }}</li>
          <li>已出貨</li>
          <li class="unpaidbtn">已付款</li>
        </ul>
        <button @click="handleButtonClick">再次購買</button>

        <ul class="orderInfo">
          <li>{{ orderNumber }}</li>
          <li>{{ orderTime }}</li>
          <li>{{ orderProcessing }}</li>
          <li>{{ orderPrice }}</li>
          <li>已出貨</li>
          <li class="unpaidbtn">已付款</li>
        </ul>
        <button @click="handleButtonClick">再次購買</button>

        <ul class="orderInfo">
          <li>{{ orderNumber }}</li>
          <li>{{ orderTime }}</li>
          <li>{{ orderProcessing }}</li>
          <li>{{ orderPrice }}</li>
          <li>已出貨</li>
          <li class="unpaidbtn">已付款</li>
        </ul>
        <button @click="handleButtonClick">再次購買</button>
      </div>

      <!-- 頁碼 -->
      <div class="page-normal">
        <span class="page-prev">&lt;</span>
        <a @click="orderPage " >1</a>
        <a @click="orderPage " >2</a>
        <a @click="orderPage " >3</a>
        <a @click="orderPage " >4</a>
        <a @click="orderPage " >5</a>
        <a @click="orderPage " >&gt;</a>
      </div>
    </div>
  </section>
</template>

<script>
import MemberMenu from '../components/MemberMenu.vue'

export default {
  name: 'Member',
  components: {
    MemberMenu
  },
  data() {
    return {
      orderNumber: '20240517379430',
      orderTime: '2021/05/17',
      orderProcessing: '訂單處理',
      orderPrice: '$18,999',
      orderDelivery: '未出貨',
      Unpaid: '未付款',
      cancelorder: '取消訂單'
    }
  },
  methods: {
    handleButtonClick(item) {
      cthis[item] = ''
    },
    aboutPage() {
      // window.location.href = '/about_us';
      this.$router.push('/member_order')
    },
  }
}
</script>

<style lang="scss" scoped>
.memberorder {
  background-color: $campari;
  padding-top: 100px;
  display: flex;
  .member_account {
    flex: 1;
    margin-left: 20px;
  }
}

.menu {
  position: fixed;
}

.content {
  width: 60vw;
  margin-bottom: 50px;
}

h1 {
  font-family: $fontfamily;
  color: $ramos-gin-fizz;
  font-size: $fontSize_h2;
  margin-bottom: 30px;
}

.title {
  display: flex;
  color: #f6f6f6;
  background-color: #cead82;
  li {
    width: 20%;
    padding: 1% 0;
    padding-left: 1%;
  }
}

.orderInfo {
  display: flex;
  background-color: #fcf0d8;
  margin-top: 20px;
  li {
    width: 20%;
    padding: 22px 0;
    padding-left: 10px;
  }
}
button {
  margin-top: 5px;
  width: 8vw;
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
//頁籤
.page-normal {
  text-align: center;
  padding-bottom: 50px;
}

.page-normal a {
  // background-color: $ramos-gin-fizz;
  padding: 5px 7px;
  color: $ramos-gin-fizz;
  margin-left: 20px;
  text-decoration: none;
  font-family: 'Noto Sans TC', sans-serif;
  font-optical-sizing: auto;
  font-weight: 400;
}

.page-normal a:hover,
.page-normal .page-prev:hover {
  background-color: $ramos-gin-fizz;
  color: $campari;
}

/*設置左單括號 < 的css樣式*/
.page-normal .page-prev {
  color: $ramos-gin-fizz;
}
</style>
