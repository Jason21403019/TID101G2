<template>
  <div class="product" v-if="currentTab === tab1">
    <!-- <article class="a" v-for="(product, index) in infos.slice(0, infos.length)" :key="product.id"> -->
    <article class="a" v-for="(product, index) in paginatedInfos" :key="product.id">
      <div class="content">
        <img :src="`/src/imgs/productsImg/${product.img}`" alt="" />
      </div>
      <span>
        <p>{{ product.brand }}</p>
        <p>{{ product.name }}</p>
        <p>{{ product.Specification }}</p>
        <h3>{{ product.price }}</h3>
      </span>
    </article>
  </div>

  <!-- <div class="product" style="border: 2px solid green">
    <article class="b" v-for="index in 5">
      <div class="content">
        <p><img src="/src/imgs/productsImg/juice/Bel Normande.png" alt="" /></p>
      </div>
      <span>
        <p>{{ currentProduct.brand }}</p>
        <p>{{ currentProduct.name }}</p>
        <p>{{ currentProduct.Specification }}</p>
        <h3>{{ currentProduct.price }}</h3>
      </span>
    </article>
  </div> -->
  <Paginatort @next-page="nextPageHandler" @previous-page="previousPageHandler"></Paginatort>
</template>
<!-- <img src="../imgs/productsImg/sparkling wine/Le Petit Etoile.png" alt=""> -->
<script>
import Paginatort from './tabs/Paginator.vue'
export default {
  components: { Paginatort },
  data() {
    return {
      infos: [
        {
          id: '01',
          brand: 'Carl Jung 卡爾榮格',
          name: 'Mousseux 穆瑟 無酒精氣泡酒',
          Specification: ' ' + '750ML/瓶',
          serialNumber: ' ' + 'P001',
          information:
            '<p>全球無酒精葡萄酒的發明者，歐陸多國米其林餐廳指定，孕產婦、幼童、酒精過敏或酒精不耐症者可安心飲用，純素、無添加劑、無人工防腐劑，富含葡萄酒天然營養成分，如白藜蘆醇、單寧等。淡金色澤，微甜，氣泡綿密細緻，適合作開胃酒，百搭各式餐點，搭配中菜也很出色。</p><p>保存期限三年<br />未開封常溫保存，放置陰涼乾燥處。避免陽光直射，開封後蓋緊瓶蓋冷藏。</p>',
          price: 'NT$800',
          img: 'juice/Bel Normande.png',
          // img: new URL('@/juice/Bel Normande.png', import.meta.url).href,
          category: '無酒精紅酒'
        },
        {
          id: 'tab2',
          brand: 'J.Chadin',
          name: '查帝麝香葡萄氣泡飲',
          Specification: ' 550ML/瓶',
          serialNumber: 'P001',
          information:
            '<p>全球無酒精葡萄酒的發明者，歐陸多國米其林餐廳指定，孕產婦、幼童、酒精過敏或酒精不耐症者可安心飲用，純素、無添加劑、無人工防腐劑，富含葡萄酒天然營養成分，如白藜蘆醇、單寧等。淡金色澤，微甜，氣泡綿密細緻，適合作開胃酒，百搭各式餐點，搭配中菜也很出色。</p><p>保存期限三年<br />未開封常溫保存，放置陰涼乾燥處。避免陽光直射，開封後蓋緊瓶蓋冷藏。</p>',
          price: 'NT$950',
          img: 'juice/el Normande redapple.png',
          category: '無酒精白酒'
        },
        {
          id: '03',
          brand: '六十四十氣泡葡萄果汁',
          name: '萊茵黑森葡萄',
          Specification: ' ' + '330ML/瓶',
          serialNumber: ' ' + 'P001',
          information:
            '<p>全球無酒精葡萄酒的發明者，歐陸多國米其林餐廳指定，孕產婦、幼童、酒精過敏或酒精不耐症者可安心飲用，純素、無添加劑、無人工防腐劑，富含葡萄酒天然營養成分，如白藜蘆醇、單寧等。淡金色澤，微甜，氣泡綿密細緻，適合作開胃酒，百搭各式餐點，搭配中菜也很出色。</p><p>保存期限三年<br />未開封常溫保存，放置陰涼乾燥處。避免陽光直射，開封後蓋緊瓶蓋冷藏。</p>',
          price: 'NT$650',
          img: 'liquor/PIERRE ZERO.png',
          category: '無酒精氣泡酒'
        },
        {
          id: '01',
          brand: '法國 Bel Normande',
          name: '貝爾 諾曼第精選氣泡紅葡萄汁',
          Specification: ' ' + '750ML/瓶',
          serialNumber: ' ' + 'P001',
          information:
            '<p>全球無酒精葡萄酒的發明者，歐陸多國米其林餐廳指定，孕產婦、幼童、酒精過敏或酒精不耐症者可安心飲用，純素、無添加劑、無人工防腐劑，富含葡萄酒天然營養成分，如白藜蘆醇、單寧等。淡金色澤，微甜，氣泡綿密細緻，適合作開胃酒，百搭各式餐點，搭配中菜也很出色。</p><p>保存期限三年<br />未開封常溫保存，放置陰涼乾燥處。避免陽光直射，開封後蓋緊瓶蓋冷藏。</p>',
          price: 'NT$530',
          img: '/wine/plus & minus  VEGAN.png',
          category: '無酒精氣泡酒'
        },
        {
          id: '01',
          brand: 'J.Chadin',
          name: 'Mousseux  無酒精氣泡酒',
          Specification: ' ' + '550ML/瓶',
          serialNumber: ' ' + 'P001',
          information:
            '<p>全球無酒精葡萄酒的發明者，歐陸多國米其林餐廳指定，孕產婦、幼童、酒精過敏或酒精不耐症者可安心飲用，純素、無添加劑、無人工防腐劑，富含葡萄酒天然營養成分，如白藜蘆醇、單寧等。淡金色澤，微甜，氣泡綿密細緻，適合作開胃酒，百搭各式餐點，搭配中菜也很出色。</p><p>保存期限三年<br />未開封常溫保存，放置陰涼乾燥處。避免陽光直射，開封後蓋緊瓶蓋冷藏。</p>',
          price: 'NT$700',
          img: 'pink wine/plus & minus.png',
          category: '無酒精紅酒'
        },
        {
          id: '01',
          brand: 'Carl Jung 卡爾榮格',
          name: 'Mousseux 穆瑟 無酒精氣',
          Specification: ' ' + '650ML/瓶',
          serialNumber: ' ' + 'P001',
          information:
            '<p>全球無酒精葡萄酒的發明者，歐陸多國米其林餐廳指定，孕產婦、幼童、酒精過敏或酒精不耐症者可安心飲用，純素、無添加劑、無人工防腐劑，富含葡萄酒天然營養成分，如白藜蘆醇、單寧等。淡金色澤，微甜，氣泡綿密細緻，適合作開胃酒，百搭各式餐點，搭配中菜也很出色。</p><p>保存期限三年<br />未開封常溫保存，放置陰涼乾燥處。避免陽光直射，開封後蓋緊瓶蓋冷藏。</p>',
          price: 'NT$850',
          img: 'sparkling wine/Le Petit Etoile.png',
          category: '無酒精粉紅酒'
        },
        {
          id: '01',
          brand: 'Carl Jung 卡爾榮格7',
          name: 'Mousseux 穆瑟 無酒精氣泡酒',
          Specification: ' ' + '750ML/瓶',
          serialNumber: ' ' + 'P001',
          information:
            '<p>全球無酒精葡萄酒的發明者，歐陸多國米其林餐廳指定，孕產婦、幼童、酒精過敏或酒精不耐症者可安心飲用，純素、無添加劑、無人工防腐劑，富含葡萄酒天然營養成分，如白藜蘆醇、單寧等。淡金色澤，微甜，氣泡綿密細緻，適合作開胃酒，百搭各式餐點，搭配中菜也很出色。</p><p>保存期限三年<br />未開封常溫保存，放置陰涼乾燥處。避免陽光直射，開封後蓋緊瓶蓋冷藏。</p>',
          price: 'NT$900',
          img: 'juice/Bel Normande.png',
          category: '無酒精白酒'
        }
      ],
      currentPage: 1,
      pageSize: 6
    }
  },
  computed: {
    currentProduct() {
      const index = this.currentPage - 1
      return this.infos[index]
    },
    paginatedInfos() {
      const startIndex = (this.currentPage - 1) * this.pageSize
      const endIndex = this.currentPage * this.pageSize
      return this.infos.slice(startIndex, endIndex)
    }
  },
  methods: {
    nextPageHandler(page) {
      this.currentPage = page
    },
    previousPageHandler(page) {
      this.currentPage = page
    }
  },
  mounted() {
    // 使用mounted鉤子
    this.$nextTick(() => {
      document.querySelectorAll('article div').forEach((div) => {
        div.addEventListener('click', (event) => {
          const rect = div.getBoundingClientRect()
          const x = event.clientX - rect.left
          const y = event.clientY - rect.top
          const beforeWidth = rect.width * 0.75
          const beforeHeight = rect.height * 0.3

          if (x > beforeWidth && y > rect.height - beforeHeight) {
            // 点击了 ::before 区域
            this.$router.push('/product_subpages') // 这里修改为您想要跳转的页面
          } else {
            // 点击了 div 区域
            this.$router.push('/product_subpages')
          }
        })
      })
    })
  }
}
</script>

<style lang="scss" scoped>
// @mixin breakpoint($point) {
//   @if $point == pc {
//     @media (max-width: 1100px) {
//       @content;
//     }
//   } @else if $point == mobile {
//     @media (max-width: 768px) {
//       @content;
//     }
//   } @else if $point == mobile2 {
//     @media (max-width: 430px) {
//       @content;
//     }
//   }
// }
@mixin breakpoint($point) {
  @if $point == pc {
    @media (max-width: 1280px) {
      @content;
    }
  } @else if $point == mobile {
    @media (max-width: 768px) {
      @content;
    }
  }
}
.product {
  display: flex;
  flex-wrap: wrap;
  // padding: 0 7%;
  padding-right: 5%;
  justify-content: space-evenly;
}
img {
  width: 286px;
  box-sizing: border-box;
  // width: 33%;
  @include breakpoint(mobile) {
    width: 200px;
  }
  // @include breakpoint(mobile2) {
  //   width: 150px;
  // }
}
p {
  font-size: 22px;
  padding-top: 2%;
  width: 100%;
  color: white;

  @include breakpoint(mobile) {
    font-size: 15px;
  }
  // @include breakpoint(mobile2) {
  //   width: 150px;
  // }
}
h3 {
  color: #cead82;
  font-size: 35px;
  padding-bottom: 20%;
  @include breakpoint(mobile) {
    font-size: 30px;
    background-image: url(/src/imgs/icon/icon_cart-shopping-w.svg);
    background-size: 30%;
    background-repeat: no-repeat;
    background-position: right top;
  }
}
article {
}
article div {
  position: relative;
}

article div:hover::before {
  opacity: 1; /* 鼠标悬停时显示遮罩层 */
}

article div::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 98%;
  background-image: url(/src/imgs/icon/icon_cart-shopping-w.svg);
  background-size: 30%;
  background-repeat: no-repeat;
  background-position: right bottom;
  background-color: rgba(0, 0, 0, 0.5); /* 遮罩层颜色，可根据需要调整透明度 */
  opacity: 0; /* 初始时不显示 */
  transition: opacity 0.3s ease; /* 添加过渡效果 */
  cursor: pointer;
  @include breakpoint(mobile) {
    background-image: none;
  }
}
</style>
