<template>
  <section class="memberorder">
    <MemberMenu />

    <div class="member_order">
      <div class="content">
        <h1>查看預約</h1>
      </div>
      <div class="order-list">
        <MemberOrderCard
          v-for="(phpdata, index) in paginatedProducts"
          :key="phpdata.id"
          :id="phpdata.id"
          :name="phpdata.full_name"
          :booking_date="phpdata.booking_date"
          :booking_time="phpdata.booking_time"
          :guest_count="phpdata.guest_count"
          :bookingNote="phpdata.booking_note"
        />
      </div>
      <!-- 頁碼 -->
      <!-- <div class="page-normal">
        <span class="page-prev">&lt;</span>
        <a @click="orderPage">1</a>
        <a @click="orderPage">2</a>
        <a @click="orderPage">3</a>
        <a @click="orderPage">4</a>
        <a @click="orderPage">5</a>
        <a @click="orderPage">&gt;</a>
      </div> -->
      <div class="page-normal">
        <Paginator
          :totalItems="phpdata.length"
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
import MemberMenu from '../components/MemberMenu.vue'
import MemberOrderCard from '../components/MemberReserveCard.vue'
import Paginator from '../components/tabs/Paginator.vue'
export default {
  name: 'Member',
  components: {
    MemberMenu,
    MemberOrderCard,
    Paginator
  },
  data() {
    return {
      currentPage: 1,
      pageSize: 2,
      phpdata: [],
      memberId: ''
    }
  },
  mounted() {
    // 获取存储在 localStorage 中的值，并赋给 memberId
    this.memberId = localStorage.getItem('isLoggedIn')
    console.log(this.memberId) // 输出 memberId，用于验证获取是否正确
    this.fetchMemberReserverData()
  },
  methods: {
    fetchMemberReserverData() {
      // const memberId = this.memberId
      console.log(this.memberId)

      fetch(`${import.meta.env.VITE_PHP_PATH}MemberReserve.php`, {
        method: 'POST',

        body: JSON.stringify({ member_id: this.memberId }) // 发送选项卡 ID 到后端
        // body: { account: tabName } // 发送选项卡 ID 到后端
      })
        .then((response) => response.json())
        .then((data) => {
          this.phpdata = data // 將從 PHP 獲取的資料存儲到 Vue 的 data 屬性中
        })
        .catch((error) => console.error('Error fetching data:', error))
    },
    nextPageHandler(page) {
      this.currentPage = page
    },
    previousPageHandler(page) {
      this.currentPage = page
    }
  },
  computed: {
    paginatedProducts() {
      const startIndex = (this.currentPage - 1) * this.pageSize
      const endIndex = startIndex + this.pageSize
      return this.phpdata.slice(startIndex, endIndex)
    }
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
  grid-template-rows: repeat(auto-fill, 150px);
  grid-gap: 20px;
  align-items: stretch;
  padding-right: 20px;
}
//頁籤
.page-normal {
  text-align: center;
  margin-top: 100px;
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
