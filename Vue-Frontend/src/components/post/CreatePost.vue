<template>
    <section class="container d-flex justify-content-center align-items-center">
      <article class="card shadow p-3 mb-5 bg-body rounded" style="width: 800px;">
        <header class="card-header">
          New Post - {{ board_name }}.{{ board_id }}
        </header>
        <section class="card-body">
          <form id="newPost" onsubmit="event.preventDefault()">
            <section class="mb-3">
              <textarea class="form-control" v-model="thread.firstPost" id="firstPost" placeholder="Write your reply...">rows="6"></textarea>
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
  
  export default {
    name: 'CreatePost',
    setup() {
      const store = userStore()
      return { store }
    },
    props: {
      thread_id: Number,
      board_name: String,
    },
    data() {
      return {
        post: {
          threadId: this.thread_id,
          title: '',
          firstPost: '',
          userId: this.store.getUserId,
        },
        tags: '',
      }
    },
    methods: {
      threadTest() {
        if (!this.thread.title || !this.thread.firstPost) {
          alert('Please fill in all fields');
          return false;
        }
        console.log('Thread Test Passed');
        return true;
      },
      splitTags(tags) {
        return tags.split(',')
      .map(tag => tag.trim())
      .filter(Boolean)
      .map(tag => tag.replace(/[^a-z0-9-_]/gi, ''));
      },
      displayResponse(response) {
        console.log(response);
      },
      async tagTest() {
        if (this.tags != '')
        {
            let tags = this.splitTags(this.tags);
            for (const tag of tags) {
              const response = await axios.post('/tag', tag);
              this.displayResponse(response);
            }
            return true;
        }
      },
      async createThread() {
        let tags;
        if (!this.threadTest()) {
          return;
        }
        try {
        const response = await axios.post('/thread', this.thread);
        if (this.tags != '') {
          tags = this.splitTags(this.tags);
          for (const tag of tags) {
              const tagResponse = await axios.post('/tag', { tag_name: tag });
              await axios.post(`/threadtag/${response.data.thread_id}`, tagResponse.data);
            }
        }
        this.$router.push({ path: `/thread/${response.data.title}.${response.data.thread_id}` });
        } catch (error) {
        console.error(error);
        }
      },
    }
  }
  