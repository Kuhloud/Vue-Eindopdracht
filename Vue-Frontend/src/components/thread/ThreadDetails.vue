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
      <post-item
          v-for="thread in threads"
          :key="thread.thread_id"
          :thread="thread"
        />
    </section>
  </template>
  <script>
  import axios from '../../axios-auth'
  import PostItem from '../post/PostItem.vue'
  
  export default {
    name: 'BoardDetails',
    components: {
      PostItem
    },
    props: {
      thread_title: String
    },
    data() {
      return {
        board: {
          board_id: 0,
          board_name: '',
          board_description: '',
          total_threads: 0,
          total_messages: 0
        },
        post: []
      }
    },
    async mounted() {
    await this.update()
  },
  methods: {
    async update() {
      try {
        const response = await axios.get(`/thread/${this.board_name}`)
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