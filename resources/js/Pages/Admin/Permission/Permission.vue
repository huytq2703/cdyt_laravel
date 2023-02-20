<script setup>
import { onMounted, computed, watch, ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import InputText from "primevue/inputtext";
import Textarea from "primevue/textarea";
import Checkbox from "primevue/checkbox";
import Button from "primevue/button";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Badge from "primevue/badge";

const props = defineProps({
  permissions: Object,
  roles: Array,
});

const role = useForm({
  code: "",
  name: "",
  permissions: [],
  description: "",
});

const permissionArr = computed(() => {
  const per = props.permissions;
  if (per) {
    return Object.keys(per).map((key) => ({
      code: key,
      name: per[key].name,
      selected: false,
    }));
  }
  return [];
});

const onClickCreate = () => {
  role.post(route("system.permission.create"), {
    onSuccess: () => {
      role.reset();
    },
  });
};

onMounted(() => {
  //   console.log(permissionKeys);
});
</script>
<template>
  <AdminLayout>
    <div class="grid">
      <div class="lg:col-3">
        <div class="card">
          <h5 class="font-bold">Thông tin quyền</h5>

          <div class="flex flex-column gap-2">
            <!-- Role code -->
            <div class="flex flex-column">
              <label for="code">Mã</label>
              <InputText
                id="code"
                v-model="role.code"
                aria-describedby="code-help"
                :class="role?.errors?.code && 'p-invalid'"
              />
              <small v-if="role?.errors?.code" id="code-help" class="p-error">{{
                role?.errors.code
              }}</small>
            </div>

            <!-- Name -->
            <div class="flex flex-column">
              <label for="name">Tên quyền</label>
              <InputText
                id="name"
                v-model="role.name"
                aria-describedby="name-help"
                :class="role?.errors?.name && 'p-invalid'"
              />
              <small v-if="role?.errors?.name" id="name-help" class="p-error">{{
                role?.errors.name
              }}</small>
            </div>

            <!-- Description -->
            <div class="flex flex-column">
              <label for="description">Mô tả quyền</label>
              <Textarea
                id="description"
                v-model="role.description"
                aria-describedby="description-help"
                :class="role?.errors?.description && 'p-invalid'"
                rows="5"
                cols="30"
              />
              <small
                v-if="role?.errors?.description"
                id="description-help"
                class="p-error"
                >{{ role?.errors.description }}</small
              >
            </div>

            <span class="font-bold text-lg">Các quyền</span>
            <div
              v-for="permission in permissionArr"
              :key="permission.code"
              class="flex flex-row gap-3"
            >
              <Checkbox
                :input-id="permission.code"
                :value="permission.code"
                v-model="role.permissions"
                name="permission"
              />
              <label :for="permission.code">{{ permission.name }}</label>
            </div>
          </div>

          <div class="flex pt-4 justify-content-end">
            <Button @click="onClickCreate">Thêm quyền</Button>
          </div>
        </div>
      </div>

      <div class="lg:col-9 col-12">
        <div class="card">
          <h5 class="font-bold">Quản lý tài khoản</h5>
          <DataTable
            :value="roles"
            :paginator="true"
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
            <Column field="code" header="Mã" :sortable="true" class="w-3rem"></Column>
            <Column field="name" header="Tên quyền" :sortable="true"></Column>
            <Column field="description" header="Mô tả" :sortable="true"></Column>
            <Column field="permissions" header="Mã chức năng" :sortable="true">
              <template #body="slotProps">
                <Badge
                  v-for="permission in slotProps.data.permissions"
                  :value="permission"
                ></Badge>
              </template>
            </Column>
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
