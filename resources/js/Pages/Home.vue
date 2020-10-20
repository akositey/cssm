<template>
  <div class="min-h-screen bg-gray-100">
    <nav class="bg-white border-b border-gray-100">
      <!-- Primary Navigation Bar -->
      <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-12 md:h-16">
          <div class="flex">
            <!-- Logo -->
            <div class="flex items-center flex-shrink-0">
              <inertia-link :href="route('feedback.index')">
                <logo class="block w-auto h-8 md:h-10" />
              </inertia-link>
            </div>

            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
              <h2 class="inline-flex items-center p-2 text-xl font-semibold leading-tight text-gray-800 ">
                Customer Satisfaction Survey | Office: {{ office }}
              </h2>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <main>
      <div
        class="flex-1 px-4 py-4 m-auto overflow-y-auto max-w-7xl "
        scroll-region
      >
        <flash-messages />

        <div class="h-screen">
          <div class="p-8 text-xl font-bold text-center md:text-5xl sm:text-3xl">
            Ano po ang masasabi nyo sa serbisyong naibigay sa inyo?

            <div class="flex flex-no-wrap justify-center p-12">
              <inertia-link :href="route('feedback.index')">
                <button class="text-xl sm:text-3xl btn-green md:btn-6xl md:text-5xl">
                  Simulan ang Survey ✍🏻
                </button>
              </inertia-link>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Dropdown Portal -->
    <portal-target
      name="dropdown"
      slim
    />
  </div>
</template>
<script>
// import AppLayout from "~/Layouts/GuestLayout";
import FlashMessages from "~/Shared/FlashMessages";

export default {
  components: { FlashMessages },
  props: {
    office: {
      type: String,
      default: "",
    },
  },
  data() {
    return {};
  },
  mounted() {},
  methods: {},
};
</script>



    