<script setup>
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import Button from "primevue/button";
import Dialog from "primevue/dialog";
import InputText from "primevue/inputtext";
import Dropdown from "primevue/dropdown";

import { ref, watch } from "vue";

const page = usePage();
const props = defineProps({
  roles: Array,
  user: Object,
  isUpdateUser: Boolean,
  errors: Object,
  modelValue: Boolean,
});
const emits = defineEmits(["update:modelValue"]);

const userInfo = useForm({
  id: "",
  username: "",
  name: "",
  email: "",
  roleCode: "",
});

const display = ref(false);

const onShow = () => {
  if (props.isUpdateUser) {
    userInfo.id = props.user.id;
    userInfo.username = props.user.username;
    userInfo.name = props.user.name;
    userInfo.email = props.user.email;
    userInfo.roleCode = props.user.role_code;
  } else {
    userInfo.reset();
  }
};

const onClickUpdateUser = () => {
  userInfo.post(route("system.user.update"), {
    onSuccess: () => {
      userInfo.reset();
      display.value = false;
    },
  });
};

watch(
  () => props.modelValue,
  (value) => {
    display.value = value;
  }
);

watch(display, (value) => {
  emits("update:modelValue", value);
});
</script>

<template>
  <Dialog
    header="Header"
    v-model:visible="display"
    modal
    :draggable="false"
    contentStyle="width: 350px"
    @show="onShow"
  >
    <template #header><h5 class="m-0">Thông tin tài khoản</h5></template>

    <div class="flex flex-column gap-3">
      <!-- Name -->
      <div class="flex flex-column">
        <label for="name">Họ và tên</label>
        <InputText
          id="name"
          v-model="userInfo.name"
          aria-describedby="name-help"
          :class="userInfo?.errors?.name && 'p-invalid'"
        />
        <small v-if="userInfo?.errors?.name" id="name-help" class="p-error">{{
          userInfo?.errors.name
        }}</small>
      </div>

      <!-- Username -->
      <div class="flex flex-column">
        <label for="usename">Tài khoản</label>
        <InputText
          id="username"
          v-model="userInfo.username"
          aria-describedby="username-help"
          :class="userInfo?.errors?.username && 'p-invalid'"
          :disabled="true"
        />
        <small v-if="userInfo?.errors?.username" id="username-help" class="p-error">{{
          userInfo?.errors.username
        }}</small>
      </div>

      <!-- Email -->
      <div class="flex flex-column">
        <label for="email">Địa chỉ email</label>
        <InputText
          id="email"
          v-model="userInfo.email"
          aria-describedby="email-help"
          :class="userInfo?.errors?.email && 'p-invalid'"
          :disabled="true"
        />
        <small v-if="userInfo?.errors?.email" id="email-help" class="p-error">{{
          userInfo?.errors.email
        }}</small>
      </div>

      <!-- Email -->
      <div class="flex flex-column">
        <label for="roleCode">Nhóm quyền</label>
        <Dropdown
          v-model="userInfo.roleCode"
          :options="roles"
          placeholder="Chọn nhóm quyền"
        />
        <small v-if="userInfo?.errors?.roleCode" id="roleCode-help" class="p-error">{{
          userInfo?.errors.roleCode
        }}</small>
      </div>
    </div>

    <template #footer>
      <div class="flex mt-3 justify-content-end">
        <!-- <Button v-if="isUpdateUser" @click="onClickCreateNewPost">Thêm</Button>
        <Button v-if="!isUpdateUser" @click="onClickUpdatePost">Cập nhật</Button> -->
        <Button @click="onClickUpdateUser">Cập nhật</Button>
      </div>
    </template>
  </Dialog>
</template>
