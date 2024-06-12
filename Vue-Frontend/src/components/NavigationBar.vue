<template>
  <nav id="navbar" class="navbar navbar-expand-lg sticky-top navbar-dark">
    <section>
      <a class="navbar-brand" href="/">
        <img id="logo" :src="img" title="Inholland University of Applied Sciences" alt="Inholland Logo" />
        InHolland Forum
      </a>
    </section>
    <section class="collapse navbar-collapse d-flex justify-content-end">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <router-link to="/" class="nav-link" active-class="active">Home</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/boards" class="nav-link" active-class="active">Boards</router-link>
        </li>
        <section class="d-flex" v-if="!store.isLoggedIn">
        <li class="nav-item">
          <router-link to="/login" class="nav-link" active-class="active">Login</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/signup" class="nav-link" active-class="active">Signup</router-link>
        </li>
        </section>
        <section class="d-flex" v-else>
        <li class="nav-item">
          <router-link to="/" class="nav-link" active-class="active">Welcome, {{ store.username }}</router-link>
        </li>
        <li class="nav-item">
          <a to="/logout" @click.prevent="logout" class="nav-link" active-class="active">Logout</a>
        </li>
        </section>
      </ul>
    </section>
  </nav>
</template>

<script>
import img from '@/assets/img/Forum_Logo.png'
import { userStore } from '../stores/userStore'

export default {
  name: 'NavigationBar',
  setup() {
    const store = userStore()
    return { store }
  },
  data() {
    return {
      img,
      token: this.store.token
    }
  },
  methods: {
  logout() {
    this.store.logout();
    this.$router.push('/');
  }
}
}
</script>

<style>
#logo {
  width: 100px;
  height: 100px;
  position: relative;
  top: 0;
  left: 0;
  right: 100px;
  margin: 0 auto;
}

#navbar {
  background-color: #e30380;
  width: 100%;
  display: flex;
}
</style>
