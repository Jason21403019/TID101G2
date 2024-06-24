<template>
  <main id="app">
    <!-- 總攬 -->
    <h2>{{ overview }}</h2>
    <section>
      <article>
        <div>
          <h3>{{ notShipped_count }}</h3>
          <h4>{{ notShipped }}</h4>
        </div>
        <img :src="icons1" alt="" />
      </article>

      <article>
        <div>
          <h3>{{ Unpaid_count }}</h3>
          <h4>{{ Unpaid }}</h4>
        </div>
        <img :src="icons2" alt="" />
      </article>

      <article v-if="phpdata.length > 0">
        <div>
          <h3>{{ phpdata[0]['count(id)'] }}</h3>
          <h4>{{ needRestock }}</h4>
        </div>
        <img :src="icons3" alt="" />
      </article>
    </section>
    <h2>{{ dataAnalysis }}</h2>

    <!-- 數據分析 -->
    <section>
      <AdminLineChart></AdminLineChart>
    </section>

    <!-- 常用功能 -->
    <h2>{{ CommonFunctions }}</h2>

    <section>
      <input type="button" :value="commodity" @click="commodityPage(commodity)" />
      <input type="button" :value="article" @click="commodityPage(article)" />
      <input type="button" :value="reserve" @click="commodityPage(reserve)" />
    </section>
  </main>
</template>

<script>
import AdminIconManger from '../components/AdminIconManger.vue'
import DefaultBkSidebar from '../layouts/default/AdminSlidebar.vue'
import AdminLineChart from '../components/AdminLineChart.vue'
export default {
  name: 'Admin',
  components: {
    AdminIconManger,
    DefaultBkSidebar,
    AdminLineChart
  },
  data() {
    return {
      phpdata: [],
      overview: '總攬',
      dataAnalysis: '數據分析',
      CommonFunctions: '常用功能',
      notShipped_count: 0,
      notShipped: '訂單未出貨',
      Unpaid_count: 0,
      Unpaid: '訂單未付款',
      needRestock_count: 0,
      needRestock: '商品需補貨',
      icons1: 'src/imgs/icon/icon_admin-rectangle.svg',
      icons2: 'src/imgs/icon/icon_admin-money-bill.svg',
      icons3: '/src/imgs/icon/icon_admin-tags.svg',
      commodity: '新增商品',
      article: '新增文章',
      reserve: '預約管理'
    }
  },
  methods: {
    commodityPage(page) {
      if (page === '新增商品') {
        window.location.href = '#/admin_product'
      } else if (page === '新增文章') {
        window.location.href = '#/admin_article'
      } else if (page === '預約管理') {
        window.location.href = '#/admin_res'
      }
    },

    // php
    fetchProductNeedRestock() {
      fetch('http://localhost/TID101G2/public/api/Admin.php')
        .then((response) => response.json())
        .then((data) => {
          this.phpdata = data // 將從 PHP 獲取的資料存儲到 Vue 的 data 屬性中
        })
        .catch((error) => console.error('Error fetching data:', error))
    }
  },
  mounted() {
    this.fetchProductNeedRestock()
  }
}
</script>
<style lang="scss" scoped>
main {
  width: 100%;
  float: right;
  padding-right: 3%;
  font-family: $fontfamily;
  background-color: $whitelady;
  padding-left: 10%;
  h2 {
    font-size: 40px;
    font-weight: bold;
    padding: 2% 0;
  }
  section {
    display: flex;
    /* width: 100%; */
    justify-content: space-between;
    article {
      width: 31%;
      display: flex;
      background-color: #fcf0d8;
      padding: 1%;
      div {
        margin: 2% 2%;
        h3 {
          font-size: 36px;
          margin: 0 0;
        }
        h4 {
          font-size: 20px;
          margin: 0 0;
        }
      }

      img {
        display: block;
        width: 48px;
        height: 48px;
        margin: auto auto;
      }
    }
    input {
      width: 31%;
      border: 0;
      background-color: #fcf0d8;
      cursor: pointer;
      font-size: 40px;
      font-weight: bolder;
      padding-top: 4%;
      padding-bottom: 4%;
      margin-bottom: 3%;
      border: 3px black;
      border-style: groove;
      border-radius: 10px;
    }
    input:hover {
      background-color: $irishcoffee;
      color: $ramos-gin-fizz;
    }
  }
}
</style>
