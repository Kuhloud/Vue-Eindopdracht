import axios from '../axios-auth'
import { defineStore } from 'pinia'

export const boardStore = defineStore('store', {
  state: () => ({
    board_id: 0
  }),
  getters: {
    getBoard: (state) => state.board_id = ''
  },
  actions: {
    setBoardId(board_name) {
      axios
        .get(`/boards/${board_name}`)
        .then((res) => {
          this.board_id = res.data.id
        })
        .catch((error) => console.log(error))
    }
  }
})
