<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import Button from "primevue/button";
import Dialog from "primevue/dialog";
import Password from "primevue/password";
import { useConfirm } from "primevue/useconfirm";
import { ref, watch } from "vue";

const confirm = useConfirm();
const emits = defineEmits(["update:modelValue"]);
const props = defineProps({
  modelValue: {
    type: Boolean,
    required: false,
    default: false,
  },
  user: {
    type: Object,
    require: true,
  },
});
const passwordForm = useForm({
  password: "",
  password_confirmation: "",
});

const visible = ref(props.modelValue);

const onUpdatePassword = () => {
  confirm.require({
    message: "Bạn có chắc chắn đổi mật khẩu không?",
    header: "Thông báo",
    icon: "pi pi-info-circle",
    acceptClass: "p-button-danger",
    acceptLabel: "Đồng ý",
    rejectLabel: "Huỷ",
    accept: () => {
      passwordForm.put(route("system.user.change_password", { id: props?.user?.id }), {
        onSuccess: () => {
          passwordForm.reset();
          visible.value = false;
        },
      });
    },
    reject: () => {},
  });
};

watch(
  () => props.modelValue,
  (value) => {
    visible.value = value;
  }
);

watch(visible, (value) => {
  emits("update:modelValue", value);
});
</script>

<template>
  <Dialog
    v-model:visible="visible"
    modal
    :header="`Đổi mật khẩu tài khoản ${user?.username}`"
    class="w-4"
  >
    <form @submit.prevent="onUpdatePassword" class="flex flex-column gap-2">
      <!-- Password -->
      <div class="flex flex-column">
        <label for="password">Mật khẩu</label>
        <Password
          toggleMask
          id="password"
          v-model="passwordForm.password"
          aria-describedby="password-help"
          :class="passwordForm?.errors?.password && 'p-invalid'"
          inputClass="w-full"
        />
        <small v-if="passwordForm?.errors?.password" id="password-help" class="p-error">{{
          passwordForm?.errors.password
        }}</small>
      </div>

      <!-- Password -->

      <div class="flex flex-column">
        <label for="password_confirmation">Nhập lại mật khẩu</label>
        <Password
          toggleMask
          id="password_confirmation"
          v-model="passwordForm.password_confirmation"
          aria-describedby="confirmPassword-help"
          :class="passwordForm?.errors?.password_confirmation && 'p-invalid'"
          inputClass="w-full"
        />
        <small
          v-if="passwordForm?.errors?.password_confirmation"
          id="password_confirmation-help"
          class="p-error"
          >{{ passwordForm?.errors.password_confirmation }}</small
        >
      </div>

      <div class="flex pt-3 justify-content-end">
        <Button type="submit" label="Cập nhật" />
      </div>
    </form>
  </Dialog>
</template>
