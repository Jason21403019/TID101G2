<template>
  <div class="product">
    <!-- <article class="a" v-for="(product, index) in infos.slice(0, infos.length)" :key="product.id"> -->
    <article class="a" v-for="(product, index) in paginatedProducts" :key="product.id">
      <div class="content">
        <img :src="product.picture" alt="" />
        <div class="overlay" @click="handleOverlayClick($event, product, index)"></div>
      </div>
      <span>
        <p>{{ product.brand }}</p>
        <p>{{ product.name }}</p>
        <p>{{ product.details }}</p>
        <h3 @click="handleOverlayClickMobile($event, product, index)">NT${{ product.price }}</h3>
      </span>
    </article>
  </div>

  <!-- 分頁器 -->
  <Paginator
    :totalItems="phpdata.length"
    :currentPage="currentPage"
    @next-page="nextPageHandler"
    @previous-page="previousPageHandler"
    @click-page="clickpage"
  ></Paginator>
</template>

<script>
import { useProductStore } from '../stores/product'
import Paginator from './tabs/Paginator.vue'
import Swal from 'sweetalert2'
export default {
  props: ['currentTab', 'phpdataSearch'],
  components: { Paginator },
  data() {
    return {
      phpdata: [],
      phpindex: -1,
      currentPage: 1,
      pageSize: 6,
      count: 1,
      // id: 66,
      memberId: 'm001'
    }
  },
  computed: {
    filteredProducts() {
      // 根据当前选项卡和搜索内容过滤商品数据
      let filtered = this.phpdata
      if (this.currentTab !== '全部商品') {
        // 根据选项卡 ID 过滤数据
        filtered = filtered.filter((product) => product.tabName === this.currentTab)
      }

      return filtered
    },

    paginatedProducts() {
      const startIndex = (this.currentPage - 1) * this.pageSize
      const endIndex = startIndex + this.pageSize
      return this.phpdata.slice(startIndex, endIndex)
    }
  },

  methods: {
    nextPageHandler(page) {
      this.currentPage = page
    },
    previousPageHandler(page) {
      this.currentPage = page
    },

    // php
    fetchAllProductData() {
      fetch('http://localhost/TID101G2/public/api/Product.php')
        .then((response) => response.json())
        .then((data) => {
          this.phpdata = data // 將從 PHP 獲取的資料存儲到 Vue 的 data 屬性中
        })
        .catch((error) => console.error('Error fetching data:', error))
    },
    fetchAllProductBest() {
      fetch('http://localhost/TID101G2/public/api/ProductBestseller.php')
        .then((response) => response.json())
        .then((data) => {
          this.phpdata = data // 將從 PHP 獲取的資料存儲到 Vue 的 data 屬性中
        })
        .catch((error) => console.error('Error fetching data:', error))
    },
    fetchProducts(tabName) {
      fetch('http://localhost/TID101G2/public/api/ProductClass.php', {
        method: 'POST',

        body: JSON.stringify({ account: tabName }) // 发送选项卡 ID 到后端
        // body: { account: tabName } // 发送选项卡 ID 到后端
      })
        .then((response) => response.json())
        .then((data) => {
          this.phpdata = data // 將從 PHP 獲取的資料存儲到 Vue 的 data 屬性中
          this.currentPage = 1 // Reset current page when data changes
        })
        .catch((error) => console.error('Error fetching data:', error))
    },
    fetchProductsCar(product) {
      // 检查 memberId 是否为空或 null
      if (!this.memberId) {
        // 如果为空或 null，弹出提示框要求用户先登录
        Swal.fire({
          icon: 'warning',
          position: 'top',
          title: '請先登入帳號',
          showConfirmButton: false,
          timer: 1500,
          toast: true,
          onClose: () => {
            console.log('Alert closed')
          }
        })
        return // 停止执行后续代码
      }

      // const memberId = 'm001' // 设置 memberId 变量为 'm001'
      const memberId = this.memberId
      // 构建带有查询字符串的 URL
      const url = `http://localhost/TID101G2sql/src/components/ProductCart.php?member_id=${encodeURIComponent(memberId)}`
      fetch('http://localhost/TID101G2/public/api/ProductCart.php', {
        method: 'POST',

        body: JSON.stringify({ product_id: product.id, member_id: this.memberId, count: this.count }) // 发送选项卡 ID 到后端
        // body: { account: tabName } // 发送选项卡 ID 到后端
      })
      // .then((response) => response.json())
      // .then((data) => {
      //   console.log('Insert successful:', data) // 輸出成功信息
      //   // 可以在這裡進行一些成功後的處理，如果有需要的話
      // })
      // .catch((error) => console.error('Error inserting data:', error))

      Swal.fire({
        icon: 'success',
        position: 'top',
        title: '商品加入成功',
        showConfirmButton: false,
        timer: 1500,
        toast: true,
        onClose: () => {
          console.log('Alert closed')
        }
      })
    },
    goToProductDetails(product) {
      // 在这里处理跳转逻辑，可以根据需要修改路径
      this.$router.push('/product_subpages')
    },
    handleOverlayClick(event, product, index) {
      // 判断点击的具体区域
      const rect = event.target.getBoundingClientRect()
      const store = useProductStore()
      const x = event.clientX - rect.left
      const y = event.clientY - rect.top

      // pinia
      store.setSelectedProduct({
        id: product.id,
        brand: product.brand,
        name: product.name,
        details: product.details,
        price: product.price,
        stock: product.stock,
        content: product.content,
        product_class_id: product.product_class_id,
        subpage_photo: product.subpage_photo
      })

      // 根据点击位置判断是哪个部分
      if (x > rect.width * 0.7 && y > rect.height * 0.7) {
        // 点击了右下角区域
        this.fetchProductsCar(product)
        this.id++ // 递增 id
      } else {
        // 点击了其他区域
        this.goToProductDetails(product)
      }
      this.phpindex = index
    },
    handleOverlayClickMobile(event, product) {
      // 判断点击的具体区域
      const rect = event.target.getBoundingClientRect()
      const store = useProductStore()
      const x = event.clientX - rect.left
      const y = event.clientY - rect.top

      // pinia
      store.setSelectedProduct({
        id: product.id,
        brand: product.brand,
        name: product.name,
        details: product.details,
        price: product.price,
        stock: product.stock,
        content: product.content,
        product_class_id: product.product_class_id,
        subpage_photo: product.subpage_photo
      })

      // 根据点击位置判断是哪个部分
      if (x > rect.width * 0.7 && y > rect.height * 0.1) {
        // 点击了右下角区域
        this.fetchProductsCar(product)
        this.id++
      }
    },
    clickpage(pageNumber) {
      // 更新 currentPage
      this.currentPage = pageNumber

      // 根據 currentPage 計算要顯示的商品範圍
      const startIndex = (this.currentPage - 1) * this.pageSize
      const endIndex = startIndex + this.pageSize

      // 更新 paginatedProducts
      this.paginatedProducts = this.phpdata.slice(startIndex, endIndex)
    }
  },
  watch: {
    // 监听当前选项卡 ID 的变化，更新商品数据
    currentTab(newValue, oldValue) {
      if (newValue !== oldValue) {
        if (newValue === '全部商品') {
          // 当选项卡为 '全部商品' 时重新获取全部商品数据
          this.fetchAllProductData()
        } else if (newValue === '熱銷商品') {
          this.fetchAllProductBest()
        } else {
          // 否则根据选项卡获取对应数据
          this.fetchProducts(newValue)
        }
      }
    },
    phpdataSearch(newValue, oldValue) {
      if (newValue !== oldValue) {
        // 处理从父组件中 phpdata 属性发生变化的情况
        this.phpdata = newValue // 更新本地数据
        this.currentPage = 1 // 数据变化时重置当前页
      }
    }
  },
  mounted() {
    this.fetchAllProductData()
  }
}
</script>

<style lang="scss" scoped>
@mixin breakpoint($point) {
  @if $point == pc {
    @media (max-width: 1100px) {
      @content;
    }
  } @else if $point == mobile {
    @media (max-width: 768px) {
      @content;
    }
  } @else if $point == mobile2 {
    @media (max-width: 430px) {
      @content;
    }
  }
}

.product {
  display: flex;
  flex-wrap: wrap;
  padding-right: 5%;
  justify-content: space-evenly;

  width: 100%;
  @include breakpoint(mobile) {
    padding-right: 0%;
  }
}

img {
  width: 286px;
  // width: 100%;
  box-sizing: border-box;
  @include breakpoint(mobile) {
    width: 190px;
  }
}

p {
  font-size: 22px;
  padding-top: 2%;
  width: 100%;
  color: white;
  // width: 27.5%;
}

h3 {
  color: #cead82;
  font-size: 35px;
  padding-bottom: 20%;
  @include breakpoint(mobile) {
    cursor: pointer;
  }
}

article {
  position: relative;
  width: min-content;
  // width: 18.6vw;
}
.content {
  position: relative;
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 99.5%;
  background-color: rgba(0, 0, 0, 0.5);
  opacity: 0;
  transition: opacity 0.3s ease;
  cursor: pointer;
  background-image: url(/src/imgs/icon/icon_cart-shopping-w.svg);
  background-size: 30%;
  background-repeat: no-repeat;
  background-position: right bottom;
}

.overlay:hover {
  opacity: 1;
}
article {
  margin-right: auto; /* 使用 auto Margin 将项目靠左对齐 */
}

@media (max-width: 768px) {
  img {
    width: 193px;
  }

  p {
    font-size: 15px;
  }

  h3 {
    font-size: 30px;
    background-image: url('/src/imgs/icon/icon_cart-shopping-w.svg');
    background-size: 30%;
    background-repeat: no-repeat;
    background-position: right top;
    padding-right: 30px;
  }

  .overlay {
    background-image: none;
  }
}
</style>
