<template>
  <div class="default-page-wrapper">
    <default-nav />
    <transition name="fade">
      <slot :key="$route.fullPath" />
    </transition>
    <default-footer />
  </div>
</template>

<script setup>
import DefaultFooter from './DefaultFooter.vue'
import DefaultNav from './DefaultNav.vue'
</script>

<style lang="scss">
// .fade-enter-active,
// .fade-leave-active {
//   transition: opacity 0.3s ease-in-out;
// }

// .fade-enter-from,
// .fade-leave-active {
//   opacity: 0;
// }
</style>
