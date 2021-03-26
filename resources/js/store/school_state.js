import axios from "axios";
import { API_URL } from "../config"
const school_state = {
    namespaced: true,
    state: {
        schools: null,
        current: null
    },
    mutations: {
        setSchools(state, value) {

            state.schools = value
        },
        clearSchools(state) {
            state.schools = null
        },
        setCurrent(state, value) {
            state.current = value
        }
    },
    actions: {
        GetSchools({ commit, rootState }) {
            return new Promise((res, rej) => {
                axios({
                    url: API_URL + "/api/tenant/getUserSchools",
                    method: "GET"
                }).then(response => {
                    commit("setSchools", response.data.data.schools)
                    res(response.data.data.schools)
                }).catch(err => {
                    rej(err)
                })
            })
        }
    },
    getters: {

    },

}
export default school_state