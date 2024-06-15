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
            <input type="text" v-model="thread.title" class="form-control" id="threadTitle"
              placeholder="Enter thread title">
          </section>
          <section class="mb-3">
            <textarea class="form-control" v-model="thread.firstPost" id="firstPost" rows="6"></textarea>
          </section>
          <section class="mb-3">
            <label for="tags" class="form-label">Tags:</label>
            <input type="text" class="form-control" id="tags" v-model="tags"
              placeholder="Enter tags (separated by commas)">
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
            this.displayResponse(tagResponse);
            const threadTagResponse = await axios.post(`/threadtag/${response.data.thread_id}`, tagResponse.data.tag_id );
            this.displayResponse(threadTagResponse);
          }
      }
      //this.$router.push({ path: `/thread/${response.data.title}.${response.data.thread_id}` });
      } catch (error) {
      console.error(error);
      }
    },
  }
}


</script>