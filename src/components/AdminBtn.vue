<template>
  <button 
    class="admin_btn" 
    type="button" 
    v-bind="$attrs" 
    :data-bs-toggle="modal ? 'modal' : null" 
    :data-bs-target="modal ? modalTarget : null" 
    :data-bs-whatever="modal ? modalWhatever : null"
  >
    <slot name="icon"></slot>
    <slot name="text"></slot>
  </button>
</template>

<script>
export default {
  name: 'AdminBtn',
  props: {
    modal: {
      type: Boolean,
      default: false
    },
    modalTarget: {
      type: String,
      default: ''
    },
    modalWhatever: {
      type: String,
      default: ''
    }
  },
  inheritAttrs: false
}
</script>

<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss';
.admin_btn {
  font-family: $fontfamily, $fontfamily-en;
  display: flex;
  align-items: center;
  background-color: $campari;
  color: $ramos-gin-fizz;
  border: none;
  border-radius: 4px;
  padding: 10px;

}
</style>
