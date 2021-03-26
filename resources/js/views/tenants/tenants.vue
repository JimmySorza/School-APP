<template>
  <div class="mt-5 p-5 flex justify-center">
    <b-loading v-model="loading" :can-cancel="false"></b-loading>
    <!-- <div class="card">
      <div class="card-content p-2">
        <div class="content has-text-centered">
          <h3>Tenants</h3>
        </div>
      </div>
    </div>
    <div class="is-flex is-justify-content-center mt-5">
      <div
        v-for="(i, index) in schools"
        :key="index"
        class="card"
        style="width: 50%"
      >
        <div class="card-content">
          <div class="content has-text-centered">
            <h3>{{ i.school }}</h3>
          </div>
          <footer class="card-footer">
            <div class="card-footer-item">
              <button
                class="button is-fullwidth"
                style="background-color: #216fed; color: white"
                v-on:click="setTenant(i.id)"
              >
                Open
              </button>
            </div>
          </footer>
        </div>
      </div>
    </div> -->
    <div
      class="space-y-8 bg-white rounded-xl py-12 sm:px-32 px-6"
      style="box-shadow: 0px 2px 14px rgba(44, 48, 59, 0.08); width: 38%"
    >
      <div class="flex items-center mb-8">
        <img
          class="w-auto"
          src="../../assets/images/school-trace-logo.png"
          alt="Workflow"
        />
        <p class="logo font-Roboto">School Trace</p>
      </div>
      <h2 class="heading font-Roboto">Your schools</h2>
      <sup>Choose a school below to start covid tracing</sup>

      <div
        v-for="(i, index) in schools"
        :key="index"
        class="grid grid-cols-3 gap-2"
      >
        <div class="col-span-2">
          <img
            class="rounded-full inline mr-2 shadow-lg"
            width="50"
            src="https://www.designevo.com/res/templates/thumb_small/encircled-branches-and-book.png"
            alt=""
          />{{ i.school }}
        </div>

        <div class="flex justify-end">
          <b-button outlined type="is-info" v-on:click="setTenant(i.id)"
            >Open</b-button
          >
        </div>
      </div>
      <hr />
      <div class="grid grid-cols-3 gap-2">
        <div class="col-span-2">
          want to start covid tracing at a diffrent school?
        </div>

        <div class="flex justify-end">
          <b-button outlined type="is-info" @click="rschool"
            >Register school</b-button
          >
        </div>
      </div>
      <hr />
      <p class="footer font-Roboto">
        Not seeing your schools?
        <a href="JavaScript:void(0)" @click="logout"
          >Sign into another account</a
        >
      </p>
    </div>
  </div>
</template>
<script>
import loader from "../../mixins/loading";
import { mapState } from "vuex";
export default {
  name: "tenants",
  mixins: [loader],
  data() {
    return {
      columns: ["Name", "Actions"],
      data: [
        {
          name: "sa",
        },
      ],
      columns: [
        {
          field: "name",
          label: "Name",
        },
        {
          field: "action",
          label: "action",
        },
      ],
    };
  },
  methods: {
    setTenant(tenant) {
      this.$store.commit("school_state/setCurrent", tenant);
      this.$router.push(`/${tenant}/traces`);
    },
    rschool() {
      if (this.schools.length > 0) {
        this.$router.push({
          name: "RegisterSchoolView",
          params: { back: true },
        });
      } else {
        this.$router.push({
          name: "RegisterSchoolView",
          params: { back: false },
        });
      }
    },
    logout() {
      this.$store.commit("user_state/delToken");
      this.$router.push("/");
    },
  },
  computed: {
    ...mapState("school_state", ["schools"]),
  },
  created() {
    this.$store.commit("school_state/clearSchools");
    this.showLoader();
    this.$store
      .dispatch("school_state/GetSchools")
      .then((res) => {
        if (res.length === 1) {
          // this.$router.push(`/${res[0].id}/traces`);
        } else if (res.length === 0) {
          this.$router.push("/registerschool");
        }
        this.hideLoader();
      })
      .catch((err) => {
        console.log(err);
      });
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
