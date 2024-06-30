<template>
  <div class="wrapper">
      <!-- 左邊區塊 -->
      <CartLeft ref="cartLeft" @updateData="handleUpdate"/>
      <!-- 右邊區塊 -->
      <CartRight @updateCartSummary="handleCartSummary" />
   
  </div>
</template>


<script>
import CartLeft from '../components/CartLeft.vue';
import CartRight from '../components/CartRight.vue';



export default {
  components: {
    CartLeft,
    CartRight
  },

  methods: {
    handleUpdate(data) {
      console.log('Received shipping info update:', data);
    if (Object.keys(data).length > 0) {
      const existingData = JSON.parse(localStorage.getItem('shippingInfo') || '{}');
      const updatedData = { ...existingData, ...data };
      localStorage.setItem('shippingInfo', JSON.stringify(updatedData));
      console.log('Updated shipping info:', updatedData);
    }

  },
    handleCartSummary(data) {
      console.log('Received cart summary:', data);
      // 將 data 轉換為 JSON 字符串
      const cartSummary = JSON.stringify(data);
      // 存儲到 localStorage
      localStorage.setItem('cartSummary', cartSummary);
      // 在這裡處理 data，例如更新父組件的數據
    }
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





