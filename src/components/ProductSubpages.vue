<template>
  <main id="app">
    <!-- 商品詳細資訊 -->
    <section class="productInformation">
      <article>
        <img src="./圖片/Group 248.png" alt="" />
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
    <section>
      <h3>相關商品</h3>
      <ul>
        <li v-for="(tab, index) in tabs" :key="index">
          <img :src="tab.img" alt="" />
          <p>{{ tab.brand }}</p>
          <p>{{ tab.name }}{{ tab.Specification }}</p>
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
          id: 'tab1',
          brand: 'Carl Jung 卡爾榮格',
          name: 'Mousseux 穆瑟 無酒精氣泡酒',
          Specification: ' ' + '750ML/瓶',
          serialNumber: ' ' + 'P001',
          information:
            '<p>全球無酒精葡萄酒的發明者，歐陸多國米其林餐廳指定，孕產婦、幼童、酒精過敏或酒精不耐症者可安心飲用，純素、無添加劑、無人工防腐劑，富含葡萄酒天然營養成分，如白藜蘆醇、單寧等。淡金色澤，微甜，氣泡綿密細緻，適合作開胃酒，百搭各式餐點，搭配中菜也很出色。</p><p>保存期限三年<br />未開封常溫保存，放置陰涼乾燥處。避免陽光直射，開封後蓋緊瓶蓋冷藏。</p>',
          price: 'NT$900',
          img: 'juice/Bel Normande.png'
        },
        {
          id: 'tab2',
          brand: 'Carl Jung 卡爾',
          name: 'Mousseux 穆瑟 無酒精氣',
          Specification: ' 75ML/瓶',
          serialNumber: 'P001',
          information:
            '<p>全球無酒精葡萄酒的發明者，歐陸多國米其林餐廳指定，孕產婦、幼童、酒精過敏或酒精不耐症者可安心飲用，純素、無添加劑、無人工防腐劑，富含葡萄酒天然營養成分，如白藜蘆醇、單寧等。淡金色澤，微甜，氣泡綿密細緻，適合作開胃酒，百搭各式餐點，搭配中菜也很出色。</p><p>保存期限三年<br />未開封常溫保存，放置陰涼乾燥處。避免陽光直射，開封後蓋緊瓶蓋冷藏。</p>',
          price: 'NT$900',
          img: 'juice/el Normande redapple.png'
        },
        {
          id: 'tab3',
          brand: '法國 Bel Normande',
          name: '貝爾 諾曼第精選氣泡紅葡萄',
          Specification: ' ' + '750ML/瓶',
          serialNumber: ' ' + 'P001',
          information:
            '<p>全球無酒精葡萄酒的發明者，歐陸多國米其林餐廳指定，孕產婦、幼童、酒精過敏或酒精不耐症者可安心飲用，純素、無添加劑、無人工防腐劑，富含葡萄酒天然營養成分，如白藜蘆醇、單寧等。淡金色澤，微甜，氣泡綿密細緻，適合作開胃酒，百搭各式餐點，搭配中菜也很出色。</p><p>保存期限三年<br />未開封常溫保存，放置陰涼乾燥處。避免陽光直射，開封後蓋緊瓶蓋冷藏。</p>',
          price: 'NT$900',
          img: 'juice/J.Chadin.png'
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
body {
  main {
    font-size: 32px;
    color: white;
    background-color: #381b1d;
    .productInformation {
      display: flex;
      width: 100%;

      .details {
        padding-top: 10%;
        padding-right: 3%;
        .countIcon {
          font-size: 48px;
          color: white;
          background-color: transparent;
          border: 1px solid white;
        }
        .counts {
          padding: 0 5%;
          font-size: 50px;
        }
        .car {
          background-color: antiquewhite;
          width: 100%;
          font-size: 53px;
          letter-spacing: 0.3em;
          padding: 1% 0;
          margin-top: 5%;
        }
      }
    }
    ul {
      display: flex;
      justify-content: space-around;
      list-style: none;
      li {
        width: 30%;
        font-size: 30px;
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
    font-size: 42px;
    padding-bottom: 5%;
  }
  h2 {
    color: rgb(187, 129, 57);
    padding-bottom: 5%;
    font-size: 70px;
  }
  h3 {
    text-align: center;
    font-size: 70px;
    padding-bottom: 5%;
  }
  h4 {
    font-size: 28px;
    padding-bottom: 5%;
  }
  h5 {
    font-size: 47px;
  }
  span {
    font-size: 32px;
    line-height: 50px;
    padding-bottom: 5%;
  }
  p {
    padding-bottom: 5%;
  }
  article {
    width: 50%;
    img {
      width: 100%;
    }
  }
}
</style>
