<script setup>
import { Inertia } from "@inertiajs/inertia";
import Badge from "primevue/badge";
import Button from "primevue/button";
import Column from "primevue/column";
import DataTable from "primevue/datatable";
import InputText from "primevue/inputtext";
import TabPanel from "primevue/tabpanel";
import TabView from "primevue/tabview";
import { useConfirm } from "primevue/useconfirm";
import { ref, watch } from "vue";

const props = defineProps({
  admissions: {
    type: Array,
    required: false,
    default: () => [],
  },
  ru_Admissions: {
    type: String,
    required: false,
    default: "",
  },
  rc_Admissions: String,
  rl_Admissions: String,
  rad_Admissions: String,
  rar_Admissions: String,
  status: [Number, String],
});
const activeIndex = ref(Number(props?.status));
const confirm = useConfirm();

const onClickAdmissionDetails = (id) => {
  Inertia.get(route(props.ru_Admissions, { id: id }));
};

const onClickAddNew = () => {
  Inertia.get(route(props.rc_Admissions));
};

const onClickRefreshPage = () => {
  Inertia.get(route(props.rl_Admissions));
};

const onClickDeleteAdmission = (id) => {
  confirm.require({
    message: "Bạn có chắc chắn muốn xoá thông tin tuyển sinh không?",
    header: "Thông báo",
    icon: "pi pi-info-circle",
    acceptClass: "p-button-danger",
    acceptLabel: "Xoá",
    rejectLabel: "Huỷ",
    accept: () => {
      Inertia.delete(route(props.rad_Admissions, { id: id }));
    },
    reject: () => {},
  });
};

const onClickRestoreAdmission = (id) => {
  confirm.require({
    message: "Bạn có chắc chắn muốn khôi phục thông tin tuyển sinh không?",
    header: "Thông báo",
    icon: "pi pi-info-circle",
    acceptClass: "p-button-danger",
    acceptLabel: "Khôi phục",
    rejectLabel: "Huỷ",
    accept: () => {
      Inertia.put(route(props.rar_Admissions, { id: id }));
    },
    reject: () => {},
  });
};

watch(activeIndex, (tab) => {
  Inertia.get(
    route(props.rl_Admissions),
    { status: tab },
    {
      preserveState: true,
    }
  );
});
</script>

<template>
  <AdminLayout>
    <div class="card">
      <DataTable
        :value="admissions"
        :paginator="true"
        :rows="200"
        :totalRecords="0"
        :first="0"
        sortField="0"
        dataKey="id"
        :rowHover="true"
        :lazy="true"
        :autoLayout="true"
        responsiveLayout="scroll"
      >
        <template #header>
          <div class="flex justify-content-between flex-wrap gap-3">
            <div class="flex gap-2 flex-wrap">
              <Button
                icon="pi pi-refresh"
                label="Làm mới"
                class="p-button-outlined"
                @click="onClickRefreshPage"
              />
              <Button icon="pi pi-plus" label="Tạo mới" @click="onClickAddNew" />
            </div>

            <span class="p-input-icon-left w-20rem">
              <i class="pi pi-search" />
              <InputText type="text" class="w-full" placeholder="Tìm kiếm" />
            </span>
          </div>
          <TabView v-model:activeIndex="activeIndex" class="mt-3">
            <TabPanel header="Chưa xử lý"></TabPanel>
            <TabPanel header="Đã xử lý"></TabPanel>
            <TabPanel header="Đã xoá"></TabPanel>
          </TabView>
        </template>
        <template #empty>
          <p class="text-center">Không tìm thấy dữ liệu</p>
        </template>
        <Column field="id" header="id" :sortable="true" class="w-3rem"></Column>
        <Column field="full_name" header="Họ & tên" :sortable="true"></Column>
        <Column field="email" header="Email" :sortable="true" class="w-15rem"></Column>
        <Column field="phone_number" header="SĐT" class="w-11rem"></Column>
        <Column field="majors.name" header="Ngành học" class="w-15rem"></Column>
        <Column field="level" header="Học vấn" class="w-8rem"></Column>
        <Column field="status" header="Trạng thái" class="w-8rem">
          <template #body="slotProps">
            <Badge
              :severity="`${slotProps?.data?.status == 0 ? 'warning' : 'success'}`"
              :value="`${slotProps?.data?.status == 0 ? 'Chưa xử lý' : 'Đã xử lý'}`"
            ></Badge>
            <Badge
              v-if="slotProps?.data?.deleted_at"
              severity="danger"
              value="Đã xoá"
            ></Badge>
          </template>
        </Column>
        <Column header="Chức năng" class="w-10rem">
          <template #body="slotProps">
            <Button
              v-if="!slotProps.data?.deleted_at"
              icon="pi pi-eye"
              class="p-button-rounded p-button-text"
              @click="onClickAdmissionDetails(slotProps.data.id)"
            />

            <Button
              v-if="slotProps.data?.status === 1 && !slotProps.data?.deleted_at"
              icon="pi pi-trash"
              class="p-button-rounded p-button-text p-button-danger"
              @click="onClickDeleteAdmission(slotProps.data.id)"
            />

            <Button
              v-if="slotProps.data?.deleted_at"
              icon="pi pi-replay"
              class="p-button-rounded p-button-text p-button-warning"
              @click="onClickRestoreAdmission(slotProps.data.id)"
            />
          </template>
        </Column>
      </DataTable>
    </div>
  </AdminLayout>
</template>

<style lang="scss">
.p-tabview-nav,
.p-tabview-panels {
  background: transparent !important;
}
.p-tabview-panels {
  padding: 0;
}
</style>
