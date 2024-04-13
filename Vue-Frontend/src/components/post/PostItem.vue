<template>
    <a
      :href="`/thread/${thread.title}`"
      class="clickable-card"
      @click.prevent="goToThread(thread.title)"
    >
      <section class="card">
        <article class="card-body d-flex justify-content-between align-items-center">
          <h4 class="card-title">{{ thread.title }}</h4>
          <section class="d-flex">
            <dl class="d-flex flex-column align-items-center border-start border-end border-secondary">
              <dt>{{ thread.post_count }}</dt>
              <dd><small class="card-subtitle mb-2 text-muted">Posts</small></dd>
            </dl>
          </section>
        </article>
      </section>
    </a>
  </template>
    <script>
    import axios from '../../axios-auth'
  
    export default {
      name: 'PostItem',
      props: {
        post: Object
      },
      data() {
        return {
          user: {
            user_name: "",
          }
        }
      },
      methods: {
          update() {
            axios
              .get(`/board/${this.board_name}`)
              .then((response) => {
                this.board = response.data;
                axios
                  .get(`/board/${this.board.board_name}/threads`)
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
          },
        goToThread(thread_title) {
          this.$router.push(`/thread/${thread_title}`)
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