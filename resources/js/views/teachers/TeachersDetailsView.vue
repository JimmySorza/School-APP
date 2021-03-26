<template>
  <!-- Teachers Details View -->
  <DetailsLayout>
    <template #details>
      <!-- Name + Risk -->
      <div class="flex items-center heading-1">
        <span v-if="!getPrivateMode">{{ getTeacher.name }}</span>
        <span v-else>{{ getTeacher.id_number }}</span>

        <BaseTag
          class="text-white capitalize ml-4"
          :class="getRiskLevelBackground(getTeacher.risk_level)"
        >
          {{ getTeacher.risk_level }} Risk
        </BaseTag>
      </div>

      <!-- Teacher Details -->
      <div v-if="!getPrivateMode">
        <!-- ID Number -->
        <div
          class="body-1 mb-8 mt-1"
        >
          ID Number: {{ getTeacher.id_number }}
        </div>

        <div class="flex items-center body-1 w-1/2">
          <div class="w-2/5">
            <i class="fas fa-apple-alt mr-2 w-5 text-center text-grey-default" />
            Teacher
          </div>

          <!-- Phone Number -->
          <div>
            <i class="fas fa-phone-alt mr-2 w-5 text-center text-grey-default" />

            <span v-if="getTeacher.phone_number">
              {{ getTeacher.phone_number }}
            </span>

            <span
              v-else
              class="text-grey-default"
            >
              Not on file
            </span>
          </div>
        </div>

        <div class="flex items-center body-1 w-1/2 mt-1">
          <!-- Email -->
          <div class="w-2/5">
            <i class="fas fa-envelope w-5 mr-2 text-center text-grey-default" />
            <span v-if="getTeacher.email">
              {{ getTeacher.email }}
            </span>

            <span
              v-else
              class="text-grey-default"
            >
              Not on file
            </span>
          </div>

          <!-- Address -->
          <div>
            <i class="fas fa-home mr-2 w-5 text-center text-grey-default" />
            <span v-if="getTeacher.address">
              {{ getTeacher.address }}
            </span>

            <span
              v-else
              class="text-grey-default"
            >
              Not on file
            </span>
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
          :tabs="getTeachersDetailsTabs"
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

      <!-- Teacher Traces -->
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

      <!-- Teacher Subjects -->
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
  name: 'TeachersDetailsView',
  components: { DetailsLayout },
  mixins: [RiskMixin],
  data () {
    return {
      selectedTab: '',
      sortBy: 'A-Z',
      subjects: [...Mock.subjects, ...Mock.subjects, ...Mock.subjects],
      subjectsHeaders: [
        { value: 'name', title: 'Class Name', show: true, style: 'width: 150px' },
        { value: 'room', title: 'Room', show: true, style: 'width: 100px' },
        { value: 'day_of_week', title: 'Day', show: true, style: 'width: 100px' },
        { value: 'time', title: 'Time', show: true, style: 'width: 150px' },
        { value: 'students', title: 'Students', show: true, style: 'width: 100px' },
        { value: 'teachers', title: 'Teachers', show: true, style: 'width: 100px' },
        { value: 'actions', style: 'width: 10px' }
      ],
      traces: Mock.traces.slice(0, 3),
      tracesHeaders: [
        { title: 'Trace Name', value: 'name', show: true, style: 'width: 150px' },
        { title: 'Person Traced', value: 'person_traced', show: true, style: 'width: 150px' },
        { title: 'Students in Contact', value: 'students_in_contact', show: true },
        { title: 'Teachers in Contact', value: 'teachers_in_contact', show: true },
        { title: 'Administrators in Contact', value: 'administrators_in_contact', show: true },
        { title: 'Impact Level', value: 'impact_level', show: true },
        { style: 'width: 10px', value: 'actions' }
      ]
    }
  },
  computed: {
    ...mapGetters(['getPrivateMode']),
    // Get Teacher
    getTeacher () {
      if (!this.$route.params.teacher) return {}
      return this.$route.params.teacher
    },
    getTeachersDetailsTabs () {
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
    this.selectedTab = this.getTeachersDetailsTabs[0]
  }
}
</script>

<style scoped>

</style>
