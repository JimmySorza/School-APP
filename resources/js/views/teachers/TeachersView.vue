<template>
  <!-- Teachers View -->
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
          @click="$router.push({ name: 'TeachersImportCSVView' })"
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

        <!-- Create Teacher -->
        <BaseButton
          class="bg-brand text-white"
          @click="showCreateTeacherModal = true"
        >
          <i class="fas fa-plus mr-2" />
          Add Teacher
        </BaseButton>
      </div>
    </div>

    <!-- Empty Placeholder -->
    <BaseEmptyPlaceholder v-if="!teachers.length">
      <template #image>
        <i class="fas fa-image" />
      </template>

      <template #title>
        You haven’t added any teachers yet.
      </template>

      <template #subtitle>
        To add your first teacher click the “Add Teacher” button in the right
        hand corner.
      </template>
    </BaseEmptyPlaceholder>

    <!-- Teachers List -->
    <div v-else class="mt-10">
      <BaseItemList :data="teachers" :headers="teachersHeaders">
        <!-- Phone Number -->
        <template #phone_number="{ item }">
          <div v-if="item.phone_number">
            {{ item.phone_number }}
          </div>

          <div v-else class="text-grey-default">
            Not on file
          </div>
        </template>

        <!-- Email -->
        <template #email="{ item }">
          <div v-if="item.email">
            {{ item.email }}
          </div>

          <div v-else class="text-grey-default">
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
            @click="
              $router.push({
                name: 'TeachersDetailsView',
                params: { id: item.id, teacher: item },
              })
            "
          >
            <i class="fas fa-ellipsis-h text-grey-default" />
          </div>
        </template>
      </BaseItemList>

      <!-- Pagination -->
      <BasePagination />
    </div>

    <!-- Create Teacher Modal -->
    <TeachersCreateModal
      v-if="showCreateTeacherModal"
      @close="showCreateTeacherModal = false"
      @add="addCallback"
    />
  </MainLayout>
</template>

<script>
import MainLayout from '../../components/layouts/MainLayout'
import RiskMixin from '../../mixins/RiskMixin'
import TeachersCreateModal from '../../components/teachers/TeachersCreateModal'
import { createNamespacedHelpers } from 'vuex'
const { mapState, mapActions } = createNamespacedHelpers('teacher')

export default {
  name: 'TeachersView',
  components: { TeachersCreateModal, MainLayout },
  mixins: [RiskMixin],
  created() {
    this.getAll()
  },
  computed: {
    ...mapState({ teachers: (state) => state.data }),
  },
  data() {
    return {
      sortBy: '',
      showCreateTeacherModal: false,
      teachersHeaders: [
        {
          value: 'name',
          title: 'Teacher Name',
          show: true,
          style: 'width: 150px',
        },
        {
          value: 'id_number',
          title: 'ID Number',
          show: true,
          style: 'width: 100px',
        },
        {
          value: 'phone_number',
          title: 'Phone Number',
          show: true,
          style: 'width: 100px',
        },
        { value: 'email', title: 'Email', show: true, style: 'width: 150px' },
        {
          value: 'classes_amount',
          title: 'Classes',
          show: true,
          style: 'width: 100px',
        },
        { value: 'traces_amount', title: 'Traces', show: true },
        { value: 'risk_level', title: 'Risk Level', show: true },
        { value: 'actions', style: 'width: 10px' },
      ],
      error: null,
      loading: false,
    }
  },
  methods: {
    ...mapActions(['getAll', 'create']),
    async addCallback(data) {
      this.create(data)
      this.getAll()
    },
  },
}
</script>

<style scoped></style>
