<template>
  <main id="app">
    <!-- 商品詳細資訊 -->
    <section class="productInformation">
      <article class="productImg">
        <img class="productbackground" src="../imgs/productsImg/sparkling wine/Carl-Jung-Mousseux_subpages.png" alt="" />
        <!-- <img class="productbackground2" src="../imgs/productsImg/bg.png" alt="" /> -->
      </article>
      <article class="details">
        <h1>{{ tabs[0].brand }}</h1>

        <h1>{{ tabs[0].name }}{{ tabs[0].Specification }}</h1>

        <h4>商品編號:{{ tabs[0].serialNumber }}</h4>

        <span v-html="tabs[0].information"></span>
        <h2>{{ tabs[0].price }}</h2>

        <button class="countIcon" @click="countminusSign">
          {{ minusSign }}
        </button>
        <span class="counts">{{ count }}</span>
        <button class="countIcon" @click="countPlus">{{ plus }}</button>
        還剩{{ quantity }}件
        <p>
          <button class="car">{{ addToTheCart }}</button>
        </p>
      </article>
    </section>

    <!-- 相關商品 -->
    <section class="Related">
      <h3>相關商品</h3>
      <ul>
        <li v-for="(tab, index) in tabs.slice(0, 3)" :key="tab.id">
          <img :src="tab.img" alt="" />
          <p>{{ tab.brand }}</p>
          <p v-html="tab.name"></p>
          <p v-html="tab.Specification"></p>
          <h5>{{ tab.price }}</h5>
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
      plus: '+',
      minusSign: '-',
      addToTheCart: '加入購物車',

      tabs: [
        {
          id: '01',
          brand: 'Carl Jung 卡爾榮格 ',
          name: 'Mousseux 穆瑟 無酒精氣泡酒',
          Specification: ' ' + '750ML/瓶',
          serialNumber: ' ' + 'P001',
          information:
            '<p>全球無酒精葡萄酒的發明者，歐陸多國米其林餐廳指定，孕產婦、幼童、酒精過敏或酒精不耐症者可安心飲用，純素、無添加劑、無人工防腐劑，富含葡萄酒天然營養成分，如白藜蘆醇、單寧等。淡金色澤，微甜，氣泡綿密細緻，適合作開胃酒，百搭各式餐點，搭配中菜也很出色。</p><p>保存期限三年<br />未開封常溫保存，放置陰涼乾燥處。<br />避免陽光直射，開封後蓋緊瓶蓋冷藏。</p>',
          price: 'NT$500',
          img: 'src/imgs/productsImg/juice/Bel Normande.png',
          category: '無酒精紅酒'
        },
        {
          id: 'tab2',
          brand: '法國 Bel Normande',
          name: '貝爾 諾曼第精選氣泡紅葡萄汁',
          Specification: ' ' + '750ML/瓶',
          serialNumber: ' ' + 'P001',
          information:
            '<p>全球無酒精葡萄酒的發明者，歐陸多國米其林餐廳指定，孕產婦、幼童、酒精過敏或酒精不耐症者可安心飲用，純素、無添加劑、無人工防腐劑，富含葡萄酒天然營養成分，如白藜蘆醇、單寧等。淡金色澤，微甜，氣泡綿密細緻，適合作開胃酒，百搭各式餐點，搭配中菜也很出色。</p><p>保存期限三年<br />未開封常溫保存，放置陰涼乾燥處。避免陽光直射，開封後蓋緊瓶蓋冷藏。</p>',
          price: 'NT$700',
          img: 'src/imgs/productsImg/juice/el Normande.png',
          category: '無酒精白酒'
        },
        {
          id: '03',
          brand: 'J.Chadin',
          name: '查帝麝香葡萄氣泡飲',
          Specification: ' ' + '750ML/瓶',
          serialNumber: ' ' + 'P001',
          information:
            '<p>全球無酒精葡萄酒的發明者，歐陸多國米其林餐廳指定，孕產婦、幼童、酒精過敏或酒精不耐症者可安心飲用，純素、無添加劑、無人工防腐劑，富含葡萄酒天然營養成分，如白藜蘆醇、單寧等。淡金色澤，微甜，氣泡綿密細緻，適合作開胃酒，百搭各式餐點，搭配中菜也很出色。</p><p>保存期限三年<br />未開封常溫保存，放置陰涼乾燥處。避免陽光直射，開封後蓋緊瓶蓋冷藏。</p>',
          price: 'NT$300',
          img: 'src/imgs/productsImg/juice/J.Chadin.png',
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
    }
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
body {
  main {
    font-family: $fontfamily;
    font-size: 27px;
    color: white;
    background-color: #381b1d;
    .productInformation {
      display: flex;
      // width: 100%;

      .details {
        padding-top: 10%;
        padding-right: 3%;
        width: 60%;
        .countIcon {
          font-size: 43px;
          color: white;
          background-color: transparent;
          border: 1px solid white;
        }
        .counts {
          padding: 0 5%;
          font-size: 50px;
        }
        .car {
          @include breakpoint(pc) {
            font-size: 44px;
          }
          @include breakpoint(mobile) {
            font-size: 39px;
          }
          @include breakpoint(mobile2) {
            font-size: 33px;
          }
          background-color: #fcf0d8;
          width: 100%;

          font-size: 48px;
          letter-spacing: 0.3em;
          padding: 5% 0;
          margin-top: 5%;
          border-radius: 10px;
        }
        .car:hover {
          background-color: #cead82;
          color: #f6f6f6;
        }
      }
    }
    ul {
      display: flex;
      justify-content: space-around;
      list-style: none;
      padding-bottom: 5%;
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

        img {
          width: 100%;
          padding-bottom: 5%;
        }
        p {
          padding-bottom: 3%;
        }
      }
    }
  }
  h1 {
    font-weight: bolder;
    font-size: 37px;
    padding-bottom: 3%;
    color: #fcf0d8;
  }
  h2 {
    color: rgb(187, 129, 57);
    padding-top: 5%;
    padding-bottom: 3%;
    font-size: 65px;
    font-weight: bolder;
    @include breakpoint(pc) {
      font-size: 60px;
    }
    @include breakpoint(mobile) {
      font-size: 55px;
    }
    @include breakpoint(mobile2) {
      font-size: 50px;
    }
  }
  h3 {
    text-align: center;
    font-size: 65px;
    padding-bottom: 3%;
  }
  h4 {
    font-size: 23px;
    padding-bottom: 3%;
  }
  h5 {
    font-size: 35px;
    color: rgb(187, 129, 57);
    font-weight: bolder;
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
    width: 40%;
    background-image: url('../imgs/productsImg/bg.png');
    background-size: cover;
    background-repeat: no-repeat;

    .productbackground {
      width: 100%;
      padding-top: 10%;
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
