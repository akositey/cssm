<template>
  <portal to="modal">
    <transition leaveActiveClass="duration-200">
      <div
        v-show="show"
        class="fixed inset-x-0 top-0 px-4 pt-6 sm:px-0 sm:flex sm:items-top sm:justify-center"
      >
        <transition
          enterActiveClass="ease-out duration-300"
          enterClass="opacity-0"
          enterToClass="opacity-100"
          leaveActiveClass="ease-in duration-200"
          leaveClass="opacity-100"
          leaveToClass="opacity-0"
        >
          <div
            v-show="show"
            class="fixed inset-0 transition-all transform"
            @click="close"
          >
            <div class="absolute inset-0 bg-gray-500 opacity-75" />
          </div>
        </transition>

        <transition
          enterActiveClass="ease-out duration-300"
          enterClass="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          enterToClass="opacity-100 translate-y-0 sm:scale-100"
          leaveActiveClass="ease-in duration-200"
          leaveClass="opacity-100 translate-y-0 sm:scale-100"
          leaveToClass="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
          <div
            v-show="show"
            class="overflow-hidden transition-all transform bg-white rounded-lg shadow-xl sm:w-full"
            :class="maxWidthClass"
          >
            <slot />
          </div>
        </transition>
      </div>
    </transition>
  </portal>
</template>

<script>
export default {
  props: {
    show: {
      default: false,
    },
    maxWidth: {
      default: "2xl",
    },
    closeable: {
      default: true,
    },
  },

  methods: {
    close() {
      if (this.closeable) {
        this.$emit("close");
      }
    },
  },

  watch: {
    show: {
      immediate: true,
      handler: (show) => {
        if (show) {
          document.body.style.overflow = "hidden";
        } else {
          document.body.style.overflow = null;
        }
      },
    },
  },

  created() {
    const closeOnEscape = (e) => {
      if (e.key === "Escape" && this.show) {
        this.close();
      }
    };

    document.addEventListener("keydown", closeOnEscape);

    this.$once("hook:destroyed", () => {
      document.removeEventListener("keydown", closeOnEscape);
    });
  },

  computed: {
    maxWidthClass() {
      return {
        sm: "sm:max-w-sm",
        md: "sm:max-w-md",
        lg: "sm:max-w-lg",
        xl: "sm:max-w-xl",
        "2xl": "sm:max-w-2xl",
      }[this.maxWidth];
    },
  },
};
</script>
