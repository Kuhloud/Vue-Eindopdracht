import axios from '../axios-auth'
import { defineStore } from 'pinia'

export const boardStore = defineStore('store', {
  state: () => ({
    boardId: 0
  }),
  actions: {
    setCurrentBoardId(board_name) {
      return new Promise((resolve, reject) => {
      axios
        .get(`/boards/${board_name}`)
        .then((res) => {
          this.boardId = res.data.id
          resolve()
        })
        .catch((error) => reject(error))
      })
    }
  }
})
