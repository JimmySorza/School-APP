<template>
  <!-- Base Pagination -->
  <div class="base-pagination">
    <!-- Left -->
    <div
      :disabled="isFirstPage"
      class="base-pagination--arrow"
      :class="{ 'base-pagination--arrow--disabled': isFirstPage }"
      @click="goPreviousPage"
    >
      <i class="fas fa-chevron-left" />
    </div>

    <!-- Pages -->
    <div
      v-for="page in getPages"
      :key="page"
      class="base-pagination--page"
      :class="{ 'base-pagination--page--selected': page === currentPage }"
      @click="goToPage(page)"
    >
      {{ page }}
    </div>

    <!-- Right -->
    <div
      :disabled="isLastPage"
      class="base-pagination--arrow"
      :class="{ 'base-pagination--arrow--disabled': isLastPage }"
      @click="goNextPage"
    >
      <i class="fas fa-chevron-right" />
    </div>
  </div>
</template>

<script>
export default {
  name: 'BasePagination',
  props: {
    // Current Page
    currentPage: {
      default: 1,
      required: false,
      type: Number
    },
    // Pages Amount
    pages: {
      default: 1,
      required: false,
      type: Number
    }
  },
  computed: {
    // Is First Page
    isFirstPage () {
      return this.currentPage === 1
    },
    // Is Last Page
    isLastPage () {
      return this.currentPage === this.pages
    },
    getPages () {
      const pages = []

      for (let i = 1; i <= this.pages; i++) {
        pages.push(i)
      }

      if (this.currentPage > 0 && this.currentPage < 4) {
        return pages.slice(0, 5)
      } else if (this.currentPage + 2 < this.pages) {
        return pages.slice(this.currentPage - 3, this.currentPage + 2)
      } else {
        return pages.slice(this.pages - 5, this.pages)
      }
    }
  },
  methods: {

    // Go To Next Page
    goNextPage () {
      if (!this.isLastPage) {
        this.$emit('goNextPage')
      }
    },

    // Go To Previous Page
    goPreviousPage () {
      if (!this.isFirstPage) {
        this.$emit('goPreviousPage')
      }
    },

    // Go To Page
    goToPage (page) {
      this.$emit('goToPage', page)
    }
  }
}
</script>

<style scoped lang="sass">
.base-pagination
  align-items: center
  display: flex
  margin-top: 25px
  margin-left: auto
  font-size: 14px
  justify-content: space-between
  width: max-content

  &--page
    align-items: center
    cursor: pointer
    display: flex
    justify-content: center
    height: 20px
    margin: 0 5px
    width: 20px

    &--selected
      @apply text-brand

  &--arrow
    color: #A4B0BE
    align-items: center
    cursor: pointer
    display: flex
    height: 30px
    justify-content: center
    margin: 0 10px
    transition: all 0.2s ease-in
    width: 30px

    &:not(&--disabled):hover
      background: #d2d2d2

    &--disabled
      cursor: not-allowed
</style>
