import { defineStore } from 'pinia'

export const useProductStore = defineStore({
  id: 'product',
  state: () => ({
    selectedProduct: ''
  }),
  actions: {
    setSelectedProduct(product) {
      // this.selectedProduct = product
      // 保存当前的 selectedProduct 值
      const currentProduct = this.selectedProduct
      // 设置新的 selectedProduct 值
      this.selectedProduct = product
    }
    // clearSelectedProduct() {
    //   this.selectedProduct = null
    // }
  }
})
