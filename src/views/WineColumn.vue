<template>
  <body class="winecolumn">
    <div class="winecolumn__wrapper">
      <WineColumnTitle :title-cn="title_cn" :title-en="title_en" />
      <section class="wine__category">
        <ul class="wine__category-ul">
          <WineColumnCategory v-for="(item, index) in wineCategories" :key="index" :item="item" />
        </ul>
      </section>
      <div class="dropdown" @click="toggleDropdown">
        <button id="dropdownMenuButton" class="btn btn-secondary dropdown-toggle" type="button" aria-expanded="false">
          {{ selectedOption }}
        </button>
        <ul class="dropdown-menu" :class="{ show: isOpen }" aria-labelledby="dropdownMenuButton">
          <li @click.stop="selectOption('最新文章', $event)"><a class="dropdown-item" href="">最新文章</a></li>
          <li @click.stop="selectOption('熱門文章', $event)"><a class="dropdown-item" href="">熱門文章</a></li>
          <li @click.stop="selectOption('本日熱門', $event)"><a class="dropdown-item" href="">本日熱門</a></li>
        </ul>
      </div>
      <WineColumnMasonry />
    </div>
  </body>
</template>

<script>
import AOS from 'aos'
import WineColumnCategory from '@/components/WineColumnCategory.vue'
import WineColumnMasonry from '@/components/WineColumnMasonry.vue'
import WineColumnTitle from '@/components/WineColumnTitle.vue'
import bottleWine from '@/imgs/wineColumnImg/bottle-with-champagne-glasses-tray.jpg'
import cotailWorld from '@/imgs/wineColumnImg/spicy-michelada-drink-assortment-table.jpg'
import newsReport from '@/imgs/wineColumnImg/businessman-reading-daily-news.jpg'
import 'aos/dist/aos.css'

export default {
  name: 'WineColumn',
  components: { WineColumnMasonry, WineColumnTitle, WineColumnCategory },
  beforeRouteEnter(to, from, next) {
    next((vm) => {
      // 在路由變更後刷新 AOS
      vm.$nextTick(() => {
        AOS.refreshHard() // 使用 refreshHard 確保 AOS 完全重新計算
      })
    })
  },
  data() {
    return {
      title_cn: '酒品專欄',
      title_en: 'Wine Column',
      isOpen: false,
      selectedOption: '最新文章',
      wineCategories: [
        {
          link: '/',
          imgSrc: bottleWine,
          altText: '',
          text: '酒品知識'
        },
        {
          link: '/',
          imgSrc: newsReport,
          altText: '',
          text: '國外報導'
        },
        {
          link: '/',
          imgSrc: cotailWorld,
          altText: '',
          text: '調酒新世界'
        }
      ]
    }
  },
  mounted() {
    setTimeout(() => {
      AOS.init({
        offset: 200,
        duration: 600,
        easing: 'ease-in-sine',
        delay: 100
      })
    }, 100)
  },
  updated() {
    AOS.refresh()
  },

  methods: {
    selectOption(option, event) {
      this.selectedOption = option
      this.isOpen = false
      event.preventDefault()
    },
    toggleDropdown() {
      this.isOpen = !this.isOpen
    }
  }
}
</script>

<style lang="scss" scoped>
.winecolumn {
  width: 100%;
  background: $negroni;
}
.winecolumn__wrapper {
  padding-top: 100px;
  width: 80%;
  margin: 0 auto;
  .wine__category {
    width: 100%;
    // border: 1px solid red;
    &-ul {
      @include border-radius(8px);
      display: flex;
      justify-content: space-evenly;
      //   border: 1px solid red;
      background: $ramos-gin-fizz;
      padding: 2rem 0;
      overflow-x: scroll;
    }
  }
  .dropdown {
    width: 100%;
    margin: 3rem 0 0.5rem 0;
    display: flex;
    justify-content: end;
    position: relative;
    .btn {
      background: $ramos-gin-fizz;
      color: $campari;
    }
    .dropdown-menu {
      min-width: 128px;
      position: absolute;
      top: 100%;
      right: 0;
      background: $ramos-gin-fizz;
      li {
        padding: 0.2rem 0.2rem;
        .dropdown-item {
          display: block;
          padding: 0.55rem 0;
          @include border-radius(8px);
          padding-left: 0.55rem;

          &:hover {
            background: $negroni;
            color: $ramos-gin-fizz;
          }
        }
      }
    }
  }
}
</style>
