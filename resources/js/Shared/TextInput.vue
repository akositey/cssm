<template>
  <div>
    <label
      v-if="label"
      class="form-label"
      :for="id"
    >{{ label }}:</label>
    <input
      :id="id"
      ref="input"
      class="form-input"
      :class="{ error: error }"
      :type="type"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
    />
    <div
      v-if="error"
      class="form-error"
    >
      {{ error }}
    </div>
  </div>
</template>

<script>
import {v4 as uuid} from 'uuid'
import {useAttrs} from "vue";

export default {
  props: {
    id: {
      type: String,
      default() {
        return `text-input-${uuid()}`
      },
    },
    type: {
      type: String,
      default: 'text',
    },
    modelValue: {
      type: String, default: () => {
      },
    },
    label: {
      type: String, default: () => {
      },
    },
    error: {
      type: String, default: () => {
      },
    },
  },
  emits: ['update:modelValue'],
  setup() {
    const attrs = useAttrs();
    return {attrs}
  },
  methods: {
    focus() {
      this.$refs.input.focus()
    },
    select() {
      this.$refs.input.select()
    },
    setSelectionRange(start, end) {
      this.$refs.input.setSelectionRange(start, end)
    },
  },
}
</script>
