<template>
  <main>
    <div class="AdminWrapper">
      <header v-if="!isLoginPage">
        <admin-header :isExpanded="isExpanded" @toggleSidebar="toggleSidebar" />
        <admin-slidebar :isExpanded="isExpanded" @update:isExpanded="isExpanded = $event" />
      </header>

      <section :class="{ 'main-shifted': isExpanded && !isLoginPage }">
        <RouterView></RouterView>
      </section>
    </div>
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
main{
  font-family: $fontfamily,$fontfamily-en;
  background: $whitelady;
  
  .AdminWrapper{
    padding-top: 60px;
    background: $whitelady;
    height: 100vh;
  }

  section {
    transition: margin-left 0.3s ease; 
    background-color: $whitelady;
  }
  
  .main-shifted {
    background-color: $whitelady;
    margin-left: 160px; /* 根據側邊欄的寬度調整這個值 */
  }

}

</style>
