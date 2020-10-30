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
      Create New
    </template>

    <div class="py-4">
      <div class="max-w-3xl m-auto overflow-hidden bg-white rounded shadow-xl">
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
            <input type="checkbox" :id="`checkbox-${Math.random()}`" v-model="form.another" class="hidden">
          </div>
          <div class="flex items-center justify-end px-8 py-4 bg-gray-100 border-t border-gray-200">
            <loading-button
              :loading="sending"
              class="btn-green"
              @click="saveAndNew"
            >
              Create and Add Another
            </loading-button>
            <loading-button
              :loading="sending"
              class="btn-indigo"
              @click="saveOnly"
            >
              Create
            </loading-button>
          </div>
        </form>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "./../../Layouts/AppLayout";
import LoadingButton from "./../../Shared/LoadingButton";
import SelectInput from "./../../Shared/SelectInput";
import TextInput from "./../../Shared/TextInput";

export default {
  components: {
    AppLayout,
    LoadingButton,
    SelectInput,
    TextInput,
  },
  props: {
    errors: { type: Object, default: () => {} },
    offices: { type: [Object, Array], default: () => {} },

  },
  remember: "form",
  data() {
    return {
      sending: false,
      form: {
        name: null,
        office_id: null,
        another: false
      },
    };
  },
  methods: {
    saveAndNew(){
      this.form.another = true;
      this.submit();
    },
    saveOnly(){
      this.form.another = false;
      this.submit();
    },
    submit() {
      this.sending = true;
      this.$inertia
        .post(this.route("services.store"), this.form)
        .then(() => (this.sending = false));
    },
  },
};
</script>
