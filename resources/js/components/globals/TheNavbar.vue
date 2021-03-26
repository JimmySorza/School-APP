<template>
  <!-- The Navbar -->
  <div class="the-navbar">
    <BaseBreadcrumbs :breadcrumbs="getBreadcrumbs" />

    <BaseToggle
      v-model="privacyMode"
      label="Privacy Mode"
    />
  </div>
</template>

<script>
export default {
  name: 'TheNavbar',
  computed: {
    privacyMode: {
      get () {
        return this.$store.state.getPrivateMode
      },
      set (val) {
        this.$store.commit('SET_PRIVATE_MODE', val)
      }
    },
    // Get Breadcrumbs
    getBreadcrumbs () {
      return this.$route.meta.breadcrumbs
    }
  }
}
</script>

<style scoped lang="sass">
.the-navbar
  height: 60px
  margin-left: 240px
  padding: 0 24px
  width: calc(100vw - 240px)
  @apply bg-white border-b border-grey-light flex fixed items-center justify-between top-0 z-30
</style>
