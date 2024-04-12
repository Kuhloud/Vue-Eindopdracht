<template>
  <section class="container">
    <article class="row">
      <header class="col-12">
        <h2>{{ board.title }}</h2>
        <p>{{ board.description }}</p>
        <a
          href="/board/<?php echo urlencode($board->getBoardId());?>/thread/createthread"
          class="btn btn-primary"
          role="button"
          >Create Thread</a
        >
      </header>
    </article>
  </section>
</template>
<script>
import axios from '../../axios-auth'

export default {
  name: 'BoardDetails',
  props: {
    board_name: String,
    thread: Object
  },
  data() {
    return {
      board: {
        id: 0,
        title: '',
        description: '',
        total_threads: 0,
        total_messages: 0
      },
      threads: []
    }
  },
  mounted() {},
  methods: {
    update() {
      axios
        .get(`/board/${this.board_name}`)
        .then((response) => {
          this.board = response.data;
          axios
            .get(`/board/${this.board_name}/threads`)
            .then((response) => {
              this.threads = response.data
            })
            .catch((error) => {
              console.log(error)
            })
        })
        .catch((error) => {
          console.log(error)
        })
    }
  }
}
</script>
