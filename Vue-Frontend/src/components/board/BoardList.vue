<template>
    <section class="container">
      <article class="row">
        <header class="col-12">
            <h2>Boards</h2>
            <p>Discussies hier</p>
        </header>
    </article>
    </section>
    <section>
      <board-item
          v-for="board in boards"
          :key="board.board_id"
          :board="board"
          @update="update"
        />
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
