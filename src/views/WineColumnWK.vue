<template>
  <body class="winecolumnwk">
    <div class="wk__wrapper">
      <WineColumnTitle :title-cn="title_cn" :title-en="title_en" />
    </div>
    <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><router-link to="/wine_column">酒品專欄</router-link></li>
        <li class="breadcrumb-item active" aria-current="page"><router-link to="">酒類知識</router-link></li>
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
      <div v-for="(article, index) in articles" :key="article.id" class="article-card">
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
import img1 from '../imgs/wineColumnImg/dl.beatsnoop.com-final-M9bsqoHSIh.jpg'
import img2 from '../imgs/wineColumnImg/glass-mojito-delicious-fresh-summer-cocktail-space-text.jpg'
import img3 from '../imgs/wineColumnImg/cocktail-decorated-with-slice-lime.jpg'
import img4 from '../imgs/wineColumnImg/wine.jpg'
import img5 from '../imgs/wineColumnImg/vodka.jpg'
import img6 from '../imgs/wineColumnImg/wine2.jpg'
import img7 from '../imgs/wineColumnImg/wine-glasses-set-table-part-inviting-dinner-setting.jpg'
import img8 from '../imgs/wineColumnImg/whiskey-making.jpg'
import img9 from '../imgs/wineColumnImg/illuminated-train-night.jpg'
import newsReport from '@/imgs/wineColumnImg/businessman-reading-daily-news.jpg'

export default {
  name: 'WineColumnWK',

  components: {
    WineColumnTitle,
    WineColumnCategory,
    ReadMoreButton
  },
  data() {
    return {
      title_cn: '酒類知識',
      title_en: 'Wine Knowledge',
      wineCategories: [
        {
          id: '',
          link: '/wine_column_news',
          imgSrc: bottleWine,
          altText: ''
        },
        {
          id: '',
          imgSrc: newsReport,
          link: '/wine_column_nc',
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
        { id: 1, title: '威士忌釀造的藝術', image: img1 },
        { id: 2, title: '蘭姆酒的奇幻旅程', image: img2 },
        { id: 3, title: '龍舌蘭的酒吧神話', image: img3 },
        { id: 4, title: '葡萄酒的氣候效應', image: img4 },
        { id: 5, title: '威士忌的風味圖譜', image: img5 },
        { id: 6, title: '葡萄酒鑑賞技巧', image: img6 },
        { id: 7, title: '威士忌的歷史沿革', image: img7 },
        { id: 8, title: '享受葡萄酒的樂趣', image: img8 },
        { id: 9, title: '葡萄酒的夢想', image: img9 }
      ],
      page: 1,
      pageSize: 9,
      loading: false,
      noMoreArticles: false
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
}
.wk__wrapper {
  margin: 0 auto;
  width: 80%;
  //   border: 1px solid red;
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
  // border: 1px solid red;
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
}
.breadcrumb-item + .breadcrumb-item::before {
  content: '>';
  color: $ramos-gin-fizz;
  padding: 0 5px;
}
.breadcrumb {
  .breadcrumb-item {
    font-size: $fontSize_h4;
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
    overflow-x: scroll;
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
  @include breakpoint(430px) {
    width: 95%;
    height: 300px;
  }
  @include breakpoint(390px) {
    width: 85%;
    height: 290px;
  }
  &::before {
    content: '';
    position: absolute;
    width: 100%;
    height: 400px;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1;
    @include breakpoint(430px) {
      width: 100%;
      height: 300px;
    }
    @include breakpoint(390px) {
      width: 100%;
      height: 290px;
    }
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
.rm-button {
  position: absolute;
  top: 50%;
  height: 50px;
  @include breakpoint(768px) {
    position: absolute;
    top: 85%;
  }
}
</style>
