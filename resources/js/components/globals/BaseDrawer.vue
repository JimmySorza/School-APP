<template>
  <!-- Base Navigation Drawer -->
  <div class="base-navigation-drawer">
    <!-- Card -->
    <div class="base-navigation-drawer--card">
      <slot />

      <!-- Close -->
      <i
        class="fas fa-times base-navigation-drawer--close"
        @click="$emit('close')"
      />
    </div>
  </div>
</template>

<script>
export default {
  name: 'BaseDrawer'
}
</script>

<style scoped lang="sass">
.base-navigation-drawer
  z-index: 5000
  @apply bg-shadow fixed top-0 left-0 w-screen h-screen

  &--card
    animation: appearRight 150ms ease-in
    max-width: 450px
    min-width: 450px
    padding: 30px
    @apply bg-white border border-grey-light fixed bottom-0 right-0 top-0 overflow-auto

  &--close
    height: 30px
    margin: 30px
    width: 30px
    @apply absolute cursor-pointer flex items-center justify-center right-0 text-grey-default top-0 text-2xl

@keyframes appearRight
  0%
    transform: translateX(450px)

  100%
    transform: translateX(0)
</style>
