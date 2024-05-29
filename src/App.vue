<template>
  <component :is="layout">
    <router-view />
  </component>
</template>

<script>
export default {
  computed: {
    layout() {
      return `layout-${this.$route.meta.layout || 'default'}`
    }
  }
}
</script>
