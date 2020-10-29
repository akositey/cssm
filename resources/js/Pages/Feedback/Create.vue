<template>
  <feedback-layout>
    <!-- Questions -->
    <div class="m-auto overflow-hidden">
      <div
        :id="`question-0-cont`"
        class="h-screen p-6 bg-white rounded shadow-xl"
      >
        <div class="flex justify-between mt-4 md:mt-8 ">
          <div class="flex justify-center w-11/12 py-10 md:py-32">
            <div class="w-full p-8 text-xl font-bold text-left text-black md:text-5xl sm:text-3xl">
              <label class="form-label">Piliin ang serbisyong natanggap:</label>
              <emoji-error
                :message="form.error(`service_id`)"
                class="mt-2"
              />
              <select v-model="form.service_id" class="form-select" @change="scrollToNext(1)">
                <option :value="null" />
                <option v-for="service in services" :key="service.id" :value="service.id">
                  {{ service.name }}
                </option>
              </select>
            </div>
          </div>

          <div class="flex justify-center w-1/12 min-h-full">
            <button
              class="md:text-5xl btn-next"
              @click="scrollToNext(1)"
            >
              <icon
                name="cheveron-right"
                class="w-12 h-12 md:w-20 md:h-20 fill-white focus:fill-gray-600"
              />
            </button>
          </div>
        </div>
      </div>

      <!-- mandatory -->
      <div
        v-for="(question, i) in questionsSet.mandatory"
        :key="question.id"
        :id="`question-${i+1}-cont`"
        class="h-screen p-6 mt-20 bg-white rounded shadow-xl"
      >
        <div class="text-xl font-bold md:text-5xl sm:text-3xl">
          {{ i+1 }}. {{ question.question }}
        </div>
        <emoji-error
          :message="form.error(`mandatory.${question.id}.answer`)"
          class="mt-2"
        />

        <div class="flex justify-between mt-4 md:mt-8">
          <div class="flex justify-center w-1/12 min-h-full">
            <button
              class="md:text-5xl btn-prev"
              @click="scrollToNext(i)"
            >
              <icon
                name="cheveron-right"
                class="w-12 h-12 transform -rotate-180 md:w-20 md:h-20 fill-white focus:fill-gray-600"
              />
            </button>
          </div>

          <emoji-choices
            :questionNumber="i+1"
            :questionId="question.id"
            @answer-mandatory="updateAnswerMandatory"
          />

          <div class="flex justify-center w-1/12 min-h-full">
            <button
              class="md:text-5xl btn-next"
              @click="scrollToNext(i+2)"
            >
              <icon
                name="cheveron-right"
                class="w-12 h-12 md:w-20 md:h-20 fill-white focus:fill-gray-600"
              />
            </button>
          </div>
        </div>
      </div>

      <!-- optional-positive -->
      <div
        :id="`question-${questionsSet.mandatory.length+1}-cont`"
        class="h-full p-6 mt-20 bg-white rounded shadow-xl md:h-screen"
      >
        <div class="text-xl font-bold md:text-5xl sm:text-3xl">
          {{ questionsSet.mandatory.length+1 }}. (Opsyonal) Mga Positibong Kumento 👍
          <div class="md:text-3xl sm:text-lg">
            Maaaring pumili hanggang tatlo(3)
          </div>
        </div>
        

        <div class="flex justify-between">
          <div class="flex justify-center w-1/12 min-h-full">
            <button
              class="md:text-5xl btn-prev"
              @click="scrollToNext(questionsSet.mandatory.length)"
            >
              <icon
                name="cheveron-right"
                class="w-12 h-12 transform -rotate-180 md:w-20 md:h-20 fill-white focus:fill-gray-600"
              />
            </button>
          </div>
          <optional-comment
            questionType="positive"
            :questionNumber="questionsSet.mandatory.length+1"
            :questions="questionsSet.optional.positive"
            :maxChecked="maxChecked"
            @answers-optional="updateAnswerOptional"
          />
          <div class="flex justify-center w-1/12 min-h-full">
            <button
              class="md:text-5xl btn-next"
              @click="scrollToNext(questionsSet.mandatory.length+2)"
            >
              <icon
                name="cheveron-right"
                class="w-12 h-12 md:w-20 md:h-20 fill-white focus:fill-gray-600"
              />
            </button>
          </div>
        </div>
      </div>

      <!-- optional-negative -->
      <div
        :id="`question-${questionsSet.mandatory.length+2}-cont`"
        class="h-full p-6 mt-20 bg-white rounded shadow-xl md:h-screen"
      >
        <div class="text-xl font-bold md:text-5xl sm:text-3xl">
          {{ questionsSet.mandatory.length+2 }}. (Opsyonal) Mga Negatibong Kumento 👎🏾
          <div class="md:text-3xl sm:text-lg">
            Maaaring pumili hanggang tatlo(3)
          </div>
        </div>

        <div class="flex justify-between">
          <div class="flex justify-center w-1/12 min-h-full">
            <button
              class="md:text-5xl btn-prev"
              @click="scrollToNext(questionsSet.mandatory.length+1)"
            >
              <icon
                name="cheveron-right"
                class="w-12 h-12 transform -rotate-180 md:w-20 md:h-20 fill-white focus:fill-gray-600"
              />
            </button>
          </div>
          <optional-comment
            questionType="negative"
            :questionNumber="questionsSet.mandatory.length+2"
            :questions="questionsSet.optional.negative"
            :maxChecked="maxChecked"
            @answers-optional="updateAnswerOptional"
          />
          <div class="flex justify-center w-1/12 min-h-full">
            <button
              class="md:text-5xl btn-next"
              @click="scrollToNext(questionsSet.mandatory.length+3)"
            >
              <icon
                name="cheveron-right"
                class="w-12 h-12 md:w-20 md:h-20 fill-white focus:fill-gray-600"
              />
            </button>
          </div>
        </div>
      </div>

      <div
        :id="`question-${questionsSet.mandatory.length+3}-cont`"
        class="h-full p-6 pb-0 mt-20 bg-white rounded shadow-xl"
      >
        <div class="text-2xl font-bold md:text-5xl">
          Pirma
        </div>
        <div class="w-3/6 h-32 pb-8 m-auto md:h-64 md:p-8">
          <canvas
            id="signature-pad"
            class="w-full h-full border-4 border-gray-600 border-solid shadow-xl signature-pad"
          />
        </div>
        <div class="flex justify-between mt-8 md:p-8">
          <button
            class="text-xl md:text-5xl btn-gray"
            @click="clearSignature"
          >
            Burahin
          </button>
          <button :disabled="sending" class="flex items-center text-xl md:text-5xl btn-green" @click="submit">
            Tapusin
            <div v-if="sending" class="ml-2 text-xl md:ml-6 btn-spinner md:text-3xl" />
            <icon
              v-else
              name="cheveron-right"
              class="inline w-12 h-12 md:w-20 md:h-20 fill-white focus:fill-gray-600"
            />
          </button>
        </div>
      </div>
    </div>
  </feedback-layout>
</template>
<script>
import FeedbackLayout from "~/Layouts/FeedbackLayout";
import EmojiChoices from "~/Shared/EmojiChoices";
import OptionalComment from "~/Shared/OptionalComment";
import Icon from "~/Shared/Icon";
import EmojiError from "~/Shared/EmojiError";
import SignaturePad from "signature_pad";

export default {
  components: {
    FeedbackLayout,
    EmojiChoices,
    OptionalComment,
    Icon,
    EmojiError,
  },
  props: {
    errors: { type: Object, default: () => {} },
    questions: { type: Array, default: () => {} },
    services: { type: Array, default: () => {} },
  },
  data() {
    return {
      sending: false,
      form: this.$inertia.form(
        {
          service_id: null,
          mandatory: {},
          optional: {},
          signature: "",
        },
        {
          resetOnSuccess: false,
        }
      ),
      questionsSet: {
        mandatory: this.questions.filter((q) => q.is_required),
        optional: {
          positive: this.questions.filter(
            (q) => !q.is_required && q.type === 1
          ),
          negative: this.questions.filter(
            (q) => !q.is_required && q.type === 2
          ),
          // etc: this.questions.filter(
          //   (q) => !q.is_required && q.type === 3
          // ),
        },
      },
      maxChecked: 3,
      currentQuestion: 0,
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
      if (this.signaturePad.isEmpty()) {
        alert("Pumirma muna bago tapusin. Salamat po!");
      } else {
        this.form.signature = this.signaturePad.toDataURL(); //default is png
        this.sending = true;
        console.log(this.form);
        this.form
          .post(this.route("feedback.store"))
          .then(() => {
            this.sending = false;
            // console.log("form", this.form);
            // console.log("errors", this.$page.errors);
            // console.log("error-1", Object.keys(this.$page.errors)[0]);
            if (Object.keys(this.$page.errors)[0]) {
              const unanswered = Object.keys(this.$page.errors)[0];
              let questionNumber = 0;
              if(unanswered.match(/(\d+)/)){
                questionNumber = unanswered.match(/(\d+)/)[0];
                // console.log("error in: ", questionNumber);
              }
              this.scrollToNext(questionNumber);
            }
            // console.log(this.form);
          });
      }
    },
    clearSignature() {
      this.signaturePad.clear();
    },
    startSurvey() {
      this.scrollToNext(1);
    },
    updateAnswerMandatory(questionNumber, questionId, answer) {
      console.log(questionNumber, questionId, answer);
      this.form.mandatory[questionId] = {
        question_id: questionId,
        answer: answer,
      };

      this.scrollToNext(+questionNumber + 1);
    },
    updateAnswerOptional(questionNumber, type, chosenIds) {
      console.log(questionNumber, type, chosenIds);
      let newOptional = chosenIds.map((questionId) => {
        console.log('questionId',questionId)
        return {
          question_id: questionId,
          answer: 1,
        };
      });
      // console.log(newOptional);
      this.form.optional[type] = newOptional;

      // this.form.optional[type] = chosenIds;
      if (chosenIds.length === this.maxChecked) {
        this.scrollToNext(+questionNumber + 1);
      }
    },
    scrollToNext(questionNumber) {
      // scroll into the next view
      // console.log("scrolling to question #" + questionNumber);
      const block = document.getElementById(`question-${questionNumber}-cont`);
      window.scrollTo({ top: block.offsetTop, left: 0, behavior: "smooth" });
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
