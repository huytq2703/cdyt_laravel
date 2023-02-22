<script setup>
import { onMounted } from "vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { useForm } from "@inertiajs/inertia-vue3";
import InputText from "primevue/inputtext";
import Button from "primevue/button";
import { slugify, formatStringDateHour } from "@/utils/utils";
import { Inertia } from "@inertiajs/inertia";
import { useConfirm } from "primevue/useconfirm";

const confirm = useConfirm();
const props = defineProps({
  majors: {
    type: Array,
    required: false,
    default: () => [],
  },
  rac_Majors: String,
  rau_Majors: String,
  rad_Majors: String,
});
const majorForm = useForm({
  id: "",
  name: "",
  majors_code: "",
  slug: "",
});

const onSubmitSaveMajors = () => {
  majorForm.slug = slugify(majorForm.name);
  majorForm.post(route(props.rac_Majors), {
    onSuccess: () => {
      majorForm.reset();
    },
  });
};

const onShowDetails = (data) => {
  majorForm.id = data?.id;
  majorForm.name = data?.name;
  majorForm.majors_code = data?.majors_code;
  majorForm.slug = data?.slug;
};

const onUpdateMajors = () => {
  majorForm.put(route(props.rau_Majors, { id: majorForm.id }), {
    onSuccess: () => {
      majorForm.reset();
    },
  });
};

const refreshForm = () => {
  majorForm.reset();
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
      Inertia.delete(route(props.rad_Majors, { id: data.id }));
    },
    reject: () => {},
  });
};

onMounted(() => {
  console.log(props.majors);
});
</script>

<template>
  <AdminLayout>
    <div class="grid">
      <div class="lg:col-4 col-12">
        <div class="card">
          <h5 class="font-bold">Thêm mới thời gian</h5>

          <form @submit.prevent="onSubmitSaveMajors" class="flex flex-column gap-2">
            <!-- Majors code -->
            <div class="flex flex-column">
              <label for="majorsCode">Mã ngành</label>
              <InputText
                id="majorsCode"
                maxlength="180"
                v-model="majorForm.majors_code"
                aria-describedby="majorsCode-help"
                :class="majorForm?.errors?.majors_code && 'p-invalid'"
              />
              <small
                v-if="majorForm?.errors?.majors_code"
                id="majorsCode-help"
                class="p-error"
                >{{ majorForm?.errors?.majors_code }}</small
              >
            </div>

            <!-- Majors name -->
            <div class="flex flex-column">
              <label for="name">Tên ngành</label>
              <InputText
                id="name"
                maxlength="180"
                v-model="majorForm.name"
                aria-describedby="name-help"
                :class="majorForm?.errors?.name && 'p-invalid'"
              />
              <small v-if="majorForm?.errors?.name" id="name-help" class="p-error">{{
                majorForm?.errors?.name
              }}</small>
            </div>

            <div class="flex justify-content-end pt-3">
              <Button v-if="!majorForm?.id" type="submit" label="Tạo ngành học" />

              <div v-if="majorForm?.id" class="flex gap-2">
                <Button
                  icon="pi pi-times"
                  label="Huỷ"
                  class="p-button-outlined"
                  @click="refreshForm"
                />
                <Button :label="`${'Cập nhật'}`" @click="onUpdateMajors" />
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="lg:col-8 col-12">
        <div class="card">
          <h5 class="font-bold">Danh sách ngành học</h5>
          <DataTable
            :value="majors"
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
            <Column field="majors_code" header="Mã ngành" class="w-7rem"></Column>
            <Column field="name" header="Tên ngành"></Column>
            <Column field="user_created.username" header="Người tạo"></Column>
            <Column field="created_at" header="Tạo ngày">
              <template #body="props">
                {{ formatStringDateHour(props.data.created_at) }}
              </template>
            </Column>

            <Column header="Chức năng" class="w-8rem">
              <template #body="slotProps">
                <Button
                  icon="pi pi-file-edit"
                  class="p-button-rounded p-button-text"
                  @click="onShowDetails(slotProps.data)"
                />

                <Button
                  icon="pi pi-trash"
                  class="p-button-rounded p-button-text p-button-danger"
                  @click="onDelete(slotProps.data)"
                />
              </template>
            </Column>
          </DataTable>
        </div>
      </div></div
  ></AdminLayout>
</template>
