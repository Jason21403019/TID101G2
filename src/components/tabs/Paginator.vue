<template>
  <div class="pagination">
    <button @click="previousPage" :disabled="currentPage === 1">&lt;</button>

    <span v-for="page in totalPages" :key="page" :class="{ 'current-page': page === currentPage }">{{ page + ' ' }}&nbsp;</span>
    <button @click="nextPage" :disabled="currentPage === totalPages">&gt;</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      productCount: [],

      currentPage: 1,
      pageSize: 6 // 每頁顯示的項目數
    }
  },
  computed: {
    totalItems() {
      return this.productCount.length // 计算 totalItems 的值为 productCount 数组的长度
    },
    totalPages() {
      return Math.ceil(this.totalItems / this.pageSize)
    }
  },
  methods: {
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++
        this.$emit('next-page', this.currentPage)
      }
    },
    previousPage() {
      if (this.currentPage > 1) {
        this.currentPage--
        this.$emit('previous-page', this.currentPage)
      }
    }
  },

  mounted() {
    for (let i = 0; i < 60; i++) {
      this.productCount.push(i)
    }
  }
}
</script>

<style scoped>
.pagination {
  width: 100%;
  font-size: 32px;
  display: flex;
  justify-content: center;
  margin-top: 20px;
}

button {
  padding: 5px 10px;
  margin: 0 5px;
  cursor: pointer;
  border: none;
  color: #fcf0d8;
  background-color: rgba(0, 0, 0, 0);
}

button:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}
.pagination span {
  /* color: #fcf0d8; */
  color: #cead8279; /* 默认颜色 */
}
.pagination .current-page {
  color: #fcf0d8; /* 你想要的当前页码颜色 */
}
</style>
