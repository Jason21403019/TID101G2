<template>
  <section class="winecolumn__masonry">
    <div class="winecolumn__masonry-item1">
      <div class="winecolumn__masonry-item1-lf">
        <div class="winecolumn__masonry-item1-lf-tp">
          <h3>{{ title }}</h3>
          <img
            src="@/imgs/wineColumnImg/bartender-opens-bottle-red-wine-using-wine-opener-pour-lot-empty-glasses-bar-counter-blurred-background-wine-tasting-open-beverage-bartender-dinner-concept.jpg"
            alt=""
          />
          <div class="category-name">{{ category }}</div>
          <ReadMoreButton />
        </div>
        <div class="winecolumn__masonry-item1-lf-bt">
          <img
            src="@/imgs/wineColumnImg/close-up-woman-s-hands-decorating-grapefruit-detox-healthy-smoothie-with-rosemary.jpg"
            alt=""
          />
        </div>
      </div>
      <div class="winecolumn__masonry-item1-rg">
        <div class="winecolumn__masonry-item1-rg-tp">
          <div class="winecolumn__masonry-item1-rg-tp-l">
            <img src="@/imgs/wineColumnImg/105d2bb9d92254d478410275acb1e78f5394907e.jpg" alt="" />
          </div>
          <div class="winecolumn__masonry-item1-rg-tp-r">
            <img src="@/imgs/wineColumnImg/Chateau-Latour.jpg" alt="" />
          </div>
        </div>
        <div class="winecolumn__masonry-item1-rg-bt">
          <img src="@/imgs/wineColumnImg/a824168e245aebc8e62ef40c9fbcaf589e7c1fe7.jpg" alt="" />
        </div>
      </div>
    </div>
    <div class="winecolumn__masonry-item2">
      <img src="@/imgs/wineColumnImg/fresh-cocktails-with-ice-lemon-lime-fruits-generative-ai.jpg" alt="" />
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
      category: 'jason'
    }
  }
}
</script>

<style lang="scss" scoped>
.winecolumn__masonry {
  //   border: 1px solid red;
  width: 100%;
  height: 130vh;
  display: flex;
  flex-direction: column;
  color: $ramos-gin-fizz;
  font-family: $fontfamily;
  padding-bottom: 6rem;
  &-item1 {
    display: flex;
    height: 75%;
    // border: 1px solid green;
    margin: 0.5rem 0;
    // padding-bottom: 0.5rem;
    &-lf {
      width: 35%;
      //   border: 1px solid red;
      margin-right: 0.5rem;

      &-tp {
        width: 100%;
        height: 40%;
        // border: 1px solid blue;
        margin-bottom: 0.5rem;
        position: relative;
        &::before {
          content: '';
          display: block;
          position: absolute;
          width: 100%;
          height: 100%;
          background-color: rgba($color: #000, $alpha: 0.4);
          z-index: 1;
          transition: all 0.5s ease;
        }
        &:hover::before {
          background-color: rgba($color: #000, $alpha: 0.8);
        }
        h3 {
          position: absolute;
          top: 2rem;
          left: 1rem;
          z-index: 2;
          font-size: $fontSize_h3;
        }
        img {
          width: 100%;
          height: 100%;
          @include border-radius(8px);
        }
        .category-name {
          position: absolute;
          bottom: 1rem;
          right: 1rem;
          z-index: 2;
          font-size: 1rem;
          color: white;
        }
        &:hover .read-more-button {
          opacity: 1;
        }
      }
      &-bt {
        width: 100%;
        height: 60%;
        // border: 1px solid blue;
        img {
          width: 100%;
          height: 100%;
          @include border-radius(8px);
          object-fit: cover;
        }
      }
    }
    &-rg {
      width: 65%;
      //   border: 1px solid blue;
      &-tp {
        width: 100%;
        height: 60%;
        // border: 1px solid yellow;
        display: flex;
        margin-bottom: 0.5rem;
        &-l {
          width: 100%;
          height: 100%;
          //   border: 1px solid palegoldenrod;
          margin-right: 0.5rem;
          img {
            width: 100%;
            height: 100%;
            @include border-radius(8px);
            object-fit: cover;
          }
        }
        &-r {
          width: 100%;
          height: 100%;
          //   border: 1px solid palegoldenrod;
          img {
            width: 100%;
            height: 100%;
            @include border-radius(8px);
            object-fit: cover;
          }
        }
      }
      &-bt {
        width: 100%;
        height: 40%;
        // border: 1px solid yellow;
        img {
          width: 100%;
          height: 100%;
          @include border-radius(8px);
          object-fit: cover;
        }
      }
    }
  }
  &-item2 {
    margin: 0.5rem 0;
    height: 25%;
    // border: 1px solid blue;
    img {
      width: 100%;
      height: 100%;
      @include border-radius(8px);
      object-fit: cover;
    }
  }
}
</style>
