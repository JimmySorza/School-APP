<template>
  <!-- Subjects View -->
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
          @click="$router.push({ name: 'SubjectsImportCSVView'})"
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

        <!-- Create Class -->
        <BaseButton
          class="bg-brand text-white"
          @click="showCreateClassModal = true"
        >
          <i class="fas fa-plus mr-2" />
          Add Class
        </BaseButton>
      </div>
    </div>

    <!-- Empty Placeholder -->
    <BaseEmptyPlaceholder v-if="!subjects.length">
      <template #image>
        <i class="fas fa-image" />
      </template>

      <template #title>
        You haven’t added any classes yet.
      </template>

      <template #subtitle>
        To add your first class click the “Add Class” button in the right hand corner.
      </template>
    </BaseEmptyPlaceholder>

    <!-- Subjects List -->
    <div
      v-else
      class="mt-10"
    >
      <BaseItemList
        :data="subjects"
        :headers="subjectsHeaders"
      >
        <template #teachers="{ item }">
          <div class="overflow-ellipsis">
            {{ item.teachers }}
          </div>
        </template>

        <!-- Actions -->
        <template #actions="{ item }">
          <div
            class="text-center"
            @click="$router.push({ name: 'SubjectsDetailsView', params: { id: item.id, subject: item } })"
          >
            <i class="fas fa-ellipsis-h text-grey-default" />
          </div>
        </template>
      </BaseItemList>

      <!-- Pagination -->
      <BasePagination />
    </div>

    <!-- Create Class Modal -->
    <SubjectsCreateModal
      v-if="showCreateClassModal"
      @close="showCreateClassModal = false"
    />
  </MainLayout>
</template>

<script>
import MainLayout from '../../components/layouts/MainLayout'
import Mock from '../../assets/mock'
import SubjectsCreateModal from '../../components/subjects/SubjectsCreateModal'

export default {
  name: 'SubjectsView',
  components: { SubjectsCreateModal, MainLayout },
  data () {
    return {
      subjects: Mock.subjects,
      subjectsHeaders: [
        { show: true, style: 'width: 200px', title: 'Class Name', value: 'name' },
        { show: true, style: 'width: 80px', title: 'Room', value: 'room' },
        { show: true, style: 'width: 100px', title: 'Day', value: 'day_of_week' },
        { show: true, style: 'width: 150px', title: 'Time', value: 'time' },
        { show: true, style: 'width: 100px', title: 'Students', value: 'students' },
        { show: true, title: 'Teachers', value: 'teachers' },
        { style: 'width: 10px', value: 'actions' }
      ],
      showCreateClassModal: false,
      sortBy: ''
    }
  }
}
</script>

<style scoped>

</style>
