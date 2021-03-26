<template>
  <label
    :class="{ 'active': isActive }"
    class="base-toggle"
  >
    <input
      v-model="checkedValue"
      type="checkbox"
      :disabled="disabled"
    >
    <span class="toggle__switch" />

    <span
      v-if="label"
      class="base-toggle--label"
    >
      {{ label }}
    </span>
  </label>
</template>

<script>
export default {
  name: 'BaseToggle',
  props: {
    disabled: {
      default: false,
      type: Boolean
    },
    label: {
      default: '',
      required: false,
      type: String
    },
    value: {
      default: false,
      type: Boolean
    }
  },
  data () {
    return {
      currentState: this.value
    }
  },
  computed: {
    checkedValue: {
      get () {
        return this.currentState
      },
      set (newValue) {
        this.currentState = newValue
        this.$emit('input', newValue)
      }
    },
    isActive () {
      return this.currentState
    }
  },
  watch: {
    value () {
      this.currentState = Boolean(this.value)
    }
  }
}
</script>

<style scoped lang="sass">
.base-toggle
  vertical-align: middle
  user-select: none
  cursor: pointer
  @apply flex

  &--label
    @apply body-2 ml-3

.base-toggle input[type="checkbox"]
  opacity: 0
  position: absolute
  width: 1px
  height: 1px

.base-toggle .toggle__switch
  display: inline-block
  height: 21px
  border-radius: 10px
  width: 34px
  background: #BFC3D3
  box-shadow: inset 0 0 1px #BFCBD9
  position: relative
  transition: all .25s

.base-toggle .toggle__switch::after,
.base-toggle .toggle__switch::before
  content: ""
  position: absolute
  display: block
  height: 21px
  width: 21px
  border-radius: 50%
  left: 0
  top: 0
  transform: translateX(0)
  transition: all .25s cubic-bezier(.5, -.6, .5, 1.6)

.base-toggle .toggle__switch::after
  background: white
  box-shadow: 0 0 1px #666

.base-toggle .toggle__switch::before
  background: #EAEAEA
  box-shadow: 0 0 0 3px rgba(0,0,0,0.1)
  opacity: 0

.active .toggle__switch
  background: #216FED
  box-shadow: inset 0 0 1px #216FED

.active .toggle__switch::after,
.active .toggle__switch::before
  transform: translateX(0px)

.active .toggle__switch::after
  left: 15px
  background: white
  border: 2px solid #216FED
</style>
