<template>
  <!-- Classes Seat Organizer -->
  <div class="classes-seat-organizer">
    <!-- Config -->
    <div class="classes-seat-organizer--config">
      <!-- Seats Config -->
      <div class="subtitle-1">
        Seats
      </div>

      <div class="flex my-4">
        <!-- Rows -->
        <BaseInput
          :key="componentKey"
          label="Rows"
          class="mr-2"
          input-type="number"
          :max="maxRowsAmount"
          :min="1"
          :value="rowsAmount"
          @input="handleUpdateRows"
        />

        <!-- Columns -->
        <BaseInput
          :key="componentKey + 2"
          label="Columns"
          class="mr-2"
          input-type="number"
          :max="maxColumnsAmount"
          :min="1"
          :value="columnsAmount"
          @input="handleUpdateColumns"
        />
      </div>

      <!-- Students List -->
      <div class="subtitle-1 mt-8">
        Students
      </div>

      <div class="body-1 mt-1 mb-6">
        Drag and drop your students into their designated seat.
      </div>

      <VueDraggable
        v-if="studentsList.length"
        v-model="studentsList"
        class="overflow-auto pr-1"
        style="height: 230px"
        :group="{ name: 'student', pull: 'clone', put: true }"
        handle=".handle"
      >
        <div
          v-for="element in studentsList"
          :key="element.id"
          style="min-width: 100% !important"
          class="classes-seat-organizer--seats--student mb-2"
        >
          <i class="cursor-pointer fa fa-arrows-alt handle mr-3 text-grey-default" />

          {{ element.name }}
        </div>
      </VueDraggable>

      <div v-else>
        No students found.
      </div>
    </div>

    <!-- Seats -->
    <div class="classes-seat-organizer--seats">
      <div class="flex body-1 text-grey-default">
        <div class="mx-auto">
          Front of Classroom
        </div>

        <div
          class="absolute cursor-pointer right-0 mr-6"
          @click="resetConfig"
        >
          <i class="fas fa-undo mr-1" />
          Reset
        </div>
      </div>

      <!-- Columns -->
      <VueDraggable
        v-model="columns"
        class="flex mt-8 w-full"
        style="height: 400px; overflow: auto"
        group="column"
      >
        <div
          v-for="(column, columnIndex) in columns"
          :key="columnIndex"
          class="flex flex-col flex-1 items-center mx-2 w-full"
          :style="{ width: `calc(80% / ${ columns.length }`}"
        >
          <i class="cursor-pointer fa fa-arrows-alt handle text-grey-default" />

          <VueDraggable
            v-for="(row, rowIndex) in rows"
            :key="rowIndex"
            class="flex flex-col pa-3 ml-3 my-3 w-full"
          >
            <VueDraggable
              v-model="students[columnIndex][rowIndex]"
              :group="{ name: 'student', clone: true, pull: true }"
              :class="{
                'classes-seat-organizer--seats--placeholder': !getStudentName(columnIndex, rowIndex),
                'classes-seat-organizer--seats--student': getStudentName(columnIndex, rowIndex)
              }"
              handle=".handle"
              ghost-class="ghost-class"
              @add="(add) => handleAdd(add, columnIndex, rowIndex)"
            >
              <i
                v-if="getStudentName(columnIndex, rowIndex)"
                class="cursor-pointer fa fa-arrows-alt handle mr-3 text-grey-default"
              />

              {{ getStudentName(columnIndex, rowIndex) }}
            </VueDraggable>
          </VueDraggable>
        </div>
      </VueDraggable>
    </div>
  </div>
</template>

<script>
import VueDraggable from 'vuedraggable'

export default {
  name: 'SubjectsSeatOrganizer',
  components: {
    VueDraggable
  },
  data () {
    return {
      students: [[], [], [], [], [], []],
      studentsList: [
        { id: 1, name: 'Addy Hemming Long Name jfkdsjafkdjskafjka' },
        { id: 2, name: 'Bailey Stoll' },
        { id: 3, name: 'Barbra Teslap' },
        { id: 4, name: 'Carly Smith' },
        { id: 5, name: 'Addy Hemming' },
        { id: 1, name: 'Addy Hemming Long Name jfkdsjafkdjskafjka' },
        { id: 2, name: 'Bailey Stoll' },
        { id: 3, name: 'Barbra Teslap' },
        { id: 4, name: 'Carly Smith' },
        { id: 5, name: 'Addy Hemming' }
      ],
      rows: [],
      columns: [],
      rowsAmount: 6,
      columnsAmount: 6,
      maxRowsAmount: 50,
      maxColumnsAmount: 50,
      componentKey: 0
    }
  },
  mounted () {
    this.generateRowsAndColumns()
  },
  methods: {
    // Reset Config
    resetConfig () {
      this.rows = 4
      this.columns = 3
    },
    // Generate Rows And Columns
    generateRowsAndColumns () {
      this.rows = Array(6).fill({}, 0, 6)
      this.columns = Array(6).fill({}, 0, 6)
    },
    // Handle Update Rows
    handleUpdateRows (newValue) {
      if (newValue > this.maxRowsAmount) {
        this.rows = this.maxRowsAmount
        this.rowsAmount = this.maxRowsAmount
      } else if (newValue <= 1) {
        this.rows = [{}]
        this.rowsAmount = 1
      } else {
        this.rows = newValue
        this.rowsAmount = newValue
      }

      this.componentKey++
    },
    // Handle Update Columns
    handleUpdateColumns (newValue) {
      if (newValue > this.maxColumnsAmount) {
        if (this.columns.length !== this.maxColumnsAmount) {
          this.columns.fill({}, this.columns.length, this.maxColumnsAmount)
        }

        this.columnsAmount = this.maxColumnsAmount
      } else if (newValue <= 1) {
        this.columns = [{}]
        this.columnsAmount = 1
      } else {
        this.columns = newValue
        this.columnsAmount = newValue
      }

      this.componentKey++
    },
    handleAdd (element, column, row) {
      this.$set(this.students[column], row, [this.studentsList[element.oldIndex]])
      this.studentsList.splice(element.oldIndex, 1)
    },
    getStudentName (column, row) {
      return this.students[column][row] && this.students[column][row][0] ? this.students[column][row][0].name : ''
    }
  }
}
</script>

<style scoped lang="sass">
.classes-seat-organizer
  height: 486px
  @apply bg-white border border-grey-light flex relative rounded w-full

  &--config
    padding: 18px
    height: 100%
    min-width: 300px
    max-width: 300px
    @apply border-r border-grey-light

  &--seats
    padding: 26px
    @apply w-full

    &--student
      height: 36px
      padding: 8px 12px
      text-overflow: ellipsis
      white-space: nowrap
      @apply body-1 border border-grey-light overflow-hidden rounded

    &--placeholder
      height: 36px
      @apply border border-grey-light border-dashed bg-grey-lightest rounded

.ghost-class
  @apply border border-brand border-dashed bg-brand-light
</style>
