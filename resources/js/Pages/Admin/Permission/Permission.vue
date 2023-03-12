<script setup>
import { onMounted, computed, watch, ref } from "vue";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import Checkbox from "primevue/checkbox";
import Button from "primevue/button";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import InputTextComponent from "@/Components/InputTextComponent.vue";
import InputTextAreaComponent from "@/Components/InputTextAreaComponent.vue";
import { Inertia } from "@inertiajs/inertia";
import { useConfirm } from "primevue/useconfirm";
import Accordion from "primevue/accordion";
import AccordionTab from "primevue/accordiontab";
import UserDetails from "./components/UserDetails.vue";
import ChangePassword from "./components/ChangePassword.vue";
import TabView from "primevue/tabview";
import TabPanel from "primevue/tabpanel";

const props = defineProps({
  permissions: Object,
  roles: Array,
  rad_Role: String,
  users: Array,
  isDeletedUserTab: [String, Number],
});

const role = useForm({
  id: null,
  code: "",
  name: "",
  permissions: [],
  description: "",
});
const page = usePage();
const checkAll = ref(false);
const permissionArr = ref([]);
const checkedDetails = ref(false);
const confirm = useConfirm();
const userDetails = ref(null);
const isShowModalUserDetails = ref(false);
const isShowModalChangePassword = ref(false);
const userTabIndex = ref(Number(props.isDeletedUserTab));

const onClickCreate = () => {
  role.post(route("system.permission.create"), {
    onSuccess: () => {
      role.reset();
    },
  });
};

const selectRole = (data) => {
  role.id = data.id;
  role.code = data.code;
  role.name = data.name;
  role.description = data.description;
  role.permissions = data.permissions;

  checkedDetails.value = true;
};

const onClickCheckAll = () => {
  confirm.require({
    message: "Bạn có chắc chắn muốn chọn tất cả không?",
    header: "Thông báo",
    icon: "pi pi-info-circle",
    acceptClass: "p-button-danger",
    acceptLabel: "Đồng ý",
    rejectLabel: "Huỷ",
    accept: () => {
      role.permissions = permissionArr.value.map(({ code }) => code);
    },
    reject: () => {},
  });
};

const onClickUnCheckAll = () => {
  confirm.require({
    message: "Bạn có chắc chắn muốn bỏ chọn tất cả không?",
    header: "Thông báo",
    icon: "pi pi-info-circle",
    acceptClass: "p-button-danger",
    acceptLabel: "Đồng ý",
    rejectLabel: "Huỷ",
    accept: () => {
      role.permissions = [];
    },
    reject: () => {},
  });
};

const onClickResetUpdate = () => {
  role.reset();
  checkedDetails.value = false;
};

const deleteRole = (id) => {
  confirm.require({
    message: "Bạn có chắc chắn muốn khoá quyền không?",
    header: "Thông báo",
    icon: "pi pi-info-circle",
    acceptClass: "p-button-danger",
    acceptLabel: "Đồng ý",
    rejectLabel: "Huỷ",
    accept: () => {
      Inertia.delete(route(props.rad_Role, { id: id }));
    },
    reject: () => {},
  });
};

const onClickUserDetails = (data) => {
  isShowModalUserDetails.value = true;
  userDetails.value = data;
};

const onClickCreateUser = () => {
  isShowModalUserDetails.value = true;
  userDetails.value = null;
};

const onClickChangePassword = (data) => {
  isShowModalChangePassword.value = true;
  userDetails.value = data;
};

const onClickDeleteUser = (id) => {
  confirm.require({
    message: "Bạn có chắc chắn muốn xoá tài khoản không?",
    header: "Thông báo",
    icon: "pi pi-info-circle",
    acceptClass: "p-button-danger",
    acceptLabel: "Đồng ý",
    rejectLabel: "Huỷ",
    accept: () => {
      Inertia.delete(route("system.user.delete", { id: id }));
    },
    reject: () => {},
  });
};

const onClickRestoreUser = (id) => {
  Inertia.put(route("system.user.restore", { id: id }));
};

watch(userTabIndex, (index) => {
  if (index === 0) Inertia.get(route("system.permission"));
  if (index === 1) Inertia.get(route("system.permission", { isUserDeleted: 1 }));
});

watch(
  () => role.permissions,
  (perChecked) => {
    const checkedLength = perChecked.length;
    const permissionsLength = permissionArr.value.length;

    checkAll.value = checkedLength === permissionsLength;
  }
);

onMounted(() => {
  const per = props.permissions;

  if (per) {
    permissionArr.value = Object.keys(per).map((key) => ({
      code: key,
      name: per[key].name,
      selected: false,
    }));
  }
});
</script>
<template>
  <AdminLayout>
    <Accordion>
      <AccordionTab header="Quản lý quyền">
        <div class="grid">
          <div class="lg:col-7">
            <div class="card">
              <h5 class="font-bold">Thông tin quyền</h5>

              <div class="flex flex-column gap-2">
                <div class="flex flex-row gap-2 w-full">
                  <InputTextComponent
                    id="code"
                    v-model="role.code"
                    label="Mã quyền"
                    class="flex-1"
                    :errorMessage="role.errors?.code"
                  />

                  <InputTextComponent
                    id="name"
                    v-model="role.name"
                    label="tên quyền"
                    class="flex-1"
                    :errorMessage="role.errors?.name"
                  />
                </div>

                <InputTextAreaComponent
                  id="description"
                  v-model="role.description"
                  label="Mô tả"
                  :error-message="role.errors.description"
                />
              </div>

              <div class="flex mt-3 flex-column">
                <h5 class="font-bold m-0">Phân quyền</h5>

                <div class="flex surface-100 flex-1 my-3">
                  <div class="p-3 flex gap-2">
                    <Button label="Chọn tất cả" @click="onClickCheckAll" />
                    <Button label="Bỏ chọn tất cả" @click="onClickUnCheckAll" />
                  </div>
                </div>
              </div>
              <div class="grid">
                <div
                  class="lg:col-4 md:col-6 col-12"
                  v-for="permission in permissionArr"
                  :key="permission.code"
                >
                  <div class="flex flex-row gap-3">
                    <Checkbox
                      :input-id="permission.code"
                      :value="permission.code"
                      v-model="role.permissions"
                      name="permission"
                    />
                    <label :for="permission.code">{{ permission.name }}</label>
                  </div>
                </div>
              </div>

              <div class="flex pt-4 gap-3 justify-content-end">
                <Button
                  v-if="role?.id"
                  @click="onClickResetUpdate"
                  label="Huỷ"
                  class="p-button-outlined"
                />
                <Button v-if="role?.id" @click="onClickCreate" label="Cập nhật" />
                <Button v-if="!role?.id" @click="onClickCreate" label="Thêm mới" />
              </div>
            </div>
          </div>

          <div class="lg:col-5 col-12">
            <div class="card">
              <h5 class="font-bold">Danh sách quyền</h5>

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
                <Column header="Chức năng" class="w-10rem">
                  <template #body="slotProps">
                    <Button
                      icon="pi pi-file-edit"
                      class="p-button-rounded p-button-text"
                      @click="selectRole(slotProps.data)"
                    />

                    <Button
                      icon="pi pi-trash"
                      class="p-button-rounded p-button-text p-button-danger"
                      @click="deleteRole(slotProps.data?.id)"
                    />
                  </template>
                </Column>
              </DataTable>
            </div>
          </div>
        </div>
      </AccordionTab>
    </Accordion>

    <div class="card">
      <h5 class="font-bold">Quản lý tài khoản</h5>
      <div class="flex pb-3">
        <Button icon="pi pi-plus" label="Tạo mới" @click="onClickCreateUser" />
      </div>
      <TabView v-model:activeIndex="userTabIndex">
        <TabPanel header="Hoạt động"> </TabPanel>
        <TabPanel header="Đã xoá"> </TabPanel>
      </TabView>

      <DataTable
        :value="users"
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
        <Column field="id" header="Id" :sortable="true" class="w-3rem"></Column>
        <Column
          field="username"
          header="Tài khoản"
          :sortable="true"
          class="w-10rem white-space-nowrap overflow-hidden"
        ></Column>
        <Column
          field="email"
          header="Email"
          :sortable="true"
          class="w-15rem white-space-nowrap overflow-hidden"
        ></Column>
        <Column header="Nhóm quyền" :sortable="true" class="w-30rem">
          <template #body="slotProps">
            <p>
              <span class="font-bold">{{ slotProps.data?.role?.name }} :</span>
              {{ slotProps.data?.role?.description }}
            </p>
          </template>
        </Column>
        <Column header="Chức năng" class="w-10rem">
          <template #body="slotProps">
            <div v-if="!isDeletedUserTab" class="">
              <Button
                icon="pi pi-file-edit"
                class="p-button-rounded p-button-text"
                @click="onClickUserDetails(slotProps.data)"
              />

              <Button
                icon="pi pi-key"
                class="p-button-rounded p-button-text"
                @click="onClickChangePassword(slotProps.data)"
              />

              <Button
                icon="pi pi-trash"
                class="p-button-rounded p-button-text p-button-danger"
                @click="onClickDeleteUser(slotProps.data?.id)"
              />
            </div>

            <Button
              v-else
              icon="pi pi-replay"
              class="p-button-rounded p-button-text p-button-warning"
              @click="onClickRestoreUser(slotProps.data.id)"
            />
          </template>
        </Column>
      </DataTable>
    </div>

    <UserDetails v-model="isShowModalUserDetails" :userDetails="userDetails" />
    <ChangePassword v-model="isShowModalChangePassword" :user="userDetails" />
  </AdminLayout>
</template>
