import { createRouter, createWebHistory } from 'vue-router'

import HomePage from '../components/Home.vue'
import BoardList from '../components/board/BoardList.vue'
import BoardDetails from '../components/board/BoardDetails.vue'
import ThreadDetails from '../components/thread/ThreadDetails.vue'
import CreateThread from '../components/thread/CreateThread.vue'
import Login from '../components/registration/Login.vue'
import Signup from '../components/registration/Signup.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: '/', component: HomePage },
    { path: '/boards', component: BoardList },
    { path: '/board/:board_name', component: BoardDetails, props: true },
    { path: '/thread/:thread_title', component: ThreadDetails, props: true },
    { path: '/thread/:board_name/create', component: CreateThread, props: true},
    { path: '/login', component: Login },
    { path: '/signup', component: Signup }
  ]
})

export default router
