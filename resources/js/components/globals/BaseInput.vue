<template>
  <!-- Base Input -->
  <div class="base-input">
    <!-- Input Label -->
    <div
      v-if="label"
      class="base-input--label"
    >
      {{ label }}

      <!-- Required Star -->
      <span v-if="required">*</span>
    </div>

    <!-- Input -->
    <div
      class="base-input--wrapper"
      :class="getInputWrapperClasses"
    >
      <!-- Icon -->
      <i
        v-if="icon"
        :class="icon"
      />

      <input
        v-model="getValue"
        :disabled="disabled"
        :placeholder="placeholder"
        :type="inputType"
      >
    </div>

    <!-- Error -->
    <div
      v-if="error"
      class="base-input--error-message"
    >
      Field is required
    </div>
  </div>
</template>

<script>
export default {
  name: 'BaseInput',
  props: {

    // Is input disabled
    disabled: {
      required: false,
      type: Boolean
    },

    // Input has error
    error: {
      required: false,
      type: Boolean
    },

    // Input Icon
    icon: {
      default: '',
      required: false,
      type: String
    },

    // Value Type
    inputType: {
      default: 'text',
      required: false,
      type: String
    },

    // Input Label
    label: {
      default: '',
      required: false,
      type: String
    },

    max: {
      default: 9999999999,
      required: false,
      type: Number
    },

    min: {
      default: 0,
      required: false,
      type: Number
    },

    // Input Placeholder
    placeholder: {
      default: '',
      required: false,
      type: String
    },

    // Is Value Required
    required: {
      required: false,
      type: Boolean
    },

    search: {
      required: false,
      type: Boolean
    },
    // Input Value
    value: {
      default: '',
      required: false,
      type: [String, Number]
    }
  },
  computed: {
    // Value Model
    getValue: {
      get () {
        return this.value
      },
      set (val) {
        this.$emit('input', this.inputType === 'number' ? parseFloat(val) : val)
      }
    },
    // Get Input Wrapper Classes
    getInputWrapperClasses () {
      const classes = []

      // Add disabled Class
      if (this.disabled) classes.push('base-input--disabled')
      if (this.icon) classes.push('pl-7')

      // Add error class
      this.error ? classes.push('ab-border-red') : classes.push('ab-border-grey')
      if (this.search) {
        classes.push('base-input--search')
      }
      return classes
    }
  }
}
</script>

<style scoped lang="sass">
.base-input
  @apply w-full

  &--wrapper
    height: 36px
    @apply bg-white border border-grey-light flex items-center relative rounded

    input
      background: transparent !important
      height: 100%
      line-height: 36px
      text-overflow: ellipsis
      padding-left: 12px
      @apply body-1 border-none cursor-pointer outline-none overflow-hidden rounded w-full whitespace-nowrap

      &::-webkit-outer-spin-button,
      &::-webkit-inner-spin-button
        -webkit-appearance: none
        @apply m-0

      &[type=number]
        -moz-appearance: textfield

      &:focus
        @apply border-b border-brand

    i
      font-size: 15px
      padding-left: 15px
      transform: translateY(-1px)
      @apply absolute left-0 text-grey-default

  &--label
    font-size: 14px
    margin-bottom: 8px

    span
      color: red

  &--disabled
    background-color: #eeeeee

  &--search
    @apply bg-white border-grey-default rounded-full

  &--error-message
    color: red
    font-size: 12px
    margin-top: 5px
    position: absolute
</style>
