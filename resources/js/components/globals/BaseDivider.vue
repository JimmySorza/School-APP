<template>
  <!-- Base Divider -->
  <div
    class="base-divider"
    :class="{ 'border-grey': !color }"
    :style="{ 'borderColor': color }"
  />
</template>

<script>
export default {
  name: 'BaseDivider',
  props: {
    // Divider Color
    color: {
      default: '',
      required: false,
      type: String
    }
  }
}
</script>

<style scoped lang="sass">
.base-divider
  @apply border-b
</style>
