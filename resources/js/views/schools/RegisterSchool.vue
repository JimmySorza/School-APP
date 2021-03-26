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
      <router-link v-if="back" :to="{ path: '/tenants' }"
        ><a href="JavaScript:void(0)">
          <i class="fas fa-arrow-left"></i> Back to your schools</a
        ></router-link
      >
      <h2 class="heading font-Roboto">Register a school</h2>
      <sup
        >Enter in your school details so you can get started tracing covid</sup
      >

      <form
        class="space-y-6"
        action="JavaScript:void(0)"
        @submit.prevent="Submit"
      >
        <div class="rounded-md shadow-sm -space-y-px">
          <div style="mb-2">
            <label for="email-address" class="font-Roboto">School Name</label>
            <input
              v-model="$v.school.$model"
              autocomplete="username"
              v-bind:style="[
                !$v.school.required && $v.school.$error
                  ? { border: '1px solid red !important' }
                  : null,
              ]"
              class="mb-0 appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            />
            <sub
              class="text-danger"
              v-if="!$v.school.required && $v.school.$error"
            >
              Field is required
            </sub>
          </div>
          <div class="mt-2">
            <label for="state" class="font-Roboto">State</label>
            <b-autocomplete
              v-model="$v.state.$model"
              open-on-focus
              :data="filteredDataObj"
              @select="select"
              clearable
              style="margin-top: 10px"
              class="font-Roboto"
              v-bind:style="[
                !$v.state.required && $v.state.$error
                  ? { border: '1px solid red !important' }
                  : null,
              ]"
            >
            </b-autocomplete>
            <sub style="color: red" v-if="invalidState">Invalid state</sub>
            <sub
              class="text-danger"
              v-if="!$v.state.required && $v.state.$error"
            >
              Field is required
            </sub>
          </div>
          <div>
            <label for="email-address" class="font-Roboto">District</label>
            <input
              v-model="$v.district.$model"
              autocomplete="username"
              v-bind:style="[
                !$v.district.required && $v.district.$error
                  ? { border: '1px solid red !important' }
                  : null,
              ]"
              class="mb-0 appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            />
            <sub
              class="text-danger"
              v-if="!$v.district.required && $v.district.$error"
            >
              Field is required
            </sub>
          </div>
        </div>

        <div>
          <button
            type="submit"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-sm text-white bg-blue hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            style="background: #216fed; border-radius: 3px"
            :disabled="loading"
          >
            {{ loading ? "Please Wait..." : "Register" }}
          </button>
        </div>

        <p class="footer font-Roboto">
          Looking to access an existing school?
          <a href="JavaScript:void(0)" @click="logout"
            >sign in to another account</a
          >
        </p>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import states from "states-us";
import { required } from "vuelidate/lib/validators";
import loader from "../../mixins/loading";
export default {
  name: "RegisterSchool",
  mixins: [loader],
  components: {},
  props: ["back"],
  data() {
    return {
      loading: false,
      selected: null,
      states: null,
      school: "",
      state: "",
      district: "",
      invalidState: false,
    };
  },
  computed: {
    filteredDataObj() {
      return this.states.filter((option) => {
        return (
          option.toString().toLowerCase().indexOf(this.state.toLowerCase()) >= 0
        );
      });
    },
  },
  methods: {
    IsValidSelection(value) {
      let x = this.states.find((v) => value === v);
      if (x) {
        return true;
      } else {
        return false;
      }
    },
    Submit() {
      if (!this.IsValidSelection(this.state)) {
        this.invalidState = true;
      }
      let data = {
        school: this.school,
        state: this.state,
        district: this.district,
      };
      this.$v.$touch();
      if (!this.$v.$invalid) {
        this.showLoader();
        const request = axios({
          method: "post",
          url: "/api/addschool",
          data: data,
          headers: {
            "X-XSRF-TOKEN": document
              .querySelector('meta[name="csrf-token"]')
              .getAttribute("content"),
          },
        });
        request
          .then((res) => {
            this.$router.push("/tenants");
          })
          .catch((err) => {
            console.log(err);
          });
      }
    },
    clear() {
      this.state = "";
      this.school = "";
      this.district = "";
    },
    select(option) {
      this.selected = option;
      this.invalidState = false;
    },
    logout() {
      this.$store.commit("user_state/delToken");
      this.$router.push("/");
    },
  },
  created() {
    this.states = states.map((item) => {
      return item.name;
    });
  },
  validations: {
    school: {
      required,
    },
    state: {
      required,
    },
    district: {
      required,
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
