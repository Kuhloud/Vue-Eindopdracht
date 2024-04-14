<template>
  <section class="container">
    <article class="row">
      <header class="col-12">
        <h2>{{ thread_title }}</h2>
      </header>
    </article>
  </section>
  <section>
    <post-item :thread_title="thread_title" v-for="post in posts" :key="post.post_id" :post="post" />
  </section>
</template>
<script>
import axios from '../../axios-auth'
import PostItem from '../post/PostItem.vue'

export default {
  name: 'ThreadDetails',
  components: {
    PostItem
  },
  props: {
    thread_title: String
  },
  data() {
    return {
      posts: [],
    }
  },
  async created() {
    await this.getPosts()
  },
  methods: {
    async getPosts() {
      try {
        const response = await axios.get(`/thread/${this.thread_title}`)
        const thread = response.data
        const postResponse = await axios.get(`/thread/${thread.thread_id}/posts`)
        const updatedPostArray = await Promise.all(postResponse.data.map(async post => {
          const userResponse = await axios.get(`/user/${post.user_id}`)
          return { ...post, username: userResponse.data.username }
        }))
        this.posts = updatedPostArray
      }
      catch (error) {
        console.error(error)
      }
    },
  }
}
</script>