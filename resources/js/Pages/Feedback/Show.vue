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

    <page-section class="md:max-w-3xl">
      <h2 class="section-header">
        Info
      </h2>
      <div class="grid grid-cols-2 justify-items-auto">
        <div>Office:</div>
        <div>{{ feedback.officeName }}</div>
        <div>Service:</div>
        <div>{{ feedback.serviceName }}</div>
        <div>Date Submitted:</div>
        <div>{{ feedback.date }}</div>
        <div>Author:</div>
        <div>{{ feedback.authorName }}</div>
        <div>Signature: </div>
        <div class="w-1/2">
          <img :src="'/'+feedback.signaturePath" alt="">
        </div>
      </div>
    </page-section>
    <page-section class="md:max-w-3xl" v-for="(set,type) of answers" :key="type">
      <h2 class="section-header">
        {{ type }}
      </h2>
      <div class="grid grid-cols-3" v-for="(answer,x) of set" :key="x">
        <div class="col-span-2">
          {{ answer.question }}
        </div>
        <div class="col-span-1 m-auto " v-if="type==='Mandatory'">
          <star-rating :rating="+answer.answer" />
        </div>
      </div>
    </page-section>
  </app-layout>
</template>

<script>
import AppLayout from '~/Layouts/AppLayout';
import PageSection from '~/Shared/Section';
import StarRating from '~/Shared/StarRating';
export default {
  components: {
    AppLayout,
    PageSection,
    StarRating,
  },
  props: {
    feedback: {
      type: Object,
      default: () => {}
    },
    answers: {
      type: [Array, Object],
      default: () => {}
    }
  }
}
</script>
