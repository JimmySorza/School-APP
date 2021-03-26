<template>
  <!-- Base Loading Spinner -->
  <div class="base-loading-spinner" />
</template>

<script>
export default {
  name: 'BaseLoadingSpinner'
}
</script>

<style scoped lang="sass">
.base-loading-spinner
  animation: spin 0.6s linear infinite
  border: 2px white solid
  border-top: 4px black solid
  width: 25px
  height: 25px
  @apply mx-auto rounded-full

@keyframes spin
  0%
    transform: rotate(0deg)

  100%
    transform: rotate(360deg)
</style>
