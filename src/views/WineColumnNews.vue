<template>
  <body class="winecolumnwk">
    <div class="news__wrapper">
      <WineColumnTitle :title-cn="title_cn" :title-en="title_en" />
    </div>
    <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><router-link to="/wine_column">酒品專欄</router-link></li>
        <li class="breadcrumb-item active" aria-current="page"><router-link to="">國外報導</router-link></li>
      </ol>
    </nav>
    <section class="wine__category">
      <ul class="wine__category-ul">
        <WineColumnCategory
          v-for="(item, index) in wineCategories"
          :key="index"
          :item="item"
          :is-active="isActive(item.link)"
        />
      </ul>
    </section>
    <div class="article-grid">
      <div v-for="article in articles" :key="article.id" class="article-card">
        <img :src="article.image" alt="article image" />
        <div class="article-content">
          <h3>{{ article.title }}</h3>
        </div>
        <ReadMoreButton class="rm-button" />
      </div>
    </div>
    <div class="more_btn">
      <button>MORE</button>
    </div>
  </body>
</template>

<script>
import axios from 'axios'
import ReadMoreButton from '@/components/WineColumnBtn.vue'
import WineColumnCategory from '@/components/WineColumnCategory.vue'
import WineColumnTitle from '@/components/WineColumnTitle.vue'
import bottleWine from '@/imgs/wineColumnImg/bottle-with-champagne-glasses-tray.jpg'
import cotailWorld from '@/imgs/wineColumnImg/spicy-michelada-drink-assortment-table.jpg'
import img1 from '../imgs/wineColumnImg/vertical-shot-person-holding-glass-wine-vineyard-sunlight.jpg'
import img2 from '../imgs/wineColumnImg/glass-red-wine-bottle-bar-counter.jpg'
import img3 from '../imgs/wineColumnImg/waiter-offers-visitors-wine.jpg'
import img4 from '../imgs/wineColumnImg/organic-vineyard-chianti-region-ripe-grapes-generated-by-ai.jpg'
import img5 from '../imgs/wineColumnImg/three-different-beautiful-cocktails-warm-colors-flower-background-cocktail.jpg'
import img6 from '../imgs/wineColumnImg/vineyard-landscape-with-nature-grapevines.jpg'
import img7 from '../imgs/wineColumnImg/aerial-shot-hungarian-parliament-building-budapest-hungary-cloudy-sky.jpg'
import img8 from '../imgs/wineColumnImg/people-cling-with-different-cocktail-glasses.jpg'
import img9 from '../imgs/wineColumnImg/set-alcoholic-beverages-studio-shot.jpg'
import newsReport from '@/imgs/wineColumnImg/businessman-reading-daily-news.jpg'

export default {
  name: 'WineColumnNews',

  components: {
    WineColumnTitle,
    WineColumnCategory,
    ReadMoreButton
  },
  data() {
    return {
      title_cn: '國外報導',
      title_en: 'News Report',
      wineCategories: [
        {
          id: '',
          link: '/wine_column_news',
          imgSrc: bottleWine,
          altText: ''
        },
        {
          id: '',
          link: '/wine_column_nc',
          imgSrc: newsReport,
          altText: ''
        },
        {
          id: '',
          link: '/wine_column_wk',
          imgSrc: cotailWorld,
          altText: ''
        }
      ],
      articles: [
        { id: 1, title: '探索全球稀有葡萄酒與烈酒', image: img1 },
        { id: 2, title: '夏日十大推薦雞尾酒', image: img2 },
        { id: 3, title: '精釀啤酒的藝術', image: img3 },
        { id: 4, title: '美食與葡萄酒搭配指南', image: img4 },
        { id: 5, title: '亞洲異國烈酒探索', image: img5 },
        { id: 6, title: '威士忌品鑑指南', image: img6 },
        { id: 7, title: '經典雞尾酒製作秘訣', image: img7 },
        { id: 8, title: '葡萄酒收藏入門', image: img8 },
        { id: 9, title: '全球知名酒莊巡禮', image: img9 }
      ]
    }
  },
  mounted() {
    this.fetchCategories()
  },
  methods: {
    isActive(link) {
      if (link === '/') return false

      return link === this.$route.path
    },
    fetchCategories() {
      axios
        .get(`${import.meta.env.VITE_PHP_PATH}adminarticle_class.php`)
        .then((response) => {
          console.log('Response:', response.data)
          this.categories = response.data
          this.mergeCategories(response.data) // 調用合併方法
        })
        .catch((error) => {
          console.error('There was an error fetching the categories: ', error)
        })
    },
    mergeCategories(fetchedCategories) {
      fetchedCategories.forEach((category, index) => {
        if (this.wineCategories[index]) {
          // 確保不超出現有的索引範圍
          this.wineCategories[index].id = category.id
          this.wineCategories[index].text = category.note
        }
      })
    }
  }
}
</script>

<style lang="scss" scoped>
.winecolumnwk {
  width: 100%;
  padding-top: 100px;
  padding-bottom: 100px;
  background: $negroni;

  // border: 1px solid red;
}

.news__wrapper {
  margin: 0 auto;
  width: 80%;
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
}
nav {
  width: 80%;
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
  //   border: 1px solid red;
  margin: 0 auto;
  padding: 1rem 0;
}
.breadcrumb-item + .breadcrumb-item::before {
  content: '>';
  color: $ramos-gin-fizz;
  padding: 0 5px;
}
.breadcrumb {
  .breadcrumb-item {
    font-size: $fontSize_h5;
    font-family: $fontfamily;
    a {
      color: $irishcoffee;
      &:hover {
        color: $ramos-gin-fizz;
      }
    }
    .active {
      font-size: $fontSize_h5;
      text-decoration: none;
    }
  }
}
.wine__category {
  width: 80%;
  margin: 0 auto;
  padding: 1rem 0;
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
.article-grid {
  width: 80%;
  margin: 0 auto;
  display: grid;
  padding: 2.5rem 0;
  grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
  gap: 35px;
  place-items: stretch;
}

.article-card {
  width: 100%;
  height: 400px;
  background: #fff;
  border-radius: 8px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  position: relative;
  z-index: 10;
  &::before {
    content: '';
    position: absolute;
    width: 100%;
    height: 400px;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1;
  }
  &:hover .read-more-button {
    position: absolute;
    z-index: 100;
    opacity: 1;
  }

  &:hover .read-more-button .text {
    opacity: 1;
    transition-delay: 0.2s;
  }
}

.article-card img {
  width: 100%;
  height: 400px;
  object-fit: cover;
}

.article-content {
  position: absolute;
  z-index: 10;
  padding: 1rem;
  font-size: $fontSize_h4;
  color: $ramos-gin-fizz;
  letter-spacing: $letterspacing;
  font-family: $fontfamily;
}
.more_btn {
  width: 80%;
  margin: 0 auto;
  font-size: $fontSize_h3;
  font-family: $fontfamily-en;
  color: $campari;
  display: flex;
  justify-content: center;
  align-items: center;
  button {
    padding: 0.75rem 1.75rem;
    border: none;
    outline: none;
    background-color: $ramos-gin-fizz;
    @include border-radius(8px);
    &:hover {
      background: $negroni;
      color: $ramos-gin-fizz;
    }
  }
}
</style>
