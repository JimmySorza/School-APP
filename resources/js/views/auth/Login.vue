<template>
  <div class="auth-container">
    <!-- <div class="auth-box">
    <h1 class="pt-6 space-y-4">Login</h1>
    </div> -->
    <div
      class="space-y-8 bg-white rounded-xl py-12 sm:px-32 px-6"
      style="box-shadow: 0px 2px 14px rgba(44, 48, 59, 0.08); width: 40%"
    >
      <div class="flex items-center mb-8">
        <img
          class="w-auto"
          src="../../assets/images/school-trace-logo.png"
          alt="Workflow"
        />
        <p class="logo font-Roboto">School Trace</p>
      </div>
      <h2 class="heading font-Roboto">Sign in</h2>
      <sup>Please signin to access your school or schools</sup>
      <p :class="[error ? 'error font-Roboto' : 'non-visible']">
        {{ error }}
      </p>

      <form
        class="space-y-6"
        action="JavaScript:void(0)"
        @submit.prevent="handleSubmit"
      >
        <div class="rounded-md shadow-sm -space-y-px">
          <div style="margin: 6px 0px 0px 0px">
            <label for="email-address" class="font-Roboto">Username</label>
            <input
              v-model="username"
              id="username"
              name="username"
              autocomplete="username"
              required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            />
          </div>
          <div>
            <label for="password" class="font-Roboto">Password</label>
            <input
              v-model="password"
              id="password"
              name="password"
              type="password"
              autocomplete="current-password"
              required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            />
          </div>
        </div>

        <div>
          <button
            type="submit"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-sm text-white bg-blue hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"

            style="background:#216FED; border-radius:3px"
            :disabled="loading"
          >
            {{ loading ? 'Please Wait...' : 'Sign in' }}
          </button>
        </div>

        <p class="footer font-Roboto">
          Don't have an account?
          <router-link :to="{ path: '/register' }"
            ><a href="JavaScript:void(0)">Join Free Today</a></router-link
          >
        </p>
        <p class="footer font-Roboto">
          <router-link :to="{ path: '/reset' }"
            ><a href="JavaScript:void(0)">Reset password</a></router-link
          >
        </p>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {

  name: 'Login',
  components: {},
  data() {
    return {
      tenant_name: '',
      username: '',
      password: '',
      error: null,
      loading: false,
    }
  },
  methods: {
    async handleSubmit() {
      this.error = null
      this.loading = true


      try {
        const data = {
          username: this.username,
          password: this.password,
        }

        const request = axios({
          method: 'post',
          url: '/api/tenant/' + this.tenant_name + '/login',
          data: data,
          headers: {
            'X-XSRF-TOKEN': document
              .querySelector('meta[name="csrf-token"]')
              .getAttribute('content'),
          },
        })

        request
          .then((res) => {
            console.log('login res', res)
            localStorage.setItem('token', res.data.data.token)
            localStorage.setItem('tenant', this.tenant_name)
            this.$store.commit('user_state/setToken', res.data.data.token)
            this.$store.commit('user_state/setTenant', this.tenant_name)
            this.$router.push(`/${this.tenant_name}/traces`)
          })
          .catch((err) => {
            console.log(err)
            console.log(err.response, 'RESPOSNE ERR')
            if (
              err.response.data.message &&
              err.response.data.message === 'Tenant Not Found'
            ) {
              this.error = 'Incorrect School ID'
            } else {
              this.error = 'Incorrect Login Credentials'
            }
            this.loading = false
          })
      } catch (e) {
        console.log(e, 'ERRORd')
        this.error = true
        this.loading = false
      }
    },
  },
}

</script>

<style scoped lang="css">
.auth-container {
  background: #e5e5e5;
  width: 100%;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: auto;
}
.auth-box {
  background: #fff;
  width: 80%;
  border-radius: 19px;
}
.error {
  font-style: normal;
  font-weight: bold;
  font-size: 13px;
  /* line-height: 19px; */
  /* identical to box height */

  color: #ff0000;
  margin-top: 0px !important;
  margin-top: 4px !important;
}

.non-visible {
  margin-top: 0px !important;
  margin-top: 4px !important;

  visibility: hidden;
}
.logo {
  font-style: normal;
  font-weight: bold;
  font-size: 18px;
  line-height: 29px;
  /* identical to box height */

  display: flex;
  align-items: center;

  color: #216fed;
  margin-left: 5px;
}
.heading {
  font-style: normal;
  font-weight: bold;
  font-size: 28px;
  /* line-height: 64px; */
  /* identical to box height, or 183% */

  font-feature-settings: "liga" off;

  margin: 0px 0px 0px 0px !important;
  color: #455160;
}
form {
  margin-top: 0px !important;
}
label {
  font-style: normal;
  font-weight: 500;
  font-size: 14px;
  line-height: 150%;
  /* identical to box height, or 24px */

  letter-spacing: 0.02em;

  color: #455160;
}
input {
  background: #ffffff;
  border: 1px solid rgba(152, 153, 154, 0.35);
  box-sizing: border-box;
  border-radius: 3px;
  margin: 10px 0px 10px;
}
.footer {
  font-style: normal;
  font-weight: normal;
  font-size: 13px;
  line-height: 19px;
  /* identical to box height */

  text-align: center;

  color: #616161;
  text-align: center;
  padding: 0px !important;
  background: none !important;
}
a {
  font-weight: bold;
  color: #216fed;
}
</style>
