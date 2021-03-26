<template>
  <!-- Base Single Select -->
  <div class="base-single-select">
    <!-- Label -->
    <div
      v-if="label"
      class="base-single-select--label"
    >
      {{ label }}
    </div>

    <!-- Input -->
    <div
      class="base-single-select--input"
      :class="{ 'border-brand': showDropdown, 'border-grey': !showDropdown, 'text-grey-darkest': disabled }"
      :disabled="disabled"
      @click="openDropdown"
    >
      <slot
        name="selected"
        :item="selected"
      >
        <div
          v-if="getSelectedValue"
          class="flex justify-center"
        >
          {{ getSelectedValue }}
        </div>

        <div
          v-else
          class="text-sm text-grey-default"
        >
          {{ placeholder }}
        </div>
      </slot>

      <div class="flex items-center ml-auto text-grey-default">
        <i
          v-if="clearable && selected"
          class="fas fa-close mr-4 mr-2"
          @click="$emit('remove')"
        />
        <i class="fas fa-caret-down right-0 mr-3" />
      </div>
    </div>

    <!-- Dropdown -->
    <div
      v-if="showDropdown"
      v-on-dismiss="{ watch: showDropdown, callback: closeDropdown }"
      class="base-single-select--dropdown"
      :class="{ 'border-brand': showDropdown, 'border-grey': !showDropdown }"
    >
      <div
        v-for="(item, index) in items"
        :key="index"
        class="base-single-select--dropdown--item"
        :class="{ 'base-single-select--dropdown--item--selected': isItemSelected(item) }"
        @click="selectItem(item)"
      >
        <slot
          name="item"
          :item="item"
        >
          <div v-if="typeof item === 'object'">
            {{ item.name }}
          </div>

          <div v-else>
            {{ item }}
          </div>
        </slot>
      </div>
    </div>
  </div>
</template>

<script>
import vueDismiss from '../../mixins/vueDismiss'

export default {
  name: 'BaseSingleSelect',
  mixins: [vueDismiss],
  model: {
    event: 'input',
    prop: 'selected'
  },
  props: {

    clearable: {
      required: false,
      type: Boolean
    },

    disabled: {
      required: false,
      type: Boolean
    },

    items: {
      default: () => [],
      required: false,
      type: Array
    },
    // Label
    label: {
      default: '',
      required: false,
      type: String
    },
    placeholder: {
      default: '',
      required: false,
      type: String
    },
    selected: {
      default: () => {},
      required: false,
      type: [Object, String, Number]
    }
  },
  data () {
    return {
      showDropdown: false
    }
  },
  computed: {
    getSelectedValue () {
      if (typeof this.selected === 'object' && Object.keys(this.selected).length) {
        return this.selected.name
      } else if (typeof this.selected === 'object' && !Object.keys(this.selected).length) {
        return ''
      } else {
        return this.selected
      }
    }
  },
  methods: {
    closeDropdown () {
      this.showDropdown = false
    },
    // Is Item Selected
    isItemSelected (item) {
      if (item && typeof item !== 'object') return this.selected === item
      return this.selected && this.selected.id === item && item.id
    },

    openDropdown () {
      if (!this.disabled) {
        this.showDropdown = true
      }
    },
    // Select Item
    selectItem (item) {
      setTimeout(() => {
        this.$emit('input', item)
        this.closeDropdown()
      }, 0)
    }
  }
}
</script>

<style scoped lang="sass">
.base-single-select
  @apply relative w-full

  &--label
    font-size: 14px
    @apply mb-3

    span
      color: red

  &--input
    border: 1px solid #EBEBEB
    border-radius: 3px
    height: 36px
    padding-left: 15px
    @apply cursor-pointer flex text-sm items-center w-full

    input
      background: transparent
      line-height: 42px
      padding-left: 10px !important
      text-overflow: ellipsis
      @apply border-none cursor-pointer outline-none overflow-hidden w-5/6 whitespace-nowrap

  &--actions
    color: #696969
    margin-top: 10px
    margin-right: 10px
    @apply absolute right-0 top-0

  &--dropdown
    animation: open 200ms ease-in
    margin-top: 3px
    max-height: 200px
    min-height: 30px
    z-index: 5000
    @apply absolute bg-white border border-grey-light rounded overflow-y-auto w-full

    &--item
      padding: 8px 16px
      @apply body-1 cursor-pointer flex items-center justify-between

      &:hover
        @apply bg-grey-lightest

      &--selected
        @apply bg-brand-light

        &:hover
          @apply bg-brand-light

  &--disabled
    background-color: grey

  &--error-message
    color: red
    font-size: 12px
    margin-top: 5px
    position: absolute

@keyframes open
  0%
    transform: translateY(-10px)
    opacity: 0

  100%
    transform: translateY(0)
    opacity: 1
</style>
