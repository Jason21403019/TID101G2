<template>
  <main id="commodity_tab">
    <div class="searchButton">
      <h4><router-link to="/home">首頁</router-link> > 商品</h4>
      <input type="text" class="searchText" v-model="search" placeholder="Search" />
      <button class="search" @click="fetchProductSearch(search)">
        <img src="../imgs/icon/icon_admin-search.svg" alt="" />
      </button>
    </div>
    <section class="productInfo">
      <section id="tabName">
        <button
          type="button"
          v-for="tab in tabs"
          :class="{ active: currentTab == tab.name }"
          :key="tab.id"
          @click="changeTab(tab.name)"
        >
          <!-- @click="currentTab = tab.id" -->
          <h1>{{ tab.name }}</h1>
        </button>
        <!-- <label></label> -->
        <select v-model="currentTab" @change="changeTab(currentTab)">
          <option v-for="tab in tabs" :key="tab.id" :value="tab.name">
            <h1>{{ tab.name }}</h1>
          </option>
        </select>
      </section>

      <section class="test">
        <!-- <component v-bind:is="current_tab_component" class="tab_content"> </component> -->
        <!-- <component is="Tab2Content"></component> -->
        <Tab2Content :currentTab="currentTab" :phpdataSearch="phpdataSearch"></Tab2Content>
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
      phpdataSearch: [],
      currentTab: '全部商品',
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
    // current_tab_component() {
    //   return 'tab' + this.currentTab + '_content'
    // }
    // searchData() {
    //   return this.infos.filter(
    //     (info) =>
    //       info.brand.includes(this.search) ||
    //       info.name.includes(this.search) ||
    //       info.Specification.includes(this.search) ||
    //       info.price.includes(this.search)
    //   )
    // }
  },

  methods: {
    // 点击标签按钮时切换标签
    changeTab(tabId) {
      this.currentTab = tabId
    },
    fetchProductSearch(search) {
      fetch('http://localhost/TID101G2sql/src/components/ProductNameSearch.php', {
        method: 'POST',

        body: JSON.stringify({ account: search }) // 发送选项卡 ID 到后端
        // body: { account: tabName } // 发送选项卡 ID 到后端
      })
        .then((response) => response.json())
        .then((data) => {
          this.phpdataSearch = data // 將從 PHP 獲取的資料存儲到 Vue 的 data 屬性中
          // this.currentPage = 1 // Reset current page when data changes
        })
      // .catch((error) => console.error('Error fetching data:', error))
    }
  }
  // watch: {
  //   search(newValue, oldValue) {
  //     if (newValue !== oldValue) {
  //       this.fetchProductSearch(newValue)
  //     }
  //   }
  // }
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
#tabName {
  width: 300px;
  font-weight: bold;
  border-radius: 10px;
  @include breakpoint(mobile) {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    width: 100%;
  }

  button {
    @include breakpoint(mobile) {
      width: 33%;

      display: none;
    }
  }
  select {
    width: 100%;
    background-color: $ramos-gin-fizz;
    font-size: 25px;
    font-family: 'Noto Serif TC';
    font-weight: bold;
    display: none;

    @include breakpoint(mobile) {
      margin-right: 3%;
      margin-bottom: 5%;
      display: flex;
    }

    // option {
    //   font-family: 'Noto Serif TC';
    // }
  }
}
article {
  margin: 0 3%;
}

main {
  background-color: #381b1d;
  padding-top: 5%;

  @include breakpoint(mobile) {
    padding-top: 20%;
  }

  p {
    font-size: 22px;
    padding-top: 2%;
    color: white;
  }
  h1 {
    border-bottom: 1px solid black;
    padding: 6% 0%;
    margin: 0 3%;
    @include breakpoint(mobile) {
      border-bottom: 0px;
      border-right: 1px solid black;
      padding: 0;
    }
    // padding-bottom: 1%;
  }
  h3 {
    color: #cead82;
    font-size: 35px;
    padding-bottom: 20%;
  }
  h4 {
    color: $whitelady;
    font-size: 25px;
    line-height: 60px;
    margin-right: auto;
    margin-left: 2.5%;
    @include breakpoint(mobile) {
      font-size: 19px;
    }

    a {
      color: inherit;
      text-decoration: none;
    }
    a:hover {
      color: #cead82;
    }
  }

  button {
    background-color: #fcf0d8;
    border: 0px;
    // border-bottom: 1px solid black;

    font-size: 25px;
    font-weight: bold;
    width: 300px;
  }
}
.productInfo {
  display: flex;
  flex-direction: row;
  margin-left: 3%;
  @include breakpoint(mobile) {
    flex-direction: column;
  }
}
.test {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: space-between;
  padding-left: 5%;
  width: 100%;
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
  margin-top: 100px;
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
