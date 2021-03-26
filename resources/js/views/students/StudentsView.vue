<template>
  <!-- Students View -->
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
          @click="$router.push({ name: 'StudentsImportCSVView'})"
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

        <!-- Create Student -->
        <BaseButton
          class="bg-brand text-white"
          @click="showCreateStudentModal = true"
        >
          <i class="fas fa-plus mr-2" />
          Add Student
        </BaseButton>
      </div>
    </div>

    <!-- Empty Placeholder -->
    <BaseEmptyPlaceholder v-if="!students.length">
      <template #image>
        <i class="fas fa-image" />
      </template>

      <template #title>
        You haven’t added any students yet.
      </template>

      <template #subtitle>
        To add your first student click the “Add Student” button in the right hand corner.
      </template>
    </BaseEmptyPlaceholder>

    <!-- Students List -->
    <div
      v-else
      class="mt-10"
    >
      <BaseItemList
        :data="students"
        :headers="studentsHeaders"
      >
        <!-- Phone Number -->
        <template #phone_number="{ item }">
          <div
            v-if="item.phone_number"
          >
            {{ item.phone_number }}
          </div>

          <div
            v-else
            class="text-grey-default"
          >
            Not on file
          </div>
        </template>

        <!-- Email -->
        <template #email="{ item }">
          <div
            v-if="item.email"
          >
            {{ item.email }}
          </div>

          <div
            v-else
            class="text-grey-default"
          >
            Not on file
          </div>
        </template>

        <!-- Risk Level -->
        <template #risk_level="{ item }">
          <div
            :class="getRiskLevelText(item.risk_level)"
            class="body-2 capitalize"
          >
            {{ item.risk_level }}
          </div>
        </template>

        <!-- Actions -->
        <template #actions="{ item }">
          <div
            class="text-center"
            @click="$router.push({ name: 'StudentsDetailsView', params: { id: item.id, student: item } })"
          >
            <i class="fas fa-ellipsis-h text-grey-default" />
          </div>
        </template>
      </BaseItemList>

      <!-- Pagination -->
      <BasePagination />
    </div>

    <!-- Create Student Modal -->
    <StudentsCreateModal
      v-if="showCreateStudentModal"
      @close="showCreateStudentModal = false"
    />
  </MainLayout>
</template>

<script>
import MainLayout from '../../components/layouts/MainLayout'
import StudentsCreateModal from '../../components/students/StudentsCreateModal'
import RiskMixin from '../../mixins/RiskMixin'
import Mock from '../../assets/mock'

export default {
  name: 'StudentsView',
  components: { StudentsCreateModal, MainLayout },
  mixins: [RiskMixin],
  data () {
    return {
      sortBy: '',
      students: Mock.students,
      showCreateStudentModal: false,
      studentsHeaders: [
        { value: 'name', title: 'Student Name', show: true, style: 'width: 150px' },
        { value: 'id_number', title: 'ID Number', show: true, style: 'width: 100px' },
        { value: 'phone_number', title: 'Phone Number', show: true, style: 'width: 100px' },
        { value: 'email', title: 'Email', show: true, style: 'width: 150px' },
        { value: 'classes_amount', title: 'Classes', show: true, style: 'width: 100px' },
        { value: 'traces_amount', title: 'Traces', show: true },
        { value: 'risk_level', title: 'Risk Level', show: true },
        { value: 'actions', style: 'width: 10px' }
      ]
    }
  }
}
</script>

<style scoped>

</style>
