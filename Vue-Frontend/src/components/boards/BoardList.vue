<template>
  <section>
    <div class="container">
      <h2 class="mt-3 mt-lg-5">Products</h2>
      <div class="row mt-3">
        <board-item
          v-for="board in boards"
          :key="board.board_id"
          :board="board"
          @update="update"
          @click="goToBoard(board.board_name)"
        />
      </div>
    </div>
  </section>
</template>

<script>
import axios from '../../axios-auth'

import BoardItem from './BoardItem.vue'

export default {
  name: 'BoardList',
  components: {
    BoardItem
  },
  data() {
    return {
      boards: []
    }
  },
  mounted() {
    this.update()
  },
  methods: {
    update() {
      axios
        .get('/boards')
        .then((response) => {
          this.boards = response.data
        })
        .catch((error) => {
          console.log(error)
        })
    },
    goToBoard(board_name) {
      this.$router.push(`/board/${board_name}`)
    }
  }
}
</script>

<style></style>
