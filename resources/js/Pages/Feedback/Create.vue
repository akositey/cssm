<template>
  <guest-layout>
    <!-- Intro -->

    <div class="h-screen">
      <div class="p-8 text-6xl font-bold text-center">
        Ano po ang masasabi nyo sa serbisyong naibigay sa inyo?

        <div class="flex flex-no-wrap justify-center p-12">
          <button
            @click="startSurvey()"
            class="btn-green btn-6xl "
          >
            Magsimula
          </button>
        </div>
      </div>
    </div>
    <!-- test -->

    <!-- Questions -->
    <div class="p-6 m-auto overflow-hidden bg-white rounded shadow-xl">
      <div
        id="question-1-cont"
        class="h-screen"
      >
        <div class="text-6xl font-bold">
          1. Magalang ang pagbibigay ng serbisyo:
        </div>
        <emoji-choices
          question="1"
          @answer-question="updateAnswer"
        />
      </div>

      <div
        id="question-2-cont"
        class="h-screen"
      >
        <div class="text-6xl font-bold">
          2. Mabilis na natugunan ang pangangailangan:
        </div>
        <emoji-choices
          question="2"
          @answer-question="updateAnswer"
        />
      </div>

      <div
        id="question-3-cont"
        class="h-screen"
      >
        <div class="text-6xl font-bold">
          3. Natugunan ng wasto at kumpleto ang pangangailangan:
        </div>
        <emoji-choices
          question="3"
          @answer-question="updateAnswer"
        />
      </div>

      <div
        id="question-4-cont"
        class="h-screen"
      >
        <div class="text-5xl font-bold">
          (Opsyonal) Mga Positibong Kumento
        </div>
        <div class="text-3xl font-bold">
          Maaaring pumili hanggang tatlo(3)
        </div>
        {{ checkedPositive }}
        <div class="table w-full text-4xl">
          <div class="tr">
            <div class="justify-center w-1/6 td">
              <input
                type="checkbox"
                id="positive1"
                value="1"
                v-model="checkedPositive"
                :disabled="checkedPositive.length >= maxChecked && checkedPositive.indexOf('1') == -1"
                class="zoom-2"
              >
            </div>
            <div class="w-5/6 td">
              Maagap sa pag-asikaso sa kliyente
            </div>
          </div>
          <div class="tr">
            <div class="justify-center w-1/6 td">
              <input
                type="checkbox"
                id="positive2"
                value="2"
                v-model="checkedPositive"
                :disabled="checkedPositive.length >= maxChecked && checkedPositive.indexOf('2') == -1"
                class="zoom-2"
              >
            </div>
            <div class="w-5/6 td">
              Magalang at maayos ang pakikitungo ng mga empleyado
            </div>
          </div>
          <div class="tr">
            <div class="justify-center w-1/6 td">
              <input
                type="checkbox"
                id="positive3"
                value="3"
                v-model="checkedPositive"
                :disabled="checkedPositive.length >= maxChecked && checkedPositive.indexOf('3') == -1"
                class="zoom-2"
              >
            </div>
            <div class="w-5/6 td">
              Malinis ang opisina
            </div>
          </div>
          <div class="tr">
            <div class="justify-center w-1/6 td">
              <input
                type="checkbox"
                id="positive4"
                value="4"
                v-model="checkedPositive"
                :disabled="checkedPositive.length >= maxChecked && checkedPositive.indexOf('4') == -1"
                class="zoom-2"
              >
            </div>
            <div class="w-5/6 td">
              Mabilis ang pagproseso ng mga dokumento
            </div>
          </div>
          <div class="tr">
            <div class="justify-center w-1/6 td">
              <input
                type="checkbox"
                id="positive5"
                value="5"
                v-model="checkedPositive"
                :disabled="checkedPositive.length >= maxChecked && checkedPositive.indexOf('5') == -1"
                class="zoom-2"
              >
            </div>
            <div class="w-5/6 td">
              Maayos ang pasilidad para sa mga Senior Citizens at PWD
            </div>
          </div>
          <div class="tr">
            <div class="justify-center w-1/6 td">
              <input
                type="checkbox"
                id="positive6"
                value="6"
                v-model="checkedPositive"
                :disabled="checkedPositive.length >= maxChecked && checkedPositive.indexOf('6') == -1"
                class="zoom-2"
              >
            </div>
            <div class="w-5/6 td">
              Maaga pumasok ang employado
            </div>
          </div>
        </div>
      </div>
    </div>
  </guest-layout>
</template>
<script>
import GuestLayout from "~/Layouts/GuestLayout";
import EmojiChoices from "~/Shared/EmojiChoices.vue";

export default {
  components: {
    GuestLayout,
    EmojiChoices,
  },
  props: {
    errors: { type: Object, default: () => {} },
    test: { type: String, default: "" },
  },
  // remember: "form",
  data() {
    return {
      sending: false,
      form: {
        name: null,
        nick: null,
        parent_id: null,
      },
      answers: {},
      maxChecked: 3,
      checkedPositive: [],
      checkedNegative: [],
    };
  },
  mounted() {
    this.$nextTick(function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  },
  watch: {
    // answers(answers) {
    //   console.log(answers);
    // },
  },
  methods: {
    submit() {
      this.sending = true;
      this.$inertia
        .post(this.route("feedback.store"), this.form)
        .then(() => (this.sending = false));
    },
    startSurvey() {
      document.getElementById("question-1-cont").scrollIntoView({
        behavior: "smooth",
        block: "start",
      });
    },
    updateAnswer(question, answer) {
      console.log("updating answers...", question, answer);
      this.answers[`q${question}`] = answer;
      console.log("new answers...", this.answers);

      this.goToNextQuestion(+question + 1);
    },
    goToNextQuestion(question) {
      if (question < 6) {
        // scroll into the next view
        document.getElementById(`question-${question}-cont`).scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      } else {
        // finish survey! //post
        this.submit();
      }
    },
  },
};
</script>
