<template>
  <div class="wrapper">
      <!-- 左邊區塊 -->
      <CartLeft />
      <!-- 右邊區塊 -->
      <CartRight />
   
  </div>
</template>


<script>
import CartLeft from '../components/CartLeft.vue';
import CartRight from '../components/CartRight.vue';



export default {
  components: {
    CartLeft,
    CartRight
  }
};

</script>



<style lang="scss" scoped>


.wrapper {
  width: 100%;
//   background-color: $campari;
  display: flex;
  padding-top: 100px;
  margin: 0 auto;

  @include breakpoint( 820px) {
       display: inline-block; 
  }


}
</style>