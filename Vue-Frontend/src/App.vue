<template>
  <navigation-bar />
  <router-view />
</template>

<script>
import NavigationBar from './components/NavigationBar.vue'
import { userStore } from './stores/userStore'

export default {
  name: 'App',
  setup() {
    const store = userStore()
    store.autologin()
    return { store }
  },
  components: {
    NavigationBar
  }
}
</script>

<style></style>
