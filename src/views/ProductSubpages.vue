<template>
  <main id="app">
    <!-- 商品詳細資訊 -->
    <h4 class="breadCrumbs">
      <router-link to="/home">首頁</router-link> > <router-link to="/product">商品</router-link> > 商品資訊
    </h4>
    <section class="productInformation">
      <article class="productImg">
        <img class="productbackground" :src="tabs[0].bigimg" alt="" />
        <!-- <img class="productbackground2" src="../imgs/productsImg/bg.png" alt="" /> -->
      </article>
      <article class="details">
        <h1>{{ tabs[tabsIndex].brand }}</h1>

        <h1>{{ tabs[tabsIndex].name }}{{ tabs[tabsIndex].Specification }}</h1>

        <h4>商品編號:{{ tabs[tabsIndex].serialNumber }}</h4>

        <span v-html="tabs[tabsIndex].information" class="content"></span>
        <div>
          <h2>NT${{ tabs[tabsIndex].price }}</h2>

          <button class="countIcon" @click="countminusSign">
            {{ minusSign }}
          </button>
          <span class="counts">{{ count }}</span>
          <button class="countIcon" @click="countPlus">{{ plus }}</button>
          <span class="quantitys"> 還剩{{ tabs[tabsIndex].stock }}件</span>
        </div>
        <p>
          <button class="car" @click="taskAdd()">{{ addToTheCart }}</button>
        </p>
      </article>
    </section>

    <!-- 相關商品 -->
    <section class="Related">
      <h3>相關商品</h3>
      <ul class="pc">
        <li v-for="(tab, index) in tabs.slice(0, 3)" :key="tab.id" @click="changeProduct(index)">
          <img :src="tab.img" alt="" />
          <p>{{ tab.brand }}</p>
          <p v-html="tab.name"></p>
          <p v-html="tab.Specification"></p>
          <h5>NT${{ tab.price }}</h5>
        </li>
      </ul>
      <!-- 手機板 -->
      <ul class="mobile">
        <li v-for="(tab, index) in tabs.slice(0, 4)" :key="tab.id" @click="changeProduct(index)">
          <img :src="tab.img" alt="" />
          <p>{{ tab.brand }}</p>
          <p v-html="tab.name"></p>
          <p v-html="tab.Specification"></p>
          <h5>NT${{ tab.price }}</h5>
        </li>
      </ul>
    </section>
  </main>
</template>
<script>
export default {
  data() {
    return {
      count: 0,
      tabsIndex: 0,
      plus: '+',
      minusSign: '-',
      addToTheCart: '加入購物車',
      productTasks: [],
      phpdata: [],
      tabs: [
        {
          id: '01',
          brand: 'Carl Jung 卡爾榮格 ',
          name: 'Mousseux 穆瑟 無酒精氣泡酒',
          Specification: ' ' + '750ML/瓶',
          serialNumber: ' ' + 'P001',
          stock: 9,
          information:
            '全球無酒精葡萄酒的發明者，歐陸多國米其林餐廳指定，孕產婦、幼童、酒精過敏或酒精不耐症者可安心飲用，純素、無添加劑、無人工防腐劑，富含葡萄酒天然營養成分，如白藜蘆醇、單寧等。淡金色澤，微甜，氣泡綿密細緻，適合作開胃酒，百搭各式餐點，搭配中菜也很出色。',
          price: '500',
          img: 'src/imgs/productsImg/sparkling wine/Oddbird-WHITE.jpg',
          bigimg: 'src/imgs/productsImg/sparkling wine/Oddbird-WHITE.png',
          category: '無酒精紅酒'
        },
        {
          id: 'tab2',
          brand: '法國 Bel Normande',
          name: '貝爾 諾曼第精選氣泡紅葡萄汁',
          Specification: ' ' + '750ML/瓶',
          serialNumber: ' ' + 'P001',
          stock: 12,
          information:
            '<p>全球無酒精葡萄酒的發明者，歐陸多國米其林餐廳指定，孕產婦、幼童、酒精過敏或酒精不耐症者可安心飲用，純素、無添加劑、無人工防腐劑，富含葡萄酒天然營養成分，如白藜蘆醇、單寧等。淡金色澤，微甜，氣泡綿密細緻，適合作開胃酒，百搭各式餐點，搭配中菜也很出色。</p><p>保存期限三年<br />未開封常溫保存，放置陰涼乾燥處。避免陽光直射，開封後蓋緊瓶蓋冷藏。</p>',
          price: '700',
          img: 'src/imgs/productsImg/juice/HenryandLotte.jpg',
          category: '無酒精白酒'
        },
        {
          id: '03',
          brand: 'J.Chadin',
          name: '查帝麝香葡萄氣泡飲',
          Specification: ' ' + '750ML/瓶',
          serialNumber: ' ' + 'P001',
          stock: 15,
          information:
            '<p>全球無酒精葡萄酒的發明者，歐陸多國米其林餐廳指定，孕產婦、幼童、酒精過敏或酒精不耐症者可安心飲用，純素、無添加劑、無人工防腐劑，富含葡萄酒天然營養成分，如白藜蘆醇、單寧等。淡金色澤，微甜，氣泡綿密細緻，適合作開胃酒，百搭各式餐點，搭配中菜也很出色。</p><p>保存期限三年<br />未開封常溫保存，放置陰涼乾燥處。避免陽光直射，開封後蓋緊瓶蓋冷藏。</p>',
          price: '300',
          img: 'src/imgs/productsImg/wine/Carl-Jung.jpg',
          category: '無酒精紅酒'
        },
        {
          id: '04',
          brand: 'J.Chadin',
          name: '查帝麝香葡萄氣泡飲',
          Specification: ' ' + '750ML/瓶',
          serialNumber: ' ' + 'P001',
          stock: 10,
          information:
            '<p>全球無酒精葡萄酒的發明者，歐陸多國米其林餐廳指定，孕產婦、幼童、酒精過敏或酒精不耐症者可安心飲用，純素、無添加劑、無人工防腐劑，富含葡萄酒天然營養成分，如白藜蘆醇、單寧等。淡金色澤，微甜，氣泡綿密細緻，適合作開胃酒，百搭各式餐點，搭配中菜也很出色。</p><p>保存期限三年<br />未開封常溫保存，放置陰涼乾燥處。避免陽光直射，開封後蓋緊瓶蓋冷藏。</p>',
          price: '300',
          img: 'src/imgs/productsImg/pink wine/Le-Petit-Chavin.jpg',
          category: '無酒精紅酒'
        }
      ]
    }
  },
  computed: {
    quantity() {
      return this.tabs.length
    }
  },
  methods: {
    countPlus() {
      if (this.count < this.quantity) {
        this.count++
      }
    },
    countminusSign() {
      if (this.count > 0) {
        this.count--
      }
    },
    // taskAdd() {
    //   this.productTasks.unshift({
    //     id: Date.now(),
    //     img: this.tabs[this.tabsIndex].img,
    //     brand: this.tabs[this.tabsIndex].brand,
    //     name: this.tabs[this.tabsIndex].name,
    //     price: this.tabs[this.tabsIndex].price,
    //     Specification: this.tabs[this.tabsIndex].Specification,
    //     count: this.count,
    //     totalprice: this.count * parseInt(this.tabs[this.tabsIndex].price)
    //   })
    //   localStorage.setItem('productTasks', JSON.stringify(this.productTasks))
    // },
    changeProduct(index) {
      this.tabsIndex = index + 1
    },
    fetchAllProductData() {
      fetch('http://localhost/TID101G2sql/src/components/getData.php')
        .then((response) => response.json())
        .then((data) => {
          this.phpdata = data // 將從 PHP 獲取的資料存儲到 Vue 的 data 屬性中
        })
        .catch((error) => console.error('Error fetching data:', error))
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
    @media (max-width: 1280px) {
      @content;
    }
  } @else if $point == mobile {
    @media (max-width: 768px) {
      @content;
    }
  } @else if $point == mobile2 {
    @media (max-width: 600px) {
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
    .productInformation {
      display: flex;
      // width: 100%;
      background-image: url('../imgs/productsImg/bg.png');
      background-size: cover;
      background-repeat: no-repeat;
      .details {
        padding-right: 2%;
        width: 70%;
        @include breakpoint(pc) {
          width: 80%;
        }
        @include breakpoint(mobile) {
        }
        .content {
          @include breakpoint(pc) {
            font-size: 23px;
            line-height: 40px;
          }
          @include breakpoint(mobile) {
            // display: none;
            font-size: 15px;
            line-height: 20px;
          }
          @include breakpoint(mobile2) {
            font-size: 11px;
            line-height: 16px;
            margin-bottom: 0.5%;
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
          padding: 0 5%;
          font-size: 50px;
          align-self: center;
          @include breakpoint(pc) {
            font-size: 40px;
          }
          @include breakpoint(mobile) {
            font-size: 20px;
          }
        }
        .quantitys {
          padding-left: 5%;
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
          @include breakpoint(mobile) {
            display: block;
          }
          button {
            // height: 40px;
            align-self: center;
          }
        }
        .car {
          @include breakpoint(pc) {
            font-size: 44px;
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
      //   @include breakpoint(pc) {
      //   font-size: 60px;
      // }
      // @include breakpoint(mobile) {
      //   font-size: 55px;
      // }
      // @include breakpoint(mobile2) {
      //   font-size: 50px;
      // }
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
      font-size: 30px;
    }
    @include breakpoint(mobile) {
      font-size: 21px;
    }
    @include breakpoint(mobile2) {
      font-size: 18px;
    }
  }
  h2 {
    color: rgb(187, 129, 57);
    padding-right: 8%;
    // padding-bottom: 3%;
    font-size: 65px;
    font-weight: bolder;

    @include breakpoint(pc) {
      font-size: 57px;
    }
    @include breakpoint(mobile) {
      font-size: 40px;
    }
  }
  h3 {
    text-align: center;
    font-size: 65px;
    padding-bottom: 3%;
    @include breakpoint(mobile) {
      font-size: 40px;
    }
  }
  h4 {
    font-size: 23px;
    padding-bottom: 3%;
    @include breakpoint(mobile) {
      font-size: 12px;
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
    padding-top: 8%;
    padding-left: 3%;
    @include breakpoint(pc) {
      padding-top: 10%;
    }
    @include breakpoint(mobile) {
      padding-top: 25%;
      font-size: 11px;
    }
  }
  h5 {
    font-size: 40px;
    color: rgb(187, 129, 57);
    font-weight: bolder;
    @include breakpoint(mobile) {
      font-size: 20px;
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
  article {
    // width: 50%;
    img {
      // height: 60%;
    }
  }

  .productImg {
    width: 400px;
    // background-image: url('../imgs/productsImg/bg.png');
    // background-size: cover;
    // background-repeat: no-repeat;

    @include breakpoint(mobile) {
      width: 200px;
    }
    .productbackground {
      width: 130%;
      display: block;
      padding-top: 10%;

      // background-size: contain;
      @include breakpoint(mobile) {
        width: 40vw;
        height: 30vh;
        float: left;
      }
    }
    // .productbackground2 {
    //   width: 100%;
    //   margin-top: -0%;
    // }
  }
  li img:hover {
    filter: brightness(70%);
  }
  .Related {
    padding: 0 2%;
  }
}
</style>
