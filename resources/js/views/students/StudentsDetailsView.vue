<template>
  <!-- Students Details View -->
  <DetailsLayout>
    <template #details>
      <!-- Name + Risk Level -->
      <div class="flex items-center heading-1">
        <span v-if="!getPrivateMode">{{ getStudent.name }}</span>
        <span v-else>{{ getStudent.id_number }}</span>

        <BaseTag
          class="text-white capitalize ml-4"
          :class="getRiskLevelBackground(getStudent.risk_level)"
        >
          {{ getStudent.risk_level }} Risk
        </BaseTag>
      </div>

      <!-- Student Details -->
      <div v-if="!getPrivateMode">
        <!-- ID Number -->
        <div class="body-1 mb-8 mt-1">
          ID Number: {{ getStudent.id_number }}
        </div>

        <div class="flex items-center body-1 w-1/2">
          <div class="w-2/5">
            <i class="fas fa-smile mr-2 w-5 text-center text-grey-default" />
            Student
          </div>

          <!-- Phone Number -->
          <div>
            <i class="fas fa-phone-alt mr-2 w-5 text-center text-grey-default" />
            {{ getStudent.phone_number }}
          </div>
        </div>

        <div class="flex items-center body-1 w-1/2 mt-1">
          <!-- Email -->
          <div class="w-2/5">
            <i class="fas fa-envelope w-5 mr-2 text-center text-grey-default" />
            {{ getStudent.email }}
          </div>

          <!-- Address -->
          <div>
            <i class="fas fa-home mr-2 w-5 text-center text-grey-default" />
            {{ getStudent.address }}
          </div>
        </div>
      </div>

      <!-- Privacy Mode Message -->
      <div
        v-else
        class="body-1 mt-8"
      >
        <i class="fas fa-lock mr-2 w-5 text-center text-grey-default" />
        Turn off privacy mode to view contact details
      </div>
    </template>

    <template #content>
      <div class="flex items-center justify-between mb-8">
        <BaseTabs
          v-model="selectedTab"
          class="w-1/2"
          :tabs="getStudentsDetailsTabs"
        />

        <!-- Sort -->
        <BaseSingleSelect
          v-model="sortBy"
          style="width: 200px"
          :items="['A-Z']"
        >
          <template #selected>
            <i class="fas fa-sort-amount-up mr-2" /> Sort By: {{ sortBy }}
          </template>
        </BaseSingleSelect>
      </div>

      <!-- Student Traces -->
      <div v-if="selectedTab.value === 'traces'">
        <BaseItemList
          v-if="traces.length"
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
            <div
              class="text-center"
            >
              <i class="fas fa-ellipsis-h text-grey-default" />
            </div>
          </template>
        </BaseItemList>

        <BasePagination v-if="traces.length" />

        <div
          v-else
          class="text-grey-default title-1 py-48 text-center h-full"
        >
          No Traces in File
        </div>
      </div>

      <!-- Student Classes -->
      <div v-else>
        <BaseItemList
          v-if="subjects.length"
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

        <BasePagination v-if="subjects.length" />

        <div
          v-else
          class="text-grey-default title-1 py-48 text-center h-full"
        >
          No Classes in File
        </div>
      </div>
    </template>
  </DetailsLayout>
</template>

<script>
import DetailsLayout from '../../components/layouts/DetailsLayout'
import Mock from '../../assets/mock'
import RiskMixin from '../../mixins/RiskMixin'
import { mapGetters } from 'vuex'

export default {
  name: 'StudentsDetailsView',
  components: { DetailsLayout },
  mixins: [RiskMixin],
  data () {
    return {
      selectedTab: '',
      sortBy: 'A-Z',
      subjects: [...Mock.subjects, ...Mock.subjects, ...Mock.subjects],
      traces: Mock.traces.slice(0, 4),
      subjectsHeaders: [
        { value: 'name', title: 'Class Name', show: true, style: 'width: 150px' },
        { value: 'room', title: 'Room', show: true, style: 'width: 100px' },
        { value: 'day_of_week', title: 'Day', show: true, style: 'width: 100px' },
        { value: 'time', title: 'Time', show: true, style: 'width: 150px' },
        { value: 'students', title: 'Students', show: true, style: 'width: 100px' },
        { value: 'teachers', title: 'Teachers', show: true, style: 'width: 100px' },
        { value: 'actions', style: 'width: 10px' }
      ],
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
  },
  computed: {
    ...mapGetters(['getPrivateMode']),
    // Get Student
    getStudent () {
      if (!this.$route.params.student) return {}
      return this.$route.params.student
    },
    getStudentsDetailsTabs () {
      return [
        {
          text: `Traces (${this.traces.length})`,
          value: 'traces'
        },
        {
          text: `Classes (${this.subjects.length})`,
          value: 'subjects'
        }
      ]
    }
  },
  mounted () {
    this.selectedTab = this.getStudentsDetailsTabs[0]
  }
}
</script>

<style scoped>

</style>
