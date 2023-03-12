<script setup>
import { watch, onMounted, ref, computed } from "vue";
import InputTextComponent from "@/Components/InputTextComponent.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import Editor from "primevue/editor";
import Button from "primevue/button";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { slugify } from "@/utils/utils";
import { useConfirm } from "primevue/useconfirm";
import { Inertia } from "@inertiajs/inertia";
import Message from "primevue/message";

const props = defineProps({
  posts: {
    type: Array,
    required: false,
    default: () => [],
  },
  rau_LecturerSchedule: String,
  rau_Schedule: String,
  rac_Schedule: String,
  rad_Schedule: String,
});

const form = useForm({
  id: "",
  title: "",
  meta_title: "",
  content: "",
  slug: "",
});
const updateEditor = ref(false);
const confirm = useConfirm();

const slugMessage = computed(() => {
  return form.errors?.slug;
});

const onSubmitForm = () => {
  if (!form?.id) {
    form.post(route(props.rac_Schedule));
    return;
  }
  form.put(route(props.rau_Schedule, { id: form?.id }));
};

const onClickPostDetails = (data) => {
  form.id = data?.id;
  form.content = data?.content;
  form.title = data?.title;
  form.meta_title = data?.meta_title;
  form.slug = data?.slug;

  updateEditor.value = !updateEditor.value;
};

const onResetForm = () => {
  form.reset();
  updateEditor.value = !updateEditor.value;
};

const onDelete = (id) => {
  confirm.require({
    message: "Bạn có chắc chắn muốn xoá lịch không?",
    header: "Thông báo",
    icon: "pi pi-info-circle",
    acceptClass: "p-button-danger",
    acceptLabel: "Đồng ý",
    rejectLabel: "Huỷ",
    accept: () => {
      Inertia.post(route(props.rad_Schedule, { id: id }));
    },
    reject: () => {},
  });
};

watch(
  () => form.title,
  (title) => {
    form.meta_title = title;
    form.slug = slugify(title);
  }
);

onMounted(() => {});
</script>

<template>
  <AdminLayout>
    <Head title="Quản lý các lịch" />
    <div class="card">
      <h5 class="font-bold">Quản lý lịch thi, giảng và học</h5>
      <Message v-show="slugMessage" severity="error" :closable="false">{{
        slugMessage
      }}</Message>

      <div class="grid">
        <div class="lg:col-8 col-12">
          <div class="flex flex-column">
            <div class="flex w-full gap-3">
              <InputTextComponent
                id="title"
                v-model="form.title"
                label="Tiêu đề"
                class="flex-1"
                :error-message="form.errors.title"
              />
              <InputTextComponent
                id="metaTitle"
                v-model="form.meta_title"
                :error-message="form.errors.meta_title"
                label="Tiêu đề nâng cao"
                class="flex-1"
              />
            </div>

            <p v-show="form?.slug">
              Đường dẫn: <span class="font-italic">{{ form?.slug }}</span>
            </p>
          </div>

          <div class="flex-1 flex flex-column w-full mt-3">
            <label for="content">Nội dung</label>
            <small v-if="form?.errors?.content" id="title-help" class="p-error">{{
              form?.errors?.content
            }}</small>
            <Editor
              :key="updateEditor"
              id="content"
              v-model="form.content"
              :class="[
                'w-full flex-1 mt-1 md:h-auto h-30rem',
                form?.errors?.content && 'p-invalid-editor',
              ]"
              editorStyle="min-height: 500px"
            />
          </div>

          <div class="flex mt-3 gap-3 justify-content-end">
            <Button
              v-show="form?.id"
              label="Huỷ"
              type="submit"
              class="p-button-outlined"
              @click="onResetForm"
            />
            <Button
              v-show="form?.id"
              label="Cập nhât"
              type="submit"
              @click="onSubmitForm"
            />
            <Button
              v-show="!form?.id"
              label="Tạo mới"
              type="submit"
              @click="onSubmitForm"
            />
          </div>
        </div>

        <div class="col-4">
          <DataTable
            :value="posts"
            :paginator="false"
            dataKey="id"
            :rowHover="true"
            :autoLayout="true"
            responsiveLayout="scroll"
          >
            <template #empty>
              <p class="text-center">Không tìm thấy dữ liệu</p>
            </template>
            <Column field="id" header="id" :sortable="true" class="w-3rem"></Column>
            <Column field="title" header="Tiêu đề" :sortable="true"></Column>
            <Column header="Chức năng" class="w-10rem">
              <template #body="slotProps">
                <Button
                  icon="pi pi-file-edit"
                  class="p-button-rounded p-button-text"
                  @click="onClickPostDetails(slotProps.data)"
                />

                <Button
                  icon="pi pi-trash"
                  class="p-button-rounded p-button-text p-button-danger"
                  @click="onDelete(slotProps.data.id)"
                />
              </template>
            </Column>
          </DataTable>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
