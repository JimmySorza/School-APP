import Vue from 'vue'
import Vuex from 'vuex'

import user_state from './user_state'
import teacher from './teacher'
import administrator from './administrator'
import school_state from "./school_state"

Vue.use(Vuex)

export default new Vuex.Store({
  actions: {},
  getters: {
    // Get Private Mode
    getPrivateMode: (state) => state.privateMode,
  },
  mutations: {
    // Set Private Mode
    SET_PRIVATE_MODE(state, mode) {
      state.privateMode = mode
    },
  },
  state: {
    privateMode: false,
  },
  modules: {
    user_state: user_state,
    school_state,
    teacher,
    administrator
  },
})
