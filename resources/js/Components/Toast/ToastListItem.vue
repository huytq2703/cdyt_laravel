<script setup>
import Button from "primevue/button";
import { onMounted, computed } from "vue";

const props = defineProps({
  message: Object,
  duration: {
    type: Number,
    default: 2000,
  },
  status: {
    type: String,
    required: false,
    default: "error",
  },
});

const status = {
  success: {
    background: "success",
    icon: "pi-check",
    iconColor: "text-green-500",
    closeBtnColor: "text-800",
  },

  error: {
    background: "error",
    icon: "pi-info-circle ",
    iconColor: "text-red-500",
    closeBtnColor: "text-red-500",
  },
};

const statusProps = computed(() => {
  return status?.[props.status];
});

onMounted(() => {
  setTimeout(() => emit("remove"), props.duration);
});

const message = computed(() => {
  return props.message[props.status];
});

const emit = defineEmits(["remove"]);
</script>
<template>
  <div
    :class="[
      'toast-items',
      statusProps.background,
      'flex items-center rounded-lg p-2 shadow justify-content-between',
    ]"
    role="alert"
  >
    <div
      :class="[
        'inline-flex flex-shrink-0 items-center justify-center border-circle p-1.5',
        statusProps.iconColor,
        statusProps?.iconBg,
      ]"
    >
      <i :class="['pi', statusProps.icon]" style="font-size: 1.5rem"></i>
    </div>
    <div class="ml-3 text-sm font-bold w-full">{{ message }}</div>
    <Button
      icon="pi pi-times"
      @click="emit('remove')"
      :class="['p-button-rounded p-button-text flex-shrink-0', statusProps.closeBtnColor]"
    />
  </div>
</template>

<style lang="scss" scoped>
.toast-items {
  &.success {
    background-color: rgb(136 246 188);
  }

  &.error {
    background-color: rgb(255 178 178);
  }
}
</style>
