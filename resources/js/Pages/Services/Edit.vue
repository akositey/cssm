<template>
  <app-layout>
    <template #header>
      <inertia-link
        class="text-indigo-400 hover:text-indigo-600"
        :href="route('services.index')"
      >
        Services
      </inertia-link>
      <span class="font-medium">/</span>
      {{ form.name }}
    </template>

    <trashed-message
      v-if="service.deleted_at"
      class="mb-6"
      @restore="restore"
    >
      This service has been deleted.
    </trashed-message>
    <div class="self-center m-auto overflow-hidden bg-white rounded shadow-xl">
      <form @submit.prevent="submit">
        <div class="flex flex-wrap p-8 -mb-8 -mr-6">
          <text-input
            v-model="form.name"
            :error="errors.name"
            class="w-full pb-8 pr-6 lg:w-1/2"
            label="Name"
          />
          <select-input
            v-model="form.office_id"
            :error="errors.office_id"
            class="w-full pb-8 pr-6 lg:w-1/2"
            label="Office"
          >
            <option :value="null" />
            <option
              v-for="row in offices"
              :key="row.id"
              :value="row.id"
            >
              {{ row.abbr }}
            </option>
          </select-input>
          <select-input
            v-model="form.is_active"
            :error="errors.is_active"
            class="w-full pb-8 pr-6 lg:w-1/2"
            label="Active"
          >
            <option value="1">
              Yes
            </option>
            <option value="0">
              No
            </option>
          </select-input>
        </div>
        <div class="flex items-center justify-between px-8 py-4 bg-gray-100 border-t border-gray-200">
          <button
            v-if="!service.deleted_at"
            class="btn-red"
            tabindex="-1"
            type="button"
            @click="destroy"
          >
            Delete Service
          </button>
          <loading-button
            :loading="sending"
            class="btn-indigo"
            type="submit"
          >
            Update Service
          </loading-button>
        </div>
      </form>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import LoadingButton from '@/Shared/LoadingButton'
import SelectInput from '@/Shared/SelectInput'
import TextInput from '@/Shared/TextInput'
import TrashedMessage from '@/Shared/TrashedMessage'

export default {
  components: {
    AppLayout,
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
  },
  props: {
    errors: { type: Object, default: () => {} },
    service: { type: Object, default: () => {} },
    offices: { type: Array, default: () => [] },
  },
  remember: 'form',
  data() {
    return {
      sending: false,
      form: {
        name: this.service.name,
        office_id: this.service.office_id,
        is_active: this.service.is_active,
      },
    }
  },
  methods: {
    submit() {
      this.sending = true
      this.$inertia
        .patch(this.route('services.update', this.service.id), this.form)
        .then(() => (this.sending = false))
    },
    destroy() {
      if (confirm('Are you sure you want to delete this service?')) {
        this.$inertia.delete(this.route('services.destroy', this.service.id))
      }
    },
  },
}
</script>
