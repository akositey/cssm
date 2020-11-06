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
      {{ feedback.id }}
    </template>
    <div class="grid grid-cols-1 gap-2 md:grid-cols-2 md:gap-4">
      <page-section class="md:col-span-2">
        <h2 class="section-header">
          Info
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 justify-items-auto">
          <div class="font-bold">
            Office:
          </div>
          <div>{{ feedback.officeName }}</div>
          <div class="font-bold">
            Service:
          </div>
          <div>{{ feedback.serviceName }}</div>
          <div class="font-bold">
            Date Submitted:
          </div>
          <div>{{ feedback.date }}</div>
          <div class="font-bold">
            Author:
          </div>
          <div>{{ feedback.authorName }}</div>
          <div class="font-bold">
            Signature:
          </div>
          <div class="w-1/2">
            <img
              :src="'/'+feedback.signaturePath"
              alt=""
            >
          </div>
        </div>
      </page-section>
      <page-section
        class=""
        v-for="(set,type) of answers"
        :key="type"
      >
        <h2 class="section-header">
          {{ type }}
        </h2>
        <div
          class="grid grid-cols-3"
          v-for="(answer,x) of set"
          :key="x"
        >
          <div class="col-span-2">
            {{ x+1 }}. {{ answer.question }}
          </div>
          <div
            class="col-span-1 m-auto "
            v-if="type==='Mandatory'"
          >
            <star-rating :rating="+answer.answer" />
          </div>
        </div>
      </page-section>
      <page-section
        class=""
        v-if="feedback.commentsPath"
      >
        <h2 class="section-header">
          Additional Comments / Suggestions
        </h2>
        <div class="w-full">
          <img
            :src="'/'+feedback.commentsPath"
            alt=""
          >
        </div>
        <div class="w-full text-right">
          <inertia-link
            v-if="!feedback.comments"
            :href="route('comments.edit', feedback.id)"
          >
            Transcribe
          </inertia-link>
        </div>
      </page-section>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "~/Layouts/AppLayout";
import PageSection from "~/Shared/Section";
import StarRating from "~/Shared/StarRating";
export default {
  components: {
    AppLayout,
    PageSection,
    StarRating,
  },
  props: {
    feedback: {
      type: Object,
      default: () => {},
    },
    answers: {
      type: [Array, Object],
      default: () => {},
    },
  },
};
</script>
