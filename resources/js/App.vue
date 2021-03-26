<template>
  <!-- App -->
  <div id="app">
    <!-- The Navigation Drawer -->
    <TheNavigationDrawer v-if="this.$route.name!=='Login' && this.$route.name!=='RegisterSchoolView' && this.$route.name!=='Register' && this.$route.name!=='Reset' && this.$route.name!=='404' && this.$route.name!=='TenantsView' " />

    <!-- The Navbar -->
    <TheNavbar v-if="this.$route.name!=='Login'  && this.$route.name!=='RegisterSchoolView' && this.$route.name!=='Register' && this.$route.name!=='Reset' && this.$route.name!=='404'&& this.$route.name!=='TenantsView'" />

    <!-- Main Content -->
    <div :class="this.$route.name!=='Login' &&  this.$route.name!=='RegisterSchoolView'&& this.$route.name!=='Register' && this.$route.name!=='Reset' && this.$route.name!=='TenantsView' ? 'main-content' : 'auth-content' ">
      <transition
        name="fade"
        mode="out-in"
      >
        <router-view />
      </transition>
    </div>
  </div>
</template>

<script>
import TheNavigationDrawer from './components/globals/TheNavigationDrawer'
import TheNavbar from './components/globals/TheNavbar'
import {API_URL} from "./config"
export default {
  components: {
    TheNavbar,
    TheNavigationDrawer
  },
}
</script>

<style lang="sass">
#app
  font-family: Roboto, sans-serif
  min-height: 100vh
  @apply bg-background flex h-full text-black

.main-content
  margin-left: 240px
  margin-top: 60px
  @apply h-full w-full

.auth-content

  @apply h-full w-full

</style>
