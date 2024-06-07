<template>
  <li class="wine__category-ul-item" data-aos="zoom-in">
    <router-link :to="item.link" class="wine__link">
      <div class="wine__link-img">
        <img :src="item.imgSrc" :alt="item.altText" />
      </div>
      <span class="wine__link-text">{{ item.text }}</span>
    </router-link>
  </li>
</template>

<script>
export default {
  name: 'WineColumnCategory',
  props: {
    item: {
      type: Object,
      required: true
    }
  }
}
</script>

<style lang="scss" scoped>
// .wine__category {
//   width: 100%;
//   // border: 1px solid red;
//   &-ul {
//     @include border-radius(8px);
//     display: flex;
//     justify-content: space-evenly;
//     //   border: 1px solid red;
//     background: $ramos-gin-fizz;
//     padding: 2rem 0;
//     overflow-x: scroll;
.wine__category-ul-item {
  // border: 1px solid blue;
  .wine__link {
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    width: 340px;
    height: 230px;
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
//   }
// }
</style>
