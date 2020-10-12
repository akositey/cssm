<template>
  <guest-layout>
    <div class="p-6 text-3xl font-bold ">
      Ano po ang masasabi nyo sa serbisyong naibigay sa inyo?
    </div>
    <div class="p-6 m-auto overflow-hidden bg-white rounded shadow-xl">
      <div v-if="urlHash ==='#1'">
        <div class="text-4xl font-bold">
          1. Magalang ang pagbibigay ng serbisyo:
        </div>
        
        <div class="flex flex-wrap p-8">
          <!-- <inertia-link class="focus:text-indigo-500" :href="route('offices.edit', row.id)" tabindex="-1"> -->
          <emoji-icon name="angry" class="flex-1 w-40 h-40" @click="saveAnswer(1,1)" />
          <!-- </inertia-link> -->
          <emoji-icon name="sad" class="flex-1 w-40 h-40" @click="saveAnswer(1,2)" />
          <emoji-icon name="like" class="flex-1 w-40 h-40" @click="saveAnswer(1,3)" />
          <emoji-icon name="wow" class="flex-1 w-40 h-40" @click="saveAnswer(1,4)" />
          <emoji-icon name="love" class="flex-1 w-40 h-40" @click="saveAnswer(1,5)" />
        </div>
      </div>

      <div v-else-if="urlHash ==='#2'">
        <div class="text-4xl font-bold">
          2. Mabilis na natugunan ang pangangailangan:
        </div>
        
        <div class="flex flex-wrap p-8">
          <emoji-icon name="angry" class="flex-1 w-40 h-40" @click="saveAnswer(2,1)" />
          <emoji-icon name="sad" class="flex-1 w-40 h-40" @click="saveAnswer(2,2)" />
          <emoji-icon name="like" class="flex-1 w-40 h-40" @click="saveAnswer(2,3)" />
          <emoji-icon name="wow" class="flex-1 w-40 h-40" @click="saveAnswer(2,4)" />
          <emoji-icon name="love" class="flex-1 w-40 h-40" @click="saveAnswer(2,5)" />
        </div>
      </div>
      
      <div v-else-if="urlHash ==='#3'">
        <div class="text-4xl font-bold">
          3. Natugunan ng wasto at kumpleto ang pangangailangan:
        </div>
        
        <div class="flex flex-wrap p-8">
          <emoji-icon name="angry" class="flex-1 w-40 h-40" @click="saveAnswer(3,1)" />
          <emoji-icon name="sad" class="flex-1 w-40 h-40" @click="saveAnswer(3,2)" />
          <emoji-icon name="like" class="flex-1 w-40 h-40" @click="saveAnswer(3,3)" />
          <emoji-icon name="wow" class="flex-1 w-40 h-40" @click="saveAnswer(3,4)" />
          <emoji-icon name="love" class="flex-1 w-40 h-40" @click="saveAnswer(3,5)" />
        </div>
      </div>
    </div>
  </guest-layout>
</template>

<script>
import GuestLayout from "~/Layouts/GuestLayout";
import EmojiIcon from "~/Shared/EmojiIcon.vue";

export default {
  components: {
    GuestLayout,
    EmojiIcon,
  },
  props: {
    errors: { type: Object, default: ()=>{} },
    test: { type: String, default:'' },
  },
  remember: 'form',
  data() {
    return {
      sending: false,
      answers: [],
      urlHash: window.location.hash
    }
  },
  watch: {
    urlHash(urlHash){
      console.log(urlHash)
    }
  },
  methods: {
    submit() {
      this.sending = true
      this.$inertia.post(this.route('feedback.store'), this.form)
        .then(() => this.sending = false)
    },
    saveAnswer(questionNumber, answer){
      this.sending = true
      if(questionNumber<6){
        this.answers.push(answer);
        console.log(this.answers)
        console.log(this.$inertia.route)
      }
      // this.$inertia.post(this.route('feedback.store'), this.form)
      //   .then(() => this.sending = false)
    }
  },
}
</script>
