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
                <input id="inputUsername" type="text" v-model="username" class="form-control" required/>
                <small class="form-text text-danger">Required</small>
              </section>
              <section class="mb-3">
                <label for="inputEmail" class="form-label">Enter Email Address</label>
                <input type="text" v-model="email" class="form-control" id="inputEmail" required/>
                <small class="form-text text-danger">Required</small>
              </section>
              <section class="mb-3">
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" v-model="password" class="form-control" id="inputPassword" required/>
                <small class="form-text text-danger">Required</small>
              </section>
              <button type="button" class="btn btn-primary" @click="signup">Signup</button>
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
      signup() {
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
  