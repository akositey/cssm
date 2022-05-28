<script setup>
import LoadingButton from '@/Shared/LoadingButton'
import SelectInput from '@/Shared/SelectInput'
import TextInput from '@/Shared/TextInput'
import {useForm, useRemember} from "@inertiajs/inertia-vue3";

const props = defineProps({
  method: {
    type: String,
    required: true
  },
  submitHandler: {
    type: Function,
    required: true
  },
  form: {
    type: Object,
    required: true
  },
  office: {
    type: Object,
    default: () => {}
  },
  offices: {type: Array, default: () => []},
})


function destroy() {
  if (confirm('Are you sure you want to delete this office?')) {
    this.$inertia.delete(this.route('offices.destroy', props.office.id))
  }
}
</script>

<template>
  <div class="self-center m-auto overflow-hidden bg-white rounded shadow-xl">
    <form @submit.prevent="submitHandler">
      <div class="flex flex-wrap p-8 -mb-8 -mr-6">
        <TextInput
          v-model="form.name"
          :error="form.errors.name"
          class="w-full pb-8 pr-6 lg:w-1/2"
          label="Name"
        />
        <TextInput
          v-model="form.abbr"
          :error="form.errors.abbr"
          class="w-full pb-8 pr-6 lg:w-1/2"
          label="Abbreviation"
        />
        <SelectInput
          v-model="form.parent_id"
          :error="form.errors.parent_id"
          class="w-full pb-8 pr-6 lg:w-1/2"
          label="Parent Office"
        >
          <option :value="null"/>
          <option
            v-for="row in offices"
            :key="row.id"
            :value="row.id"
          >
            {{ row.abbr }}
          </option>
        </SelectInput>
      </div>
      <div class="flex items-center justify-between px-8 py-4 bg-gray-100 border-t border-gray-200">
        <button
          v-if="!office?.deleted_at"
          class="btn-red"
          tabindex="-1"
          type="button"
          @click="destroy"
        >
          Delete Office
        </button>
        <LoadingButton
          :loading="form.processing"
          class="btn-indigo capitalize"
          type="submit"
        >
          {{ method }} Office
        </LoadingButton>
      </div>
    </form>
  </div>
</template>
