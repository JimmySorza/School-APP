<template>
  <!-- Details Layout -->
  <div class="details-layout">
    <div
      class="details-layout--details"
      :style="getDetailsStyle"
    >
      <slot name="details" />
    </div>

    <div class="details-layout--content">
      <slot name="content" />
    </div>
  </div>
</template>

<script>
export default {
  name: 'DetailsLayout',
  data () {
    return {
      scrollY: 0
    }
  },
  computed: {
    // Get Details Style
    getDetailsStyle () {
      if (this.scrollY > 30) {
        return {
          paddingTop: '70px'
        }
      }
      return ''
    }
  },
  destroyed () {
    window.removeEventListener('scroll', (e) => e)
  },
  mounted () {
    window.addEventListener('scroll', (e) => {
      this.scrollY = window.pageYOffset
    })
  }
}
</script>

<style scoped lang="sass">
.details-layout
  &--details
    padding: 24px 24px
    transition: all 100ms ease-in
    @apply bg-white border-b border-grey-light sticky top-0 z-20

  &--content
    padding: 24px
    @apply bg-background
</style>
