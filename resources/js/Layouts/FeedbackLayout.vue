<template>
  <div class="min-h-screen bg-gray-200">
    <nav class="bg-white shadow-md">
      <!-- Primary Navigation Bar -->
      <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
          <!-- Logo -->
          <div class="flex items-center justify-center flex-1 md:items-stretch md:justify-start">
            <div class="flex-shrink-0">
              <inertia-link :href="route('home')">
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

          <!-- Settings Dropdown -->
          <div class="hidden sm:flex sm:items-center sm:ml-6">
            <div class="relative ml-3">
              <jet-dropdown
                align="right"
                width="48"
              >
                <template #trigger>
                  <button class="flex text-sm transition duration-150 ease-in-out border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                    <h2 class="items-center px-3 py-2 text-xl font-semibold leading-tight text-gray-800 ">
                      {{ $page.user.name }}
                    </h2>
                  </button>
                </template>

                <template #content>
                  <div class="block px-4 py-2 text-xs text-gray-400">
                    Tools
                  </div>

                  <jet-dropdown-link :href="route('export.create')">
                    Export
                  </jet-dropdown-link>
                </template>
              </jet-dropdown>
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
import FlashMessages from "~/Shared/FlashMessages";
import JetDropdown from "~/Jetstream/Dropdown";
import JetDropdownLink from "~/Jetstream/DropdownLink";

export default {
  components: {
    Logo,
    FlashMessages,
    JetDropdown,
    JetDropdownLink,
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
