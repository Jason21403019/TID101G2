<template>
  <section class="memberorder">
    <MemberMenu />

    <div class="member_order">
      <div class="content">
        <h1>查看訂單</h1>
      </div>
    
      <div class="order-list">
        <MemberOrderCard
          v-for="(order, index) in paginatedOrders"
          :key="index"
          :order="order"
        />
      </div>

      <!-- 分頁 -->
      <div class="page-normal">
        <Paginator
          :totalItems="orders.length"
          :currentPage="currentPage"
          :pageSize="pageSize"
          @next-page="nextPageHandler"
          @previous-page="previousPageHandler"
        ></Paginator>
      </div>
    </div>
  </section>
</template>

<script>
import MemberMenu from '../components/MemberMenu.vue'; 
import MemberOrderCard from '../components/MemberOrderCard.vue'; 
import Paginator from '../components/tabs/Paginator.vue'; 
import axios from 'axios'; //HTTP的請求工具之一
// import user       //引入抓登入的會員編號的js

export default {
  name: 'MemberOrder',
  components: {
    MemberMenu,
    MemberOrderCard,
    Paginator
  },
  props: {
    order: Object // 讓資料從父層傳送到元件裡面
  },
  data() {
    return {
      orders: [], // 訂單陣列
      currentPage: 1, // 當前頁碼
      pageSize: 4, // 每頁顯示的單數量
    };
  },
  computed: {
    // 計算訂單比數去分頁
    paginatedOrders() {
      const startIndex = (this.currentPage - 1) * this.pageSize;
      return this.orders.slice(startIndex, startIndex + this.pageSize);
    }
  },
  //資料庫渲染
  async mounted() {
    await this.fetchOrders();
  },
  methods: {
    //先抓登入的會員編號
    // if(useUserStore.checkLoginStatus() === true){
      //   const member_id = useUserStore.isLoggedIn
      // }else{
       // console.error("沒抓取到會員編號成");
      // },

    // 從後端獲取訂單數據的方法
    fetchOrders() {
      axios.get(`${import.meta.env.VITE_PHP_PATH}MemberOrder.php`)
        .then(response => {
          this.orders = response.data;
           console.log('成功'.data);
        })
        .catch(error => {
          console.error("Error", error);
        });
    },

    // 切換頁面設定
    // 下一頁的事件處理方法
    nextPageHandler() {
      if (this.currentPage < Math.ceil(this.orders.length / this.pageSize)) {
        this.currentPage++;
      }
    },
    // 上一頁的事件處理方法
    previousPageHandler() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    }
  }
};
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
  // margin-bottom: 50px;
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
// grid設定
.order-list {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  grid-template-rows: repeat(auto-fill, 250px);
  grid-gap: 20px;
  align-items: stretch;
  // padding-right: 20px;
}
</style>
