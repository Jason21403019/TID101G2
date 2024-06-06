<template>
  <router-link to="" class="read-more-button-link">
    <button class="read-more-button">
      <span class="text">Read More</span>
    </button>
  </router-link>
</template>

<script>
export default {
  name: 'ReadMoreButton',
  methods: {
    handleClick() {
      console.log('Read More button clicked')
    }
  }
}
</script>

<style lang="scss" scoped>
.read-more-button-link {
  text-decoration: none;
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

  .arrow {
    position: absolute;
    transition: transform 1s ease;
  }
}

.winecolumn__masonry-item1-lf-tp:hover .read-more-button,
.winecolumn__masonry-item1-lf-bt:hover .read-more-button,
.winecolumn__masonry-item1-rg-tp-l:hover .read-more-button,
.winecolumn__masonry-item1-rg-tp-r:hover .read-more-button,
.winecolumn__masonry-item1-rg-bt:hover .read-more-button,
.winecolumn__masonry-item2:hover .read-more-button {
  width: 150px;
  opacity: 1;

  .text {
    opacity: 1;
    transition-delay: 0.2s;
  }

  .arrow {
    transform: translateX(55px);
  }
}
</style>
