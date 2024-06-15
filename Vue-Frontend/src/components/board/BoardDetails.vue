<template>
  <section class="container">
    <article class="row">
      <header class="col-12">
        <h2>{{ board.board_name }}</h2>
        <p>{{ board.board_description }}</p>
        <button v-if="store.isLoggedIn" @click="createThread" class="btn btn-primary" role="button">Post Thread</button>
      </header>
    </article>
  </section>
  <section>
    <thread-item v-for="thread in threads" :key="thread.thread_id" :thread="thread" @update="update"
      @updateTotals="handleUpdateReplies" />
  </section>
</template>
<script>
import axios from '../../axios-auth'
import { userStore } from '../../stores/userStore'
import ThreadItem from '../thread/ThreadItem.vue'

export default {
  name: 'BoardDetails',
  setup() {
    const store = userStore();
    return { store }
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
    this.update().then(() => {
      this.handleUpdateReplies(this.threads);
    });
    setInterval(() => {
      this.handleUpdateReplies(this.threads);
    }, 5000);
  },
  methods: {
    update() {
      return axios.get(`/board/${this.board_name}`)
        .then(response => {
          this.board = response.data;
          return axios.get(`/board/${this.board_name}/threads`);
        })
        .then(threadResponse => {
          this.threads = threadResponse.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    handleUpdateReplies(threads) {
      threads.forEach((thread) => {
        axios.put(`/thread/${thread.thread_id}/totalreplies`)
          .catch(error => {
            console.error(error);
          });
      });
    },
    createThread() {
      this.$router.push({
        path: `/board/${this.board_name}.${this.board_id}/createthread`
      })
    },
  }
}
</script>
