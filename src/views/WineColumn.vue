<template>
  <body class="winecolumn">
    <div class="winecolumn__wrapper">
      <WineColumnTitle :title-cn="title_cn" :title-en="title_en" />
      <section class="wine__category">
        <ul class="wine__category-ul">
          <WineColumnCategory
            v-for="(item, index) in wineCategories"
            :key="index"
            :item="item"
            @item-clicked="handleItemClicked"
          />
        </ul>
      </section>
      <section class="news_title">
        <h3>最新文章</h3>
      </section>

      <WineColumnMasonry />
    </div>
  </body>
</template>

<script>
import AOS from 'aos'
import WineColumnCategory from '../components/WineColumnCategory.vue'
import WineColumnMasonry from '../components/WineColumnMasonry.vue'
import WineColumnTitle from '../components/WineColumnTitle.vue'
import bottleWine from '../imgs/wineColumnImg/bottle-with-champagne-glasses-tray.jpg'
import cotailWorld from '../imgs/wineColumnImg/spicy-michelada-drink-assortment-table.jpg'
import newsReport from '../imgs/wineColumnImg/businessman-reading-daily-news.jpg'
import 'aos/dist/aos.css'

export default {
  name: 'WineColumn',
  components: { WineColumnMasonry, WineColumnTitle, WineColumnCategory },
  beforeRouteEnter(to, from, next) {
    next((vm) => {
      vm.$nextTick(() => {
        AOS.refreshHard()
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
          link: '/wine_column_wk',
          imgSrc: bottleWine,
          altText: '',
          text: '酒類知識'
        },
        {
          link: '/wine_column_news',
          imgSrc: newsReport,
          altText: '',
          text: '國外報導'
        },
        {
          link: '/wine_column_nc',
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
    handleItemClicked(link) {
      console.log('Item clicked with link:', link)
      this.activeLink = link
      this.$router.push(link)
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
  @include breakpoint(1280px) {
    width: 85%;
  }
  @include breakpoint(1130px) {
    width: 95%;
  }
  @include breakpoint(1000px) {
    width: 98%;
  }
  @include breakpoint(430px) {
    width: 90%;
  }
  .wine__category {
    width: 100%;
    // border: 1px solid red;
    &-ul {
      @include border-radius(8px);
      background: $ramos-gin-fizz;
      padding: 2rem;
      gap: 1rem;
      display: grid;
      grid-template-rows: auto;
      grid-template-columns: 1fr 1fr 1fr;

      @include breakpoint(820px) {
        grid-template-columns: 1fr;
      }
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
      letter-spacing: $letterspacing;
    }
    .dropdown-menu {
      min-width: 159px;
      position: absolute;
      top: 100%;
      right: 0;
      background: $ramos-gin-fizz;
      letter-spacing: $letterspacing;
      li {
        padding: 0.2rem 0.2rem;
        .dropdown-item {
          display: block;
          padding: 0.55rem 0;
          @include border-radius(8px);
          padding-left: 0.55rem;
          letter-spacing: $letterspacing;
          &:hover {
            background: $negroni;
            color: $ramos-gin-fizz;
          }
        }
      }
    }
  }
}
.news_title {
  width: 80%;
  margin: 0 auto;
  padding: 100px 0 50px 0;
  @include breakpoint(430px) {
    width: 90%;
  }
  h3 {
    font-family: $fontfamily;
    font-size: $fontSize_h3;
    letter-spacing: $letterspacing;
    color: $ramos-gin-fizz;
    text-align: center;
  }
}
</style>
