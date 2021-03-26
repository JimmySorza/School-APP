/**
 * default state
 */
export const buildArrayState = {
  data: [],
  isLoading: false,
  isCreating: false,
  isDeleting: false,
  isUpdating: false,
}

/**
 * Generate default mutations
 */
export const buildArrayMutations = () => {
  let mutations = {}

  mutations[`setAll`] = (state, payload) => {
    Object.keys(payload).map((key) => {
      state[key] = payload[key]
    })
  }
  mutations[`create`] = (state, data) => {
    if (data) {
      state['data'].push(data)
    }
  }
  mutations[`update`] = (state, data) => {
    const index = state['data'].find((i) => i.id == id)
    state['data'][index] = data
  }
  mutations[`delete`] = (state, id) => {
    const index = state['data'].find((i) => i.id == id)
    state['data'].splice(index, 1)
  }

  mutations[`setLoading`] = (state, status) => {
    state['isLoading'] = status
  }
  mutations[`setCreating`] = (state, status) => {
    state['isCreating'] = status
  }
  mutations[`setUpdating`] = (state, status) => {
    state['isUpdating'] = status
  }
  mutations[`setDeleting`] = (state, status) => {
    state['isDeleting'] = status
  }
  return mutations
}

/**
 *
 * @param {{getAll: Promise<any>, create: Promise<any>, update: Promise<any>, delete: Promise<any>, }} actions
 */
export const buildArrayAction = (actions) => {
  const mapActions = {}
  if (actions['getAll']) {
    mapActions['getAll'] = async ({ state, commit }, payload) => {
      commit('setLoading', true)
      try {
        const data = await actions['getAll'](payload)
        commit('setAll', data)
        commit('setLoading', false)
      } catch (err) {
        console.log(`[Error] => `, err)
        commit('setLoading', false)
      }
    }
  }

  if (actions['create']) {
    mapActions['create'] = async ({ state, commit }, payload) => {
      commit('setCreating', true)
      try {
        const data = await actions['create'](payload)
        commit('create', data)
        commit('setCreating', false)
      } catch (err) {
        commit('setCreating', false)
      }
    }
  }
  if (actions['update']) {
    mapActions['update'] = async ({ state, commit }, payload) => {
      commit('setUpdating', true)
      try {
        const data = await actions['update'](data)
        commit('update', data)
        commit('setUpdating', false)
      } catch (err) {
        commit('setUpdating', false)
      }
    }
  }
  if (actions['delete']) {
    mapActions['delete'] = async ({ state, commit }, id) => {
      commit('setDeleting', true)
      try {
        const data = await actions['delete'](id)
        commit('delete', data)
        commit('setLoading', false)
      } catch (error) {
        commit('setLoading', false)
      }
    }
  }

  return mapActions
}
