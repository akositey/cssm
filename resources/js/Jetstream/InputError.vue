<template>
  <div v-show="message">
    <p class="text-sm font-bold text-red-600 md:text-4xl">
      {{ message }}
    </p>
  </div>
</template>

<script>
export default {
  props: {
    message: {
      type: String,
      default: "",
    },
  },
};
</script>
