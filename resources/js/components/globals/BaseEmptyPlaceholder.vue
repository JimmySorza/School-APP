<template>
  <!-- Base Empty Placeholder -->
  <div class="base-empty-placeholder">
    <!-- Image -->
    <div class="base-empty-placeholder--image">
      <slot name="image" />
    </div>

    <!-- Title -->
    <div class="base-empty-placeholder--title">
      <slot name="title" />
    </div>

    <!-- Subtitle -->
    <div class="base-empty-placeholder--subtitle">
      <slot name="subtitle" />
    </div>
  </div>
</template>

<script>
export default {
  name: 'BaseEmptyPlaceholder'
}
</script>

<style scoped lang="sass">
.base-empty-placeholder
  @apply flex flex-col items-center py-48 text-center

  &--image
    font-size: 48px
    width: 184px
    height: 176px
    @apply border border-dashed border-grey-default flex items-center justify-center mb-10 rounded text-grey-default

  &--title
    @apply title-1

  &--subtitle
    @apply body-1 mt-1
</style>
