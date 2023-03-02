<script setup>
import InputText from "primevue/inputtext";

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
});

const onInput = (e) => {
  const value = e.target.value;
  emits("update:modelValue", value);
};
</script>

<template>
  <div class="flex flex-column">
    <label v-if="label" :for="id">{{ label }}</label>
    <InputText
      :id="id"
      :maxlength="maxlength"
      :value="modelValue"
      :class="errorMessage && 'p-invalid'"
      @input="onInput"
    />
    <small v-if="errorMessage" class="p-error">{{ errorMessage }}</small>
  </div>
</template>
