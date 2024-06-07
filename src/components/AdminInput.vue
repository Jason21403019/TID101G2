<template>
  <div class="d-flex justify-content-start inputBlock">
    <label :for="inputId" class="form-label">
      <slot name="label"></slot>
    </label>
    <slot name="select"></slot>
    <input :id="inputId" type="text" class="form-control" />
  </div>
</template>

<script>
export default {
  name: 'AdminInput',
  props: {
    inputId: {
      type: String,
      required: true
    }
  }
}
</script>

<style lang="scss" scoped>
.inputBlock {
  width: 50%;
  height: 40px;
  margin-top: 40px;
  margin-left: 170px;
  display: flex;
  align-items: center;
  .form-label {
    width: 20%;
  }
  .form-control {
    margin-left: 10px;
  }
}
</style>
