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
          <div class="col-span-2">
            <img
              :src="'/'+feedback.commentsImgPath"
              alt=""
            >
          </div>
          <div>
            <textarea-input
              v-model="form.positiveComments"
              :error="errors.positiveComments"
              class="w-full pb-8 pr-6"
              label="Positive Comments"
              rows="7"
            />
          </div>
          <div>
            <textarea-input
              v-model="form.negativeComments"
              :error="errors.negativeComments"
              class="w-full pb-8 pr-6"
              label="Negative Comments"
              rows="7"
            />
          </div>
          <div class="flex items-center justify-between col-span-2 px-8 py-4">
            <loading-button
              :loading="sending"
              class="btn-green"
              type="button"
              @click="saveEmpty"
            >
              Save Empty
            </loading-button>

            <loading-button
              :loading="sending"
              class="btn-indigo"
              type="submit"
            >
              Save
            </loading-button>
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
        positiveComments: this.feedback.positiveComments,
        negativeComments: this.feedback.negativeComments,
      },
    };
  },
  methods: {
    saveEmpty(){
      this.form.positiveComments='--none--';
      this.form.negativeComments='--none--';
      this.submit();
    },
    submit() {
      this.sending = true;
      this.$inertia
        .patch(this.route("feedback.update", this.feedback.id), this.form)
        .then(() => (this.sending = false));
    },
  },
};
</script>
