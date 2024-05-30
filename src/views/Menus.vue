<template>
  <div id="app" class="warper">
    <div class="menu">
      <menu-item v-for="item in menuItems" :key="item.title" :title="item.title" :img-path="item.imgPath" />
    </div>
  </div>
</template>

<script>
export default {
  name: 'Menus',
  components: {
    // MenuItem: () => import('../components/MenuItem.vue')
  },
  data() {
    return {
      menuItems: [
        {
          title: 'Appetizer 開胃菜',
          imgPath: 'imgs/menuImg/food_menu_1-01.jpg'
        },
        {
          title: 'Drink Snacks 喝酒菜',
          imgPath: '../imgs/menuImg/food_menu_1-02.jpg'
        },
        {
          title: "Chef's Special 主廚特選",
          imgPath: ''
        },
        {
          title: 'Captivate Intoxicat 紙醉金迷',
          imgPath: ''
        }
      ]
    }
  }
}
</script>

<style lang="scss" scoped="scoped">
.warper {
  display: flex;
  flex-direction: column;
  align-items: center;
  background: $negroni;

  .menu {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }
}
</style>
