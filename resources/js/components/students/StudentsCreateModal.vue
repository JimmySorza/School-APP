<template>
  <!-- Students Create Modal -->
  <BaseDrawer @close="$emit('close')">
    <!-- Title -->
    <div class="title-2">
      Add Student
    </div>

    <!-- First Name -->
    <BaseInput
      label="First Name"
      class="mt-10"
      required
    />

    <!-- Last Name -->
    <BaseInput
      label="Last Name"
      class="mt-5"
      required
    />

    <!-- ID Number -->
    <BaseInput
      label="ID Number"
      class="mt-5"
      required
    />

    <!-- Email -->
    <BaseInput
      label="Email"
      class="mt-5"
      required
    />

    <!-- Phone Number -->
    <BaseInput
      label="Phone Number"
      class="mt-5"
    />

    <!-- Street Address -->
    <BaseInput
      label="Street Address"
      class="mt-5"
    />

    <!-- City -->
    <BaseInput
      label="City"
      class="mt-5"
    />

    <div class="flex items-center my-5">
      <!-- State -->
      <BaseSingleSelect
        :items="['AZ']"
        class="mr-2"
        label="State"
        placeholder="Select One"
      />

      <!-- Zipcode -->
      <BaseInput
        label="Zipcode"
        class="ml-2"
      />
    </div>

    <!-- Create -->
    <BaseButton class="bg-brand text-white mt-10 ml-auto">
      Add
    </BaseButton>
  </BaseDrawer>
</template>

<script>
export default {
  name: 'StudentsCreateModal'
}
</script>

<style scoped>

</style>
