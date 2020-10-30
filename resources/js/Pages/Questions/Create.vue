<template>
  <app-layout>
    <template #header>
      <inertia-link
        class="text-indigo-400 hover:text-indigo-600"
        :href="route('questions.index')"
      >
        Questions
      </inertia-link>
      <span class="font-medium">/</span>
      Create New
    </template>

    <div class="py-4">
      <div class="max-w-3xl m-auto overflow-hidden bg-white rounded shadow-xl">
        <form @submit.prevent="submit">
          <div class="flex flex-wrap p-8 -mb-8 -mr-6">
            <text-input
              v-model="form.question"
              :error="errors.question"
              class="w-full pb-8 pr-6"
              label="Question"
            />
            <select-input
              v-model="form.is_required"
              :error="errors.is_required"
              class="w-full pb-8 pr-6 lg:w-1/2"
              label="Required"
            >
              <option :value="null" />
              <option
                key="0"
                value="0"
              >
                Optional
              </option>
              <option
                key="1"
                value="1"
              >
                Mandatory
              </option>
            </select-input>
            <select-input
              v-model="form.type"
              :error="errors.type"
              class="w-full pb-8 pr-6 lg:w-1/2"
              label="(If Optional) Type"
            >
              <option :value="null" />
              <option
                key="1"
                value="1"
              >
                Positive
              </option>
              <option
                key="2"
                value="2"
              >
                Negative
              </option>
              <option
                key="3"
                value="3"
              >
                Etc
              </option>
            </select-input>
          </div>
          <div class="flex items-center justify-end px-8 py-4 bg-gray-100 border-t border-gray-200">
            <loading-button
              :loading="sending"
              class="btn-indigo"
              type="submit"
            >
              Create Question
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
    offices: { type: Object, default: () => {} },
  },
  remember: "form",
  data() {
    return {
      sending: false,
      form: {
        question: null,
        is_required: null,
        type: null,
      },
    };
  },
  methods: {
    submit() {
      this.sending = true;
      this.$inertia
        .post(this.route("offices.store"), this.form)
        .then(() => (this.sending = false));
    },
  },
};
</script>
