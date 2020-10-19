<template>
  <app-layout>
    <div class="h-screen">
      <div
        v-if="office"
        class="p-8 text-xl font-bold text-center md:text-5xl sm:text-3xl"
      >
        Ano po ang masasabi nyo sa serbisyong naibigay sa inyo?

        <div class="flex flex-no-wrap justify-center p-12">
          <inertia-link :href="route('feedback.index')">
            <button class="text-xl sm:text-3xl btn-green md:btn-6xl md:text-5xl">
              Simulan ang Survey ✍🏻
            </button>
          </inertia-link>
        </div>
      </div>
      <div
        v-else
        class="text-xl font-bold text-center text-red-600"
      >
        Ang kagamitang ito ay hindi pa otorisadong gamitin. Kontakin lamang ang MIS kung may katanungan o kailangan tulong.
      </div>
    </div>
  </app-layout>
</template>
<script>
import AppLayout from "~/Layouts/GuestLayout";

export default {
  components: {
    AppLayout,
  },
  props: {
    office: {
      type: [String, Boolean],
      default: null,
    },
  },
  data() {
    return {};
  },
  mounted() {
    this.$nextTick(function () {});
  },
  methods: {},
};
</script>



    