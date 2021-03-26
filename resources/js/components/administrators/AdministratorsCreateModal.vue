<template>
  <!-- Administrators Create Modal -->
  <BaseDrawer @close="$emit('close')">
    <!-- Title -->
    <div class="title-2">
      Add Administrator
    </div>

    <!-- First Name -->
    <BaseInput
      label="First Name"
      class="mt-10"
      v-model="administrator.first_name"
      required
    />

    <!-- Last Name -->
    <BaseInput
      label="Last Name"
      class="mt-5"
      v-model="administrator.last_name"
      required
    />

    <!-- ID Number -->
    <BaseInput
      label="ID Number"
      class="mt-5"
      v-model="administrator.id_number"
      required
    />

    <!-- Email -->
    <BaseInput
      label="Email"
      class="mt-5"
      v-model="administrator.email"
      required
    />

    <!-- Phone Number -->
    <BaseInput
      label="Phone Number"
      v-model="administrator.phone_number"
      class="mt-5"
    />

    <!-- Street Address -->
    <BaseInput
      label="Street Address"
      v-model="administrator.address_line_1"
      class="mt-5"
    />

    <!-- City -->
    <BaseInput
      label="City"
      v-model="administrator.city"
      class="mt-5"
    />

    <div class="flex items-center my-5">
      <!-- State -->
      <BaseSingleSelect
        :items="['AZ']"
        class="mr-2"
        label="State"
        v-model="administrator.state"
        placeholder="Select One"
      />

      <!-- Zipcode -->
      <BaseInput
        label="Zipcode"
        v-model="administrator.zip_code"
        class="ml-2"
      />
    </div>

    <!-- Create -->
    <BaseButton 
      class="bg-brand text-white mt-10 ml-auto"
      @click="$emit('add', administrator)"
    >
      Add
    </BaseButton>
  </BaseDrawer>
</template>

<script>
export default {
  name: 'AdministratorsCreateModal',
  data() {
    return {
      administrator: {
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

<style scoped>

</style>
