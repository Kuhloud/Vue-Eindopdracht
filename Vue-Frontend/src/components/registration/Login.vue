<template>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <form>
            <div v-if="errorMessage != ''" class="alert alert-danger">
              {{ errorMessage }}
            </div>
            <div class="mb-3">
              <label for="inputUsername" class="form-label">Username</label>
              <input id="inputUsername" type="text" v-model="username" class="form-control" />
            </div>
            <div class="mb-3">
              <label for="inputPassword" class="form-label">Password</label>
              <input type="password" v-model="password" class="form-control" id="inputPassword" />
            </div>
            <button type="button" class="btn btn-primary" @click="login">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { useStore } from '../../stores/store'

export default {
  name: 'LoginComponent',
  setup() {
    const store = useStore()
    return { store }
  },
  data() {
    return {
      username: '',
      password: '',
      errorMessage: ''
    }
  },
  methods: {
    login() {
      this.store
        .login(this.username, this.password)
        .then(() => {
          this.$router.replace('/')
        })
        .catch((error) => (this.errorMessage = error))
    }
  }
}
</script>

<style></style>
