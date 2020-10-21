<template>
  <div class="min-h-screen bg-gray-100">
    <nav class="bg-white border-b border-gray-100">
      <!-- Primary Navigation Bar -->
      <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
          <!-- Logo -->
          <div class="flex items-center justify-center flex-1 md:items-stretch md:justify-start">
            <div class="flex-shrink-0">
              <inertia-link :href="route('feedback.index')">
                <logo class="block w-auto h-8 md:h-10" />
              </inertia-link>
            </div>
            <div class="hidden sm:block sm:ml-6">
              <div class="flex">
                <h2 class="items-center px-3 py-2 text-xl font-semibold leading-tight text-gray-800 ">
                  Customer Satisfaction Survey
                </h2>
              </div>
            </div>
          </div>
          <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
            <h2 class="items-center px-3 py-2 text-xl font-semibold leading-tight text-gray-800 ">
              {{ $page.user.name }}
            </h2>
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
import FlashMessages from "~/Shared/FlashMessages";

export default {
  components: {
    Logo,
    FlashMessages,
  },
  props: {
    office: {
      type: String,
      default: "",
    },
  },
  data() {
    return {
      showingNavigationDropdown: false,
    };
  },

  methods: {},

  computed: {
    path() {
      return window.location.pathname;
    },
  },
};
</script>
