import axios from '../axios-auth'
import { defineStore } from 'pinia'

export const userStore = defineStore('store', {
  state: () => ({
    token: '',
    username: ''
  }),
  getters: {
    isLoggedIn: (state) => state.token != ''
  },
  actions: {
    signup(username, email, password) {
      const sanitizedUsername = username.trim().toLowerCase()
      const sanitizedEmail = email.trim().toLowerCase()
      return new Promise((resolve, reject) => {
        axios
          .post('/users/signup', {
            username: sanitizedUsername,
            email: sanitizedEmail,
            password: password
          })
          .then((res) => {
            console.log(res.data)
            this.setUserData(res, username)
            resolve()
          })
          .catch((error) => reject(error.response.data.errorMessage))
      })
    },
    login(username, password) {
      const sanitizedUsername = username.trim()
      return new Promise((resolve, reject) => {
        axios
          .post('/users/login', {
            username: sanitizedUsername,
            password: password
          })
          .then((res) => {
            console.log(res.data)
            this.setUserData(res, username)
            resolve()
          })
          .catch((error) => reject(error.response.data.errorMessage))
      })
    },
    setUserData(response, username)
    {
      localStorage['token'] = response.data
      localStorage.setItem('username', username)
      this.username = username
      this.token = response.data
    },
    autologin() {
      if (localStorage['token']) {
        this.token = localStorage['token']
        this.username = localStorage.getItem('username')
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      }
    },
    logout() {
      this.token = ''
      this.username = ''
      localStorage.removeItem('token')
      localStorage.removeItem('username')
      axios.defaults.headers.common['Authorization'] = ''
    }
  }
})
