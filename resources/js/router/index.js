// Imports
import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'
import Routes from './routes'
import _404 from "../views/_404.vue"
Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    redirect: { name: 'Login' }
  },
  {
    name:"404",
    path: "/404",
    component: _404,
  },
  {
    path: '*',
    redirect: { name: '404' }
  },
  ...Routes
]

const router = new VueRouter({
  base: process.env.BASE_URL,
  routes
})
router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    console.log("its a protected path", store.getters["user_state/isLoggedIn"])
    if (!store.getters["user_state/isLoggedIn"]) {
      next({
        path: '/',
        query: { redirect: to.fullPath }
      })
    } else {
      next()
    }
  } else {
    next() // make sure to always call next()!
  }
   if (to.matched.some(record => record.meta.NoAuth)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    console.log("its a protected path", store.getters["user_state/isLoggedIn"])
    if (store.getters["user_state/isLoggedIn"]) {
      next({
        path: '/tenants',
        
      })
    } else {
      next()
    }
  } else {
    next() // make sure to always call next()!
  }
})

export default router
