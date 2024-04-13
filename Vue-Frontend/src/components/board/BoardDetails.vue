<template>
  <section class="container">
    <article class="row">
      <header class="col-12">
          <h2>{{ board_name }}</h2>
          <p>Discussies hier</p>
      </header>
  </article>
  </section>
  <section>
    <thread-item
        v-for="thread in threads"
        :key="thread.thread_id"
        :thread="thread"
      />
  </section>
</template>
<script>
import axios from '../../axios-auth'
import ThreadItem from '../thread/ThreadItem.vue'

export default {
  name: 'BoardDetails',
  components: {
    ThreadItem
  },
  props: {
    board_name: String
  },
  data() {
    return {
      threads: []
    }
  },
  async mounted() {
    await this.update()
  },
  methods: {
    async update() {
      try {
        const response = await axios.get(`/board/${this.board_name}`)
        this.board = response.data
        const threadResponse = await axios.get(`/board/${this.board.board_name}/threads`)
        this.threads = threadResponse.data
      } catch (error) {
        console.error(error)
      }
    }
  }
}
</script>
