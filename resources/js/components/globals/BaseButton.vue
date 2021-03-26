<template>
  <!-- Base Button -->
  <button
    :type="type"
    class="base-button"
    :class="getBaseButtonClasses"
    :disabled="disabled"
    @click="emitClick"
  >
    <slot v-if="!loading" />

    <BaseLoadingSpinner v-else />
  </button>
</template>

<script>
export default {
  name: 'BaseButton',
  props: {

    // Is Button Disabled
    disabled: {
      required: false,
      type: Boolean
    },

    // Loading State
    loading: {
      required: false,
      type: Boolean
    },

    // Outlined
    outlined: {
      required: false,
      type: Boolean
    },

    // Outlined small
    outlinedSm: {
      required: false,
      type: Boolean
    },

    // Pill
    pill: {
      required: false,
      type: Boolean
    },

    // Primary Style
    primary: {
      required: false,
      type: Boolean
    },

    // Text
    text: {
      required: false,
      type: Boolean
    },

    type: {
      default: 'button',
      required: false,
      type: String
    }
  },
  computed: {
    // Get Button Classes
    getBaseButtonClasses () {
      const classes = []

      if (this.primary) classes.push('base-button--primary')
      if (this.pill) classes.push('base-button--pill')
      if (this.outlined) classes.push('base-button--outlined')
      if (this.outlinedSm) classes.push('base-button--outlined-sm')
      if (this.disabled) classes.push('base-button--disabled')
      if (this.text) classes.push('base-button--text')

      return classes
    }
  },
  methods: {
    emitClick (e) {
      this.$emit('click')
    }
  }
}
</script>

<style scoped lang="sass">
.base-button
  transition: all 0.1s ease-in
  white-space: nowrap
  padding: 6px 18px
  font-weight: 500
  @apply body-1 flex items-center justify-center rounded outline-none

  &--primary
    @apply bg-brand text-white

  &--text
    background: none !important
    border: none !important
    @apply px-0

  &--pill
    font-size: 16px
    @apply border-2 border-brand text-black py-2 px-10 rounded-full

    &:hover
      @apply bg-brand text-white

  &--outlined
    font-size: 16px
    @apply border bg-white text-brand py-2 px-5 rounded-full

  &--outlined-sm
    font-size: 12px
    @apply border border-brand bg-white text-brand py-2 px-3 rounded-full

  &--disabled
    color: #AFAFAF !important
    background: none !important
    @apply cursor-text border-grey-default

  &--disable, &--text
    background-color: transparent !important
</style>
