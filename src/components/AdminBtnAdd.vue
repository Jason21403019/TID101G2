<template>
  <button class="create_btn" type="button" @click="handleClick">
    <img src="../imgs/icon/icon_expand-w-67.svg" alt="addIcon" height="20px" width="20px" />
    新增
  </button>
</template>

<script>
export default {
  name: 'AdminBtnAdd',
  props: {
    click: {
      type: Function,
      required: true
    }
  },
  methods: {
    handleClick() {
      this.click()
    }
  }
}
</script>

<style lang="scss" scoped>
.create_btn {
  font-family: $fontfamily, $fontfamily-en;
  display: flex;
  align-items: center;
  background-color: $campari;
  color: $ramos-gin-fizz;
  border: none;
  border-radius: 4px;
  padding: 5px;
  img {
    margin-right: 5px;
  }
}
</style>
