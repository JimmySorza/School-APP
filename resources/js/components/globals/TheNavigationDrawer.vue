<template>
  <!-- The Navigation Drawer -->
  <div class="the-navigation-drawer">
    <div class="py-4">
      <!-- Logo -->
      <div class="flex font-bold text-brand text-lg px-8">
        <img
          src="../../assets/images/school-trace-logo.png"
          class="mr-3"
          style="width: 25px; object-fit: contain"
        />

        School Trace
      </div>

      <!-- Avatar -->
      <div
        class="body-2 cursor-pointer flex items-center px-8 pt-6 -ml-1"
        @click="showSettingsProfileModal = true"
      >
        <BaseAvatar
          avatar="https://gravatar.com/avatar/2a26dc8d09602b40557b06e90ea2923f?s=400&d=robohash&r=x"
          class="mr-3"
        />

        <span>{{ getUserName }}</span>
      </div>
    </div>

    <BaseDivider :color="tailwindColors.grey.light" />

    <!-- Navigation Items -->
    <div class="the-navigation-drawer--items mt-3">
      <router-link
        v-for="(item, index) in navigationItems"
        :key="index"
        :to="{ name: item.path }"
        class="the-navigation-drawer--items--item"
        :class="{
          'the-navigation-drawer--items--item--selected': isItemSelected(item),
        }"
      >
        <i :class="item.icon" />
        {{ item.title }}
      </router-link>
    </div>

    <BaseDivider :color="tailwindColors.grey.light" class="my-3" />

    <!-- My School -->
    <div
      class="the-navigation-drawer--items--item"
      @click="showMySchoolModal = true"
    >
      <i class="fas fa-school" />
      My School
    </div>

    <!-- Logout -->
    <div class="the-navigation-drawer--items--item" v-on:click="logout">
      <i class="fas fa-door-open" />
      Logout
    </div>

    <!-- Settings Profile Modal -->
    <SettingsProfileModal
      v-if="showSettingsProfileModal"
      @close="showSettingsProfileModal = false"
    />

    <!-- My School Modal -->
    <SettingsMySchoolModal
      v-if="showMySchoolModal"
      @close="showMySchoolModal = false"
    />
  </div>
</template>

<script>
import SettingsProfileModal from '../settings/SettingsProfileModal'
import SettingsMySchoolModal from '../settings/SettingsMySchoolModal'

export default {
  name: 'TheNavigationDrawer',
  components: { SettingsMySchoolModal, SettingsProfileModal },
  data () {
    return {
      showMySchoolModal: false,
      navigationItems: [
        { path: 'TracesView', title: 'Traces', icon: 'fas fa-route', value: 'traces' },
        { path: 'StudentsView', title: 'Students', icon: 'fas fa-smile', value: 'students' },
        { path: 'TeachersView', title: 'Teachers', icon: 'fas fa-apple-alt', value: 'teachers' },
        { path: 'AdministratorsView', title: 'Administrators', icon: 'fas fa-globe', value: 'administrators' },
        { path: 'SubjectsView', title: 'Classes', icon: 'fas fa-chalkboard', value: 'subjects' }
      ],
      showSettingsProfileModal: false
    }
  },
  computed: {
    // Get User Name
    getUserName () {
      return 'Joanna Smith'
    }
  },
  methods: {
    isItemSelected (item) {
      return this.$route.path.includes(item.value)
    },
    logout(){
     this.$store.commit("user_state/delToken")
     this.$router.push("/")
    }
  }
}
</script>

<style scoped lang="sass">
.the-navigation-drawer
  min-height: 100%
  min-width: 240px
  @apply bg-white border-r border-grey-light fixed left-0 z-50

  &--items
    &--item
      min-height: 40px
      padding: 5px 28px
      transition: all 100ms ease-in
      @apply cursor-pointer body-1 flex items-center

      i
        @apply mr-3 text-center text-lg text-grey-default w-6

      &:hover
        @apply bg-grey-lightest

      &--selected
        font-weight: 500
        @apply bg-grey-lightest

        i
          @apply text-brand
</style>
