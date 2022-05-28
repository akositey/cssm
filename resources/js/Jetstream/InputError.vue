<script setup>
defineProps({
  message: String,
})
</script>

<template>
  <div v-show="message">
    <p className="text-sm text-red-600">
      {{ message }}
    </p>
  </div>
</template>
