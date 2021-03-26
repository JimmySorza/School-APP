const user_state = {
    namespaced: true,
    state: {
        user: null,
        token: null,
        tenant_name: null,
    },
    actions: {
    },
    getters: {
        isLoggedIn: state => {
            if (state.token)
                return true
            else
                return false
        }
    },
    mutations: {

        // token
        setToken(state, value) {
            state.token = value
            localStorage.setItem("token", value)
        },
        loadToken(state) {
            let token = localStorage.getItem("token")
            if (token) {
                state.token = token
            }
        },
        delToken(state) {
            state.token = null
            localStorage.removeItem("token")
        },

        // tenant
        setTenant(state, value) {
            state.tenant_name = value
            localStorage.setItem("tenant_name", value)
        },
        loadTenant(state) {
            let tenant_name = localStorage.getItem("tenant_name")
            if (tenant_name) {
                state.tenant_name = tenant_name
            }
        },
        delTenant(state) {
            state.tenant_name = null
            localStorage.removeItem("tenant_name")
        }
    },

}
export default user_state
