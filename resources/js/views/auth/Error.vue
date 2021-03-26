<template>
  <div :class="'text-center alert alert-' + error.status" role="alert">
    {{ error.message }}
  </div>
</template>
<script>
export default {
  name: "Error",
  props: ["error"],
};
</script>
