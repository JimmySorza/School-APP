<template>
  <div class="auth-container">
    <b-loading v-model="loading" :can-cancel="false"></b-loading>
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
      <h2 class="heading font-Roboto">Reset Password</h2>
      <p class="mt-2 text-success">{{ msg }}</p>
      <form class="space-y-6" action="JavaScript:void(0)" @submit="submit">
        <div v-if="!token" class="rounded-md shadow-sm -space-y-px">
          <div style="margin: 6px 0px 0px 0px">
            <label for="email-address" class="font-Roboto">Email</label>
            <input
              v-model="email"
              type="email"
              autocomplete="email"
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            />
          </div>
        </div>
        <div v-else>
          <div class="rounded-md shadow-sm -space-y-px">
            <div style="margin: 6px 0px 0px 0px">
              <label for="email-address" class="font-Roboto">Password</label>
              <input
                v-model="password"
                type="password"
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
              />
            </div>
          </div>
          <div class="rounded-md shadow-sm -space-y-px">
            <div style="margin: 6px 0px 0px 0px">
              <label for="email-address" class="font-Roboto"
                >Confirm Password</label
              >
              <input
                v-model="password_confirm"
                type="password"
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
              />
            </div>
          </div>
        </div>
        <div>
          <button
            type="submit"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-sm text-white bg-blue hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            style="background: #216fed; border-radius: 3px"
            :disabled="loading"
          >
            {{ loading ? "Please Wait..." : "Reset password" }}
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import loader from "../../mixins/loading";
export default {
  name: "reset",
  props: ["token"],
  mixins: [loader],
  components: {},
  data() {
    return {
      email: "",
      password: "",
      password_confirm: "",
      loading: false,
      msg: "",
    };
  },
  methods: {
    async resetemail() {
      try {
        if (this.email.length > 0) {
          const data = {
            email: this.email,
          };
          this.showLoader();
          const request = axios({
            method: "post",
            url: "/api/forgots",
            data: data,
            headers: {
              "X-XSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            },
          });

          request
            .then((res) => {
              this.email = "";
              this.msg = res.data.message;
              this.hideLoader();
            })
            .catch((err) => {
              console.log(err);
            });
        }
      } catch (e) {
        console.log(e);
      }
    },
    async resetpassword() {
      try {
        const data = {
          password: this.password,
          password_confirm: this.password_confirm,
          token: this.token,
        };
        this.showLoader();
        const request = axios({
          method: "post",
          url: "/api/reset",
          data: data,
          headers: {
            "X-XSRF-TOKEN": document
              .querySelector('meta[name="csrf-token"]')
              .getAttribute("content"),
          },
        });

        request
          .then((res) => {
            this.password = "";
            this.password_confirm = "";
            this.$router.push("/");
          })
          .catch((err) => {
            console.log(err);
          });
      } catch (e) {
        console.log(e);
      }
    },
    submit(evt) {
      evt.preventDefault();
      if (this.token) {
        this.resetpassword();
      } else {
        this.resetemail();
      }
    },
  },
};
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
