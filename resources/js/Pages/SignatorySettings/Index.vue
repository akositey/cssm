<template>
  <app-layout>
    <template #header>
      <div class="flex justify-between">
        Signatory Settings
      </div>
    </template>
    <div class="w-full">
      <form @submit.prevent="saveSettings">
        <div class="grid md:grid-cols-2">
          <text-input
            v-model="form.reviewerName"
            :error="errors.reviewerName"
            class="w-full px-4 pb-8"
            label="Reviewer Name"
          />
          <text-input
            v-model="form.reviewerPosition"
            :error="errors.reviewerPosition"
            class="w-full px-4 pb-8"
            label="Reviewer Position"
          />
          <text-input
            v-model="form.noterName"
            :error="errors.noterName"
            class="w-full px-4 pb-8"
            label="Office Head Name"
          />
          <text-input
            v-model="form.noterPosition"
            :error="errors.noterPosition"
            class="w-full px-4 pb-8"
            label="Office Head Position"
          />
        </div>
        <div class="flex justify-end">
          <loading-button
            :loading="sending"
            class="btn-indigo"
            type="submit"
          >
            Save
          </loading-button>
        </div>
      </form>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "~/Layouts/AppLayout";
import TextInput from "~/Shared/TextInput";
import LoadingButton from "~/Shared/LoadingButton";

export default {
  props: {
    settings: { type: [Object, Array], default: () => {} },
    errors: { type: [Object, Array], default: () => {} },
  },
  components: {
    AppLayout,
    TextInput,
    LoadingButton,
  },
  data() {
    return {
      form: {
        reviewerName: this.settings.reviewerName,
        reviewerPosition: this.settings.reviewerPosition,
        noterName: this.settings.noterName,
        noterPosition: this.settings.noterPosition,
      },
      sending: false,
    };
  },
  computed: {},
  watch: {},
  methods: {
    saveSettings() {
      this.sending = true;
      this.$inertia.patch(this.route("signatories.update"), this.form, {
        onFinish: () => {
          this.sending = false;
          console.log("done");
        },
      });
    },
  },
};
</script>
