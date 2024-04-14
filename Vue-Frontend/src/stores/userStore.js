import axios from '../axios-auth'
import { defineStore } from 'pinia'

export const userStore = defineStore('store', {
  state: () => ({
    token: '',
    user: {}
  }),
  getters: {
    isLoggedIn: (state) => state.token != ''
  },
  actions: {
    signup(user, email, password) {
      const sanitizedUsername = user.trim().toLowerCase()
      const sanitizedEmail = email.trim().toLowerCase()
      return new Promise((resolve, reject) => {
        axios
          .post('/users/signup', {
            user: sanitizedUsername,
            email: sanitizedEmail,
            password: password
          })
          .then((res) => {
            console.log(res.data)
            this.setUserData(res.data)
            resolve()
          })
          .catch((error) => reject(error))
      })
    },
    login(user, password) {
      const sanitizedUsername = user.trim()
      return new Promise((resolve, reject) => {
        axios
          .post('/users/login', {
            username: sanitizedUsername,
            password: password
          })
          .then((res) => {
            console.log(res.data)
            this.setUserData(res.data)
            resolve()
          })
          .catch((error) => reject(error))
      })
    },
    setUserData(response)
    {
      localStorage.setItem('token', response.token);
      localStorage.setItem('user', JSON.stringify(response.user));
      this.user = response.user
      this.token = response.token
    },
    autologin() {
      if (localStorage['token']) {
        try {
          this.token = localStorage.getItem('token')
          this.user = JSON.parse(localStorage.getItem('user'));
          axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        } catch (error) {
          console.error('Error while retrieving data from localStorage:', error, localStorage.getItem('user'));
        }
      }
    },
    logout() {
      this.token = ''
      this.user = ''
      localStorage.removeItem('token')
      localStorage.removeItem('user')
      axios.defaults.headers.common['Authorization'] = ''
    }
  }
})
