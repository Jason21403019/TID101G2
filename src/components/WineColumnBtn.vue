<template>
  <button class="read-more-button" @click="handleClick">Read More</button>
</template>

<script>
export default {
  name: 'ReadMoreButton',
  methods: {
    handleClick() {
      console.log('Read More button clicked')
    }
  }
}
</script>

<style scoped>
.read-more-button {
  position: absolute;
  top: 46%;
  left: 34%;
  padding: 0.5rem 1rem;
  background-color: rgba(255, 255, 255, 0.8);
  border: none;
  border-radius: 4px;
  cursor: pointer;
  z-index: 2;
  opacity: 0;
  transition: opacity 0.3s ease;
}
</style>
