<template>
  <div>
    <label
      v-if="label"
      class="form-label"
      :for="id"
    >{{ label }}:</label>
    <DatePicker
      :id="id"
      ref="input"
      v-bind="$attrs"
      v-model:value="chosen"
      class="w-full"
      inputClass="form-input"
      valueType="format"
      :class="{ error: error }"
      :type="type"
      :inputAttr="{ required: isRequired}"
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
import DatePicker from 'vue-datepicker-next'
import 'vue-datepicker-next/index.css'
import { v4 as uuid } from 'uuid'

export default {
  components: {
    DatePicker,
  },
  props: {
    id: {
      type: String,
      default() {
        return `date-${uuid()}`
      },
    },
    type: {
      type: String,
      default: 'date',
    },
    modelValue: {
      type: [String, Boolean],
      default: null,
    },
    label: {
      type: [String, Boolean],
      default: null,
    },
    error: {
      type: [String, Boolean],
      default: null,
    },
  },
  emits: ['update:modelValue'],
  data() {
    return {
      chosen: this.modelValue,
      isRequired: this.$attrs.hasOwnProperty('required'),
    }
  },
  watch: {
    chosen(chosen) {
      this.$emit('update:modelValue', chosen)
    },
  },
  methods: {
    focus() {
      this.$refs.input.focus()
    },
  },
}
</script>
