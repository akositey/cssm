<template>
  <div class="min-h-screen bg-gray-100">
    <nav class="bg-white border-b border-gray-100">
      <!-- Primary Navigation Bar -->
      <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex">
            <!-- Logo -->
            <div class="flex items-center flex-shrink-0">
              <inertia-link :href="route('feedback.index')">
                <logo class="block w-auto h-10" />
              </inertia-link>
            </div>

            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
              <h2
                class="inline-flex items-center p-2 text-xl font-semibold leading-tight text-gray-800 "
              >
                Customer Satisfaction Survey
              </h2>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <main>
      <div
        class="flex-1 px-4 py-4 m-auto overflow-y-auto max-w-7xl "
        scroll-region
      >
        <flash-messages />
        <slot />
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
import Logo from "~/Shared/PgomLogo";
import FlashMessages from '~/Shared/FlashMessages';

export default {
  components: {
    Logo,
    FlashMessages,
  },

  data() {
    return {
      showingNavigationDropdown: false,
    };
  },

  methods: {
    
  },

  computed: {
    path() {
      return window.location.pathname;
    },
  },
};
</script>
