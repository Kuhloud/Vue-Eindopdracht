<template>
  <nav class="navbar navbar-expand-md navbar-dark mb-4">
    <section>
      <a class="navbar-brand" href="/">
        <img
          id="logo"
          :src="img"
          title="Inholland University of Applied Sciences"
          alt="Inholland Logo"
        />
        InHolland Forum
      </a>
    </section>
    <section class="container-fluid">
      <ul id="navbar" class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <router-link to="/" class="nav-link" active-class="active">Home</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/boards" class="nav-link" active-class="active">Boards</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/login" class="nav-link" active-class="active">Login</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/signup" class="nav-link" active-class="active">Signup</router-link>
        </li>
      </ul>
    </section>
  </nav>
</template>

<script>
import img from '@/assets/img/Forum_Logo.png'

export default {
  name: 'NavigationHeader',
  data() {
    return {
      img
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
}
</style>
