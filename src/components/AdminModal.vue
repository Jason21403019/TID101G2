<template>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">{{ title }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div v-for="(field, index) in fields" :key="index" class="mb-3">
              <label :for="field.id" class="col-form-label">{{ field.label }}:</label>
              <component
                :is="field.type"
                class="form-control"
                :id="field.id"
                v-model="formData[field.id]"
                v-if="field.type !== 'select'"
              />
              <select
                v-if="field.type === 'select'"
                class="form-control"
                :id="field.id"
                v-model="formData[field.id]"
              >
                <option v-for="option in field.options" :key="option.value" :value="option.value">
                  {{ option.text }}
                </option>
              </select>
            </div>
            <div class="mb-3 d-flex align-items-center">
              <label for="flexSwitchCheckChecked" class="col-form-label me-2">啟用/停用:</label>
              <div class="form-check form-switch">
                <input id="flexSwitchCheckChecked" class="form-check-input" type="checkbox" v-model="formData.active" />
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
          <button type="button" class="btn btn-primary" @click="save">儲存</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: true
    },
    fields: {
      type: Array,
      required: true
    },
    formData: {
      type: Object,
      required: true
    }
  },
  methods: {
    save() {
      this.$emit('save', this.formData);
    }
  }
}
</script>