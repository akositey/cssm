<template>
  <feedback-layout>
    <template #header>
      <inertia-link
        class="text-indigo-400 hover:text-indigo-600"
        :href="route('offices.index')"
      >
        Tools
      </inertia-link>
      <span class="font-medium">/</span>
      Export Data
    </template>

    <div class="py-4">
      <div class="max-w-3xl m-auto overflow-hidden bg-white rounded shadow-xl">
        <div>
          <div class="flex flex-wrap p-8 -mb-8 -mr-6">
            <date-input
              type="month"
              format="YYYY-MM"
              v-model="form.month"
              :error="errors.month"
              class="pr-6"
              label="Month"
            />
            <text-input
              type="text"
              v-model="form.password"
              :error="errors.password"
              class="w-full pb-8 pr-6 lg:w-1/2"
              label="Admin Password"
            />
          </div>
          <div class="flex items-center justify-end px-8 py-4 bg-gray-100 border-t border-gray-200">
            <loading-button
              :loading="sending"
              class="btn-indigo"
              type="button"
              @click="submit"
            >
              Download
            </loading-button>
          </div>
        </div>
      </div>
    </div>
  </feedback-layout>
</template>

<script>
import FeedbackLayout from "./../../Layouts/FeedbackLayout";
import LoadingButton from "./../../Shared/LoadingButton";
import DateInput from "./../../Shared/DateInput";
import TextInput from "./../../Shared/TextInput";

export default {
  components: {
    FeedbackLayout,
    LoadingButton,
    DateInput,
    TextInput,
  },
  props: {
    errors: { type: Object, default: () => {} },
  },
  // remember: "form",
  data() {
    return {
      sending: false,
      form: this.$inertia.form({
        month: null,
        password: null,
      }),
    };
  },
  methods: {
    submit() {
      this.sending = true;
      this.form
        .post(this.route("export"), {
          headers: {
            responseType: "arraybuffer",
          },
        })
        .then(() => {
          console.log(this.$page);
          this.sending = false;
        });
    },
  },
};
</script>
