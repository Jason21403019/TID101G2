<template>
  <div class="wine__article">
    <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><router-link to="/wine_column">酒品專欄</router-link></li>
        <li class="breadcrumb-item" aria-current="page"><router-link to="wine_column_wk">酒類知識</router-link></li>
        <li class="breadcrumb-item active" aria-current="page"><router-link to="">威士忌釀造的藝術</router-link></li>
      </ol>
    </nav>
    <div class="wine__article-banner">
      <img :src="article.src1" alt="banner" />
    </div>
    <div class="wine__article-textarea">
      <p>
        {{ article.p1 }}
      </p>
      <p>
        {{ article.p2 }}
      </p>
    </div>
    <div class="wine__article-banner">
      <img :src="article.src2" alt="banner" />
    </div>

    <div class="wine__article-textarea">
      <p>
        {{ article.p3 }}
      </p>
      <p>
        {{ article.p4 }}
      </p>
    </div>
    <h3 class="wine__article-related">更多相關文章</h3>
    <div class="article-grid">
      <div v-for="article in articles" :key="article.id" class="article-card">
        <img :src="article.image" alt="article image" />
        <div class="article-content">
          <h3>{{ article.title }}</h3>
        </div>
        <ReadMoreButton />
      </div>
    </div>
  </div>
</template>

<script>
import ReadMoreButton from '@/components/WineColumnBtn.vue'
import img1 from '../imgs/wineColumnImg/105d2bb9d92254d478410275acb1e78f5394907e.jpg'
import img2 from '../imgs/wineColumnImg/4fd6ad2b388e62b71d7fdf74902d4a5095c1e46d.jpg'
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
      article: {
        src1: img1,
        src2: img2,
        p1: '2020年初，一場突如其來的疫情，讓全世界陷入前所未有的變化，病毒阻絕了人與人之間的實體來往，也嚴重打擊了日本酒產業，愛媛縣政府面對這樣的困境，與東京農業大學、愛媛縣產業技術研究中心、愛媛縣酒造組合、伊台貿股份有限公司（台灣）等產官學通各界，投入近千萬日幣研發預算，由愛媛縣境內22家酒造共同進行實驗釀造，打造出由愛媛縣特有品種「翠雀花(Sakurahime)」所分離出之花酵母釀製之EhimeSakurahime系列，作為面對疫情後再次出發的強勢商品。',
        p2: '愛媛縣酒造組合理事長越智浩(石鎚酒造)表示：「愛媛縣雖曾於90年代發展出愛媛(EK)酵母，但那畢竟是從熊本K901培育過來的變異株，簡單來說愛媛縣至此並無自己本地的「原生酵母」」。畢業於日本釀造最高學府−東京農業大學釀造學系的越智浩進一步表示：「石鎚酒造曾在2019年接受東農大委託，與來自日本其他六間酒造共同以美智子玫瑰花酵母釀造花酵母日本酒，此次與東農大再度合作，成功從愛媛縣的特有原生花種「翠雀花/さくらひめ/桜姫」(Sakura-hime)中，分離出愛媛縣特有的原生酵母。（按:翠雀花原為深藍色的花種，在1970年代在愛媛縣產業技術中心的培育進行突變後產生了特有的粉櫻色品種，因顏色與形狀酷似櫻花，故以櫻花與愛媛的媛合名為Sakura-hime）',
        p3: `擔任愛媛縣酒造組合市場開發委員長的近藤嘉郎(近藤酒造/華姬櫻)指出：「此次Sakurahim花酵母系列，總共分為Type1 Tropical、Type 2 Clear、Type 3 Well Balance、Type 4 Rich等四種特性完全不同的酵母種類(TYPE)釀造，由縣內22家酒造分別選擇自己拿手的酵母後，釀造出22款在香氣與口感上完全不同的酒款呈現給消費者。日本國內預計於2023年3月30日由愛媛縣中村時廣知事進行首次發表，並於4月14日於台北國際酒展作為海外首次發表場地。」`,
        p4: `身為愛媛縣酒造組合海外最大代理商的伊台貿股份有限公司董事長管怡宣表示：「台灣這幾年已成為愛媛縣日本酒出口第一大國，選擇台灣作為海外首場發表場地，更可顯現出愛媛縣全體酒造對台灣市場的高度重視。此次將由四組花酵母的領銜酒造（石鎚酒造、梅錦山川酒造、近藤酒造以及八木酒造/山丹正宗）社長親自來台，除將於展期首日(4月14日)，由四家酒造社長於品酒教室中講解各組花酵母的特性與提供試飲講解外，展期期間也將於酒展展間舞台區舉行各式活動並且提供限量紀念品，也藉此機會讓消費者能夠更近距離與酒造社長進行互動。`
      },
      articles: [
        { id: 1, title: '威士忌釀造的藝術', image: img4 },
        { id: 2, title: '蘭姆酒的奇幻旅程', image: img5 },
        { id: 3, title: '龍舌蘭的酒吧神話', image: img6 }
      ]
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
    img {
      width: 100%;
      display: block;
      @include border-radius(8px);
    }
  }
  &-textarea {
    width: 80%;
    margin: 0 auto;
    padding: 30px 0;
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
    &::before {
      content: '';
      position: absolute;
      width: 100%;
      height: 400px;
      background: rgba(0, 0, 0, 0.5);
      z-index: 1;
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
