<template>
  <div>
    <div class="mb-4">
      <inertia-link
        class="flex items-center py-3 group"
        :href="route('dashboard')"
      >
        <icon
          name="dashboard"
          class="w-4 h-4 mr-2"
          :class="
            isUrl('') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'
          "
        />
        <div
          :class="
            isUrl('') ? 'text-white' : 'text-indigo-300 group-hover:text-white'
          "
        >
          Dashboard
        </div>
      </inertia-link>
    </div>
  </div>
</template>

<script>
import Icon from '@/Shared/Icon'

export default {
  components: {
    Icon,
  },
  props: {
    url: {
      type: String,
      default: null,
    },
  },
  methods: {
    isUrl(...urls) {
      if (urls[0] === '') {
        return this.url === ''
      }

      return urls.filter((url) => this.url.startsWith(url)).length
    },
  },
}
</script>
