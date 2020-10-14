<template>
  <guest-layout>
    <!-- Intro -->

    <div class="h-screen">
      <div class="p-8 font-bold text-center md:text-6xl sm:text-3xl">
        Ano po ang masasabi nyo sa serbisyong naibigay sa inyo?

        <div class="flex flex-no-wrap justify-center p-12">
          <button
            @click="startSurvey()"
            class="sm:text-3xl btn-green md:btn-6xl md:text-6xl"
          >
            Simulan ang Survey
          </button>
        </div>
      </div>
    </div>

    <!-- Questions -->
    <div class="p-6 m-auto overflow-hidden bg-white rounded shadow-xl">
      <!-- mandatory -->
      <div
        v-for="(question, i) in questionsSet.mandatory.questions"
        :key="question.id"
        :id="`question-${i+1}-cont`"
        class="h-screen"
      >
        <div class="font-bold md:text-6xl sm:text-3xl">
          {{ i+1 }}. {{ question.question }}
        </div>
        <span :error="form.mandatory['question']" />
        <emoji-choices
          :questionNumber="i+1"
          :questionId="question.id"
          @answer-mandatory="updateAnswerMandatory"
        />
      </div>

      <!-- optional-positive -->
      <div
        :id="`question-${questionsSet.optional.positive.number}-cont`"
        class="h-full md:h-screen"
      >
        <div class="font-bold md:text-5xl sm:text-2xl">
          {{ questionsSet.optional.positive.number }}. (Opsyonal) Mga Positibong Kumento
        </div>
        <div class="font-bold md:text-3xl sm:text-lg">
          Maaaring pumili hanggang tatlo(3)
        </div>

        <optional-comment
          questionType="positive"
          :questionNumber="questionsSet.optional.positive.number"
          :questions="questionsSet.optional.positive.questions"
          :maxChecked="maxChecked"
          @answers-optional="updateAnswerOptional"
        />
      </div>

      <!-- optional-negative -->
      <div
        :id="`question-${questionsSet.optional.negative.number}-cont`"
        class="h-full md:h-screen"
      >
        <div class="font-bold md:text-5xl sm:text-2xl">
          {{ questionsSet.optional.negative.number }}. (Opsyonal) Mga Negatibong Kumento
        </div>
        <div class="font-bold md:text-3xl sm:text-lg">
          Maaaring pumili hanggang tatlo(3)
        </div>

        <optional-comment
          questionType="negative"
          :questionNumber="questionsSet.optional.negative.number"
          :questions="questionsSet.optional.negative.questions"
          :maxChecked="maxChecked"
          @answers-optional="updateAnswerOptional"
        />
      </div>

      <div
        :id="`question-${numberOfQuestions+1}-cont`"
        class="h-full pb-10 md:h-screen md:pb-0"
      >
        <div class="font-bold md:text-5xl sm:text-2xl">
          Pirma
        </div>
        <div class="w-full h-auto m-auto md:p-8 sm:pb-20 md:h-64">
          <canvas
            id="signature-pad"
            class="w-full h-full border-4 border-gray-600 border-solid shadow-xl signature-pad"
          />
          <div class="flex justify-between mt-8">
            <button
              id="clear"
              class="md:text-5xl sm:text-2xl btn-gray"
              @click="clearSignature"
            >
              Burahin
            </button>
            <button
              id="save"
              class="md:text-5xl sm:text-2xl btn-green"
              @click="submit"
            >
              Tapusin
            </button>
          </div>
        </div>
      </div>
    </div>
  </guest-layout>
</template>
<script>
import GuestLayout from "~/Layouts/GuestLayout";
import EmojiChoices from "~/Shared/EmojiChoices.vue";
import OptionalComment from "~/Shared/OptionalComment.vue";
import SignaturePad from "signature_pad";

export default {
  components: {
    GuestLayout,
    EmojiChoices,
    OptionalComment,
  },
  props: {
    errors: { type: Object, default: () => {} },
    questions: { type: Object, default: () => {} },
  },
  remember: "form",
  data() {
    return {
      sending: false,
      form: {
        ip_id: "1",
        mandatory: {},
        optional: {},
      },
      questionsSet: {
        mandatory: {
          questions: this.questions.mandatory,
          count: this.questions.mandatory.length,
        },
        optional: {
          positive: {
            questions: this.questions.optional.positive,
            number: this.questions.mandatory.length + 1,
          },
          negative: {
            questions: this.questions.optional.negative,
            number: this.questions.mandatory.length + 2,
          },
          etc: {
            //implement this later
            questions: this.questions.optional.etc,
            number: this.questions.mandatory.length + 3,
          },
        },
      },
      maxChecked: 3,
      numberOfQuestions:
        Object.keys(this.questions.mandatory).length +
        Object.keys(this.questions.optional).length,
      canvas: null,
      signaturePad: null,
    };
  },
  mounted() {
    this.$nextTick(function () {
      // scroll to top
      window.scrollTo({ top: 0, behavior: "smooth" });

      //init signature_pad
      this.canvas = document.getElementById("signature-pad");
      this.signaturePad = new SignaturePad(this.canvas);
      //resize canvas, fix for signature_pad
      window.addEventListener("resize", this.resizeCanvas);
      this.resizeCanvas();
    });
  },
  methods: {
    submit() {
      console.log("submit triggered!");
      // check if signature is not empty
      // if (this.signaturePad.isEmpty()) {
      //   alert("Pumirma muna bago tapusin. Salamat po!");
      // }

      this.form.signature = this.signaturePad.toDataURL("image/jpeg");

      // console.log(this.form);

      this.sending = true;
      this.$inertia
        .post(this.route("feedback.store"), this.form)
        .then(() => (this.sending = false));
    },
    clearSignature() {
      this.signaturePad.clear();
    },
    startSurvey() {
      this.goToNextQuestion(1);
    },
    updateAnswerMandatory(questionNumber, questionId, answer) {
      this.form.mandatory[questionId] = answer;

      this.goToNextQuestion(+questionNumber + 1);
    },
    updateAnswerOptional(questionNumber, type, answer) {
      this.form.optional[type] = answer;
      if (answer.length === this.maxChecked) {
        this.goToNextQuestion(+questionNumber + 1);
      }
    },
    goToNextQuestion(questionNumber) {
      // scroll into the next view
      document
        .getElementById(`question-${questionNumber}-cont`)
        .scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
    },
    resizeCanvas() {
      const ratio = Math.max(window.devicePixelRatio || 1, 1);
      this.canvas.width = this.canvas.offsetWidth * ratio;
      this.canvas.height = this.canvas.offsetHeight * ratio;
      this.canvas.getContext("2d").scale(ratio, ratio);
      this.signaturePad.clear(); // otherwise isEmpty() might return incorrect value
    },
  },
};
</script>
