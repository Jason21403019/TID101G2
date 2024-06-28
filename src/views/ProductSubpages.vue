<template>
  <main id="app">
    <!-- 商品詳細資訊 -->
    <h4 class="breadCrumbs">
      <router-link to="/home">首頁</router-link> > <router-link to="/product">全部商品</router-link> > 商品資訊
    </h4>
    <section class="productInformation">
      <article class="productImg">
        <img class="productbackground" :src="selectedProduct().subpage_photo" alt="" />
      </article>
      <article class="details">
        <h1>{{ selectedProduct().brand }}</h1>

        <h1>{{ selectedProduct().name }}{{ selectedProduct().details }}</h1>

        <h4>商品編號:{{ selectedProduct().id }}</h4>

        <span v-html="selectedProduct().content" class="content"></span>
        <div>
          <h2>NT${{ selectedProduct().price }}</h2>

          <button class="countIcon" @click="countminusSign">
            {{ minusSign }}
          </button>
          <span class="counts">{{ count }}</span>
          <button class="countIcon" @click="countPlus">{{ plus }}</button>
          <span class="quantitys"> 還剩{{ selectedProduct().stock }}件</span>
        </div>
        <p>
          <button class="car" @click="fetchProductsCar">{{ addToTheCart }}</button>
        </p>
      </article>
    </section>

    <!-- 相關商品 -->
    <section class="Related">
      <h3>相關商品</h3>
      <ul class="pc">
        <li v-for="(phpdata, index) in phpdata.slice(0, 3)" :key="phpdata.id" @click="handleOverlayClick(index)">
          <img :src="phpdata.picture" alt="" />
          <p>{{ phpdata.brand }}</p>
          <p v-html="phpdata.name"></p>
          <p v-html="phpdata.details"></p>
          <h5>NT${{ phpdata.price }}</h5>
        </li>
      </ul>
      <!-- 手機板 -->
      <ul class="mobile">
        <li
          v-for="(phpdata, index) in phpdata.slice(0, 4)"
          :key="phpdata.id"
          @click="handleOverlayClickMobile($event, phpdata, index)"
        >
          <img :src="phpdata.picture" alt="" />
          <p>{{ phpdata.brand }}</p>
          <p v-html="phpdata.name"></p>
          <p v-html="phpdata.details"></p>
          <h5>NT${{ phpdata.price }}</h5>
        </li>
      </ul>
    </section>
  </main>
</template>
<script>
import { useProductStore } from '../stores/product'
import Swal from 'sweetalert2'
export default {
  data() {
    return {
      count: 1,
      counts: 1,
      tabsIndex: 0,
      // id: 77,
      plus: '+',
      minusSign: '-',
      addToTheCart: '加入購物車',
      productTasks: [],
      phpdata: [],
      memberId: ''
    }
  },
  computed: {
    quantity() {
      return this.selectedProduct().stock
    }
  },
  methods: {
    countPlus() {
      if (this.count < this.quantity) {
        this.count++
      }
    },
    countminusSign() {
      if (this.count > 1) {
        this.count--
      }
    },

    // php
    fetchProductsCar() {
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
        this.$router.push('/register')
        return // 停止执行后续代码
      }

      // const memberId = 'm001' // 设置 memberId 变量为 'm001'
      const memberId = this.memberId
      // 构建带有查询字符串的 URL
      // const url = `http://localhost/TID101G2sql/src/components/ProductCart.php?member_id=${encodeURIComponent(memberId)}`
      fetch(`${import.meta.env.VITE_PHP_PATH}ProductCart.php`, {
        method: 'POST',

        body: JSON.stringify({
          // id: this.id,
          product_id: this.selectedProduct().id,
          member_id: this.memberId,
          count: this.count
        }) // 发送选项卡 ID 到后端
        // body: { account: tabName } // 发送选项卡 ID 到后端
      })
        .then((response) => response.json())
        .then((data) => {
          console.log('Insert successful:', data) // 輸出成功信息
          // 可以在這裡進行一些成功後的處理，如果有需要的話
        })
        .catch((error) => console.error('Error inserting data:', error))
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
      this.id++ // 递增 id
    },

    fetchProductsCarMobile(phpdata) {
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
        this.$router.push('/register')
        return // 停止执行后续代码
      }

      // const memberId = 'm001' // 设置 memberId 变量为 'm001'
      const memberId = this.memberId

      // 构建带有查询字符串的 URL
      // const url = `http://localhost/TID101G2sql/src/components/ProductCart.php?member_id=${encodeURIComponent(memberId)}`
      fetch(`${import.meta.env.VITE_PHP_PATH}ProductCart.php`, {
        method: 'POST',

        body: JSON.stringify({ product_id: phpdata.id, member_id: this.memberId, count: this.counts }) // 发送选项卡 ID 到后端
        // body: { account: tabName } // 发送选项卡 ID 到后端
      })
        .then((response) => response.json())
        .then((data) => {
          console.log('Insert successful:', data) // 輸出成功信息
          // 可以在這裡進行一些成功後的處理，如果有需要的話
        })
        .catch((error) => console.error('Error inserting data:', error))
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
      this.id++
    },
    changeProduct(index) {
      this.tabsIndex = index + 1
    },

    fetchAllProductData() {
      fetch(`${import.meta.env.VITE_PHP_PATH}Product.php`)
        .then((response) => response.json())
        .then((data) => {
          this.phpdata = data // 將從 PHP 獲取的資料存儲到 Vue 的 data 屬性中
          this.phpdata.sort(() => Math.random() - 0.5)
        })
        .catch((error) => console.error('Error fetching data:', error))
    },
    handleOverlayClickMobile(event, phpdata, index) {
      // 判断点击的具体区域
      const rect = event.target.getBoundingClientRect()

      const x = event.clientX - rect.left
      const y = event.clientY - rect.top

      // 根据点击位置判断是哪个部分
      if (x > rect.width * 0.7 && y > rect.height * 0.42) {
        // 点击了右下角区域
        this.fetchProductsCarMobile(phpdata)
        // Swal.fire({
        //   icon: 'success',
        //   position: 'top',
        //   title: '商品加入成功',
        //   showConfirmButton: false,
        //   timer: 1500,
        //   toast: true,
        //   onClose: () => {
        //     console.log('Alert closed')
        //   }
        // })
      } else {
        // 点击了其他区域
        this.handleOverlayClick(index)
      }
    },

    // pinia
    selectedProduct() {
      const store = useProductStore()
      return store.selectedProduct
    },
    handleOverlayClick(index) {
      const selectedProduct = this.phpdata[index]
      const store = useProductStore()
      store.setSelectedProduct({
        id: selectedProduct.id,
        brand: selectedProduct.brand,
        name: selectedProduct.name,
        details: selectedProduct.details,
        price: selectedProduct.price,
        stock: selectedProduct.stock,
        content: selectedProduct.content,
        product_class_id: selectedProduct.product_class_id,
        subpage_photo: selectedProduct.subpage_photo
      })
      // window.scrollTo({
      //   top: 0,
      //   behavior: 'smooth' // 可選的，平滑滾動
      // })
      this.count = 0
      this.$router.push('/product_subpages')
    }
  },
  mounted() {
    this.fetchAllProductData()
    // 获取存储在 localStorage 中的值，并赋给 memberId
    this.memberId = localStorage.getItem('isLoggedIn')
    console.log(this.memberId) // 输出 memberId，用于验证获取是否正确
  }
}
</script>
<style lang="scss" scoped>
@mixin breakpoint($point) {
  @if $point == pc {
    @media (max-width: 1280px) {
      @content;
    }
  } @else if $point == pc2 {
    @media (max-width: 950px) {
      @content;
    }
  } @else if $point == mobile {
    @media (max-width: 768px) {
      @content;
    }
  } @else if $point == mobile2 {
    @media (max-width: 605px) {
      @content;
    }
  } @else if $point == mobile3 {
    @media (max-width: 500px) {
      @content;
    }
  } @else if $point == mobile4 {
    @media (max-width: 430px) {
      @content;
    }
  }
}

body {
  main {
    font-family: $fontfamily;
    font-size: 23px;
    color: white;
    background-color: #381b1d;
    background-image: url('../imgs/productsImg/bg.png');
    background-size: 60%;
    background-repeat: no-repeat;

    align-items: center;
    .productInformation {
      display: flex;
      .details {
        padding-right: 2%;
        width: 50%;
        // height: 60vh;
        @include breakpoint(pc) {
          width: 55%;
        }

        .content {
          @include breakpoint(pc) {
            font-size: 20px;
            line-height: 40px;
          }
          @include breakpoint(mobile) {
            // display: none;
            font-size: 18px;
            line-height: 20px;
          }
          @include breakpoint(mobile3) {
            font-size: 15px;
            line-height: 15px;
          }
        }
        .countIcon {
          font-size: 43px;
          color: white;
          background-color: transparent;
          border: 1px solid white;
          @include breakpoint(mobile) {
            font-size: 20px;
          }
        }

        .counts {
          padding: 0 3%;
          font-size: 50px;
          align-self: center;
          @include breakpoint(pc) {
            font-size: 35px;
          }
          @include breakpoint(mobile) {
            font-size: 20px;
          }
        }
        .quantitys {
          padding-left: 3%;
          padding-bottom: 0%;
          font-size: 20px;
          align-self: center;
          @include breakpoint(pc) {
            font-size: 16px;
          }
          @include breakpoint(mobile) {
            margin: auto 0;
          }
        }
        div {
          display: flex;
          @include breakpoint(mobile2) {
            display: block;
          }
          button {
            // height: 40px;
            align-self: center;
          }
        }
        .car {
          @include breakpoint(pc) {
            font-size: 35px;
          }
          @include breakpoint(mobile) {
            font-size: 25px;
          }
          // @include breakpoint(mobile2) {
          //   font-size: 33px;
          // }
          background-color: #fcf0d8;
          width: 100%;

          font-size: 48px;
          font-weight: bold;
          letter-spacing: 0.3em;
          padding: 2% 0;
          margin-top: 3%;
          border-radius: 10px;
        }
        .car:hover {
          background-color: #cead82;
          color: #f6f6f6;
        }
      }
    }

    .pc {
      @include breakpoint(mobile) {
        display: none;
      }
    }
    .mobile {
      display: none;

      @include breakpoint(mobile) {
        display: flex;
      }
    }
    ul {
      display: flex;
      justify-content: space-around;
      list-style: none;
      padding-bottom: 5%;
      @include breakpoint(mobile) {
        flex-wrap: wrap;
      }

      li {
        width: 30%;
        font-size: 25px;
        line-height: 40px;

        @include breakpoint(mobile) {
          width: 35vw;
          line-height: 20px;
          margin-bottom: 4%;
          background-image: url(/src/imgs/icon/icon_cart-shopping-w.svg);
          background-size: 30%;
          background-repeat: no-repeat;
          background-position: right bottom;
        }
        img {
          width: 100%;
          padding-bottom: 5%;
          cursor: pointer;
          @include breakpoint(mobile) {
            // width: 180px;
          }
        }
        p {
          padding-bottom: 3%;
          font-size: 25px;
          @include breakpoint(mobile) {
            font-size: 13px;
          }
        }
      }
    }
  }
  h1 {
    font-weight: bolder;
    font-size: 33px;
    padding-bottom: 1%;
    color: #fcf0d8;
    @include breakpoint(pc) {
      font-size: 28px;
    }
    @include breakpoint(mobile) {
      font-size: 25px;
    }
    @include breakpoint(mobile2) {
      font-size: 22px;
    }
    @include breakpoint(mobile3) {
      font-size: 20px;
    }
  }
  h2 {
    color: rgb(187, 129, 57);
    padding-right: 5%;
    // padding-bottom: 3%;
    font-size: 62px;
    font-weight: bolder;

    @include breakpoint(pc) {
      font-size: 52px;
    }
    @include breakpoint(mobile) {
      font-size: 40px;
    }
    @include breakpoint(mobile3) {
      font-size: 35px;
    }
  }
  h3 {
    text-align: center;
    font-size: 65px;
    padding-bottom: 1.5%;
    @include breakpoint(mobile) {
      font-size: 40px;
    }
  }
  h4 {
    font-size: 23px;
    padding-bottom: 1.5%;
    @include breakpoint(mobile) {
      font-size: 20px;
    }
    a {
      color: inherit;
      text-decoration: none;
    }
    a:hover {
      color: #cead82;
    }
  }
  .breadCrumbs {
    padding-top: 120px;
    padding-left: 3%;
    @include breakpoint(pc) {
    }
    @include breakpoint(mobile) {
      font-size: 11px;
    }
  }
  h5 {
    font-size: 40px;
    color: rgb(187, 129, 57);
    font-weight: bolder;

    @include breakpoint(mobile) {
      font-size: 20px;

      background-image: url(/src/imgs/icon/icon_cart-shopping-w.svg);
      background-size: 30%;
      background-repeat: no-repeat;
      background-position: right bottom;
    }
  }
  span {
    font-size: 27px;
    line-height: 50px;
    padding-bottom: 3%;
  }
  p {
    padding-bottom: 3%;
  }

  .productImg {
    width: 40%;

    .productbackground {
      width: 550px;
      @include breakpoint(pc) {
        width: 515px;
        margin-left: -20%;
      }
      @include breakpoint(pc2) {
        width: 480px;
        margin-left: -25%;
      }

      @include breakpoint(mobile) {
        width: 445px;
        margin-left: -30%;
      }
      @include breakpoint(mobile2) {
        width: 445px;
        margin-left: -50%;
      }
      @include breakpoint(mobile3) {
        width: 445px;
        margin-left: -65%;
      }
      @include breakpoint(mobile3) {
        width: 445px;
        margin-left: -85%;
      }
    }
  }
  li img:hover {
    filter: brightness(70%);
  }
  .Related {
    padding: 0 2%;
  }
}
</style>
