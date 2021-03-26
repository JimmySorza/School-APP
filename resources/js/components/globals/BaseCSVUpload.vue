<template>
  <!-- Base CSV Upload -->
  <div
    id="base-csv-upload"
    class="base-csv-upload"
    :class="{ 'base-csv-upload--dragging': isDragging }"
    @dragover="isDragging = true"
    @dragenter="isDragging = true"
    @dragleave="isDragging =false"
    @dragend="isDragging = false"
  >
    <!-- Loading State -->
    <div v-if="importingCSV">
      <BaseLoadingSpinner
        size="30"
        class="my-3"
      />

      Importing CSV...
    </div>

    <div
      v-else
      class="text-center"
    >
      <div
        v-if="!filename"
        class="subtitle-2"
      >
        Select a CSV file to import or
        <span
          class="text-brand"
          @click="openUpload"
        >
          browse
        </span>

        <div class="mt-1 body-1">
          Max file size: 200MB
        </div>
      </div>

      <!-- File Name -->
      <div
        v-else
        class="mx-auto subtitle-2"
      >
        {{ filename }}

        <BaseButton
          class="text-danger mt-5 mx-auto"
          text
          @click="showDeleteModal = true"
        >
          Delete file
        </BaseButton>
      </div>
    </div>

    <!-- Hidden Input -->
    <input
      id="upload-input"
      type="file"
      class="hidden"
      accept=".xlsx, .xls, .csv"
      @change="handleFileUpload"
    >

    <!-- Base Accept Modal -->
    <BaseAcceptModal
      v-if="showDeleteModal"
      @close="showDeleteModal = false"
    >
      <template #title>
        Delete CSV File
      </template>

      <template #body>
        Are you sure you want to delete this CSV file? This action can not be undone and you will lose all your uploaded records thus far.
      </template>

      <template #actions>
        <BaseButton
          text
          class="mr-4"
          @click="showDeleteModal = false"
        >
          Cancel
        </BaseButton>

        <BaseButton
          class="bg-danger text-white"
          @click="handleDeleteFile"
        >
          Delete
        </BaseButton>
      </template>
    </BaseAcceptModal>
  </div>
</template>

<script>
export default {
  name: 'BaseCSVUpload',
  data () {
    return {
      showDeleteModal: false,
      isDragging: false,
      filename: '',
      importingCSV: false
    }
  },
  mounted () {
    const uploadWrapper = document.getElementById('base-csv-upload')
    const events = ['drag', 'dragstart', 'dragend', 'dragover', 'dragenter', 'dragleave', 'drop']

    // File Upload
    events.forEach(evt =>
      uploadWrapper.addEventListener(evt, function (e) {
        e.preventDefault()
        e.stopPropagation()
      }, false)
    )

    // Handle File Drop Upload
    uploadWrapper.addEventListener('drop', (e) => {
      this.handleFileUpload(e)
    })
  },
  methods: {
    // Files
    handleFileUpload (e) {
      this.importingCSV = true
      const target = e.dataTransfer || e.target

      if (!target.files) {
        return
      }

      const file = target.files[0]
      const reader = new FileReader()
      reader.readAsText(file)

      reader.onload = e => {
        this.filename = file.name
        this.$emit('input', this.parseCSV(e.target.result))
        this.isDragging = false
        this.importingCSV = false
      }
    },

    // Open Upload File
    openUpload () {
      const fileUploadInput = document.getElementById('upload-input')

      fileUploadInput.click()
    },
    // Parse CSV
    parseCSV (str) {
      const arr = []
      let quote = false // 'true' means we're inside a quoted field

      // Iterate over each character, keep track of current row and column (of the returned array)
      for (let row = 0, col = 0, c = 0; c < str.length; c++) {
        const cc = str[c]
        const nc = str[c + 1] // Current character, next character
        arr[row] = arr[row] || [] // Create a new row if necessary
        arr[row][col] = arr[row][col] || '' // Create a new column (start with empty string) if necessary

        // If the current character is a quotation mark, and we're inside a
        // quoted field, and the next character is also a quotation mark,
        // add a quotation mark to the current column and skip the next character
        if (cc === '"' && quote && nc === '"') { arr[row][col] += cc; ++c; continue }

        // If it's just one quotation mark, begin/end quoted field
        if (cc === '"') { quote = !quote; continue }

        // If it's a comma and we're not in a quoted field, move on to the next column
        if ((cc === ';' || cc === ',') && !quote) { ++col; continue }

        // If it's a newline (CRLF) and we're not in a quoted field, skip the next character
        // and move on to the next row and move to column 0 of that new row
        if (cc === '\r' && nc === '\n' && !quote) { ++row; col = 0; ++c; continue }

        // If it's a newline (LF or CR) and we're not in a quoted field,
        // move on to the next row and move to column 0 of that new row
        if (cc === '\n' && !quote) { ++row; col = 0; continue }
        if (cc === '\r' && !quote) { ++row; col = 0; continue }

        // Otherwise, append the current character to the current column
        arr[row][col] += cc
      }
      return arr
    },
    handleDeleteFile () {
      this.$emit('input', '')
      this.filename = ''
      this.showDeleteModal = false
    }
  }
}
</script>

<style scoped lang="sass">
.base-csv-upload
  animation: appearBottom 100ms ease-in
  height: 210px
  @apply cursor-pointer border border-dashed border-grey-default flex flex-col items-center justify-center rounded w-full

  &--dragging
    @apply border-dashed border-brand bg-brand-light

  i
    font-size: 30px
    margin-bottom: 10px
    @apply text-brand
</style>
