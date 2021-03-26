<template>
  <div class="auth-container">
    <!-- <div class="auth-box">
    <h1 class="pt-6 space-y-4">Login</h1>
    </div> -->
    <div
      class="w-full space-y-8 bg-white rounded-xl py-12 sm:px-32 px-6"
      style="box-shadow: 0px 2px 14px rgba(44, 48, 59, 0.08); width: 40%"
    >
      <div class="flex items-center">
        <img
          class="w-auto"
          src="../../assets/images/school-trace-logo.png"
          alt="Workflow"
        />
        <p class="logo font-Roboto">School Trace</p>
      </div>
      <h2 class="heading font-Roboto">Create an account</h2>
      <p class="slogan font-Roboto" style="margin-bottom: 30px">
        Once you create your account than you can start registering your
        associated schools for covid tracing.
      </p>
      <p :class="[error ? 'error font-Roboto' : 'non-visible']">
        <!-- Please complete the required fields below. -->
        <!-- Please fill all the fields properly. -->
        {{ error }}
      </p>

      <form
        class="space-y-6"
        action="JavaScript:void(0)"
        @submit.prevent="handleSubmit"
      >
        <!-- <error :error="error" v-if="error" /> -->
        <div style="margin: 6px 0px 0px 0px">
          <div class="mb-2">
            <label for="firstname" class="font-Roboto">First Name</label>
            <input
              id="firstname"
              v-model="$v.first_name.$model"
              name="first-name"
              style=""
              v-bind:style="[
                !$v.first_name.required && $v.first_name.$error
                  ? { border: '1px solid red !important' }
                  : null,
              ]"
              class="mb-0 appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 border-danger placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            />
            <sub
              class="text-danger"
              v-if="!$v.first_name.required && $v.first_name.$error"
            >
              Field is required
            </sub>
          </div>
          <div class="mb-2">
            <label for="lastname" class="font-Roboto">Last Name</label>
            <input
              id="lastname"
              v-model="$v.last_name.$model"
              name="lastname"
              v-bind:style="[
                !$v.last_name.required && $v.last_name.$error
                  ? { border: '1px solid red !important' }
                  : null,
              ]"
              class="mb-0 appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            />
            <sub
              class="text-danger"
              v-if="!$v.last_name.required && $v.last_name.$error"
            >
              Field is required
            </sub>
          </div>
          <div class="mb-2">
            <label for="email" class="font-Roboto">Email</label>
            <input
              id="email"
              v-model="$v.email.$model"
              name="email"
              type="email"
              v-bind:style="[
                !$v.email.required && $v.email.$error
                  ? { border: '1px solid red !important' }
                  : null,
              ]"
              class="mb-0 appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            />
            <sub
              class="text-danger"
              v-if="!$v.email.required && $v.email.$error"
            >
              Field is required
            </sub>
            <sub class="text-danger" v-if="!$v.email.email && $v.email.$error">
              Invalid email
            </sub>
          </div>
          <div class="mb-2">
            <label for="phone" class="font-Roboto">Phone Number</label>
            <input
              id="phone"
              v-model="$v.phone_number.$model"
              name="phone"
              type="tel"
              pattern="\(\d{3}\)[ ]?\d{3}[-]?\d{4}"
              title="US based Phone Number in the format of: (123) 456-7890"
              placeholder="(xxx) xxx-xxxx"
              v-bind:style="[
                !$v.phone_number.required && $v.phone_number.$error
                  ? { border: '1px solid red !important' }
                  : null,
              ]"
              class="mb-0 appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            />
            <sub
              class="text-danger"
              v-if="!$v.phone_number.required && $v.phone_number.$error"
            >
              Field is required
            </sub>
            <sub
              class="text-danger"
              v-if="!$v.phone_number.usphone && $v.phone_number.$error"
            >
              iNVALID PHONE
            </sub>
          </div>
          <label class="flex items-center">
            <input type="checkbox" class="form-checkbox" v-model="is_message" />
            <span class="ml-2">Receieve text messages </span>
          </label>
          <div class="mb-2">
            <label for="username" class="font-Roboto">Username</label>
            <input
              id="susername"
              v-model="$v.username.$model"
              name="username"
              required
              v-bind:style="[
                !$v.username.required && $v.username.$error
                  ? { border: '1px solid red !important' }
                  : null,
              ]"
              class="mb-0 appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            />
            <sub
              class="text-danger"
              v-if="!$v.username.required && $v.username.$error"
            >
              Field is required
            </sub>
          </div>
          <div class="mb-2">
            <label for="password" class="font-Roboto">Password</label>
            <input
              type="password"
              id="password"
              v-model="$v.password.$model"
              name="password"
              required
              v-bind:style="[
                !$v.password.required && $v.password.$error
                  ? { border: '1px solid red !important' }
                  : null,
              ]"
              class="mb-0 appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            />
            <sub
              class="text-danger"
              v-if="!$v.password.required && $v.password.$error"
            >
              Field is required
            </sub>
          </div>
          <div class="mb-2">
            <label for="confirm-password" class="font-Roboto"
              >Confirm Password</label
            >
            <input
              type="password"
              v-model="$v.password_confirmation.$model"
              id="confirm-password"
              name="confirm-password"
              v-bind:style="[
                !$v.password_confirmation.required &&
                $v.password_confirmation.$error
                  ? { border: '1px solid red !important' }
                  : null,
              ]"
              class="mb-0 appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            />
            <sub
              class="text-danger"
              v-if="
                !$v.password_confirmation.sameAsPassword &&
                $v.password_confirmation.$error
              "
            >
              Passwords must be identical.
            </sub>
          </div>
        </div>

        <!-- <p class="head2 font-Roboto" style="margin-top:0px">Your Tenant ID: {{username+school.toLowerCase()}}</p> -->

        <div style="margin-top: 8px">
          <button
            type="submit"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-sm text-white bg-blue hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            style="background: #216fed; border-radius: 3px"
            :disabled="loading"
          >
            {{ loading ? "Please Wait..." : "Create an Account" }}
          </button>
        </div>

        <p class="footer font-Roboto">
          Already have an account?
          <router-link :to="{ path: '/login' }"
            ><a href="JavaScript:void(0)">Sign in</a></router-link
          >
        </p>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import states from "states-us";
import { required, email, helpers, sameAs } from "vuelidate/lib/validators";
const usphone = helpers.regex("usphone", /^\(\d{3}\)[ ]?\d{3}[-]?\d{4}$/);
export default {
  name: "Register",

  components: {},
  data() {
    return {
      invalidState: false,
      randomStr: "",
      first_name: "",
      last_name: "",
      email: "",
      password: "",
      password_confirmation: "",
      username: "",
      phone_number: "",
      error: null,
      is_message: false,
      keepFirst: false,
      openOnFocus: false,
      name: "",
      selected: null,
      clearable: false,
      data: states,
      loading: false,
    };
  },
  mounted() {
    this.getRandomString(40);
  },
  computed: {
    filteredDataObj() {
      return this.data.filter((option) => {
        return (
          option.name
            .toString()
            .toLowerCase()
            .indexOf(this.name.toLowerCase()) >= 0
        );
      });
    },
  },
  methods: {
    getRandomString(length) {
      var randomChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
      var result = "";
      for (var i = 0; i < length; i++) {
        result += randomChars.charAt(
          Math.floor(Math.random() * randomChars.length)
        );
      }
      this.randomStr = result;
    },
    blur() {
      const body = {
        school: this.school,
      };
      console.log(body, "THIS>SCHOOL");

      axios
        .post("/api/checkschool", body)
        .then((res) => {
          console.log(res, "RES SCHOOL ID");
          this.school_id = res.data.data[0].school.name;
          console.log(res.data.data[0], "SCHOOL ID---");

          console.log(res.data.data[0].school.name, "SCHOOL ID");
        })
        .catch((err) => {
          console.log(err);
          console.log(err.response, "RESPOSNE ERR");
        });
    },
    IsValidSelection(value) {
      let x = this.data.find((v) => value === v.name);
      if (x) {
        return true;
      } else {
        return false;
      }
    },
    async handleSubmit() {
      //   this.loading = true;
      //   this.error = null;
      // if (!this.IsValidSelection(this.name)) {
      //   this.invalidState = true;
      //   return;
      // }
      try {
        const data = {
          email: this.email,
          username: this.username,
          first_name: this.first_name,
          last_name: this.last_name,
          is_message: this.is_message,
          phone_number: this.phone_number,
          password: this.password,
          password_confirmation: this.password_confirmation,
        };
        console.log(data);
        this.$v.$touch();
        if (!this.$v.$invalid) {
          const request = axios({
            method: "post",
            url: "/api/register",
            data: data,
            headers: {
              "X-XSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            },
          });
          request
            .then((res) => {
              let temp = res.data.data;
              this.$store.commit("user_state/setToken", temp[0].token);
              this.$router.push(`/tenants`);
              this.loading = false;
            })
            .catch((err) => {
              console.log(err);
              console.log(err.response, "RESPOSNE ERR");
              this.loading = false;
              if (
                err.response &&
                err.response.data.message &&
                err.response.data.message === "The given data was invalid."
              ) {
                if (err.response.data.validation_params_error) {
                  const obj = err.response.data.validation_params_error;
                  this.error = obj[Object.keys(obj)[0]][0];
                }
              } else {
                this.error = "Please complete the required fields below.";
              }
            });
        }
      } catch (e) {
        console.log(e, "ERRORd");
      }
    },
  },

  validations: {
    email: {
      required,
      email,
    },
    username: {
      required,
    },
    first_name: {
      required,
    },
    last_name: {
      required,
    },
    is_message: {
      required,
    },
    phone_number: {
      required,
      usphone,
    },
    password: {
      required,
    },
    password_confirmation: {
      sameAsPassword: sameAs("password"),
    },
  },
};
</script>

<style scoped lang="css">
.auth-container {
  background: #e5e5e5;
  width: 100%;
  /* height: 100vh; */
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: auto;
  padding: 20px;
}

.auth-box {
  background: #fff;
  border-radius: 19px;
}
.slogan {
  font-style: normal;
  font-weight: normal;
  font-size: 13px;
  line-height: 150%;
  /* or 27px */
  margin-top: 0px !important;

  letter-spacing: 0.02em;

  color: #000000;
}
.error {
  font-style: normal;
  font-weight: bold;
  font-size: 13px;
  /* line-height: 19px; */
  /* identical to box height */
  margin-top: 0px !important;
  margin-top: 4px !important;

  color: #ff0000;
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
.head {
  font-style: normal;
  font-weight: bold;
  font-size: 16px;
  /* line-height: 29px; */
  /* identical to box height */

  display: flex;
  align-items: center;
  color: #216fed;
  margin-bottom: 4px;
}
.head2 {
  font-style: normal;
  font-size: 14px;
  line-height: 29px;
  /* identical to box height */

  display: flex;
  align-items: center;

  color: #216fed;
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
input,
select {
  background: #ffffff;
  border: 1px solid rgba(152, 153, 154, 0.35);
  box-sizing: border-box;
  border-radius: 3px;
  margin: 10px 0px 10px;
  font-size: 14px;
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
