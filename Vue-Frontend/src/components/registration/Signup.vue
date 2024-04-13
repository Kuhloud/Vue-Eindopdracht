<template>
    <section>
      <section class="container">
        <section class="row">
          <section class="col-md-6">
            <form>
              <section v-if="errorMessage != ''" class="alert alert-danger">
                {{ errorMessage }}
              </section>
              <section class="mb-3">
                <label for="inputUsername" class="form-label">Username</label>
                <input id="inputUsername" type="text" v-model="username" class="form-control" />
                <small class="form-text text-muted">Required</small>
              </section>
              <section class="mb-3">
                <label for="inputPassword" class="form-label">Enter Email Address</label>
                <input type="password" v-model="email" class="form-control" id="inputPassword" />
                <small class="form-text text-muted">Required</small>
              </section>
              <section class="mb-3">
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" v-model="password" class="form-control" id="inputPassword" />
                <small class="form-text text-muted">Required</small>
              </section>
              <button type="button" class="btn btn-primary" @click="login">Submit</button>
            </form>
          </section>
        </section>
      </section>
    </section>
  </template>
  
  <script>
  import { userStore } from '../../stores/userStore'
  
  export default {
    name: 'SignupComponent',
    setup() {
      const store = userStore()
      return { store }
    },
    data() {
      return {
        username: '',
        email: '',
        password: '',
        errorMessage: ''
      }
    },
    methods: {
      login() {
        this.store
          .signup(this.username, this.email, this.password)
          .then(() => {
            this.$router.replace('/')
          })
          .catch((error) => (this.errorMessage = error))
      }
    }
  }
  </script>
  
  <style></style>
  