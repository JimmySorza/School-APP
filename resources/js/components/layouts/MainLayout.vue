<template>
  <!-- Main Layout -->
  <div class="main-layout">
    <slot />
  </div>
</template>

<script>
export default {
  name: 'MainLayout'
}
</script>

<style scoped lang="sass">
.main-layout
  padding: 24px
  @apply h-full w-full
</style>
