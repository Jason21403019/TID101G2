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
    <!-- 雙向綁定AdminOrder日期 -->
    <input :id="startDateId" v-model="internalStartDate" type="date" class="form-control" @change="emitDateChange" />
    <span>到</span>
    <input :id="endDateId" v-model="internalEndDate" type="date" class="form-control" @change="emitDateChange" />
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
    },
    startDate: {
      type: String,
      default: ''
    },
    endDate: {
      type: String,
      default: ''
    }
  },
  emits: ['dateChange'],
  data() {
    return {
      internalStartDate: this.startDate,
      internalEndDate: this.endDate
    }
  },
  // 監聽父組件日期的變化
  watch: {
    startDate(newVal) {
      this.internalStartDate = newVal
    },
    endDate(newVal) {
      this.internalEndDate = newVal
    }
  },
  methods: {
    emitDateChange() {
      this.$emit('dateChange', { startDate: this.internalStartDate, endDate: this.internalEndDate })
    }
  }
}
</script>

<style lang="scss" scoped>
.date__Input {
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
    width: 30%;
    // align-items: center;
  }
  span {
    margin: 0 5px;
  }
}
.date-info {
  margin-top: 5px;
  font-size: $fontSize_p;
  color: gray;
}
</style>
