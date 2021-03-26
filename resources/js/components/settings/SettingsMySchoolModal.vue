<template>
  <!-- Settings My School Modal -->
  <BaseDrawer @close="$emit('close')">
    <!-- Title -->
    <div class="title-2">
      My School
    </div>

    <!-- Name -->
    <BaseInput
      label="Name"
      class="mt-10"
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
      Save
    </BaseButton>
  </BaseDrawer>
</template>

<script>
export default {
  name: 'SettingsMySchoolModal'
}
</script>

<style scoped>

</style>
