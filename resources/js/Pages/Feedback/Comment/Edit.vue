<template>
  <app-layout>
    <template #header>
      <inertia-link
        class="text-indigo-400 hover:text-indigo-600"
        :href="route('feedback.index')"
      >
        Feedback
      </inertia-link>
      <span class="font-medium">/</span>
      <inertia-link
        class="text-indigo-400 hover:text-indigo-600"
        :href="route('feedback.show', feedback.id)"
      >
        {{ feedback.id }}
      </inertia-link>
      Comment
    </template>

    <page-section>
      <form @submit.prevent="submit">
        <div class="grid grid-cols-2 gap-4">
          <div>
            <img
              :src="'/'+feedback.comments_path"
              alt=""
            >
          </div>
          <div>
            <textarea-input
              v-model="form.comments"
              :error="errors.comments"
              class="w-full pb-8 pr-6"
              label="Transcribe Comments"
              rows="7"
            />
            <div class="flex items-center justify-end px-8 py-4">
              <loading-button
                :loading="sending"
                class="btn-indigo"
                type="submit"
              >
                Save
              </loading-button>
            </div>
          </div>
        </div>
      </form>
    </page-section>
  </app-layout>
</template>

<script>
import AppLayout from "~/Layouts/AppLayout";
import PageSection from "~/Shared/Section";
import LoadingButton from "~/Shared/LoadingButton";
import TextareaInput from "~/Shared/TextareaInput";

export default {
  components: {
    AppLayout,
    PageSection,
    LoadingButton,
    TextareaInput,
  },
  props: {
    errors: { type: Object, default: () => {} },
    feedback: { type: Object, default: () => {} },
  },
  remember: "form",
  data() {
    return {
      sending: false,
      form: {
        id: this.feedback.id,
        comments: this.feedback.comments,
      },
    };
  },
  methods: {
    submit() {
      this.sending = true;
      this.$inertia
        .patch(this.route("feedback.update", this.feedback.id), this.form)
        .then(() => (this.sending = false));
    },
  },
};
</script>
