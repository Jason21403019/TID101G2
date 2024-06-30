<template>
  <main id="app">
    <!-- 總攬 -->
    <h2>{{ overview }}</h2>
    <section>
      <article v-if="phpdata.data2 && phpdata.data2.length > 0">
        <div>
          <h3>{{ phpdata.data2[0].member }}</h3>
          <h4>{{ notShipped }}</h4>
        </div>
        <img :src="icons1" alt="" />
      </article>

      <article v-if="phpdata.data3 && phpdata.data3.length > 0">
        <div>
          <h3>{{ phpdata.data3[0].payment }}</h3>
          <h4>{{ Unpaid }}</h4>
        </div>
        <img :src="icons2" alt="" />
      </article>

      <article v-if="phpdata.data && phpdata.data.length > 0">
        <div>
          <h3>{{ phpdata.data[0].counts }}</h3>
          <!-- this.phpdata.data.counts -->
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
      <input type="button" :value="commodity" @click="openModal('add', product)" />
      <input type="button" :value="article" @click="openModalA('add', article)" />
      <input type="button" :value="reserve" @click="commodityPage(reserve)" />
    </section>
  </main>
  <ModalArticle ref="modalA" :action-type="currentActionType" :article="currentArticle" @save="handleSave" />
  <ModalProduct ref="modal" :action-type="currentActionType" :product="currentProduct" @save="handleSaveA" />
</template>

<script>
import AdminIconManger from '../components/AdminIconManger.vue'
import DefaultBkSidebar from '../layouts/default/AdminSlidebar.vue'
import AdminLineChart from '../components/AdminLineChart.vue'
import ModalProduct from '../components/AdminModalProduct.vue'
import ModalArticle from '../components/AdminModalArticle.vue'
export default {
  name: 'Admin',
  components: {
    AdminIconManger,
    DefaultBkSidebar,
    AdminLineChart,
    ModalProduct,
    ModalArticle
  },
  data() {
    return {
      phpdata: [],
      overview: '總攬',
      dataAnalysis: '數據分析',
      CommonFunctions: '常用功能',
      notShipped_count: 0,
      notShipped: '會員人數',
      Unpaid_count: 0,
      Unpaid: '訂單未付款',
      needRestock_count: 0,
      needRestock: '商品需補貨',
      icons1: 'src/imgs/icon/icon_admin-rectangle.svg',
      icons2: 'src/imgs/icon/icon_admin-money-bill.svg',
      icons3: '/src/imgs/icon/icon_admin-tags.svg',
      commodity: '新增商品',
      article: '新增文章',
      reserve: '預約管理',
      currentActionType: '',
      currentProduct: {},
      products: [],
      currentActionType: 'add',
      currentActionTypeA: 'add',
      currentArticle: {}
    }
  },
  methods: {
    commodityPage(page) {
      if (page === '新增商品') {
        window.location.href = '#/admin_product'
      } else if (page === '新增文章') {
        window.location.href = '#/admin_article'
      } else if (page === '預約管理') {
        this.$router.push('/admin_res')
      }
    },
    openModal(actionType, product = {}) {
      this.currentActionType = actionType
      this.currentProduct = product
      this.$refs.modal.show()
    },
    handleSave(updatedProduct) {
      if (this.currentActionType === 'add') {
        this.products.push(updatedProduct)
      } else {
        const index = this.products.findIndex((p) => p.id === updatedProduct.id)
        if (index !== -1) {
          this.products.splice(index, 1, updatedProduct)
        }
      }
    },

    openModalA(action, article = {}) {
      this.currentActionTypeA = action
      this.currentArticle = { ...article }
      this.$refs.modalA.show()
    },
    handleSaveA(formData) {
      if (this.currentActionTypeA === 'add') {
        this.createArticle(formData)
      } else {
        this.updateArticle(formData)
      }
    },
    async createArticle(articleData) {
      try {
        const response = await axios.post(`${import.meta.env.VITE_PHP_PATH}adminarticle.php`, articleData)
        console.log('Article created:', response.data)
        this.fetchArticles()
      } catch (error) {
        console.error('Error creating article:', error)
      }
    },
    async updateArticle(articleData) {
      try {
        const response = await axios.put(`${import.meta.env.VITE_PHP_PATH}adminarticle.php?id=${articleData.name}`, articleData)
        console.log('Article updated:', response.data)
        this.fetchArticles()
        this.$refs.modalA.hide()
      } catch (error) {
        console.error('Error updating article:', error)
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
