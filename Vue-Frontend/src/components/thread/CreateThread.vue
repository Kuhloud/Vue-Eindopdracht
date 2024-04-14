<template>
<section class="container d-flex justify-content-center align-items-center">
    <article class="card shadow p-3 mb-5 bg-body rounded" style="width: 800px;">
        <header class="card-header">
            Post a New Thread - {{ board_name }}
        </header>
        <section class="card-body">
            <form id="createThread" onsubmit="event.preventDefault()">
                <section class="mb-3">
                    <label for="threadTitle" class="form-label">Thread Title:</label>
                    <input type="text" v-model="thread.title" class="form-control" id="threadTitle" placeholder="Enter thread title">
                </section>
                <section class="mb-3">
                    <textarea class="form-control" v-model="thread.firstPost" id="firstPost" rows="6"></textarea>
                </section>
                <section class="mb-3">
                    <label for="tags" class="form-label">Tags:</label>
                    <input type="text" class="form-control" id="tags" placeholder="Enter tags (separated by commas)">
                </section>
                <button type="submit" onclick="createThread()" class="btn btn-primary">Create Thread</button>
            </form>
        </section>
    </article>
</section>
</template>
<script>
import axios from '../../axios-auth'
import { userStore } from '../../stores/userStore'
import { boardStore } from '../../stores/boardStore'

export default {
  name: 'CreateThread',
  setup() {
    const uStore = userStore()
    const bStore = boardStore()
    return { uStore, bStore }
  },
  props: {
    board_name: String
  },
  data() {
    return {
      thread: {
        boardId: this.bStore.boardId,
        title: '',
        firstPost: '',
        userId: this.uStore.user.userId,
      },
    }
  },
  async created() {

  },
  methods: {
    createThread(userId, boardId) {
      axios.post('/thread', data)
        .then(response => {
          console.log(response)
          this.$router.push({ path: `/thread/${threadTitle}` })
        })
        .catch(error => {
          console.error(error)
        })
    }

  }
}
</script>