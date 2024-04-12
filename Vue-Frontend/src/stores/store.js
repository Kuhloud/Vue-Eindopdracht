import axios from '../axios-auth'
import { defineStore } from 'pinia'

export const useStore = defineStore('store', {
  state: () => ({
    token: '',
    username: ''
  }),
  getters: {
    isLoggedIn: (state) => state.token != ''
  },
  actions: {
    login(username, password) {
      return new Promise((resolve, reject) => {
        axios
          .post('/users/login', {
            username: username,
            password: password
          })
          .then((res) => {
            console.log(res.data)
            localStorage['token'] = res.data
            localStorage.setItem('username', username)
            this.username = username
            this.token = res.data
            resolve()
          })
          .catch((error) => reject(error.response.data.errorMessage))
      })
    },
    autologin() {
      if (localStorage['token']) {
        this.token = localStorage['token']
        this.username = localStorage.getItem('username')
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      }
    }
  }
})
