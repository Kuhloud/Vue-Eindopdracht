<template>
<section class="container d-flex justify-content-center align-items-center">
    <article class="card shadow p-3 mb-5 bg-body rounded" style="width: 800px;">
        <header class="card-header">
            Post a New Thread - {{ board_name }}.{{ board_id }} 
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
                <button type="submit" @click="createThread" class="btn btn-primary">Create Thread</button>
            </form>
        </section>
    </article>
</section>
</template>
<script>
import axios from '../../axios-auth'
import { userStore } from '../../stores/userStore'

export default {
  name: 'CreateThread',
  setup() {
    const store = userStore()
    return { store }
  },
  props: {
    board_id: Number,
    board_name: String,
  },
  data() {
    return {
      thread: {
        boardId: this.board_id,
        title: '',
        firstPost: '',
        userId: this.store.getUserId,
      },
      tags: [],
    }
  },
  methods: {
    createThread() {
      axios.post('/thread', this.thread)
        .then(response => {
          console.log(response)
          this.$router.push({ path: `/thread/${response.title}.${response.thread_id}` })
        })
        .then(axios.post)
        .catch(error => {
          console.error(error)
        })
    },
  }
}


</script>