<template>
  <div class="form-group d-flex justify-content-start align-self-center date__Input">
    <div class="label-container">
      <label :for="startDateId">
        <slot name="label"></slot>
      </label>
      <div class="date-info">
        <slot name="info"></slot>
      </div>
    </div>
    <input :id="startDateId" type="date" class="form-control">
    <span>到</span>
    <input :id="endDateId" type="date" class="form-control">
  </div>
</template>

<script>
export default {
  name: 'AdminDateInput',
  props: {
    startDateId: {
      type: String,
      required: true
    },
    endDateId: {
      type: String,
      required: true
    }
  }
}
</script>

<style lang="scss" scoped>
.date__Input{
  width: 50%;
  margin-left: 170px;
  margin-top: 5px;
  margin-right: 10px;
  display: flex;
  // flex-direction: column;
  align-items: center;
  .label-container {
    display: flex;
    flex-direction: column;
    margin-right: 10px;
    width: 20%;
    // align-items: center;

  }
  span{
    margin: 0 5px;
  }
}
.date-info {
  margin-top: 5px;
  font-size: $fontSize_p;
  color: gray;
}
</style>