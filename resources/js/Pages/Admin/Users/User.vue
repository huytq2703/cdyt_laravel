<script setup>
import { onMounted, ref, watch } from "vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Button from "primevue/button";
import UserDetailsComponent from "./Components/UserDetailsComponent.vue";
import InputText from "primevue/inputtext";
import Password from "primevue/password";
import Dropdown from "primevue/dropdown";

const props = defineProps({
  users: Array,
  roles: Array,
});
const userDetails = ref(null);
const isUpdateUser = ref(false);
const userDetailVisible = ref(false);
const newUserInfo = useForm({
  email: "",
  username: "",
  password: "",
  password_confirmation: "",
  roleCode: "REGISTERED",
});

const onPageChange = () => {};

const onSort = () => {};

const createUser = () => {
  newUserInfo.post(route("system.user.create"), {
    onSuccess: ({ props }) => {
      if (Object.keys(props?.errors) <= 0) newUserInfo.reset();
    },
    onFinish: () => {
      console.log(newUserInfo);
    },
  });
};

const showModelUserDetails = (details) => {
  isUpdateUser.value = true;
  userDetails.value = details;
  userDetailVisible.value = true;
};

onMounted(() => {});
</script>

<template>
  <UserDetailsComponent
    v-model="userDetailVisible"
    :roles="roles"
    :user="userDetails"
    :isUpdateUser="isUpdateUser"
  />
  <AdminLayout>
    <Head title="Hệ thống" />

    <div class="grid">
      <div class="lg:col-3 col-12">
        <div class="card">
          <h5 class="font-bold">Tạo tài khoản</h5>
          <form @submit.prevent="createUser">
            <div class="flex flex-column gap-3">
              <!-- Username -->
              <div class="flex flex-column">
                <label for="username">Tài khoản</label>
                <InputText
                  id="username"
                  v-model="newUserInfo.username"
                  :class="newUserInfo?.errors?.username && 'p-invalid'"
                />
                <small v-if="newUserInfo?.errors?.username" class="p-error">{{
                  newUserInfo?.errors.username
                }}</small>
              </div>

              <!-- Email -->
              <div class="flex flex-column">
                <label for="email">Địa chỉ email</label>
                <InputText
                  id="email"
                  type="email"
                  v-model="newUserInfo.email"
                  aria-describedby="email-help"
                  :class="[newUserInfo?.errors?.email && 'p-invalid']"
                />
                <small
                  v-if="newUserInfo?.errors?.email"
                  id="email-help"
                  class="p-error"
                  >{{ newUserInfo?.errors.email }}</small
                >
              </div>

              <!-- Roles -->
              <div class="flex flex-column">
                <label for="roleCode">Nhóm quyền</label>
                <Dropdown
                  v-model="newUserInfo.roleCode"
                  :options="roles"
                  optionLabel="name"
                  optionValue="code"
                  aria-describedby="roleCode-help"
                  :class="newUserInfo?.errors?.roleCode && 'p-invalid'"
                  :showClear="true"
                  placeholder="Chọn quyền"
                />
                <small
                  v-if="newUserInfo?.errors?.roleCode"
                  id="username-help"
                  class="p-error"
                  >{{ newUserInfo?.errors.roleCode }}</small
                >
              </div>

              <!-- Password -->
              <div class="flex flex-column">
                <label for="password">Mật khẩu</label>
                <Password
                  toggleMask
                  id="password"
                  v-model="newUserInfo.password"
                  aria-describedby="password-help"
                  :class="newUserInfo?.errors?.password && 'p-invalid'"
                  inputClass="w-full"
                />
                <small
                  v-if="newUserInfo?.errors?.password"
                  id="password-help"
                  class="p-error"
                  >{{ newUserInfo?.errors.password }}</small
                >
              </div>

              <!-- Password -->

              <div class="flex flex-column">
                <label for="password_confirmation">Nhập lại mật khẩu</label>
                <Password
                  toggleMask
                  id="password_confirmation"
                  v-model="newUserInfo.password_confirmation"
                  aria-describedby="confirmPassword-help"
                  :class="newUserInfo?.errors?.password_confirmation && 'p-invalid'"
                  inputClass="w-full"
                />
                <small
                  v-if="newUserInfo?.errors?.password_confirmation"
                  id="password_confirmation-help"
                  class="p-error"
                  >{{ newUserInfo?.errors.password_confirmation }}</small
                >
              </div>
            </div>

            <div class="flex pt-3">
              <Button type="submit" icon="pi pi-plus" label="Tạo mới" />
            </div>
          </form>
        </div>
      </div>

      <div class="lg:col-9 col-12">
        <div class="card">
          <h5 class="font-bold">Quản lý tài khoản</h5>
          <DataTable
            :value="users"
            :paginator="false"
            :rows="100"
            :totalRecords="0"
            :first="0"
            :sortField="null"
            :sortOrder="null"
            dataKey="id"
            :rowHover="true"
            :lazy="true"
            :autoLayout="true"
            responsiveLayout="scroll"
          >
            <Column field="id" header="id" :sortable="true" class="w-3rem"></Column>
            <Column field="username" header="Tài khoản" :sortable="true"></Column>
            <Column field="email" header="Email" :sortable="true"></Column>
            <Column
              field="role.name"
              header="Quyền"
              :sortable="true"
              class="w-12rem"
            ></Column>

            <Column header="Chức năng" class="w-10rem">
              <template #body="slotProps">
                <Button
                  icon="pi pi-file-edit"
                  class="p-button-rounded p-button-text"
                  @click="showModelUserDetails(slotProps.data)"
                />

                <Button
                  icon="pi pi-trash"
                  class="p-button-rounded p-button-text p-button-danger"
                  @click="deletePost(slotProps.data)"
                />
              </template>
            </Column>
          </DataTable>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
