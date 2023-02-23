<script setup>
import { onMounted, ref, watch } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { formatStringDateHour } from "@/utils/utils";
import Button from "primevue/button";
import Column from "primevue/column";
import DataTable from "primevue/datatable";
import InputText from "primevue/inputtext";
import TabPanel from "primevue/tabpanel";
import TabView from "primevue/tabview";
import { Inertia } from "@inertiajs/inertia";
import { useConfirm } from "primevue/useconfirm";

const confirm = useConfirm();
const props = defineProps({
  rl_Department: String,
  rau_Department: String,
  rac_Department: String,
  rad_Department: String,
  rar_Department: String,
  departments: Array,
});
const isUpdate = ref(false);
const departmentForm = useForm({
  phone_number: "",
  name: "",
  code: "",
  id: null,
});

const activeIndex = ref(0);

const onSubmitSave = () => {
  departmentForm.post(route(props.rac_Department), {
    onSuccess: () => {
      departmentForm.reset();
    },
  });
};

const onShowDetails = (data) => {
  departmentForm.id = data?.id;
  departmentForm.code = data?.code;
  departmentForm.name = data?.name;
  departmentForm.phone_number = data?.phone_number;
  isUpdate.value = true;
};

const onUpdate = () => {
  departmentForm.put(route(props.rau_Department, { id: departmentForm.id }), {
    onSuccess: () => {
      departmentForm.reset();
    },
  });
};

const refreshForm = () => {
  departmentForm.reset();
  isUpdate.value = false;
};

const onDelete = (data) => {
  confirm.require({
    message: "Bạn có chắc chắn muốn xoá ngành học không?",
    header: "Thông báo",
    icon: "pi pi-info-circle",
    acceptClass: "p-button-danger",
    acceptLabel: "Xoá",
    rejectLabel: "Huỷ",
    accept: () => {
      Inertia.delete(route(props.rad_Department, { id: data.id }));
    },
    reject: () => {},
  });
};

const onRestore = (data) => {
  confirm.require({
    message: "Bạn có chắc chắn khôi phục không?",
    header: "Thông báo",
    icon: "pi pi-info-circle",
    acceptClass: "p-button-danger",
    acceptLabel: "Khôi phục",
    rejectLabel: "Huỷ",
    accept: () => {
      Inertia.put(route(props.rar_Department, { id: data.id }));
    },
    reject: () => {},
  });
};

watch(activeIndex, (index) => {
  Inertia.get(
    route(props.rl_Department),
    {
      deleted: index,
    },
    {
      preserveState: true,
    }
  );
});

onMounted(() => {});
</script>

<template>
  <AdminLayout>
    <div class="grid">
      <div class="lg:col-4 col-12">
        <div class="card">
          <h5 class="font-bold">Thông tin phòng ban</h5>

          <form @submit.prevent="onSubmitSave" class="flex flex-column gap-2">
            <!-- Majors code -->
            <div class="flex flex-column">
              <label for="code">Mã phòng ban</label>
              <InputText
                id="code"
                maxlength="180"
                v-model="departmentForm.code"
                aria-describedby="majorsCode-help"
                :class="departmentForm?.errors?.code && 'p-invalid'"
              />
              <small
                v-if="departmentForm?.errors?.code"
                id="majorsCode-help"
                class="p-error"
                >{{ departmentForm?.errors?.code }}</small
              >
            </div>

            <!-- Majors name -->
            <div class="flex flex-column">
              <label for="name">Tên phòng ban</label>
              <InputText
                id="name"
                maxlength="180"
                v-model="departmentForm.name"
                aria-describedby="name-help"
                :class="departmentForm?.errors?.name && 'p-invalid'"
              />
              <small v-if="departmentForm?.errors?.name" id="name-help" class="p-error">{{
                departmentForm?.errors?.name
              }}</small>
            </div>

            <!-- Majors code -->
            <div class="flex flex-column">
              <label for="phone">Số điện thoại</label>
              <InputText
                id="phone"
                maxlength="20"
                v-model="departmentForm.phone_number"
                aria-describedby="phone-help"
                :class="departmentForm?.errors?.phone_number && 'p-invalid'"
              />
              <small
                v-if="departmentForm?.errors?.phone_number"
                id="phone-help"
                class="p-error"
                >{{ departmentForm?.errors?.phone_number }}</small
              >
            </div>

            <div class="flex justify-content-end pt-3">
              <Button v-if="!isUpdate" type="submit" label="Tạo phòng ban" />

              <div v-else class="flex gap-2">
                <Button
                  icon="pi pi-times"
                  label="Huỷ"
                  class="p-button-outlined"
                  @click="refreshForm"
                />
                <Button :label="`${'Cập nhật'}`" @click="onUpdate" />
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="lg:col-8 col-12">
        <div class="card">
          <h5 class="font-bold">Danh sách phòng ban</h5>

          <TabView v-model:activeIndex="activeIndex">
            <TabPanel header="Đang hoạt động"></TabPanel>
            <TabPanel header="Đã xoá"></TabPanel>
          </TabView>
          <DataTable
            :value="departments"
            :sortField="null"
            :sortOrder="null"
            dataKey="id"
            :rowHover="true"
            :autoLayout="true"
            responsiveLayout="scroll"
          >
            <template #empty>
              <p class="text-center">Không tìm thấy dữ liệu</p>
            </template>
            <Column field="id" header="id" class="w-3rem"></Column>
            <Column field="code" header="Mã PB" class="w-7rem"></Column>
            <Column field="name" header="Tên Phòng ban"></Column>
            <Column field="phone_number" header="Số điện thoại"></Column>
            <Column
              field="user.username"
              :header="activeIndex == 0 ? 'Người tạo' : 'Người xoá'"
            ></Column>
            <Column
              :field="`${activeIndex == 0 ? 'created_at' : 'deleted_at'}`"
              :header="`${activeIndex == 0 ? 'Tạo ngày' : 'Xoá ngày'}`"
            >
              <template #body="props">
                {{
                  formatStringDateHour(
                    activeIndex == 0 ? props.data.created_at : props.data.deleted_at
                  )
                }}
              </template>
            </Column>

            <Column header="Chức năng" class="w-8rem">
              <template #body="slotProps">
                <div v-if="activeIndex === 0">
                  <Button
                    v-tooltip="'Chỉnh sửa'"
                    icon="pi pi-file-edit"
                    class="p-button-rounded p-button-text"
                    @click="onShowDetails(slotProps.data)"
                  />

                  <Button
                    v-tooltip="'Xoá'"
                    icon="pi pi-trash"
                    class="p-button-rounded p-button-text p-button-danger"
                    @click="onDelete(slotProps.data)"
                  />
                </div>

                <Button
                  v-else
                  v-tooltip="'Khôi phục'"
                  icon="pi pi-refresh"
                  class="p-button-rounded p-button-text p-button-warning"
                  @click="onRestore(slotProps.data)"
                />
              </template>
            </Column>
          </DataTable>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
