<template>
  <!-- Classes Create Modal -->
  <BaseDrawer @close="$emit('close')">
    <!-- Title -->
    <div class="title-2">
      Add Class
    </div>

    <div class="subtitle-1 mt-8">
      Details
    </div>

    <!-- Class Name -->
    <BaseInput
      label="Class Name"
      class="mt-10"
    />

    <!-- Room -->
    <BaseInput
      label="Room"
      class="my-5"
    />

    <!-- Day -->
    <BaseSingleSelect
      :items="['Monday']"
      class="my-5"
      label="Day"
      placeholder="Select One"
    />

    <!-- Time -->
    <BaseInput
      label="Time"
      class="my-5"
    />

    <div class="subtitle-1 mt-8 mb-4">
      Students
    </div>

    <!-- Choose Student -->
    <div
      v-for="(student, studentIndex) in students"
      :key="studentIndex"
      class="flex items-center mb-3"
    >
      <BaseSingleSelect
        v-model="students[studentIndex]"
        :items="getStudentsList"
        placeholder="Choose student"
        class="mr-3"
      >
        <template #selected="{ item }">
          {{ item.name }}
        </template>
      </BaseSingleSelect>

      <i
        v-if="students.length > 1"
        class="cursor-pointer fas fa-times text-lg text-danger"
        @click="handleRemoveItem('students', studentIndex)"
      />
    </div>

    <BaseButton
      v-if="getStudentsList.length"
      text
      class="text-brand mt-2"
      @click="students.push({})"
    >
      <i class="fas fa-plus mr-2" />

      Add Another Student
    </BaseButton>

    <div class="subtitle-1 mt-8 mb-4">
      Teachers
    </div>

    <!-- Choose Teacher -->
    <div
      v-for="(teacher, teacherIndex) in teachers"
      :key="teacherIndex"
      class="flex items-center mb-3"
    >
      <BaseSingleSelect
        v-model="teachers[teacherIndex]"
        :items="getTeachersList"
        placeholder="Choose teacher"
        class="mr-3"
      >
        <template #selected="{ item }">
          {{ item.name }}
        </template>
      </BaseSingleSelect>

      <i
        v-if="teachers.length > 1"
        class="cursor-pointer fas fa-times text-lg text-danger"
        @click="handleRemoveItem('teachers', teacherIndex)"
      />
    </div>

    <BaseButton
      text
      class="text-brand mt-2"
      @click="teachers.push({})"
    >
      <i class="fas fa-plus mr-2" />

      Add Another Teacher
    </BaseButton>

    <!-- Administrators -->
    <div class="subtitle-1 mt-8 mb-4">
      Administrators
    </div>

    <!-- Choose Administrator -->
    <div
      v-for="(administrator, administratorIndex) in administrators"
      :key="administratorIndex"
      class="flex items-center mb-3"
    >
      <BaseSingleSelect
        v-model="administrators[administratorIndex]"
        :items="getAdministratorsList"
        placeholder="Choose administrator"
        class="mr-3"
      >
        <template #selected="{ item }">
          {{ item.name }}
        </template>
      </BaseSingleSelect>

      <i
        v-if="administrators.length > 1"
        class="cursor-pointer fas fa-times text-lg text-danger"
        @click="handleRemoveItem('administrators', administratorIndex)"
      />
    </div>

    <BaseButton
      text
      class="text-brand mt-2"
      @click="administrators.push({})"
    >
      <i class="fas fa-plus mr-2" />

      Add Another Administrator
    </BaseButton>

    <!-- Create -->
    <BaseButton class="bg-brand text-white mt-10 ml-auto">
      Create
    </BaseButton>
  </BaseDrawer>
</template>

<script>
import Mock from '../../assets/mock'

export default {
  name: 'SubjectsCreateModal',
  data () {
    return {
      studentsList: [],
      teachersList: [],
      administratorsList: [],
      students: [{}],
      teachers: [{}],
      administrators: [{}]
    }
  },
  computed: {
    // Get Students Remaining List
    getStudentsList () {
      return this.studentsList.filter(student => !this.students.find(s => s.id === student.id))
    },
    // Get Teachers List
    getTeachersList () {
      return this.teachersList.filter(teacher => !this.teachers.find(s => s.id === teacher.id))
    },
    // Get Administrator List
    getAdministratorsList () {
      return this.administratorsList.filter(administrator => !this.administrators.find(s => s.id === administrator.id))
    }
  },
  mounted () {
    this.studentsList = Mock.students
    this.teachersList = Mock.teachers
    this.administratorsList = Mock.administrators
  },
  methods: {
    // Handle Remove Item
    handleRemoveItem (type, item) {
      this[type].splice(item, 1)
    }
  }
}
</script>

<style scoped>

</style>
