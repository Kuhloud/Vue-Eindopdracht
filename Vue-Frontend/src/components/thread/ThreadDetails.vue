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
  <section v-if="store.isLoggedIn" class="container d-flex justify-content-center align-items-center">
      <article class="card shadow p-3 mb-5 bg-body rounded" style="width: 800px;">
        <section class="card-body">
          <form id="newPost" onsubmit="event.preventDefault()">
            <section class="mb-3">
              <textarea class="form-control" v-model="post.message" id="firstPost" placeholder="Write your reply...">rows="6"></textarea>
            </section>
            <button type="submit" @click="newPost" class="btn btn-primary">Post Reply</button>
          </form>
        </section>
      </article>
    </section>
</template>
<script>
import axios from '../../axios-auth'
import { userStore } from '../../stores/userStore'
import PostItem from '../post/PostItem.vue'

export default {
  name: 'ThreadDetails',
  setup() {
    const store = userStore();
    return { store }
  },
  components: {
    PostItem
  },
  props: {
    thread_id: Number,
    thread_title: String
  },
  data() {
    return {
      posts: [],
      post: {
          threadId: this.thread_id,
          message: '',
          userId: this.store.getUserId,
        },
    }
  },
  async mounted() {
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
    postCheck() {
      if (!this.post.message) {
        alert('Please fill in all fields');
        return false;
      }
      console.log('Post Test Passed');
      return true;
    },
    async newPost() {
      try 
      {
          if (!this.postCheck()) {
          return;
        }
          const response = await axios.post('/post', this.post);
          console.log(response);
      }
      catch (error) {
        console.error(error)
      }
    },
  }
}
</script>