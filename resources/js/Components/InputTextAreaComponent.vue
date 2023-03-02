<script setup>
import Textarea from "primevue/textarea";

const emits = defineEmits(["update:modelValue"]);
const props = defineProps({
  id: {
    type: String,
    required: false,
    default: "",
  },
  label: {
    type: String,
    required: false,
    default: "",
  },
  modelValue: {
    type: String,
    required: false,
    default: "",
  },
  errorMessage: {
    type: String,
    required: false,
    default: "",
  },
  maxlength: {
    type: Number,
    required: false,
    default: 255,
  },
  rows: {
    type: Number,
    required: false,
    default: 3,
  },
});

const onInput = (e) => {
  const value = e.target.value;
  emits("update:modelValue", value);
};
</script>

<template>
  <div class="flex flex-column">
    <label v-if="label" :for="id">{{ label }}</label>
    <Textarea
      :id="id"
      :maxlength="maxlength"
      :value="modelValue"
      :class="errorMessage && 'p-invalid'"
      :rows="rows"
      @input="onInput"
    />
    <small v-if="errorMessage" class="p-error">{{ errorMessage }}</small>
  </div>
</template>
