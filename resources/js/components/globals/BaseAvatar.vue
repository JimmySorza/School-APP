<template>
  <!-- Base Avatar -->
  <div
    class="base-avatar"
    :style="getAvatarStyle"
  >
    <!-- Placeholder -->
    <i
      v-if="!avatar"
      class="fas fa-camera base-avatar--placeholder"
    />

    <!-- Image -->
    <img
      v-else
      :src="avatar"
    >
  </div>
</template>

<script>
export default {
  name: 'BaseAvatar',
  props: {
    // Avatar
    avatar: {
      default: '',
      required: false,
      type: String
    },
    // Size
    size: {
      default: 30,
      required: false,
      type: Number
    }
  },
  computed: {
    // Get Avatar Style
    getAvatarStyle () {
      return {
        height: this.size + 'px',
        width: this.size + 'px'
      }
    }
  }
}
</script>

<style scoped lang="sass">
.base-avatar
  @apply rounded-full

  &--placeholder
    @apply bg-grey-default border border-grey-default flex h-full items-center justify-center rounded-full text-white w-full

  img
    @apply border border-grey-default h-full object-cover rounded-full w-full
</style>
