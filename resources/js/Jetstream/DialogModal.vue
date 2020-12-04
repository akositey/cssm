<template>
  <modal
    :show="isShown"
    :maxWidth="maxWidth"
    :closeable="closeable"
    @close="closeModal"
  >
    <div class="px-6 py-4">
      <div class="text-lg font-bold">
        <slot name="title" />
      </div>

      <div class="mt-4">
        <slot name="content" />
      </div>
    </div>

    <div class="px-6 py-4 text-right bg-gray-100">
      <slot name="footer" />
    </div>
  </modal>
</template>

<script>
import Modal from "./Modal";

export default {
  components: {
    Modal,
  },
  props: {
    show: {
      type: Boolean,
      default: false,
    },
    maxWidth: {
      type: String,
      default: "2xl",
    },
    closeable: {
      type: Boolean,
      default: true,
    },
  },
  data() {
    return {
      isShown: this.show,
    };
  },
  watch: {
    show() {
      this.isShown = this.show;
    },
  },
  mounted() {
    // this.$nextTick(function () {
    //   // console.log("isShown", this.isShown);
    // });
  },
  methods: {
    closeModal() {
      this.$emit("close");
    },
  },
};
</script>
