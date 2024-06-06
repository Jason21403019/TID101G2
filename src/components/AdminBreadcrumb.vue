<template>
  <nav class="breadcrumb-nav" style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
    <ol class="breadcrumb d-flex justify-content-end">
      <li
        v-for="(item, index) in items"
        :key="index"
        class="breadcrumb-item"
        :class="{ active: item.active }"
        aria-current="page"
      >
        <router-link v-if="!item.active" :to="item.link">{{ item.text }}</router-link>
        <span v-else>{{ item.text }}</span>
      </li>
    </ol>
  </nav>
</template>

<script>
export default {
  props: {
    items: {
      type: Array,
      required: true,
      default: () => []
    }
  },
  created() {
    // console.log('Breadcrumb items:', this.items);
  }
}
</script>

<style lang="scss" scoped>
.breadcrumb-nav {
  margin-top: 20px;
  margin-right: 20px;
  background-color: $whitelady;
  font-size: $fontSize_h5;
  
  .breadcrumb-item {
    a {
      font-size: $fontSize_h5;
      color: $campari;
    }
  }
}
</style>
