<template>
  <body class="winecolumn">
    <div class="winecolumn__wrapper">
      <div class="winecolumn__wrapper-title">
        <h1 class="winecolumn__wrapper-title-cn">
          {{ title_cn }}
        </h1>
        <span class="winecolumn__wrapper-title-en">
          {{ title_en }}
        </span>
      </div>
      <section class="wine__category">
        <ul class="wine__category-ul">
          <li v-for="(item, index) in wineCategories" :key="index" class="wine__category-ul-item">
            <router-link :to="item.link" class="wine__link">
              <div class="wine__link-img">
                <img :src="item.imgSrc" :alt="item.altText" />
              </div>
              <span class="wine__link-text">{{ item.text }}</span>
            </router-link>
          </li>
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
import WineColumnMasonry from '@/components/WineColumnMasonry.vue'
import bottleWine from '@/imgs/wineColumnImg/bottle-with-champagne-glasses-tray.jpg'
import cotailWorld from '@/imgs/wineColumnImg/spicy-michelada-drink-assortment-table.jpg'
import newsReport from '@/imgs/wineColumnImg/businessman-reading-daily-news.jpg'

export default {
  name: 'WineColumn',
  components: { WineColumnMasonry },
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
  width: 90%;
  margin: 0 auto;
  &-title {
    // border: 1px solid red;
    display: flex;
    align-items: center;
    color: $ramos-gin-fizz;
    margin: 2rem 0;
  }
  &-title-cn {
    font-size: $fontSize_h1;
    font-family: $fontfamily;
    font-weight: bold;
  }
  &-title-en {
    font-size: $fontSize_h3;
    font-family: $fontfamily-en;
    align-self: end;
    margin-left: 1rem;
    color: rgba($color: $ramos-gin-fizz, $alpha: 0.5);
  }
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
      &-item {
        // border: 1px solid blue;
        .wine__link {
          position: relative;
          display: flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
          text-decoration: none;
          width: 380px;
          height: 260px;
          &-text {
            position: absolute;
            font-size: $fontSize_h2;
            font-family: $fontfamily-en;
            color: $ramos-gin-fizz;
            z-index: 2;
          }
          &-img {
            width: 100%;
            height: 100%;
            img {
              width: 100%;
              height: 100%;
              @include border-radius(8px);
              object-fit: cover;
              transition: all 0.5s ease;
              position: relative;
              z-index: 0;
            }
            &::before {
              content: '';
              position: absolute;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              background: rgba($blackvevet, 0.8);
              @include border-radius(8px);
              z-index: 1;
            }
            &:hover::before {
              background: rgba($blackvevet, 0.5);
            }
          }
        }
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
