<template>
  <div class="flex flex-wrap mt-6 -mb-1">
    <template v-for="(link, key) in links">
      <div
        v-if="link.url === null"
        :key="`a_${key}`"
        class="px-4 py-3 mb-1 mr-1 text-sm text-gray-400 border rounded"
        :class="{ 'ml-auto': link.label === 'Next' }"
      >
        <span v-html="link.label"/>
      </div>
      <Link
        v-else
        :key="`b_${key}`"
        class="px-4 py-3 mb-1 mr-1 text-sm border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
        :class="{ 'bg-white': link.active, 'ml-auto': link.label === 'Next' }"
        :href="link.url"
      >
        <span v-html="link.label"/>
      </Link>
    </template>
  </div>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3'

export default {
  components: {Link},
  props: {
    links: {
      type: Array, default: () => {
      },
    },
  },
}
</script>
