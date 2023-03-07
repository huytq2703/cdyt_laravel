<script setup>
import Calendar from "primevue/calendar";

const emits = defineEmits(["update:modelValue"]);
const props = defineProps({
  id: {
    type: String,
    required: false,
    default: "",
  },
  modelValue: {
    type: [Array, String, Object],
    required: true,
  },
  label: {
    type: String,
    required: false,
    default: "",
  },
  required: {
    type: Boolean,
    required: false,
    default: false,
  },
  dateFormat: {
    type: String,
    required: false,
    default: "mm-dd-yy",
  },
  errorMessage: {
    type: String,
    required: false,
    default: "",
  },
  placeholder: {
    type: String,
    required: false,
    default: "",
  },
});

const onDateSelect = (value) => {
  emits("update:modelValue", value);
};
</script>

<template>
  <div class="w-full flex flex-column">
    <label :for="id" class=""
      >{{ label }} <span v-if="required" class="text-red">*</span></label
    >
    <Calendar
      :inputId="id"
      :modelValue="modelValue"
      :dateFormat="dateFormat"
      :class="[errorMessage && 'p-invalid']"
      :placeholder="placeholder"
      @date-select="onDateSelect"
    />
    <small v-if="errorMessage" id="birthday-help" class="p-error">{{
      errorMessage
    }}</small>
  </div>
</template>
