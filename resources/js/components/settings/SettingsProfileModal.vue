<template>
  <!-- Settings Profile Modal -->
  <BaseDrawer @close="$emit('close')">
    <!-- Title -->
    <div class="title-2">
      My Profile
    </div>

    <!-- Avatar -->
    <div class="flex items-center my-8">
      <BaseAvatar
        size="60"
        avatar="https://gravatar.com/avatar/2a26dc8d09602b40557b06e90ea2923f?s=400&d=robohash&r=x"
        class="mr-4"
      />

      <!-- Change Photo -->
      <div class="subtitle-2">
        Joanna Smith

        <div class="flex items-center mt-1">
          <BaseButton
            text
            class="text-brand"
          >
            Change Photo
          </BaseButton>

          <div class=" border-r border-grey-light h-5 mx-3" />

          <BaseButton
            text
            class="text-danger"
          >
            Remove Photo
          </BaseButton>
        </div>
      </div>
    </div>

    <!-- First Name -->
    <BaseInput
      label="First Name"
      class="mt-5"
    />

    <!-- Last Name -->
    <BaseInput
      label="Last Name"
      class="mt-5"
    />

    <!-- Email -->
    <BaseInput
      label="Email"
      class="mt-5"
    />

    <!-- Password -->
    <BaseInput
      label="Password"
      class="mt-5"
      input-type="password"
    />

    <!-- New Password -->
    <BaseInput
      label="New Password"
      class="mt-5"
      input-type="password"
    />

    <!-- Confirm New Password -->
    <BaseInput
      label="Confirm New Password"
      class="mt-5"
      input-type="password"
    />

    <!-- Create -->
    <BaseButton class="bg-brand text-white mt-10 ml-auto">
      Save
    </BaseButton>
  </BaseDrawer>
</template>

<script>
export default {
  name: 'SettingsProfileModal'
}
</script>

<style scoped>

</style>
