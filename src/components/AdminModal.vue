<template>
  <div id="exampleModal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 id="exampleModalLabel" class="modal-title fs-5">{{ title }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="closeModal"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="handleSubmit">
            <div v-for="field in fields" :key="field.id" class="mb-3">
              <label :for="field.id" class="col-form-label">{{ field.label }}:</label>
              <input v-if="field.type === 'input'" :id="field.id" v-model="formData[field.id]" class="form-control" :type="field.type" />
              <input v-if="field.type === 'password'" :id="field.id" v-model="formData[field.id]" class="form-control" :type="field.type" />
              <input v-if="field.type === 'file'" :id="field.id" v-model="formData[field.id]" class="form-control" :type="field.type" />
              <input v-if="field.type === 'date'" :id="field.id" v-model="formData[field.id]" class="form-control" :type="field.type" />
              <textarea v-if="field.type === 'textarea'" :id="field.id" v-model="formData[field.id]" class="form-control"></textarea>
              <!-- 文字編輯器 -->
              <!-- <admin-text-editor v-if="field.type === 'ckeditor'" :id="field.id" v-model="formData[field.id]"></admin-text-editor> -->
              <select v-if="field.type === 'select'" :id="field.id" v-model="formData[field.id]" class="form-control">
                <option v-for="option in field.options" :key="option.value" :value="option.value">{{ option.text }}</option>
              </select>
              <div v-if="field.type === 'checkbox'" class="form-check form-switch">
                <input :id="field.id" v-model="formData[field.id]" class="form-check-input" :type="field.type" />
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <AdminBtn 
            modal 
            modal-target="#exampleModal" 
            modal-whatever="@fat"
            @click="handleSubmit"
          >
            <template #text>儲存</template>
          </AdminBtn>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AdminBtn from './AdminBtn.vue';
// import AdminTextEditor from './AdminTextEditor.vue';

export default {
  name: 'AdminModal',
  components: {
    AdminBtn,
    // AdminTextEditor
  },
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
    },
    visible: {
      type: Boolean,
      required: true
    }
  },
  watch: {
    visible(val) {
      if (val) {
        this.showModal();
      } else {
        this.hideModal();
      }
    }
  },
  methods: {
    showModal() {
      const modalElement = this.$refs.modal;
      const modal = new bootstrap.Modal(modalElement);
      modal.show();
    },
    hideModal() {
      const modalElement = this.$refs.modal;
      const modal = bootstrap.Modal.getInstance(modalElement);
      if (modal) {
        modal.hide();
      }
    },
    closeModal() {
      this.$emit('close');
    },
    handleSubmit() {
      this.$emit('save', this.formData);
      this.closeModal();
    }
  }
}
</script>


<style lang="scss" scoped>
@import '../../node_modules/bootstrap/scss/bootstrap.scss'; 

#exampleModal{
  font-size: $fontSize_h4;
  color: $campari;

  .modal-header{
    background-color: $babypowder;
  }

  .modal-body{
    background-color: $babypowder;

    .col-form-label{
      font-size: $fontSize_h4;
    }

    .form-control{
      outline: 1px solid $campari;
    }
    .form-check-input:checked{
      background-color: $toggle-on;
      border: solid $toggle-on;
    }
  }

  .modal-footer{
    background-color: $babypowder;
  }
}

</style>