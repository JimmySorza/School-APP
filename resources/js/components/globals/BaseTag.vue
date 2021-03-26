<template>
  <!-- Base Tag -->
  <div class="base-tag">
    <slot />
  </div>
</template>

<script>
export default {
  name: 'BaseTag'
}
</script>

<style scoped lang="sass">
.base-tag
  font-size: 12px
  font-weight: 500
  padding: 6px 10px
  height: 25px
  @apply flex items-center justify-center rounded
</style>
