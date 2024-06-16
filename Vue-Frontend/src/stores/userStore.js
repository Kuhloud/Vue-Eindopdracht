import axios from '../axios-auth'
import { defineStore } from 'pinia'

export const userStore = defineStore('store', {
  state: () => ({
    token: '',
    user_id: 0,
    username: '',
    role: ''
  }),
  getters: {
    isLoggedIn: (state) => state.token != '',
    getUserId: (state) => state.user_id,
    getUsername: (state) => state.username,
    getRole: (state) => state.role,
    isStaff: (state) => state.role.toLowerCase() == 'moderator' || state.role.toLowerCase() == 'administrator',
    isCurrentUser: (state) => (user_id) => state.user_id == user_id,
  },
  actions: {
    async signup(username, email, password) {
      const sanitizedUsername = username.trim().toLowerCase()
      const sanitizedEmail = email.trim().toLowerCase()
      try {
        const res = await axios.post('/users/signup', {
          username: sanitizedUsername,
          email: sanitizedEmail,
          password: password
        })
        await this.setUserData(res.data)
        await this.getUserRole()
        return Promise.resolve()
      } catch (error) {
        return Promise.reject(error)
      }
    },
    async login(username, password) {
      const sanitizedUsername = username.trim()
      try {
        const res = await axios.post('/users/login', {
          username: sanitizedUsername,
          password: password
        })
        await this.setUserData(res.data)
        await this.getUserRole()
        return Promise.resolve()
      } catch (error) {
        return Promise.reject(error)
      }
    },
    async getUserRole() {
      return new Promise((resolve, reject) => {
        axios
          .get(`/userrole/${this.user_id}`)
          .then((res) => {
            localStorage.setItem('role', res.data)
            this.role = res.data
            resolve()
          })
          .catch((error) => reject(error))
      })
    },
    async setUserData(response) {
      localStorage.setItem('token', response.token)
      localStorage.setItem('user_id', response.user_id)
      localStorage.setItem('username', response.username)
      this.token = response.token
      this.user_id = response.user_id
      this.username = response.username
    },
    autologin() {
      if (localStorage['token']) {
        try {
          this.token = localStorage.getItem('token')
          this.user_id = localStorage.getItem('user_id')
          this.username = localStorage.getItem('username')
          this.role = localStorage.getItem('role')
          axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        } catch (error) {
          console.error('Error while retrieving data from localStorage:', error)
        }
      }
    },
    validateInput(email) {
      if (email != '') {
        this.errorMessage = 'Please fill in your email address'
        return false
      }
      return true
    },
    logout() {
      this.token = ''
      this.user_id = 0
      this.username = ''
      localStorage.removeItem('token')
      localStorage.removeItem('user_id')
      localStorage.removeItem('username')
      localStorage.removeItem('role')
      axios.defaults.headers.common['Authorization'] = ''
    }
  }
})
