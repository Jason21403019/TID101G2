<template>
  <div class="winecolumn__wrapper-title">
    <h1 class="winecolumn__wrapper-title-cn">
      {{ titleCn }}
    </h1>
    <span class="winecolumn__wrapper-title-en">
      {{ titleEn }}
    </span>
  </div>
</template>

<script>
export default {
  name: 'WineColumnTitle',

  props: {
    titleCn: {
      type: String,
      required: true
    },
    titleEn: {
      type: String,
      required: true
    }
  }
}
</script>

<style lang="scss" scoped>
.winecolumn__wrapper-title {
  display: flex;
  align-items: center;
  color: $ramos-gin-fizz;
  margin: 2rem 0;

  @include breakpoint(430px) {
    flex-direction: column;
    align-items: baseline;
  }

  &-cn {
    font-size: $fontSize_h2;
    font-family: $fontfamily;
    font-weight: bold;
    letter-spacing: $letterspacing;
    @include breakpoint(430px) {
      font-size: $fontSize_h3;
      margin-bottom: 1rem;
    }
  }
  &-en {
    font-size: $fontSize_h4;
    font-family: $fontfamily-en;
    align-self: end;
    letter-spacing: $letterspacing;
    margin-left: 1rem;
    color: rgba($color: $ramos-gin-fizz, $alpha: 0.5);
    @include breakpoint(430px) {
      font-size: $fontSize_h5;
      align-self: start;
      margin-left: 0;
    }
  }
}
</style>
