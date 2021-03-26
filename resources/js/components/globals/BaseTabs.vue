<template>
  <!-- Base Tabs -->
  <div class="base-tabs">
    <div
      v-for="(tab, index) in tabs"
      :key="index"
      class="base-tabs--item"
      :class="{ 'base-tabs--selected': isTabSelected(tab) }"
      @click="selectTab(tab)"
    >
      {{ tab.text }}
    </div>
  </div>
</template>

<script>
export default {
  name: 'BaseTabs',
  props: {
    // Tabs List
    tabs: {
      default: () => [],
      required: false,
      type: Array
    },
    // Tab Selected
    value: {
      default: () => {},
      required: false,
      type: Object
    }
  },
  methods: {
    // Check if tab is selected
    isTabSelected (tab) {
      return this.value?.value === tab.value
    },
    selectTab (tab) {
      this.$emit('input', tab)
    }
  }
}
</script>

<style scoped lang="sass">
.base-tabs
  @apply flex pr-5

  &--item
    padding-bottom: 1px
    transition: all 100ms ease-in
    @apply border-b border-transparent cursor-pointer body-1 mr-4

    &:hover
      @apply bg-grey-lightest

  &--selected
    @apply border-b-2 border-brand text-brand
</style>
