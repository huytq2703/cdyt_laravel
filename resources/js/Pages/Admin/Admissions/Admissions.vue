<script setup>
import { Inertia } from "@inertiajs/inertia";
import Badge from "primevue/badge";
import Button from "primevue/button";
import Column from "primevue/column";
import DataTable from "primevue/datatable";
import InputText from "primevue/inputtext";

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
});

const onClickAdmissionDetails = (id) => {
  Inertia.get(route(props.ru_Admissions, { id: id }));
};
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
        </template>
        <template #empty>
          <p class="text-center">Không tìm thấy dữ liệu</p>
        </template>
        <Column field="id" header="id" :sortable="true" class="w-3rem"></Column>
        <Column
          field="full_name"
          header="Họ & tên"
          class="w-10rem"
          :sortable="true"
        ></Column>
        <Column field="email" header="Email" class="w-12rem" :sortable="true"></Column>
        <Column field="phone_number" header="SĐT" class="w-11rem"></Column>
        <Column field="majors.name" header="Ngành học" class="w-8rem"></Column>
        <Column field="level" header="Học vấn" class="w-8rem"></Column>
        <Column header="Chức năng" class="w-10rem">
          <template #body="slotProps">
            <Button
              icon="pi pi-eye"
              class="p-button-rounded p-button-text"
              @click="onClickAdmissionDetails(slotProps.data.id)"
            />

            <Button
              icon="pi pi-trash"
              class="p-button-rounded p-button-text p-button-danger"
              @click="deletePost(slotProps.data)"
            />
          </template>
        </Column>
        <!-- <Column header="Chức năng" class="w-10rem">
          <template #body="slotProps">
            <Button
              icon="pi pi-eye"
              class="p-button-rounded p-button-text"
              @click="onClickPreviewPost(slotProps.data.id)"
            />



            <Button
              icon="pi pi-trash"
              class="p-button-rounded p-button-text p-button-danger"
              @click="deletePost(slotProps.data)"
            />
          </template>
        </Column> -->
      </DataTable>
    </div>
  </AdminLayout>
</template>
