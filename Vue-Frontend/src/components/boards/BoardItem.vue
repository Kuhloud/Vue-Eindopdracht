<template>
  <a
    :href="`/board/${board.board_id}`"
    class="clickable-card"
    @click.prevent="viewType === 'list' ? goToBoard() : null"
  >
    <section class="card">
      <article class="card-body">
        <h4 class="card-title">{{ board.board_name }}</h4>
        <section v-if="viewType === 'list'">
          <p class="card-text">{{ board.board_description }}</p>
          <small class="card-subtitle mb-2 text-muted">{{ board.total_threads }}</small>
          <small class="card-subtitle mb-2 text-muted">{{ board.total_messages }}</small>
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
    viewType: {
      type: String,
      default: 'list'
    }
  },
  mounted() {},
  methods: {
    goToBoard() {
      this.$emit('click')
    }
  }
}
</script>
