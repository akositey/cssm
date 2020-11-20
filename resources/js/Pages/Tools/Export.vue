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
      <div class="w-full m-auto overflow-hidden bg-white rounded shadow-xl sm:max-w-sm">
        <div class="flex items-center px-8 py-4 border-b border-gray-200">
          <h3 class="text-xl font-bold">
            Export Feedback Entries
          </h3>
        </div>
        <form
          @submit.prevent="submit"
          autocomplete="off"
        >
          <div class="flex flex-wrap px-6 pb-6">
            <date-input
              type="month"
              format="YYYY-MM"
              v-model="form.month"
              class="min-w-full py-4"
              label="Month"
              required
            />
            <text-input
              type="password"
              pattern="[0-9]{4}"
              maxlength="4"
              v-model="form.passCode"
              :error="error"
              class="w-full py-4"
              label="Admin Passcode"
              @change.native="checkPassCode"
              required
            />
          </div>
          <div class="flex items-center justify-end px-8 py-4 bg-gray-100 border-t border-gray-200">
            <loading-button
              :loading="sending"
              :disabled="disabled"
              class="btn-indigo"
              type="submit"
            >
              Download
            </loading-button>
          </div>
        </form>
      </div>
    </div>
  </feedback-layout>
</template>

<script>
import FeedbackLayout from "./../../Layouts/FeedbackLayout";
import LoadingButton from "./../../Shared/LoadingButton";
import DateInput from "./../../Shared/DateInput";
import TextInput from "./../../Shared/TextInput";
// import { Inertia } from "@inertiajs/inertia";
import axios from "axios";

export default {
  components: {
    FeedbackLayout,
    LoadingButton,
    DateInput,
    TextInput,
  },
  // props: {
  //   errors: { type: [Object, Array], default: () => {} },
  // },
  // remember: "form",
  data() {
    return {
      sending: false,
      disabled: true,
      form: {
        month: null,
        passCode: "",
      },
      error: "",
    };
  },
  methods: {
    checkPassCode() {
      console.log("checking...");
      axios
        .post(this.route("export.check"), this.form, {
          headers: {
            "X-CSRF-TOKEN": document.head.querySelector(
              'meta[name="csrf-token"]'
            ).content,
            "X-Requested-With": "XMLHttpRequest",
          },
        })
        .then((response) => {
          this.disabled = !response.data.status;
          this.error = response.data.error || "";
        });
    },
    submit() {
      this.sending = true;

      // inertia does not work because it will not catch the reponse, so use axios
      axios
        .post(this.route("export"), this.form, {
          headers: {
            "X-CSRF-TOKEN": document.head.querySelector(
              'meta[name="csrf-token"]'
            ).content,
            "X-Requested-With": "XMLHttpRequest",
          },
          responseType: "blob", // important
        })
        .then((response) => {
          this.sending = false;

          console.log("response", response);

          const url = window.URL.createObjectURL(new Blob([response.data]));
          const link = document.createElement("a");
          link.href = url;
          link.setAttribute(
            "download",
            "cssf_dump_" + this.form.month + ".zip"
          );
          document.body.appendChild(link);
          link.click();
        })
        .catch((e) => {
          this.sending = false;
          console.log("error", e);
          console.log("error.response", e.response);
        });
    },
  },
};
</script>
