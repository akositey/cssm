<template>
  <div class="min-h-screen bg-gray-100">
    <nav class="bg-white border-b border-gray-100 shadow-md">
      <!-- Primary Navigation Menu -->
      <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex">
            <!-- Logo -->
            <div class="flex items-center flex-shrink-0">
              <inertia-link :href="route('dashboard')">
                <logo class="block w-auto h-10" />
              </inertia-link>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
              <jet-nav-link
                :href="route('dashboard')"
                :active="$page.props.currentRouteName == 'dashboard'"
              >
                Dashboard
              </jet-nav-link>
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
              <jet-nav-link
                :href="route('feedback.index')"
                :active="$page.props.currentRouteName == 'feedback.index'"
              >
                Feedback
              </jet-nav-link>
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
              <jet-nav-link
                :href="route('offices.index')"
                :active="$page.props.currentRouteName == 'offices.index'"
              >
                Offices
              </jet-nav-link>
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
              <jet-nav-link
                :href="route('services.index')"
                :active="$page.props.currentRouteName == 'services.index'"
              >
                Services
              </jet-nav-link>
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
              <jet-nav-link
                :href="route('questions.index')"
                :active="$page.props.currentRouteName == 'questions.index'"
              >
                Questions
              </jet-nav-link>
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
              <jet-nav-link
                :href="route('reports.index')"
                :active="$page.props.currentRouteName == 'reports.index'"
              >
                Reports
              </jet-nav-link>
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
              <jet-nav-link
                :href="route('signatories.index')"
                :active="$page.props.currentRouteName == 'signatories.index'"
              >
                Signatories
              </jet-nav-link>
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
                    <img
                      class="object-cover w-8 h-8 rounded-full"
                      :src="$page.props.user.profile_photo_url"
                      :alt="$page.props.user.name"
                    >
                  </button>
                </template>

                <template #content>
                  <!-- Account Management -->
                  <div class="block px-4 py-2 text-xs text-gray-400">
                    Manage Account
                  </div>

                  <jet-dropdown-link href="/user/profile">
                    Profile
                  </jet-dropdown-link>

                  <jet-dropdown-link
                    href="/user/api-tokens"
                    v-if="$page.props.jetstream.hasApiFeatures"
                  >
                    API Tokens
                  </jet-dropdown-link>

                  <div class="border-t border-gray-100" />

                  <!-- Authentication -->
                  <form @submit.prevent="logout">
                    <jet-dropdown-link as="button">
                      Logout
                    </jet-dropdown-link>
                  </form>
                </template>
              </jet-dropdown>
            </div>
          </div>

          <!-- Hamburger -->
          <div class="flex items-center -mr-2 sm:hidden">
            <button
              @click="showingNavigationDropdown = ! showingNavigationDropdown"
              class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500"
            >
              <svg
                class="w-6 h-6"
                stroke="currentColor"
                fill="none"
                viewBox="0 0 24 24"
              >
                <path
                  :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"
                />
                <path
                  :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Responsive Navigation Menu -->
      <div
        :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}"
        class="sm:hidden"
      >
        <div class="pt-2 pb-3 space-y-1">
          <jet-responsive-nav-link
            :href="route('dashboard')"
            :active="$page.props.currentRouteName == 'dashboard'"
          >
            Dashboard
          </jet-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
          <div class="flex items-center px-4">
            <div class="flex-shrink-0">
              <img
                class="w-10 h-10 rounded-full"
                :src="$page.props.user.profile_photo_url"
                :alt="$page.props.user.name"
              >
            </div>

            <div class="ml-3">
              <div class="text-base font-medium text-gray-800">
                {{ $page.props.user.name }}
              </div>
              <div class="text-sm font-medium text-gray-500">
                {{ $page.props.user.email }}
              </div>
            </div>
          </div>

          <div class="mt-3 space-y-1">
            <jet-responsive-nav-link
              href="/user/profile"
              :active="$page.props.currentRouteName == 'profile.show'"
            >
              Profile
            </jet-responsive-nav-link>

            <jet-responsive-nav-link
              href="/user/api-tokens"
              :active="$page.props.currentRouteName == 'api-tokens.index'"
              v-if="$page.props.jetstream.hasApiFeatures"
            >
              API Tokens
            </jet-responsive-nav-link>

            <!-- Authentication -->
            <form
              method="POST"
              @submit.prevent="logout"
            >
              <jet-responsive-nav-link as="button">
                Logout
              </jet-responsive-nav-link>
            </form>

            <!-- Team Management -->
            <template v-if="$page.props.jetstream.hasTeamFeatures">
              <div class="border-t border-gray-200" />

              <div class="block px-4 py-2 text-xs text-gray-400">
                Manage Team
              </div>

              <!-- Team Settings -->
              <jet-responsive-nav-link
                :href="'/teams/' + $page.props.user.current_team.id"
                :active="$page.props.currentRouteName == 'teams.show'"
              >
                Team Settings
              </jet-responsive-nav-link>

              <jet-responsive-nav-link
                href="/teams/create"
                :active="$page.props.currentRouteName == 'teams.create'"
              >
                Create New Team
              </jet-responsive-nav-link>

              <div class="border-t border-gray-200" />

              <!-- Team Switcher -->
              <div class="block px-4 py-2 text-xs text-gray-400">
                Switch Teams
              </div>

              <template v-for="team in $page.props.user.all_teams">
                <form
                  @submit.prevent="switchToTeam(team)"
                  :key="team.id"
                >
                  <jet-responsive-nav-link as="button">
                    <div class="flex items-center">
                      <svg
                        v-if="team.id == $page.props.user.current_team_id"
                        class="w-5 h-5 mr-2 text-green-400"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                      >
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                      <div>{{ team.name }}</div>
                    </div>
                  </jet-responsive-nav-link>
                </form>
              </template>
            </template>
          </div>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <main>
      <div
        class="flex-1 max-w-6xl px-4 py-4 m-auto overflow-y-auto"
        scroll-region
      >
        <!-- Page Heading -->
        <header>
          <h1 class="page-header">
            <slot name="header" />
          </h1>
        </header>

        <flash-messages />
        <error-boundary>
          <div>
            <slot />
          </div>
        </error-boundary>
      </div>
    </main>

    <!-- Modal Portal -->
    <portal-target
      name="modal"
      multiple
    />

    <!-- Dropdown Portal -->
    <portal-target
      name="dropdown"
      slim
    />
  </div>
</template>

<script>
import Logo from "~/Shared/DefaultLogo";
import JetDropdown from "~/Jetstream/Dropdown";
import JetDropdownLink from "~/Jetstream/DropdownLink";
import JetNavLink from "~/Jetstream/NavLink";
import JetResponsiveNavLink from "~/Jetstream/ResponsiveNavLink";
import FlashMessages from "~/Shared/FlashMessages";
import ErrorBoundary from "~/Shared/ErrorBoundary";

export default {
  components: {
    Logo,
    JetDropdown,
    JetDropdownLink,
    JetNavLink,
    FlashMessages,
    JetResponsiveNavLink,
    ErrorBoundary,
  },

  data() {
    return {
      showingNavigationDropdown: false,
    };
  },

  methods: {
    switchToTeam(team) {
      this.$inertia.put(
        "/current-team",
        {
          team_id: team.id,
        },
        {
          preserveState: false,
        }
      );
    },

    logout() {
      this.$inertia.post(this.route("logout"));
    },
  },

  computed: {
    path() {
      return window.location.pathname;
    },
  },
};
</script>
