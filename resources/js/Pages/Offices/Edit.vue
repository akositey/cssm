<template>
  <AppLayout>
    <template #header>
      <Link
        class="text-indigo-400 hover:text-indigo-600"
        :href="route('offices.index')"
      >
        Offices
      </Link>
      <span class="font-medium">/</span>
      {{ form.name }}
    </template>

    <TrashedMessage
      v-if="office.deleted_at"
      class="mb-6"
      @restore="restore"
    >
      This office has been deleted.
    </TrashedMessage>

    <Form method="update" :submitHandler="()=>form.patch(route('offices.update', office.id))" :form="form"
          :office="office" :offices="offices"/>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout'
import TrashedMessage from '@/Shared/TrashedMessage'
import {Link, useForm, useRemember} from "@inertiajs/inertia-vue3";
import Form from "@/Pages/Offices/Form";

const props = defineProps({
  errors: {
    type: Object, default: () => {
    }
  },
  office: {
    type: Object, default: () => {
    }
  },
  offices: {type: Array, default: () => []},
})

const form = useForm({
  name: props.office.name,
  abbr: props.office.abbr,
  parent_id: props.office.parent_id,
})

useRemember(form);
</script>
