<template>
  <!-- Base Breadcrumbs -->
  <div class="base-breadcrumbs">
    <router-link
      v-for="(breadcrumb, index) in breadcrumbs"
      :key="index"
      :to="{ name: breadcrumb.path }"
      class="base-breadcrumbs--item"
    >
      <!-- Title -->
      <div
        v-if="!breadcrumb.last"
        class="flex items-center capitalize"
      >
        {{ breadcrumb.title }}
      </div>

      <!-- Last Breadcrumb -->
      <div
        v-else
        class="flex items-center capitalize"
      >
        {{ breadcrumb.title }}
      </div>

      <!-- Divider -->
      <div
        v-if="index !== breadcrumbs.length - 1"
        class="mx-3"
      >
        /
      </div>
    </router-link>
  </div>
</template>

<script>
export default {
  name: 'BaseBreadcrumbs',
  props: {
    // Breadcrumbs List
    breadcrumbs: {
      type: Array,
      required: false,
      default: () => []
    }
  }
}
</script>

<style scoped lang="sass">
.base-breadcrumbs
  @apply flex

  &--item
    @apply body-2 flex text-grey-default

    &:last-child
      @apply text-black
</style>
