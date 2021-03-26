<template>
  <!-- Base CSV Upload View -->
  <MainLayout>
    <div class="flex justify-between">
      <div class="title-1">
        Import CSV File
      </div>

      <div class="flex items-center">
        <BaseButton
          text
          class="text-brand mr-3"
          @click="$router.go(-1)"
        >
          Cancel
        </BaseButton>

        <BaseButton class="bg-brand text-white">
          Publish
        </BaseButton>
      </div>
    </div>

    <!-- Step 1 -->
    <div class="flex-spread mt-10">
      <!-- Title -->
      <h2 class="subtitle-2">
        Step 1: Upload CSV
      </h2>
    </div>

    <!-- CSV Upload -->
    <BaseCSVUpload
      v-model="csvData"
      class="mt-5"
    />

    <!-- Step 2 -->
    <div class="flex-spread mt-10">
      <h2 class="subtitle-2">
        Step 2: Review Upload and Publish
      </h2>
    </div>

    <!-- Imports Message -->
    <div
      v-if="csvData.length"
      class="my-5"
    >
      Importing {{ getCSVTableData.length }} total records and {{ getCSVTableHeaders.length }} fields.
    </div>

    <!-- Table Data -->
    <BaseTable
      v-if="csvData.length"
      :data="getCSVTableData"
      :headers="getCSVTableHeaders"
    />
  </MainLayout>
</template>

<script>
import MainLayout from '../layouts/MainLayout'

export default {
  name: 'BaseCSVUploadView',
  components: { MainLayout },
  data () {
    return {
      loadingPublish: false,
      csvData: []
    }
  },
  computed: {
    // Get CSV Table Headers
    getCSVTableHeaders () {
      if (!this.csvData.length) return []

      return this.csvData[0].map(c => {
        return {
          title: c,
          value: c
        }
      })
    },
    // Get CSVTable Data
    getCSVTableData: {
      get () {
        if (!this.csvData.length) return []

        const data = []

        for (let i = 1; i < this.csvData.length; i++) {
          const currentData = {}
          for (let j = 0; j < this.csvData[0].length; j++) {
            currentData[this.csvData[0][j]] = this.csvData[i][j]
          }

          data.push(currentData)
        }

        return data
      },
      set (val) {
        this.importData = val
      }
    }
  },
  methods: {
    handlePublish () {

    }
  }
}
</script>

<style scoped>

</style>
