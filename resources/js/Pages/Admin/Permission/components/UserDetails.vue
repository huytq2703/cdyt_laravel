<script setup>
import { ref, onMounted, watch, computed } from "vue";
import Dialog from "primevue/dialog";
import InputTextComponent from "@/Components/InputTextComponent.vue";
import { formatStringDateHour } from "@/utils/utils";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import Chip from "primevue/chip";
import Tag from "primevue/tag";
import DropdownComponent from "@/Components/DropdownComponent.vue";
import Accordion from "primevue/accordion";
import AccordionTab from "primevue/accordiontab";
import Button from "primevue/button";
import Password from "primevue/password";

const emits = defineEmits(["update:modelValue"]);
const props = defineProps({
  modelValue: {
    type: Boolean,
    required: false,
    default: false,
  },
  userDetails: {
    type: Object,
    required: false,
    default: null,
  },
});

const page = usePage();
const visible = ref(props.modelValue);
const userForm = useForm({
  id: null,
  username: "",
  email: "",
  role_code: "",
  password: "",
  password_confirmation: "",
});

const isCreateForm = computed(() => !userForm?.id);

const roleOptions = computed(() => {
  return page.props.value?.roles;
});

const roleSelected = computed(() => {
  return roleOptions.value?.find(({ code }) => code === userForm.role_code);
});

const permissionsName = computed(() => {
  const arr = [];
  const allPermissions = page.props.value?.permissions;
  roleSelected.value?.permissions?.forEach((per) => {
    if (allPermissions?.[per]?.name) arr.push(allPermissions?.[per]?.name);
  });
  return arr;
});

const onShowModal = () => {
  const details = props?.userDetails;
  if (!details?.id) {
    userForm.reset();
    return;
  }

  userForm.username = details?.username;
  userForm.email = details?.email;
  userForm.id = details?.id;
  userForm.role_code = details?.role_code;
};

const onClickUpdateUser = () => {
  userForm.put(route("system.user.update", { id: userForm.id }), {
    onSuccess: () => {
      userForm.reset();
      visible.value = false;
    },
  });
};

const onClickCreateUser = () => {
  userForm.post(route("system.user.create"), {
    onSuccess: () => {
      userForm.reset();
      visible.value = false;
    },
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

onMounted(() => {});
</script>

<template>
  <Dialog
    v-model:visible="visible"
    modal
    header="Cập nhật thông tin tài khoản"
    @show="onShowModal"
    class="w-7"
  >
    <form @submit.prevent="">
      <div class="flex flex-column gap-2">
        <InputTextComponent
          id="username"
          v-model="userForm.username"
          label="Tài khoản"
          :error-message="userForm?.errors?.username"
        />
        <InputTextComponent
          id="email"
          v-model="userForm.email"
          label="Email"
          :error-message="userForm?.errors?.email"
        />
        <div class="flex flex-column">
          <DropdownComponent
            v-model="userForm.role_code"
            :options="roleOptions"
            option-label="name"
            option-value="code"
            label="Nhóm quyền"
            :error-message="userForm.errors?.role_code"
          />

          <div v-if="permissionsName?.length > 0" class="">
            <p class="mt-2 font-italic text-600">{{ roleSelected?.description }}</p>

            <Accordion>
              <AccordionTab header="Chi tiết quyền">
                <div class="flex flex-wrap py-2 gap-2">
                  <Chip
                    v-for="(name, index) in permissionsName"
                    :key="index"
                    :label="name"
                  />
                </div>
              </AccordionTab>
            </Accordion>
          </div>

          <div v-else class="mt-2 font-italic text-600">Nhóm chưa được cập quyền nào</div>

          <div v-if="isCreateForm">
            <!-- Password -->
            <div class="flex flex-column mt-2">
              <label for="password">Mật khẩu</label>
              <Password
                toggleMask
                id="password"
                v-model="userForm.password"
                aria-describedby="password-help"
                :class="userForm?.errors?.password && 'p-invalid'"
                inputClass="w-full"
              />
              <small
                v-if="userForm?.errors?.password"
                id="password-help"
                class="p-error"
                >{{ userForm?.errors.password }}</small
              >
            </div>

            <!-- Password -->

            <div class="flex flex-column mt-2">
              <label for="password_confirmation">Nhập lại mật khẩu</label>
              <Password
                toggleMask
                id="password_confirmation"
                v-model="userForm.password_confirmation"
                aria-describedby="confirmPassword-help"
                :class="userForm?.errors?.password_confirmation && 'p-invalid'"
                inputClass="w-full"
              />
              <small
                v-if="userForm?.errors?.password_confirmation"
                id="password_confirmation-help"
                class="p-error"
                >{{ userForm?.errors.password_confirmation }}</small
              >
            </div>
          </div>
        </div>
      </div>
    </form>

    <template #footer>
      <div v-if="!isCreateForm" class="flex pt-2 justify-content-between">
        <div class="flex gap-2 mb-2 text-sm">
          <span class="font-bold">Ngày tạo: </span>
          <span class="font-italic">{{
            formatStringDateHour(userDetails?.created_at)
          }}</span>
        </div>
        <Button label="Cập nhật" @click="onClickUpdateUser" />
      </div>

      <div v-else class="class flex pt-2 justify-content-end">
        <Button label="Tạo" @click="onClickCreateUser" />
      </div>
    </template>
  </Dialog>
</template>
