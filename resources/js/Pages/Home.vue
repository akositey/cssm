<template>
  <feedback-layout>
    <div class="h-full">
      <form @submit.prevent="submit">
        <div class="p-8 text-xl font-bold text-left md:text-5xl sm:text-3xl">
          <p>
            Ano po ang masasabi nyo sa serbisyong naibigay sa inyo?
          </p>

          <div class="flex flex-no-wrap justify-center p-12">
            <inertia-link :href="route('survey.index')">
              <button
                class="text-xl sm:text-3xl btn-green md:btn-6xl md:text-5xl"
                @click="goFullScreen"
              >
                Simulan ang Survey ✍🏻
              </button>
            </inertia-link>
          </div>
        </div>
      </form>
    </div>
  </feedback-layout>
</template>
<script>
import FeedbackLayout from "~/Layouts/FeedbackLayout";
// import SelectInput from "~/Shared/SelectInput";

export default {
  components: { FeedbackLayout },
  props: {
    file: {
      type: String,
      default: "",
    },
  },
  // data() {
  //   return {
  //     form: this.$inertia.form({
  //       service : null
  //     })
  //   };
  // },
  mounted() {},
  methods: {
    // submit(){
    //   this.form.post(route('feedback.index'));
    // },
    goFullScreen() {
      //go fullscreen
      document.documentElement
        .requestFullscreen({ navigationUI: "show" })
        .then(function () {
          console.log("entered full screen");
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>



    