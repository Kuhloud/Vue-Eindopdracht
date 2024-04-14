<template>
  <section class="container">
    <article class="row">
      <header class="col-12">
          <h2>{{ board.board_name }}</h2>
          <p>{{ board.board_description }}</p>
          <button v-if="uStore.isLoggedIn" @click="createThread" class="btn btn-primary" role="button">Post Thread</button>
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
import { userStore } from '../../stores/userStore'
import { boardStore } from '../../stores/boardStore'
import ThreadItem from '../thread/ThreadItem.vue'

export default {
  name: 'BoardDetails',
  setup() {
    const uStore = userStore()
    const bStore = boardStore()
    return { uStore, bStore }
  },
  components: {
    ThreadItem
  },
  props: {
    board_name: String,
    board_description: String,
  },
  data() {
    return {
      board: Object,
      threads: []
    }
  },
  created() {
    this.update()
    this.bStore.setBoardId(this.board_name)
  },
  methods: {
    async update() {
      try {
        const response = await axios.get(`/board/${this.board_name}`)
        this.board = response.data
        const threadResponse = await axios.get(`/board/${this.board_name}/threads`)
        this.threads = threadResponse.data
      } catch (error) {
        console.error(error)
      }
    },
    createThread() {
      this.$router.push({ path: `/thread/${this.board_name}/create` })
    },
  }
}
</script>
