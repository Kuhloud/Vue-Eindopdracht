<template>
  <navigation-bar />
  <router-view />
</template>

<script>
import NavigationBar from './components/NavigationBar.vue'
import { useStore } from './stores/store'

export default {
  name: 'App',
  setup() {
    const store = useStore()
    store.autologin()
    return { store }
  },
  components: {
    NavigationBar
  }
}
</script>

<style></style>
