import { defineStore } from 'pinia'

export const useAdminOrderStore = defineStore('adminOrder', {
  state: () => ({
    orders: [],
    orderDetails: {}
  }),
  actions: {
    // table
    async fetchOrders() {
      try {
        const apiUrl = import.meta.env.VITE_PHP_PATH
        const url = `${apiUrl}adminorder.php`

        const response = await fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ action: 'fetch' })
        })

        const data = await response.json()

        if (data.success) {
          this.orders = data.orders

          return { success: true, orders: data.orders }
        } else {
          return { success: false, message: data.message }
        }
      } catch (error) {
        return { success: false, message: error.message }
      }
    },
    // 彈跳視窗訂單
    async fetchOrderDetails(orderId) {
      try {
        const apiUrl = import.meta.env.VITE_PHP_PATH
        const url = `${apiUrl}adminorder.php`

        const response = await fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ action: 'orderDetails', order_id: orderId })
        })

        const data = await response.json()

        if (data.success) {
          this.orderDetails = data.orderDetails
          // console.log('data.orderDetails:',data.orderDetails);

          return { success: true, orderDetails: data.orderDetails }
        } else {
          return { success: false, message: data.message }
        }
      } catch (error) {
        return { success: false, message: error.message }
      }
    },
    // 編輯收件人
    async editOrderRecipient(orderId, recipientData) {
      try {
        const apiUrl = import.meta.env.VITE_PHP_PATH
        const url = `${apiUrl}adminorder.php`

        const response = await fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ action: 'editOrder', order_id: orderId, recipientData })
        })

        const data = await response.json()

        if (data.success) {
          this.orderDetails = { ...this.orderDetails, ...recipientData }

          return { success: true }
        } else {
          return { success: false, message: data.message }
        }
      } catch (error) {
        return { success: false, message: error.message }
      }
    },
    // 取消訂單
    async cancelOrder(orderId) {
      try {
        const apiUrl = import.meta.env.VITE_PHP_PATH
        const url = `${apiUrl}adminorder.php`

        const response = await fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ action: 'cancelOrder', order_id: orderId })
        })

        const data = await response.json()

        return data
      } catch (error) {
        return { success: false, message: error.message }
      }
    },
    // 查詢
    async searchOrders(field, query, startDate, endDate) {
      try {
        const apiUrl = import.meta.env.VITE_PHP_PATH
        const url = `${apiUrl}adminorder.php`

        const response = await fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ action: 'search', field, query, startDate, endDate })
        })

        const data = await response.json()

        if (data.success) {
          this.orders = data.orders

          return { success: true, orders: data.orders }
        } else {
          return { success: false, message: data.message }
        }
      } catch (error) {
        return { success: false, message: error.message }
      }
    }
  }
})
