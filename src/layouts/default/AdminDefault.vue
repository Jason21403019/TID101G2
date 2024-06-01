<template>
  <header v-if="!isLoginPage">
    <admin-header :isExpanded="isExpanded" @toggleSidebar="toggleSidebar" />
    <admin-slidebar :isExpanded="isExpanded" @update:isExpanded="isExpanded = $event" />
  </header>

  <main :class="{ 'main-shifted': isExpanded && !isLoginPage }">
    <RouterView></RouterView>
  </main>
</template>

<script>
import AdminHeader from './AdminHeader.vue'
import AdminSlidebar from './AdminSlidebar.vue'
import { useRoute } from 'vue-router'

export default {
  components: {
    AdminHeader,
    AdminSlidebar
  },
  data() {
    return {
      isExpanded: false,
      isLoginPage: false
    }
  },
  watch: {
    $route(to) {
      this.isLoginPage = to.path === '/admin_login'
    }
  },
  created() {
    const route = useRoute()
    this.isLoginPage = route.path === '/admin_login'
  },
  methods: {
    toggleSidebar() {
      this.isExpanded = !this.isExpanded
    }
  }
}
</script>

<style lang="scss" scoped>
main {
  transition: margin-left 0.3s ease;
}

.main-shifted {
  margin-left: 160px; /* 根據側邊欄的寬度調整這個值 */
}
</style>
