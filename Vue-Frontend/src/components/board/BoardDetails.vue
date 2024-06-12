<template>
  <section class="container">
    <article class="row">
      <header class="col-12">
          <h2>{{ board.board_name }}.{{ board.board_id }}</h2>
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
import ThreadItem from '../thread/ThreadItem.vue'

export default {
  name: 'BoardDetails',
  setup() {
    const uStore = userStore();
    return { uStore }
  },
  components: {
    ThreadItem
  },
  props: {
    board_name: String,
    board_id: Number,
  },
  data() {
    return {
      board: Object,
      threads: []
    }
  },
  mounted() {
    this.update();
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
  //   async setBoardId() {
  //   try {
  //     await this.bStore.setCurrentBoardId(this.board_name);
  //     console.log('Board ID set');
  //   } catch (error) {
  //     console.error('Error setting board ID:', error);
  //   }
  // },
    createThread() {
      this.$router.push({ 
        path: `/board/${this.board_name}.${this.board_id}/createthread`})
    },
  }
}
</script>
