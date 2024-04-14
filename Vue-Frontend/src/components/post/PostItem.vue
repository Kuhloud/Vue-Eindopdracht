<template>
      <section class="card">
        <article class="card-body">
          <h4 class="card-title">{{ NewPost.username }}</h4>
          <section class="d-flex flex-column">
            <p>{{ NewPost.message }}</p>
            <small class="card-subtitle mb-2 text-muted">Posted at: {{ NewPost.posted_at }}</small>
          </section>
        </article>
      </section>
  </template>
    <script>

    export default {
      name: 'PostItem',
      props: {
        post: Object,
      },
      computed: {
        NewPost() {
          return this.post
        }
      },
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