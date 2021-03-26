// Imports
import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import '../sass/app.scss'
import TailwindMixin from './mixins/TailwindMixin'
import Components from './components/globals'
import Filters from './filters'
import axios from 'axios'
import Buefy from 'buefy'
import axiosInstance from './utils/axios'

import 'buefy/dist/buefy.css'
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)
Vue.use(Buefy)

var token = localStorage.getItem('token')
store.commit('user_state/loadToken')
store.commit('user_state/loadTenant')

if (token !== null) {
  axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
}

Vue.prototype.$axios = axiosInstance

Vue.config.productionTip = false

// Add Components
Object.keys(Components).forEach((key) => {
  Vue.component(key, Components[key])
})

// Add Filters
Object.keys(Filters).forEach((key) => {
  Vue.filter(key, Filters[key])
})

// Mixins
Vue.mixin(TailwindMixin)

// eslint-disable-next-line
new Vue({
  el: '#app',
  render: (h) => h(App),
  router,
  store,
})
