<template>
  <div>
    <label
      v-if="label"
      class="form-label"
      :for="id"
    >{{ label }}:</label>
    <select
      :id="id"
      ref="input"
      :value="modelValue"
      class="form-select"
      :class="{ error: error }"
      @change="$emit('update:modelValue', $event.target.value)"
    >
      <slot />
    </select>
    <div
      v-if="error"
      class="form-error"
    >
      {{ error }}
    </div>
  </div>
</template>

<script>
import { v4 as uuid } from 'uuid'

export default {
  props: {
    id: {
      type: String,
      default() {
        return `select-input-${uuid()}`
      },
    },
    modelValue: {
      type: [String, Number, Boolean],
      default: () => {},
    },
    label: {
      type: [String, Boolean], default: null,
    },
    error: {
      type: [String, Boolean], default: null,
    },
  },
  emits: ['input'],
  data() {
    return {
      selected: this.modelValue,
    }
  },
  // computed: {
  //   selectedOption: {
  //     get() { return this.modelValue},
  //     set(selectedOption) { this.$emit('update:modelValue', selectedOption)},
  //   },
  // },
  methods: {
    focus() {
      this.$refs.input.focus()
    },
    select() {
      this.$refs.input.select()
    },
  },
}
</script>
