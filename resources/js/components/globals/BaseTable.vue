<template>
  <!-- Base Table -->
  <table class="base-table">
    <!-- Mobile Header -->
    <thead
      v-if="$scopedSlots.mobile && shouldShowMobile"
      class="base-table--head--mobile"
    >
      <tr>
        <!-- Table Headers -->
        <th
          class="base-table--header"
        >
          Table
        </th>
      </tr>
    </thead>

    <!-- Table Head -->
    <thead
      v-else
      class="base-table--head"
    >
      <tr>
        <!-- Table Headers -->
        <th
          v-for="header in headers"
          :key="header.id"
          :class="[header.class]"
          :style="header.style"
          class="base-table--header"
        >
          <div class="ab-flex">
            {{ header.title }}

            <div
              v-if="header.sortable"
              class="ab-flex-col"
            >
              <i class="fas fa-caret-up" />
              <i class="fas fa-caret-down" />
            </div>
          </div>
        </th>
      </tr>
    </thead>

    <!-- Mobile Body -->
    <tbody
      v-if="shouldShowMobile && $scopedSlots['mobile']"
    >
      <tr
        v-for="(row, index) in data"
        :key="index"
        class="base-table--row"
      >
        <td
          :colspan="1"
          class="p-3"
        >
          <slot
            name="mobile"
            :item="row"
          />
        </td>
      </tr>
    </tbody>

    <!-- Table Body -->
    <tbody
      v-else
      class="base-table--body"
    >
      <tr>
        <td
          v-if="!data.length"
          :colspan="headers.length"
          class="base-table--no-data"
        >
          <slot
            v-if="$scopedSlots['no-data']"
            name="no-data"
          />

          <div v-else>
            No data found
          </div>
        </td>
      </tr>

      <!-- Table Rows -->
      <tr
        v-for="(row, index) in data"
        :key="index"
        class="base-table--row"
      >
        <!-- Table Cells -->
        <td
          v-for="header in headers"
          :key="header.id"
          class="base-table--cell"
        >
          <!-- Slot For Cell -->
          <slot
            v-if="$scopedSlots[header.value]"
            :name="header.value"
            :item="row"
          />

          <!-- Default Value -->
          <div v-else>
            {{ row[header.value] }}
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  name: 'BaseTable',
  props: {
    // Table Headers
    headers: {
      type: Array,
      required: false,
      default: () => []
    },
    // Table Data
    data: {
      type: Array,
      required: false,
      default: () => []
    },
    // Sortable
    sortable: {
      type: Boolean,
      required: false,
      default: false
    },
    // Sorting
    sort: {
      type: Object,
      required: false,
      default: () => {}
    }
  },
  data () {
    return {
      windowWidth: 0
    }
  },
  computed: {
    shouldShowMobile () {
      return this.windowWidth < 900
    }
  },
  created () {
    window.addEventListener('resize', this.handleResize)
    this.handleResize()
  },
  destroyed () {
    window.removeEventListener('resize', this.handleResize)
  },
  methods: {
    // Handle Resize
    handleResize () {
      this.windowWidth = window.innerWidth
    }
  }
}
</script>

<style scoped lang="sass">
table
  background-color: transparent !important
  border-collapse: collapse
  width: 100%

tbody
  border: none !important
  background-color: transparent !important

.base-table
  border: none !important
  max-width: 100vw
  overflow-x: auto

  &--header
    font-size: 12px
    min-width: max-content
    letter-spacing: 0.5px
    padding: 8px 15px
    position: sticky
    text-align: left
    top: 0
    @apply bg-grey-light

    div
      align-items: center
      display: flex
      justify-content: space-between

    i
      cursor: pointer

  &--row
    border-bottom: 1px solid #d4d4d4

  &--cell
    background-color: transparent !important
    border: none !important
    color: #444444 !important
    font-size: 14px
    padding: 15px 15px

  &--no-data
    background-color: transparent !important
    height: 200px
    font-size: 18px
    padding: 50px 0
    text-align: center
</style>
