<template>
  <!-- Subjects Details View -->
  <DetailsLayout>
    <template #details>
      <div class="heading-1 mb-8">
        {{ getSubject.name }}
      </div>

      <div class="flex items-center body-1 w-1/2">
        <div class="w-2/5">
          <i class="fas fa-door-open mr-2 w-5 text-center text-grey-default" />
          {{ getSubject.room }}
        </div>

        <div>
          <i class="fas fa-clock mr-2 w-5 text-center text-grey-default" />
          {{ getSubject.time }}
        </div>
      </div>

      <div class="flex items-center mt-3 body-1 w-1/2">
        <div class="w-2/5">
          <i class="fas fa-calendar w-5 mr-2 text-center text-grey-default" />
          {{ getSubject.day_of_week }}
        </div>
      </div>
    </template>

    <template #content>
      <div class="flex items-center justify-between mb-8 relative">
        <BaseTabs
          v-model="selectedTab"
          class="w-1/2"
          :tabs="getSubjectsDetailsTabs"
        />

        <!-- Sort -->
        <BaseSingleSelect
          v-if="selectedTab.value !== 'seating_chart'"
          v-model="sortBy"
          style="width: 200px; height: 10px; position: absolute; top: 0; right: 0; margin-top: -5px"
          :items="['A-Z']"
        >
          <template #selected>
            <i class="fas fa-sort-amount-up mr-2" /> Sort By: {{ sortBy }}
          </template>
        </BaseSingleSelect>
      </div>

      <!-- Subject Students -->
      <div v-if="selectedTab.value === 'students'">
        <BaseItemList
          v-if="students.length"
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
              @click="$router.push({ name: 'StudentsDetailsView', params: { id: item.id, subject: item } })"
            >
              <i class="fas fa-ellipsis-h text-grey-default" />
            </div>
          </template>
        </BaseItemList>

        <BasePagination v-if="students.length" />

        <div
          v-else
          class="text-grey-default title-1 py-48 text-center h-full"
        >
          No Students in File
        </div>
      </div>

      <!-- Subject Teachers -->
      <div v-else-if="selectedTab.value === 'teachers'">
        <BaseItemList
          v-if="teachers.length"
          :data="teachers"
          :headers="teachersHeaders"
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
              @click="$router.push({ name: 'TeachersDetailsView', params: { id: item.id, subject: item } })"
            >
              <i class="fas fa-ellipsis-h text-grey-default" />
            </div>
          </template>
        </BaseItemList>

        <BasePagination v-if="teachers.length" />

        <div
          v-else
          class="text-grey-default title-1 py-48 text-center h-full"
        >
          No Teachers in File
        </div>
      </div>

      <!-- Seat Organizer -->
      <SubjectsSeatOrganizer v-else />
    </template>
  </DetailsLayout>
</template>

<script>
import DetailsLayout from '../../components/layouts/DetailsLayout'
import SubjectsSeatOrganizer from '../../components/subjects/SubjectsSeatOrganizer'
import Mock from '../../assets/mock'
import RiskMixin from '../../mixins/RiskMixin'

export default {
  name: 'SubjectsDetailsView',
  components: { SubjectsSeatOrganizer, DetailsLayout },
  mixins: [RiskMixin],
  data () {
    return {
      selectedTab: {},
      sortBy: '',
      students: Mock.students.slice(0, 3),
      teachers: Mock.teachers.slice(0, 5),
      studentsHeaders: [
        { value: 'name', title: 'Student Name', show: true, style: 'width: 150px' },
        { value: 'id_number', title: 'ID Number', show: true, style: 'width: 100px' },
        { value: 'phone_number', title: 'Phone Number', show: true, style: 'width: 100px' },
        { value: 'email', title: 'Email', show: true, style: 'width: 150px' },
        { value: 'classes_amount', title: 'Classes', show: true, style: 'width: 100px' },
        { value: 'traces_amount', title: 'Traces', show: true },
        { value: 'risk_level', title: 'Risk Level', show: true },
        { value: 'actions', style: 'width: 10px' }
      ],
      teachersHeaders: [
        { value: 'name', title: 'Teacher Name', show: true, style: 'width: 150px' },
        { value: 'id_number', title: 'ID Number', show: true, style: 'width: 100px' },
        { value: 'phone_number', title: 'Phone Number', show: true, style: 'width: 100px' },
        { value: 'email', title: 'Email', show: true, style: 'width: 150px' },
        { value: 'classes_amount', title: 'Classes', show: true, style: 'width: 100px' },
        { value: 'traces_amount', title: 'Traces', show: true },
        { value: 'risk_level', title: 'Risk Level', show: true },
        { value: 'actions', style: 'width: 10px' }
      ]
    }
  },
  computed: {
    // Get Subject
    getSubject () {
      if (!this.$route.params.subject) return {}
      return this.$route.params.subject
    },
    getSubjectsDetailsTabs () {
      return [
        {
          text: `Students (${this.students.length})`,
          value: 'students'
        },
        {
          text: `Teachers (${this.teachers.length})`,
          value: 'teachers'
        },
        {
          text: 'Seating Chart',
          value: 'seating_chart'
        }
      ]
    }
  },
  mounted () {
    this.selectedTab = this.getSubjectsDetailsTabs[0]
  }
}
</script>

<style scoped>

</style>
