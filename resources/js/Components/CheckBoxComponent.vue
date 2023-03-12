<script setup>
import Checkbox from "primevue/checkbox";
import { ref, watch } from "vue";

const emits = defineEmits(["update:modelValue"]);
const props = defineProps({
  id: {
    type: String,
    required: false,
    default: "",
  },
  modelValue: {
    type: Boolean,
    required: false,
    default: false,
  },
  name: {
    type: String,
    required: false,
    default: "",
  },
  errorMessage: {
    type: String,
    required: false,
    default: "",
  },
  label: {
    type: String,
    required: false,
    default: "",
  },
});
const value = ref(props.modelValue);

watch(value, (checked) => {
  emits("update:modelValue", checked);
});
</script>

<template>
  <div class="flex flex-row gap-3">
    <Checkbox
      v-model="value"
      :input-id="id"
      :value="modelValue"
      :name="name"
      :binary="true"
    />
    <label :for="id">{{ label }}</label>
  </div>
</template>
