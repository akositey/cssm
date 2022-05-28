<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import DefaultLogo from '@/Shared/DefaultLogo'

</script>

<template>
  <Link :href="'/'">
    <DefaultLogo class="block w-auto h-20" />
  </Link>
</template>
