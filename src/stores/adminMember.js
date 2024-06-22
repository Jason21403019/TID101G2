import { defineStore } from 'pinia'

export const useAdminMemberStore = defineStore('adminMember', {
  state: () => ({
    members: []
  }),
  actions: {
    async fetchMembers() {
      try {
        const apiUrl = import.meta.env.VITE_PHP_PATH
        const url = `${apiUrl}adminmember.php`

        const response = await fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ action: 'fetch' })
        })

        const data = await response.json()

        if (data.success) {
          this.members = data.members

          return { success: true, members: data.members }
        } else {
          return { success: false, message: data.message }
        }
      } catch (error) {
        return { success: false, message: error.message }
      }
    },
    async searchMembers(field, query) {
      try {
        const apiUrl = import.meta.env.VITE_PHP_PATH
        const url = `${apiUrl}adminmember.php`

        const response = await fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ action: 'search', field, query })
        })

        const data = await response.json()

        if (data.success) {
          this.members = data.members

          return { success: true, members: data.members }
        } else {
          return { success: false, message: data.message }
        }
      } catch (error) {
        return { success: false, message: error.message }
      }
    }
  }
})
