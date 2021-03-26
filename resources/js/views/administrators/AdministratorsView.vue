<template>
  <!-- Administrators View -->
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
          @click="$router.push({ name: 'AdministratorsImportCSVView' })"
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

        <!-- Create Administrator -->
        <BaseButton
          class="bg-brand text-white"
          @click="showCreateAdministratorModal = true"
        >
          <i class="fas fa-plus mr-2" />
          Add Administrator
        </BaseButton>
      </div>
    </div>

    <!-- Empty Placeholder -->
    <BaseEmptyPlaceholder v-if="!administrators.length">
      <template #image>
        <i class="fas fa-image" />
      </template>

      <template #title>
        You haven’t added any administrators yet.
      </template>

      <template #subtitle>
        To add your first administrator click the “Add Administrator” button in the right hand corner.
      </template>
    </BaseEmptyPlaceholder>

    <!-- Administrators List -->
    <div
      v-else
      class="mt-10"
    >
      <BaseItemList
        :data="administrators"
        :headers="administratorsHeaders"
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
            @click="$router.replace({ name: 'AdministratorsDetailsView', params: { id: item.id, administrator: item } })"
          >
            <i class="fas fa-ellipsis-h text-grey-default" />
          </div>
        </template>
      </BaseItemList>

      <!-- Pagination -->
      <BasePagination />
    </div>

    <!-- Create Administrator Modal -->
    <AdministratorsCreateModal
      v-if="showCreateAdministratorModal"
      @close="showCreateAdministratorModal = false"
      @add="addCallback"
    />
  </MainLayout>
</template>

<script>
import MainLayout from '../../components/layouts/MainLayout'
import AdministratorsCreateModal from '../../components/administrators/AdministratorsCreateModal'
import RiskMixin from '../../mixins/RiskMixin'
// import Mock from '../../assets/mock'
import { createNamespacedHelpers } from 'vuex'
const { mapState, mapActions } = createNamespacedHelpers('administrator')


export default {
  name: 'AdministratorsView',
  components: { AdministratorsCreateModal, MainLayout },
  mixins: [RiskMixin],    
  created () {
    // console.log(this.$route.params.tenant_id);
    this.getAll()
  },
  computed: {
    ...mapState({ administrators: (state) => state.data}),
  },
  data () {
    return {
      // administrators: Mock.administrators,
      administratorsHeaders: [
        { title: 'Administrator Name', show: true, value: 'name', style: 'width: 150px' },
        { title: 'ID Number', show: true, value: 'id_number', style: 'width: 100px' },
        { title: 'Phone Number', show: true, value: 'phone_number', style: 'width: 100px' },
        { title: 'Email', show: true, value: 'email', style: 'width: 150px' },
        { title: 'Classes', show: true, value: 'classes_amount', style: 'width: 100px' },
        { title: 'Traces', show: true, value: 'traces_amount' },
        { title: 'Risk Level', show: true, value: 'risk_level' },
        { style: 'width: 10px', value: 'actions' }
      ],
      showCreateAdministratorModal: false,
      sortBy: ''
    }
  },
  methods: {
    ...mapActions(['getAll', 'create']),
    async addCallback(data) {
      console.log(data);
      this.create(data)
      this.getAll();
    },
  }
}
</script>

<style scoped>

</style>
