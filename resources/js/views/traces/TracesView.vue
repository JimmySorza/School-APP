<template>
  <!-- Traces View -->
  <MainLayout>
    <!-- Toolbar -->
    <div class="flex items-center justify-between w-full">
      <!-- Search -->
      <BaseInput
        placeholder="Search..."
        icon="fas fa-search"
        style="width: 300px"
      />

      <div class="flex">
        <!-- Import CSV -->
        <BaseButton
          text
          class="text-brand mr-3"
          @click="$router.push({ name: 'TracesImportCSVView'})"
        >
          <i class="fas fa-cloud-upload-alt mr-2" />
          Import CSV
        </BaseButton>

        <!-- Sort -->
        <BaseSingleSelect
          v-model="sortBy"
          style="width: 200px"
          class="mx-3"
          :items="['A-Z']"
        >
          <template #selected>
            <i class="fas fa-sort-amount-up mr-2" /> Sort By: {{ sortBy }}
          </template>
        </BaseSingleSelect>

        <!-- Create Trace -->
        <BaseButton
          class="bg-brand text-white"
          @click="showCreateTraceModal = true"
        >
          <i class="fas fa-plus mr-2" />
          Create Trace
        </BaseButton>
      </div>
    </div>

    <!-- Empty Placeholder -->
    <BaseEmptyPlaceholder v-if="!traces.length">
      <template #image>
        <i class="fas fa-image" />
      </template>

      <template #title>
        You haven’t created any traces yet.
      </template>

      <template #subtitle>
        To create your first trace click the “Create Trace” button in the right hand corner.
      </template>
    </BaseEmptyPlaceholder>

    <!-- Traces List -->
    <div
      v-else
      class="mt-10"
    >
      <BaseItemList
        :data="traces"
        :headers="tracesHeaders"
      >
        <!-- Impact Level -->
        <template #impact_level="{ item }">
          <div
            :class="getRiskLevelText(item.impact_level)"
            class="body-2 capitalize"
          >
            {{ item.impact_level }}
          </div>
        </template>

        <!-- Actions -->
        <template #actions>
          <div class="text-center">
            <i class="fas fa-ellipsis-h text-grey-default" />
          </div>
        </template>
      </BaseItemList>

      <!-- Pagination -->
      <BasePagination />
    </div>

    <!-- Create Trace Modal -->
    <TracesCreateModal
      v-if="showCreateTraceModal"
      @close="showCreateTraceModal = false"
    />
  </MainLayout>
</template>

<script>
import MainLayout from '../../components/layouts/MainLayout'
import Mock from '../../assets/mock'
import RiskMixin from '../../mixins/RiskMixin'
import TracesCreateModal from '../../components/traces/TracesCreateModal'

export default {
  name: 'TracesView',
  components: { TracesCreateModal, MainLayout },
  mixins: [RiskMixin],
  data () {
    return {
      sortBy: '',
      traces: Mock.traces,
      showCreateTraceModal: false,
      tracesHeaders: [
        { value: 'name', title: 'Trace Name', show: true, style: 'width: 150px' },
        { value: 'person_traced', title: 'Person Traced', show: true, style: 'width: 150px' },
        { value: 'students_in_contact', title: 'Students in Contact', show: true },
        { value: 'teachers_in_contact', title: 'Teachers in Contact', show: true },
        { value: 'administrators_in_contact', title: 'Administrators in Contact', show: true },
        { value: 'impact_level', title: 'Impact Level', show: true },
        { value: 'actions', style: 'width: 10px' }
      ]
    }
  }
}
</script>

<style scoped>

</style>
