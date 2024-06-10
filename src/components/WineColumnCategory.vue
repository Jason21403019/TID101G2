<template>
  <li
    class="wine__category-ul-item"
    :class="{ active: isActive }"
    :data-aos="windowWidth > 430 ? 'zoom-in' : ''"
    @click="handleClick"
  >
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
    },
    isActive: {
      type: Boolean,
      default: false
    }
  },
  emits: ['item-clicked'],
  data() {
    return {
      windowWidth: window.innerWidth
    }
  },
  mounted() {
    window.addEventListener('resize', this.updateWindowWidth)
  },
  beforeUnmount() {
    window.removeEventListener('resize', this.updateWindowWidth)
  },
  methods: {
    handleClick() {
      this.$emit('item-clicked', this.item.link)
    },
    updateWindowWidth() {
      this.windowWidth = window.innerWidth
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
    // border: 1px solid red;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    width: 340px;
    height: 230px;
    @include breakpoint(1280px) {
      width: 300px;
      height: 200px;
    }
    @include breakpoint(960px) {
      width: 250px;
      height: 200px;
    }
    @include breakpoint(820px) {
      width: 780px;
      &:nth-child(1) {
        margin: 1rem;
      }
    }
    @include breakpoint(430px) {
      width: 350px;
      &:nth-child(1) {
        margin: 1rem;
      }
    }
    @include breakpoint(375px) {
      width: 300px;
      &:nth-child(1) {
        margin: 1rem;
      }
    }
    &-text {
      position: absolute;
      font-size: $fontSize_h3;
      letter-spacing: $letterspacing;
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
.wine__category-ul-item.active {
  background-color: #ffcc00 !important;
}
//   }
// }
</style>
