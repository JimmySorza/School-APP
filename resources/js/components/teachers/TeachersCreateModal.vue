<template>
  <!-- Teachers Create Modal -->
  <BaseDrawer @close="$emit('close')">
    <!-- Title -->
    <div class="title-2">
      Add Teacher
    </div>

    <!-- First Name -->
    <BaseInput
      label="First Name"
      class="mt-10"
      v-model="teacher.first_name"
      required
    />

    <!-- Last Name -->
    <BaseInput
      label="Last Name"
      class="mt-5"
      v-model="teacher.last_name"
      required
    />

    <!-- ID Number -->
    <BaseInput
      label="ID Number"
      class="mt-5"
      v-model="teacher.id_number"
      required
    />

    <!-- Email -->
    <BaseInput label="Email" class="mt-5" v-model="teacher.email" required />

    <!-- Phone Number -->
    <BaseInput
      label="Phone Number"
      v-model="teacher.phone_number"
      class="mt-5"
    />

    <!-- Street Address -->
    <BaseInput
      label="Street Address"
      v-model="teacher.address_linke_1"
      class="mt-5"
    />

    <!-- City -->
    <BaseInput label="City" v-model="teacher.city" class="mt-5" />

    <div class="flex items-center my-5">
      <!-- State -->
      <BaseSingleSelect
        :items="['AZ']"
        class="mr-2"
        v-model="teacher.state"
        label="State"
        placeholder="Select One"
      />

      <!-- Zipcode -->
      <BaseInput label="Zipcode" v-model="teacher.zip_code" class="ml-2" />
    </div>

    <!-- Create -->
    <BaseButton
      class="bg-brand text-white mt-10 ml-auto"
      @click="$emit('add', teacher)"
    >
      Add
    </BaseButton>
  </BaseDrawer>
</template>

<script>
import { createNamespacedHelpers } from 'vuex'
const { mapState, mapActions } = createNamespacedHelpers('teacher')

export default {
  name: 'TeachersCreateModal',
  data() {
    return {
      teacher: {
        first_name: '',
        last_name: '',
        id_number: '',
        email: '',
        phone_number: '',
        address_line_1: '',
        country: '',
        city: '',
        state: '',
        zip_code: '',
      },
    }
  },
}
</script>

<style scoped></style>
