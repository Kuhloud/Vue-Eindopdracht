<template>
  <section class="card">
    <article class="card-body d-flex justify-content-between align-items-center">
      <section class="d-flex flex-column align-items-start">
        <a :href="`/thread/${thread.title}`" class="clickable-card"
          @click.prevent="goToThread(thread.thread_id, thread.title)">
          <h4 class="card-title">{{ thread.title }}</h4>
        </a>
        <article v-if="tags != null" class="d-flex ">
          <tag-item v-for="tag in tags" :key="tag.tag_id" :tag="tag" />
        </article>
        <button v-if="store.isStaff" type="submit" @click="deleteThread" class="btn btn-primary margin-right">Delete
          Thread</button>
      </section>
      <section class="d-flex">
        <dl class="d-flex flex-column align-items-center border-start border-end border-secondary">
          <dt>{{ thread.replies }}</dt>
          <dd><small class="card-subtitle mb-2 text-muted">Replies</small></dd>
        </dl>
      </section>
    </article>
  </section>
</template>
<script>
import axios from '../../axios-auth'
import TagItem from '../tag/TagItem.vue'
import { userStore } from '../../stores/userStore'

export default {
  name: 'ThreadItem',
  setup() {
    const store = userStore()
    return { store }
  },
  components: {
    TagItem
  },
  props: {
    thread: Object
  },
  data() {
    return {
      tags: []
    }
  },
  async created() {
    await this.getThreadTags(this.thread.thread_id);
  },
  methods: {
    goToThread(thread_id, thread_title) {
      this.$router.push(`/thread/${thread_title}.${Number(thread_id)}`)
    },
    async getThreadTags(thread_id) {
      axios
        .get(`/tags/${thread_id}`)
        .then((res) => {
          this.tags = res.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    deleteThread() {
      this.$emit('deleteThread', this.thread.thread_id)
    },
  }

}
</script>
<style scoped>
a {
  text-decoration: underline;
  color: #E30380;
}

dl {
  padding-right: 2em;
  padding-left: 2em;
  margin: 0;
}
</style>