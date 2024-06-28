<template>
  <li
    class="wine__category-ul-item"
    :class="{ active: isActive }"
    :data-aos="windowWidth > 1024 ? 'zoom-in' : ''"
    @click="handleClick"
  >
    <router-link :to="item.link" class="wine__link">
      <div class="wine__link-img">
        <img :src="item.imgSrc" :alt="item.altText" />
      </div>
      <span class="wine__link-text">{{ item.id }}</span>
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
.wine__category-ul-item {
  .wine__link {
    position: relative;
    display: block;
    text-decoration: none;
    width: 100%;
    height: 200px;

    &::before {
      content: '';
      display: block;
      width: 100%;
      height: 100%;
      // padding-bottom: 70%;
    }

    &-text {
      position: absolute;
      font-size: $fontSize_h3;
      letter-spacing: $letterspacing;
      font-family: $fontfamily-en;
      color: $ramos-gin-fizz;
      z-index: 2;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    &-img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      img {
        width: 100%;
        height: 100%;
        display: block;
        @include border-radius(8px);
        object-fit: cover;
        transition: all 0.5s ease;
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
</style>
