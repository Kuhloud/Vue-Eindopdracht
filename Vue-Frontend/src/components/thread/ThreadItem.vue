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
            <dt>{{ thread.replies }}</dt>
            <dd><small class="card-subtitle mb-2 text-muted">Replies</small></dd>
          </dl>
        </section>
      </article>
    </section>
  </a>
</template>
  <script>

  export default {
    name: 'ThreadItem',
    props: {
      thread: Object
    },
    methods: {
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