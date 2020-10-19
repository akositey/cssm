<template>
  <app-layout>
    <template #header>
      <inertia-link
        class="text-indigo-400 hover:text-indigo-600"
        :href="route('offices.index')"
      >
        Offices
      </inertia-link>
      <span class="font-medium">/</span>
      {{ form.name }}
    </template>

    <trashed-message
      v-if="office.deleted_at"
      class="mb-6"
      @restore="restore"
    >
      This office has been deleted.
    </trashed-message>
    <div class="self-center m-auto overflow-hidden bg-white rounded shadow-xl">
      <form @submit.prevent="submit">
        <div class="flex flex-wrap p-8 -mb-8 -mr-6">
          <text-input
            v-model="form.name"
            :error="errors.name"
            class="w-full pb-8 pr-6 lg:w-1/2"
            label="Name"
          />
          <text-input
            v-model="form.nick"
            :error="errors.nick"
            class="w-full pb-8 pr-6 lg:w-1/2"
            label="Abbreviation"
          />
          <select-input
            v-model="form.parent_id"
            :error="errors.parent_id"
            class="w-full pb-8 pr-6 lg:w-1/2"
            label="Parent Office"
          >
            <option :value="null" />
            <option
              v-for="row in officesList"
              :key="row.id"
              :value="row.id"
            >
              {{ row.name }}
            </option>
          </select-input>
        </div>
        <div class="flex items-center justify-between px-8 py-4 bg-gray-100 border-t border-gray-200">
          <button
            v-if="!office.deleted_at"
            class="btn-red"
            tabindex="-1"
            type="button"
            @click="destroy"
          >
            Delete Office
          </button>
          <loading-button
            :loading="sending"
            class="btn-indigo"
            type="submit"
          >
            Update Office
          </loading-button>
        </div>
      </form>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "~/Layouts/AppLayout";
import LoadingButton from "~/Shared/LoadingButton";
import SelectInput from "~/Shared/SelectInput";
import TextInput from "~/Shared/TextInput";
import TrashedMessage from "~/Shared/TrashedMessage";

export default {
  components: {
    AppLayout,
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
  },
  props: {
    errors: { type: Object, default: () => {} },
    office: { type: Object, default: () => {} },
    officesList: { type: Array, default: () => [] },
  },
  remember: "form",
  data() {
    return {
      sending: false,
      form: {
        name: this.office.name,
        nick: this.office.nick,
        parent_id: this.office.parent_id,
      },
    };
  },
  methods: {
    submit() {
      this.sending = true;
      this.$inertia
        .patch(this.route("offices.update", this.office.id), this.form)
        .then(() => (this.sending = false));
    },
    destroy() {
      if (confirm("Are you sure you want to delete this office?")) {
        this.$inertia.delete(this.route("offices.destroy", this.office.id));
      }
    },
  },
};
</script>
