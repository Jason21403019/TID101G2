<template>
  <main id="app">
    <h2>{{ overview }}</h2>
    <section>
      <article>
        <div>
          <h3>{{ notShipped_count }}</h3>
          <h4>{{ notShipped }}</h4>
        </div>
        <img :src="icons" alt="" />
      </article>

      <article>
        <div>
          <h3>{{ Unpaid_count }}</h3>
          <h4>{{ Unpaid }}</h4>
        </div>
        <img :src="icons" alt="" />
      </article>

      <article>
        <div>
          <h3>{{ needRestock_count }}</h3>
          <h4>{{ needRestock }}</h4>
        </div>
        <img :src="icons" alt="" />
      </article>
    </section>
    <h2>{{ dataAnalysis }}</h2>
    <section>
      <AdminLineChart></AdminLineChart>
    </section>
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
      overview: '總攬',
      dataAnalysis: '數據分析',
      CommonFunctions: '常用功能',
      notShipped_count: 0,
      notShipped: '訂單未出貨',
      Unpaid_count: 0,
      Unpaid: '訂單未付款',
      needRestock_count: 0,
      needRestock: '商品需補貨',
      icons: '../imgs/icon/icon_admin-money-bill.svg',
      commodity: '新增商品',
      article: '新增文章',
      reserve: '預約管理'
    }
  },
  methods: {
    commodityPage(page) {
      if (page === '新增商品') {
        window.location.href = '#'
      } else if (page === '新增文章') {
        window.location.href = '#'
      } else if (page === '預約管理') {
        window.location.href = '#'
      }
    }
  }
}
</script>
<style lang="scss" scoped>
main {
  width: 90%;
  float: right;
  padding-right: 3%;
  font-family: $fontfamily;
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
    }
  }
}
</style>
