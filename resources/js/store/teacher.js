import { axiosInstance as axios, getTeachers, createTeacher } from './../utils'
import { buildArrayAction, buildArrayMutations, buildArrayState } from './_base'
import _ from 'lodash'
// state
const state = {
  ...buildArrayState,
  current_page: null,
  first_page_url: null,
  from: null,
  last_page: null,
  last_page_url: null,
  links: null,
  next_page_url: null,
  path: null,
  per_page: null,
  prev_page_url: null,
  to: null,
  total: null,
}

// mutations
const mutations = buildArrayMutations()

// actions
const actions = buildArrayAction({
  getAll: () =>
    new Promise((resolve, reject) => {
      axios()
        .get(getTeachers)
        .then((res) => {
          resolve(_.get(res, 'data.data', {}))
        })
        .catch((err) => {
          reject()
        })
    }),
  create: (data) => {
    return new Promise((resolve, reject) => {
      axios()
        .post(createTeacher, data)
        .then((res) => {
          resolve()
        })
        .catch((err) => {
          reject()
        })
    })
  },
})

export default {
  namespaced: true,
  state,
  mutations,
  actions,
}
