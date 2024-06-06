<template>
  <div>
    <div id="editor">
      <!-- 文字框 -->
      <p class="TextEditor"></p>
    </div>
  </div>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

export default {
  mounted() {
    ClassicEditor.create(document.querySelector('#editor')).catch((error) => {
      console.error(error)
    })
  }
}
</script>
<style lang="scss" scoped>
.TextEditor {
  /* 文字框高度 */
  height: 300px;
}
</style>
