<template>
  <button class="admin_bulkbtn" type="button" @click="handleClickEvent">
    <slot name="bulkicon"></slot>
    <slot name="bulktext"></slot>
  </button>
</template>

<script>
export default {
  name: 'AdminBulkBtn',
  props: {
    handleClick: {
      type: Function,
      required: true
    }
  },
  methods: {
    handleClickEvent() {
      if (this.handleClick && typeof this.handleClick === 'function') {
        this.handleClick()
      }
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss';

.admin_bulkbtn {
  font-family: $fontfamily, $fontfamily-en;
  display: flex;
  align-items: center;
  background-color: $ramos-gin-fizz;
  color: $campari;
  border: 1px solid $campari;
  border-radius: 4px;
  padding: 5px;
}
</style>
