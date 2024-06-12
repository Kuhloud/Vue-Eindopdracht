import axios from '../axios-auth'
import { defineStore } from 'pinia'

export const userStore = defineStore('store', {
  state: () => ({
    token: '',
    user_id: 0,
    username: ''
  }),
  getters: {
    isLoggedIn: (state) => state.token != '',
    getUserId: (state) => state.user_id,
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
            this.setUserData(res.data)
            resolve()
          })
          .catch((error) => reject(error))
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
            console.log(res)
            this.setUserData(res.data)
            resolve()
          })
          .catch((error) => reject(error))
      })
    },
    setUserData(response)
    {
      localStorage.setItem('token', response.token);
      localStorage.setItem('userid', response.id);
      localStorage.setItem('username', response.username);
      this.token = response.token;
      this.user_id = response.id;
      this.username = response.username;
    },
    autologin() {
      if (localStorage['token']) {
        try {
          this.token = localStorage.getItem('token');
          this.user_id = localStorage.getItem('userId');
          this.username = localStorage.getItem('username');
          axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        } catch (error) {
          console.error('Error while retrieving data from localStorage:', error);
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
      this.token = '';
      this.user_id = 0;
      this.username = '';
      localStorage.removeItem('token');
      localStorage.removeItem('userId');
      localStorage.removeItem('username');
      axios.defaults.headers.common['Authorization'] = '';
    }
  }
})
