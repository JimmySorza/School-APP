<template>
  <!-- Base Accept Modal -->
  <div class="base-accept-modal">
    <!-- Modal Card -->
    <div class="base-accept-modal--card">
      <div class="base-accept-modal--card--content">
        <!-- Card Title -->
        <div class="base-accept-modal--card--title">
          <slot name="title" />
        </div>

        <!-- Card Body -->
        <div class="base-accept-modal--card--body">
          <slot name="body" />
        </div>
      </div>

      <!-- Card Actions -->
      <div class="base-accept-modal--card--actions">
        <slot name="actions" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'BaseAcceptModal',
  mounted () {
    document.body.style.width = '100%'
    document.body.style.position = 'fixed'
    document.body.style.top = `-${window.scrollY}px`
  },
  destroyed () {
    document.body.style.position = ''
    document.body.style.top = ''
  }
}
</script>

<style scoped lang="sass">
.base-accept-modal
  @apply bg-shadow fixed flex h-screen items-center justify-center left-0 rounded top-0 w-screen z-50

  &--card
    min-height: 220px
    min-width: 220px
    max-width: 560px

    &--content
      border-radius: 4px 4px 0 0
      height: calc(100% - 68px)
      padding: 40px 24px
      @apply bg-white

    &--title
      @apply title-2

    &--body
      @apply body-1 mt-5

    &--actions
      border-radius: 0 0 4px 4px
      height: 68px
      @apply bg-grey-light border-t border-grey-default flex items-center justify-end px-5 w-full
</style>
