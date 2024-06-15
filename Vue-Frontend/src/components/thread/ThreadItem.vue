<template>
  <a :href="`/thread/${thread.title}`" class="clickable-card"
    @click.prevent="goToThread(thread.thread_id, thread.title)">
    <section class="card">
      <article class="card-body d-flex justify-content-between align-items-center">
        <section class="d-flex flex-column align-items-start">
          <h4 class="card-title">{{ thread.title }}</h4>
          <article v-if="this.tags.length > 0" class="d-flex ">
            <p class="card-text">Tags:</p>
            <tag-item v-for="tag in tags" :key="tag.tag_id" :tag="tag" />
          </article>
        </section>
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
import axios from '../../axios-auth'
import TagItem from '../tag/TagItem.vue'

export default {
  name: 'ThreadItem',
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
      this.$router.push(`/thread/${thread_title}.${thread_id}`)
    },
    getThreadTags(thread_id) {
      axios
        .get(`/tags/${thread_id}`)
        .then((res) => {
          this.tags = res.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },
  }

}
</script>
<style scoped>
a {
  text-decoration: none;
  color: #E30380;
}

dl {
  padding-right: 2em;
  padding-left: 2em;
  margin: 0;
}
</style>