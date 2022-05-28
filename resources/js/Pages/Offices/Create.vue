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
      Create New
    </template>

    <Form method="create" :submitHandler="()=>form.post(route('offices.store'))" :form="form"
          :office="office" :offices="offices"/>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout'
import {Link, useForm} from "@inertiajs/inertia-vue3";
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
  name: props.office?.name,
  abbr: props.office?.abbr,
  parent_id: props.office?.parent_id,
})
</script>
