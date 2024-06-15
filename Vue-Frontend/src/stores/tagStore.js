import axios from '../axios-auth'
import { defineStore } from 'pinia'

export const tagStore = defineStore('store', {
  state: () => ({
    tags: []
  }),
  getters: {
    getTags: (state) => state.tags
  },
  actions: {
    getThreadTags(thread_id) {
      return new Promise((resolve, reject) => {
      axios
        .get(`/tags/${thread_id}`)
        .then((res) => {
          this.tags = res.data
          console.log(this.tags)
          resolve()
        })
        .catch((error) => reject(error))
      })
    }
  }
})
