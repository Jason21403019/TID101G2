<template>
  <div class="wine__article">
    <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><router-link to="/wine_column">酒品專欄</router-link></li>
        <li class="breadcrumb-item" aria-current="page"><router-link to="/wine_column_wk">酒類知識</router-link></li>
        <li class="breadcrumb-item active" aria-current="page"><router-link to="">威士忌釀造的藝術</router-link></li>
      </ol>
    </nav>
    <div class="wine__article-banner">
      <img :src="article.picture" alt="banner" />
    </div>
    <div class="ap">
      <div class="wine__article-author">
        <p>
          {{ article.publisher }}
        </p>
      </div>
      <div class="wine__article-publish-time">
        <p>
          {{ article.publish_date }}
        </p>
      </div>
    </div>
    <div class="wine__article-textarea">
      <p>
        {{ article.content }}
      </p>
    </div>
    <h3 class="wine__article-related">更多相關文章</h3>
    <div class="article-grid">
      <div v-for="article_item in articles" :key="article_item.id" class="article-card">
        <img :src="article_item.image" alt="article image" />
        <div class="article-content">
          <h3>{{ article_item.title }}</h3>
        </div>
        <ReadMoreButton :article_id="article_item.id" class="article-card__button rm-button" />
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import ReadMoreButton from '@/components/WineColumnBtn.vue'
// import img1 from '../imgs/wineColumnImg/105d2bb9d92254d478410275acb1e78f5394907e.jpg'
// import img2 from '../imgs/wineColumnImg/4fd6ad2b388e62b71d7fdf74902d4a5095c1e46d.jpg'
import img4 from '../imgs/wineColumnImg/dl.beatsnoop.com-final-M9bsqoHSIh.jpg'
import img5 from '../imgs/wineColumnImg/glass-mojito-delicious-fresh-summer-cocktail-space-text.jpg'
import img6 from '../imgs/wineColumnImg/cocktail-decorated-with-slice-lime.jpg'

export default {
  name: 'WineArticle',
  components: {
    ReadMoreButton
  },

  data() {
    return {
      article: [],
      articles: [
        { id: 1, title: '威士忌釀造的藝術', image: img4 },
        { id: 2, title: '蘭姆酒的奇幻旅程', image: img5 },
        { id: 3, title: '龍舌蘭的酒吧神話', image: img6 }
      ]
    }
  },
  mounted() {
    let id = 1
    if (this.$route && this.$route.params && this.$route.params.id) {
      id = this.$route.params.id
    }
    this.articleFetch(id)
  },
  methods: {
    articleFetch(id) {
      axios
        .get(`${import.meta.env.VITE_PHP_PATH}ArticleSearch.php?id=${id}`)
        .then((res) => {
          this.article = res.data[0]
          console.log(res.data)
          console.log(this.article)
        })
        .catch((err) => {
          console.log(err)
        })
    }
  }
}
</script>

<style lang="scss" scoped>
.wine__article {
  width: 100%;
  padding-top: 130px;
  background: $negroni;
  nav {
    width: 80%;
    //   border: 1px solid red;
    margin: 0 auto;
    padding: 1rem 0;
    @include breakpoint(430px) {
      width: 95%;
    }
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
  &-banner {
    width: 80%;
    margin: 0 auto;
    @include breakpoint(430px) {
      width: 95%;
    }
    img {
      width: 100%;
      display: block;
      @include border-radius(8px);
    }
  }
  .ap {
    width: 80%;
    margin: 0 auto;
    margin-top: 1.5rem;
    margin-bottom: 1.5rem;
    position: relative;
    border: 1px solid transparent;
    @include breakpoint(430px) {
      width: 95%;
    }
    p {
      font-family: $fontfamily;
      font-size: $fontSize_h5;
      letter-spacing: $letterspacing;
      color: $ramos-gin-fizz;
    }
  }
  &-author {
    width: 100%;
    margin: 0 auto;
    position: absolute;
    @include breakpoint(430px) {
      width: 95%;
    }
    p {
      font-family: $fontfamily;
      font-size: $fontSize_h5;
      letter-spacing: $letterspacing;
      color: $ramos-gin-fizz;
    }
  }
  &-publish-time {
    // border: 1px solid red;
    position: absolute;
    width: 100%;
    margin: 0 auto;
    display: flex;
    justify-content: flex-end;
    @include breakpoint(430px) {
      width: 95%;
    }
    p {
      font-family: $fontfamily;
      font-size: $fontSize_h5;
      letter-spacing: $letterspacing;
      color: $ramos-gin-fizz;
    }
  }
  &-textarea {
    width: 80%;
    margin: 0 auto;
    padding: 30px 0;
    @include breakpoint(430px) {
      width: 95%;
    }
    p {
      font-family: $fontfamily;
      font-size: $fontSize_h5;
      line-height: 2rem;
      letter-spacing: $letterspacing;
      color: $ramos-gin-fizz;
      text-indent: 3.5rem;
    }
  }
  &-related {
    width: 80%;
    margin: 0 auto;
    text-align: center;
    padding-top: 5rem;
    font-size: $fontSize_h3;
    font-weight: bold;
    letter-spacing: $letterspacing;
    color: $ramos-gin-fizz;
    font-family: $fontfamily;
    @include breakpoint(430px) {
      width: 95%;
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
    @include breakpoint(430px) {
      width: 95%;
    }
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
    &::before {
      content: '';
      position: absolute;
      width: 100%;
      height: 400px;
      background: rgba(0, 0, 0, 0.5);
      z-index: 1;
    }
    .article-card__button {
      position: absolute;
      bottom: 20px;
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
}
</style>
