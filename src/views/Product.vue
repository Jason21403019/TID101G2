<template>
  <main id="commodity_tab">
    <section id="tabName">
      <button
        v-for="tab in tabs"
        :key="tab.id"
        type="button"
        :class="{ active: currentTab == tab.id }"
        @click="currentTab = tab.id"
      >
        {{ tab.name }}
      </button>
    </section>

    <section class="test">
      <component :is="current_tab_component" class="tab_content"></component>
    </section>
  </main>
</template>

<script>
export default {
  data() {
    return {
      imgs: [
        { j1: 'juice/Bel Normande.png' },
        { j2: 'juice/el Normande redapple.png' },
        { j3: 'juice//el Normande.png' },
        { j4: 'juice/HenryandLotte.jpg' },
        { j5: 'juice/J.Chadin.png' }
      ],
      currentTab: 'tab1',
      tabs: [
        { id: 'tab1', name: '全部商品' },
        { id: 'tab2', name: '熱銷商品' },
        { id: 'tab3', name: '無酒精紅酒' },
        { id: 'tab4', name: '無酒精白酒' },
        { id: 'tab5', name: '無酒精氣泡酒' },
        { id: 'tab6', name: '無酒精粉紅酒' },
        { id: 'tab7', name: '無酒精果汁' }
      ],
      infos: [
        {
          id: '01',
          brand: 'Carl Jung 卡爾榮格',
          name: 'Mousseux 穆瑟 無酒精氣泡酒',
          Specification: ' 750ML/瓶',
          serialNumber: ' P001',
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
        }
      ]
    }
  },
  computed: {
    current_tab_component() {
      return this.currentTab + '_content'
    }
  }
}
</script>

<style scoped>
#tabName {
  width: 300px;
}
article {
  margin: 0 3%;
}
main {
  background-color: #381b1d;
  display: flex;
  margin-top: 20%;
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
    padding: 2% 5%;
    font-size: 25px;
    font-weight: bold;
  }
  section {
    display: flex;
    flex-direction: column;
  }
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
  opacity: 1;
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
  background-color: rgba(0, 0, 0, 0.5);
  opacity: 0;
  transition: opacity 0.3s ease;
  cursor: pointer;
}
</style>
