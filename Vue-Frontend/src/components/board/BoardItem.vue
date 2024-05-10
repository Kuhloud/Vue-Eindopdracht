<template>
  <a
    :href="`/board/${board.board_name}`"
    class="clickable-card"
    data-bs-toggle="tooltip" data-placement="right" :title="board.board_description"
    @click.prevent="goToBoard(board.board_name)"
  >
    <section class="card">
      <article class="card-body d-flex justify-content-between align-items-center">
        <h4 class="card-title">{{ board.board_name }}</h4>
        <section class="d-flex">
          <dl class="d-flex flex-column align-items-center border-end border-secondary">
            <dt>{{ board.total_threads }}</dt>
            <dd><small class="card-subtitle mb-2 text-muted">Threads</small></dd>
          </dl>
          <dl class="d-flex flex-column align-items-center">
            <dt>{{ board.total_messages }}</dt>
            <dd><small class="card-subtitle mb-2 text-muted">Messages</small></dd>
          </dl>
        </section>
      </article>
    </section>
  </a>
</template>
<script>
export default {
  name: 'BoardItem',
  props: {
    board: Object,
  },
  
  methods: {
    goToBoard(board_name) {
      this.$router.push(`/board/${board_name}`);
    }
  }
}
</script>
<style scoped>
a {
  text-decoration: none;
  color: #E30380;
}
dl{
  padding-right: 2em;
  padding-left: 2em;
  margin: 0;
}
</style>
