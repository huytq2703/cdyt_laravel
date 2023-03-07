<script setup>
import Dropdown from "primevue/dropdown";

const emits = defineEmits(["update:modelValue", "change"]);
const props = defineProps({
  id: {
    type: String,
    required: false,
    default: "",
  },
  modelValue: {
    type: [String, Number, Object],
    required: true,
  },
  label: {
    type: String,
    required: false,
    default: "",
  },
  optionLabel: {
    type: String,
    required: false,
    default: "",
  },
  optionValue: {
    type: [String, Object],
    required: false,
    default: null,
  },
  options: {
    type: Array,
    required: true,
  },
  placeholder: {
    type: String,
    required: false,
    default: "",
  },
  errorMessage: {
    type: String,
    required: false,
    default: "",
  },
  required: {
    type: Boolean,
    required: false,
    default: false,
  },
  disabled: {
    type: Boolean,
    required: false,
    default: false,
  },
  filter: {
    type: Boolean,
    required: false,
    default: false,
  },

  filterFields: {
    type: [String, Array],
    required: false,
    default: () => [],
  },
});

const onChange = (e) => {
  emits("change", e);
  emits("update:modelValue", e.value);
};
</script>

<template>
  <div class="flex flex-column w-full">
    <label :for="id">{{ label }} <span v-if="required" class="text-red">*</span></label>
    <Dropdown
      :id="id"
      :modelValue="modelValue"
      :options="options"
      :optionLabel="optionLabel"
      :optionValue="optionValue"
      :placeholder="placeholder"
      :class="[errorMessage && 'p-invalid', 'w-full']"
      :disabled="disabled"
      :filter="filter"
      :filterFields="filterFields"
      @change="onChange"
    />
    <small v-if="errorMessage" id="gender-help" class="p-error">{{ errorMessage }}</small>
  </div>
</template>
