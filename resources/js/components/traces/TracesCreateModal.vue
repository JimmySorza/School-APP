<template>
  <!-- Traces Create Modal -->
  <BaseDrawer @close="$emit('close')">
    <!-- Title -->
    <div class="title-2">
      Create a Trace
    </div>

    <!-- Name of Trace -->
    <BaseInput
      label="Name of Trace"
      class="mt-10"
    />

    <div class="subtitle-1 mt-8">
      Who are you tracing?
    </div>

    <!-- Filter -->
    <BaseSingleSelect
      v-model="selectedFilter"
      :items="tracesFilters"
      class="mt-5 mb-3"
      label="People"
    />

    <!-- Choose Student -->
    <BaseSingleSelect
      v-model="selectedStudent"
      :items="['Matthew', 'Jessica']"
      placeholder="Choose student"
    />

    <!-- Create -->
    <BaseButton class="bg-brand text-white mt-10 ml-auto">
      Create
    </BaseButton>
  </BaseDrawer>
</template>

<script>
export default {
  name: 'TracesCreateModal',
  data () {
    return {
      tracesFilters: ['Filter by students', 'Filter by teachers', 'Filter by administrators', 'Filter by other stuff'],
      selectedFilter: 'Filter by students',
      selectedStudent: ''
    }
  }
}
</script>

<style scoped>

</style>
