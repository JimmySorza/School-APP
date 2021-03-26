<template>
  <!-- Base Item List -->
  <div class="base-item-list">
    <!-- Item List -->
    <div
      v-for="item in data"
      :key="item.id"
      class="base-item-list--item"
      :class="getItemClass(item)"
    >
      <div class="flex w-full items-center">
        <!-- Headers List -->
        <div
          v-for="(header, headerIndex) in headers"
          :key="headerIndex"
          class="base-item-list--item--section"
          :style="header.style"
          :class="header.class"
        >
          <div>
            <!-- Header -->
            <div
              v-if="header.show"
              class="base-item-list--item--section--title"
            >
              {{ header.title }}
            </div>

            <!-- Value Slot -->
            <slot
              :item="item"
              :name="header.value"
            >
              <div class="z-50">
                {{ item[header.value] }}
              </div>
            </slot>
          </div>
        </div>
      </div>

      <div
        v-if="expanded.includes(item._id)"
        class="w-full"
      >
        <!-- Item List -->
        <div
          v-for="(children, childrenIndex) in item.children"
          :key="childrenIndex"
          class="flex items-center mt-5 border-t border-grey w-full"
        >
          <div class="flex w-full items-center">
            <!-- Headers List -->
            <div
              v-for="(header, headerIndex) in headers"
              :key="headerIndex"
              :style="header.style"
              class="base-item-list--item--section pt-5 pb-2"
            >
              <!-- Value Slot -->
              <slot
                :item="children"
                :name="`expanded.${header.value}`"
              >
                <div class="z-50">
                  {{ children[header.value] }}
                </div>
              </slot>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'BaseItemList',
  props: {
    // List Data
    data: {
      default: () => [],
      required: false,
      type: Array
    },

    expanded: {
      default: () => [],
      required: false,
      type: Array
    },

    // List Headers
    headers: {
      default: () => [],
      required: false,
      type: Array
    },
    // Selected Item
    selected: {
      default: () => {},
      required: false,
      type: Object
    }
  },
  methods: {
    // Get Item Class
    getItemClass (item) {
      if (!this.selected) return 'border-grey'
      return item._id === this.selected._id ? 'border-brand' : 'border-grey'
    },
    emitClick (item, e) {
      this.$emit('click', item)
      e.stopPropagation()
    }
  }
}
</script>

<style scoped lang="sass">
.base-item-list
  &--item
    transition: all 100ms ease-in
    @apply bg-white border border-grey-light body-1 flex flex-col items-center justify-between rounded mb-3 py-4 px-5

    &:hover
      @apply cursor-pointer

    &--section
      @apply flex flex-col flex-grow

      &--title
        @apply body-1 mb-1 text-grey-default
</style>
