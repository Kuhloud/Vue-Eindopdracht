<template>
  <section class="card">
    <article class="card-body">
      <h4 class="card-title">{{ NewPost.username }}</h4>
      <p>{{ this.role }}</p>
      <section class="d-flex flex-column">
        <textarea v-show="edit" class="form-control" v-model="newMessage" id="firstPost" rows="6"></textarea>
        <p v-show="message">{{ NewPost.message }}</p>
        <small class="card-subtitle mb-2 text-muted">Posted at: {{ NewPost.posted_at }}</small>
      </section>
      <button v-if="store.isStaff" type="submit" @click="deletePost" class="btn btn-danger">Delete Post</button>
      <button v-show="editButton" v-if="store.isCurrentUser(this.post.user_id)" @click="displayEdit" class="btn btn-primary">Edit</button>
      <button v-show="editConfirm" v-if="store.isCurrentUser(this.post.user_id) && NewPost.message" type="submit" @click="editPost" class="btn btn-success">Confirm</button>
      <button v-show="editCancel" v-if="store.isCurrentUser(this.post.user_id) && NewPost.message" type="submit" @click="displayEdit" class="btn btn-danger">Cancel</button>
    </article>
  </section>
</template>
<script>
import axios from '../../axios-auth'
import { userStore } from '../../stores/userStore'

export default {
  name: 'PostItem',
  setup() {
    const store = userStore();
    return { store }
  },
  props: {
    post: Object,
  },
  created() {
    this.getUserRole();
  },
  
  computed: {
    NewPost() {
      return this.post
    }
  },
  data() {
    return {
      message: true,
      edit: false,
      editButton: true,
      editConfirm: false,
      editCancel: false,
      role: '',
      newMessage: '',
    }
  },
  methods: {
    displayEdit() {
      if (this.edit) {
        this.message = true;
        this.edit = false;
        this.editButton = true;
        this.editConfirm = false;
        this.editCancel = false;
      }
      else {
        this.message = false;
        this.edit = true;
        this.editButton = false;
        this.editConfirm = true;
        this.editCancel = true;
      }
    },
    async getUserRole() {
      axios
        .get(`/userrole/${this.post.user_id}`)
        .then((res) => {
          localStorage.setItem('role', res.data);
          this.role = res.data
        })
        .catch((error) => {
          console.error(error);
        });
    },
editPost() {
  axios
    .put(`/post/${this.post.post_id}/edit`, { message: this.newMessage })
    .then((res) => {
      console.log(res);
      this.displayEdit();
    })
    .catch((error) => {
      console.error(error);
    });
},
    deletePost() {
      axios
        .delete(`/post/${this.post.post_id}/delete`)
        .then(() => {
          console.log('Post deleted');
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