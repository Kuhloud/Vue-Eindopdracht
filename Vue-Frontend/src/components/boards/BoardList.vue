<template>
  <section>
    <section class="container">
      <h2 class="mt-3 mt-lg-5">Discussie</h2>
      <section class="row mt-3">
        <board-item
          v-for="board in boards"
          :key="board.board_id"
          :board="board"
          viewType="list"
          @update="update"
          @click="goToBoard(board.board_name)"
        />
      </section>
    </section>
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

<style scoped>
.clickable-card {
    text-decoration: none; 
}
.clickable-card:hover {
    /* Styling for hover state, e.g., change background color, add a shadow, etc. */
    background-color: #E30380;
}
</style>
