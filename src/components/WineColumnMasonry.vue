<template>
  <section class="winecolumn__masonry">
    <!-- <div class="winecolumn__masonry">
      <div v-for="(item, key) in data" class="winecolumn__masonry-item" :key="key">
        {{ item.title }}
      </div>
    </div> -->
    <div class="winecolumn__masonry-item1 winecolumn__group-outer">
      <div class="winecolumn__masonry-item1-lf winecolumn__group-outer">
        <div class="winecolumn__masonry-item1-lf-tp winecolumn__group">
          <h3 class="winecolumn__title">{{ title }}</h3>
          <img
            class="winecolumn__img"
            src="@/imgs/wineColumnImg/bartender-opens-bottle-red-wine-using-wine-opener-pour-lot-empty-glasses-bar-counter-blurred-background-wine-tasting-open-beverage-bartender-dinner-concept.jpg"
            alt=""
          />
          <ReadMoreButton />
          <div class="category-name">{{ category }}</div>
        </div>
        <div class="winecolumn__masonry-item1-lf-bt winecolumn__group">
          <h3 class="winecolumn__title">{{ title2 }}</h3>
          <img
            class="winecolumn__img"
            src="@/imgs/wineColumnImg/close-up-woman-s-hands-decorating-grapefruit-detox-healthy-smoothie-with-rosemary.jpg"
            alt=""
          />
          <ReadMoreButton />
          <div class="category-name">{{ category2 }}</div>
        </div>
      </div>
      <div class="winecolumn__masonry-item1-rg winecolumn__group-outer">
        <div class="winecolumn__masonry-item1-rg-tp winecolumn__group-outer">
          <div class="winecolumn__masonry-item1-rg-tp-l winecolumn__group">
            <h3 class="winecolumn__title">{{ title3 }}</h3>
            <img class="winecolumn__img" src="@/imgs/wineColumnImg/105d2bb9d92254d478410275acb1e78f5394907e.jpg" alt="" />
            <ReadMoreButton />
            <div class="category-name">{{ category3 }}</div>
          </div>
          <div class="winecolumn__masonry-item1-rg-tp-r winecolumn__group">
            <h3 class="winecolumn__title">{{ title4 }}</h3>
            <img class="winecolumn__img" src="@/imgs/wineColumnImg/Chateau-Latour.jpg" alt="" />
            <ReadMoreButton />
            <div class="category-name">{{ category4 }}</div>
          </div>
        </div>
        <div class="winecolumn__masonry-item1-rg-bt winecolumn__group">
          <h3 class="winecolumn__title">{{ title5 }}</h3>
          <img class="winecolumn__img" src="@/imgs/wineColumnImg/a824168e245aebc8e62ef40c9fbcaf589e7c1fe7.jpg" alt="" />
          <ReadMoreButton />
          <div class="category-name">{{ category5 }}</div>
        </div>
      </div>
    </div>
    <div class="winecolumn__masonry-item2 winecolumn__group">
      <h3 class="winecolumn__title">{{ title6 }}</h3>
      <img
        class="winecolumn__img"
        src="@/imgs/wineColumnImg/fresh-cocktails-with-ice-lemon-lime-fruits-generative-ai.jpg"
        alt=""
      />
      <ReadMoreButton />
      <div class="category-name">{{ category6 }}</div>
    </div>
  </section>
</template>

<script>
import ReadMoreButton from '@/components/WineColumnBtn.vue'

export default {
  name: 'WineColumnMasonry',
  components: {
    ReadMoreButton
  },
  props: {
    // imgSrc: {
    //   type: String,
    //   required: true
    // },
    // category: {
    //   type: String,
    //   required: true
    // }
  },
  data() {
    return {
      title: '專業品酒師的開瓶技巧',
      //   imageSrc:
      //     '@/imgs/wineColumnImg/bartender-opens-bottle-red-wine-using-wine-opener-pour-lot-empty-glasses-bar-counter-blurred-background-wine-tasting-open-beverage-bartender-dinner-concept.jpg',
      category: '酒品知識',
      title2: '簡易草莓瑪莉調酒配方',
      category2: '調酒新世界',
      title3: '日本清酒歷史故事',
      category3: '酒品知識',
      title4: '探索葡萄酒的秘密',
      category4: '國外報導',
      title5: '在櫻花樹下品嘗清酒',
      category5: '國外報導',
      title6: '品嚐來自世界各地調酒師的最佳調酒',
      category6: '調酒新世界'
    }
  }
}
</script>

<style lang="scss" scoped>
// .winecolumn__masonry-item {
//   &:nth-child(1) {
//     font-size: 28px;
//   }

//   &:nth-child(2) {
//     font-size: 40px;
//   }
// }
.winecolumn {
  &__title {
    position: absolute;
    top: 2rem;
    left: 1rem;
    z-index: 2;
    font-size: $fontSize_h4;
    letter-spacing: $letterspacing;
  }

  &__group {
    @include breakpoint(767px) {
      margin-top: 0 !important;
      margin-bottom: 2rem !important;
      margin-right: 0 !important;
      width: 100% !important;
      height: 200px !important;

      &-outer {
        margin-bottom: 0 !important;
        height: auto !important;
        display: block !important;
        padding: 0 !important;
        margin: 0 !important;
      }
    }
  }
}

.category-name {
  position: absolute;
  bottom: 1rem;
  right: 1rem;
  z-index: 2;
  font-size: $fontSize_h5;
  letter-spacing: $letterspacing;
  color: white;
}
.winecolumn__masonry {
  //   border: 1px solid red;
  width: 100%;
  height: 1000px;
  display: flex;
  flex-direction: column;
  color: $ramos-gin-fizz;
  font-family: $fontfamily;
  padding-bottom: 6rem;

  @include breakpoint(767px) {
    display: block;
    height: auto;
    padding-bottom: 3rem;
  }

  &-item1 {
    display: flex;
    height: 75%;
    // border: 1px solid green;
    margin: 0.5rem 0 1.5rem 0;
    padding-bottom: 2rem;

    @include breakpoint(767px) {
      flex-direction: column;
      height: auto;
    }

    &-lf,
    &-rg {
      @include breakpoint(767px) {
        width: 100%;
        margin: 0;
      }
    }

    &-lf {
      width: 35%;
      // border: 1px solid red;
      margin-right: 2rem;

      @include breakpoint(767px) {
        width: 100%;
        margin-right: 0;
      }

      &-tp {
        width: 100%;
        height: 40%;
        // border: 1px solid blue;
        margin-bottom: 2rem;

        @include breakpoint(767px) {
          height: auto;
        }

        position: relative;

        &::before {
          content: '';
          display: block;
          position: absolute;
          width: 100%;
          height: 100%;
          background-color: rgba($color: #000, $alpha: 0.4);
          z-index: 1;
          @include border-radius(8px);
          transition: all 0.3s ease;
        }

        &:hover::before {
          background-color: rgba($color: #000, $alpha: 0.8);
        }

        h3 {
          position: absolute;
          top: 2rem;
          left: 1rem;
          z-index: 2;
          font-size: $fontSize_h4;
          letter-spacing: $letterspacing;
        }

        img {
          width: 100%;
          height: 100%;
          @include border-radius(8px);
        }

        &:hover .read-more-button {
          opacity: 1;
        }
      }

      &-bt {
        width: 100%;
        height: 60%;
        // border: 1px solid blue;
        position: relative;

        @include breakpoint(767px) {
          height: auto;
        }

        &::before {
          content: '';
          display: block;
          position: absolute;
          width: 100%;
          height: 100%;
          background-color: rgba($color: #000, $alpha: 0.4);
          z-index: 1;
          @include border-radius(8px);
          transition: all 0.3s ease;
        }

        &:hover::before {
          background-color: rgba($color: #000, $alpha: 0.8);
        }

        h3 {
          position: absolute;
          top: 2rem;
          left: 1rem;
          z-index: 2;
          font-size: $fontSize_h4;
          letter-spacing: $letterspacing;
        }

        img {
          width: 100%;
          height: 100%;
          @include border-radius(8px);
          object-fit: cover;
        }

        &:hover .read-more-button {
          position: absolute;
          top: 3rem;
          right: 6rem;
          opacity: 1;
        }
      }
    }

    &-rg {
      width: 65%;

      // border: 1px solid blue;
      @include breakpoint(767px) {
        height: auto;
        width: 100%;
      }

      &-tp,
      &-bt {
        @include breakpoint(767px) {
          gap: 2rem;
          height: auto;
          flex-direction: column;
        }
      }

      &-tp {
        width: 100%;
        height: 60%;
        // border: 1px solid yellow;
        display: flex;
        margin-bottom: 2rem;

        &-l,
        &-r {
          @include breakpoint(767px) {
            gap: 1rem;
            margin-right: 0;
            height: 100%;
          }
        }

        &-l {
          width: 100%;
          height: 100%;
          //   border: 1px solid palegoldenrod;
          position: relative;
          margin-right: 2rem;

          &::before {
            content: '';
            display: block;
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: rgba($color: #000, $alpha: 0.4);
            z-index: 1;
            @include border-radius(8px);
            transition: all 0.3s ease;
          }

          &:hover::before {
            background-color: rgba($color: #000, $alpha: 0.8);
          }

          h3 {
            position: absolute;
            top: 2rem;
            left: 1rem;
            z-index: 2;
            font-size: $fontSize_h4;
            letter-spacing: $letterspacing;
          }

          img {
            width: 100%;
            height: 100%;
            @include border-radius(8px);
            object-fit: cover;
          }

          &:hover .read-more-button {
            opacity: 1;
          }
        }

        &-r {
          width: 100%;
          height: 100%;
          // border: 1px solid palegoldenrod;
          position: relative;

          @include breakpoint(767px) {
            gap: 2rem;
          }

          &::before {
            content: '';
            display: block;
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: rgba($color: #000, $alpha: 0.4);
            z-index: 1;
            @include border-radius(8px);
            transition: all 0.3s ease;
          }

          &:hover::before {
            background-color: rgba($color: #000, $alpha: 0.8);
          }

          h3 {
            position: absolute;
            top: 2rem;
            left: 1rem;
            z-index: 2;
            font-size: $fontSize_h4;
            letter-spacing: $letterspacing;
          }

          img {
            width: 100%;
            height: 100%;
            @include border-radius(8px);
            object-fit: cover;
          }

          &:hover .read-more-button {
            opacity: 1;
          }
        }
      }

      &-bt {
        width: 100%;
        height: 40%;
        // border: 1px solid yellow;
        position: relative;

        &::before {
          content: '';
          display: block;
          position: absolute;
          width: 100%;
          height: 100%;
          background-color: rgba($color: #000, $alpha: 0.4);
          z-index: 1;
          @include border-radius(8px);
          transition: all 0.3s ease;
        }

        &:hover::before {
          background-color: rgba($color: #000, $alpha: 0.8);
        }

        h3 {
          position: absolute;
          top: 2rem;
          left: 1rem;
          z-index: 2;
          font-size: $fontSize_h4;
          letter-spacing: $letterspacing;
        }

        img {
          width: 100%;
          height: 100%;
          @include border-radius(8px);
          object-fit: cover;
        }

        &:hover .read-more-button {
          opacity: 1;
        }
      }
    }
  }

  &-item2 {
    margin: 0.5rem 0;
    height: 25%;
    // border: 1px solid blue;
    position: relative;

    @include breakpoint(767px) {
      height: auto;
    }

    &::before {
      content: '';
      display: block;
      position: absolute;
      width: 100%;
      @include border-radius(8px);
      height: 100%;
      background-color: rgba($color: #000, $alpha: 0.4);
      z-index: 1;
      transition: all 0.3s ease;
    }

    &:hover::before {
      background-color: rgba($color: #000, $alpha: 0.8);
    }

    h3 {
      position: absolute;
      top: 2rem;
      left: 1rem;
      z-index: 2;
      font-size: $fontSize_h4;
      letter-spacing: $letterspacing;
    }

    img {
      width: 100%;
      height: 100%;
      @include border-radius(8px);
      object-fit: cover;
    }

    &:hover .read-more-button {
      opacity: 1;
    }
  }
}
</style>
