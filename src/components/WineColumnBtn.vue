<template>
  <router-link to="/wine_article" class="read-more-button-link" :style="customStyle">
    <button class="read-more-button">
      <span class="text">Read More</span>
    </button>
  </router-link>
</template>

<script>
export default {
  name: 'ReadMoreButton',
  props: {
    customStyle: {
      type: Object,
      required: true
    }
  },
  created() {
    // console.log('customStyle:', this.customStyle)
  },
  methods: {
    handleClick() {
      // console.log('Read More button clicked')
    }
  }
}
</script>

<style lang="scss" scoped>
.read-more-button-link {
  text-decoration: none;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  position: absolute;
  z-index: 2;
}

.read-more-button {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 1rem 2.5rem;
  background: $ramos-gin-fizz;
  color: $negroni;
  font-size: $fontSize_h5;
  border: none;
  @include border-radius(8px);
  cursor: pointer;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  overflow: hidden;
  white-space: nowrap;
  transition: all 0.6s cubic-bezier(0.85, 0.05, 0.25, 1);
  width: 50px;
  opacity: 0;
  z-index: 2;

  .text {
    opacity: 0;
    transition: all 0.5s cubic-bezier(0.8, 0.03, 0.25, 1);
  }
}
.article-card:hover .read-more-button,
.winecolumn__masonry-item1-lf-tp:hover .read-more-button,
.winecolumn__masonry-item1-lf-bt:hover .read-more-button,
.winecolumn__masonry-item1-rg-tp-l:hover .read-more-button,
.winecolumn__masonry-item1-rg-tp-r:hover .read-more-button,
.winecolumn__masonry-item1-rg-bt:hover .read-more-button,
.winecolumn__masonry-item2:hover .read-more-button {
  font-family: $fontfamily-en;
  width: 150px;
  opacity: 1;

  .text {
    font-family: $fontfamily-en;
    opacity: 1;
    transition-delay: 0.2s;
  }
}
@include breakpoint(768px) {
  .read-more-button-link {
    position: absolute;
    top: 170px;
    left: 85px;
  }
  .read-more-button {
    position: absolute;
    border: 1px solid #fcf0d8;
    opacity: 1;
    position: absolute;
    // top: 170px;
    // left: 85px;
    transition: none;
    width: 150px;
    background: none;
    padding: 0.5rem 0.75rem;
    color: #fcf0d8;
    .text {
      font-family: $fontfamily-en;
      opacity: 1;
    }
  }
}
</style>
