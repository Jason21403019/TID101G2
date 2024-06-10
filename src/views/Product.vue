<template>
  <main id="commodity_tab">
    <div class="searchButton">
      <input type="text" v-model="search" placeholder="Search" />
      <button class="search" @click="searchData">
        <img src="../imgs/icon/icon_admin-search.svg" alt="" />
      </button>
    </div>
    <section class="productInfo">
      <section id="tabName">
        <button
          type="button"
          v-for="tab in tabs"
          :class="{ active: currentTab == tab.id }"
          :key="tab.id"
          @click="changeTab(tab.id)"
        >
          <!-- @click="currentTab = tab.id" -->
          {{ tab.name }}
        </button>
      </section>

      <section class="test">
        <!-- <component v-bind:is="current_tab_component" class="tab_content"> </component> -->
        <component is="Tab2Content"></component>
        <!-- <component :is="current_tab_component" is="Tab2Content" class="tab_content"></component> -->
      </section>
    </section>
  </main>
</template>

<script>
import Tab2Content from '../components/ProductInfo.vue'

export default {
  // components: ['TabContent'],
  components: { Tab2Content },
  data() {
    return {
      currentTab: 'tab1',
      tabs: [
        {
          id: 'tab1',
          name: '全部商品'
        },
        {
          id: 'tab2',
          name: '熱銷商品'
        },
        {
          id: 'tab3',
          name: '無酒精紅酒'
        },
        {
          id: 'tab4',
          name: '無酒精白酒'
        },
        {
          id: 'tab5',
          name: '無酒精氣泡酒'
        },
        {
          id: 'tab6',
          name: '無酒精粉紅酒'
        },
        {
          id: 'tab7',
          name: '無酒精果汁'
        }
      ],
      // infos: [
      //   {
      //     id: '01',
      //     brand: 'Carl Jung 卡爾榮格',
      //     name: 'Mousseux 穆瑟 無酒精氣泡酒',
      //     Specification: ' ' + '750ML/瓶',
      //     serialNumber: ' ' + 'P001',
      //     information:
      //       '<p>全球無酒精葡萄酒的發明者，歐陸多國米其林餐廳指定，孕產婦、幼童、酒精過敏或酒精不耐症者可安心飲用，純素、無添加劑、無人工防腐劑，富含葡萄酒天然營養成分，如白藜蘆醇、單寧等。淡金色澤，微甜，氣泡綿密細緻，適合作開胃酒，百搭各式餐點，搭配中菜也很出色。</p><p>保存期限三年<br />未開封常溫保存，放置陰涼乾燥處。避免陽光直射，開封後蓋緊瓶蓋冷藏。</p>',
      //     price: 'NT$900',
      //     img: 'juice/Bel Normande.png'
      //   },
      //   {
      //     id: 'tab2',
      //     brand: 'Carl Jung 卡爾',
      //     name: 'Mousseux 穆瑟 無酒精氣',
      //     Specification: ' 75ML/瓶',
      //     serialNumber: 'P001',
      //     information:
      //       '<p>全球無酒精葡萄酒的發明者，歐陸多國米其林餐廳指定，孕產婦、幼童、酒精過敏或酒精不耐症者可安心飲用，純素、無添加劑、無人工防腐劑，富含葡萄酒天然營養成分，如白藜蘆醇、單寧等。淡金色澤，微甜，氣泡綿密細緻，適合作開胃酒，百搭各式餐點，搭配中菜也很出色。</p><p>保存期限三年<br />未開封常溫保存，放置陰涼乾燥處。避免陽光直射，開封後蓋緊瓶蓋冷藏。</p>',
      //     price: 'NT$900',
      //     img: 'juice/el Normande redapple.png'
      //   }
      // ],
      search: ''
    }
  },
  computed: {
    current_tab_component() {
      return 'tab' + this.currentTab + '_content'
    },

    searchData() {
      return this.infos.filter(
        (info) =>
          info.brand.includes(this.search) ||
          info.name.includes(this.search) ||
          info.Specification.includes(this.search) ||
          info.price.includes(this.search)
      )
    }
  },

  methods: {
    // 点击标签按钮时切换标签
    changeTab(tabId) {
      this.currentTab = tabId
    }
  },
  created() {
    // 動態註冊組件
    /*
    const info = {}
    this.tabs.forEach((tab) => {
      info[`tab${tab.id}_content`] = {
        template: `
        <article class="a" v-for="index in 6">
          <div class='content'>
            <img src='./圖片/Rectangle 42.png'/>
          </div>
          <span>
            <p>${tab.name}</p>
            <p>貝爾 諾曼第氣泡紅肉蘋果汁</p>
            <p>750ML/瓶</p>
            <h3>NT$299</h3>
          </span>
        </article>
      `
      }
    })

    // 將動態生成的組件分配給組件對象
    this.$options.components = { ...this.$options.components, ...info }
    */
  }
}
</script>

<style scoped>
#tabName {
  width: 300px;
  font-weight: bold;
}
article {
  margin: 0 3%;
}

main {
  background-color: #381b1d;
  padding-top: 5%;

  p {
    font-size: 22px;
    padding-top: 2%;
    color: white;
  }
  h3 {
    color: #cead82;
    font-size: 35px;
    padding-bottom: 20%;
  }
  button {
    background-color: #fcf0d8;
    border: 0px;
    border-bottom: 1px solid black;
    padding: 6% 5%;
    font-size: 25px;
    font-weight: bold;
    width: 300px;
  }
}
.productInfo {
  display: flex;
  flex-direction: row;
}
.test {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: space-between;
}

.tab_content {
  border: 1px solid lightgray;
  padding: 10px;
  margin-top: 5px;
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
  height: 99%;
  background-image: url(./圖片/Group.png);
  background-repeat: no-repeat;
  background-position: right bottom;
  background-color: rgba(0, 0, 0, 0.5); /* 遮罩层颜色，可根据需要调整透明度 */
  opacity: 0; /* 初始时不显示 */
  transition: opacity 0.3s ease; /* 添加过渡效果 */
  cursor: pointer;
}

.searchButton {
  display: flex;
  justify-content: flex-end;
  margin-top: 2%;
  margin-right: 3%;
  padding: 5% 0;
  height: 60px;
  margin-bottom: 3%;
  padding: 0 0;
  border-radius: 10px;
  border: none;
  input {
    height: 100%;
    background-color: #fcf0d8;
    border-radius: 10px;
    ::placeholder {
      color: rgb(220, 218, 218);
    }
  }
  button {
    background-color: rgba(255, 255, 255, 0);
    border: none;
    border-radius: 10px;
    width: 5%;
    padding: 0;
    margin-left: -4%;
    img {
      width: 20px;
    }
  }
}
.active {
  color: #c7a979;
}
</style>
