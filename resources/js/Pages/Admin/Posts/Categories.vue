<script setup>
import { watch, ref } from "vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import Button from "primevue/button";
import Column from "primevue/column";
import DataTable from "primevue/datatable";
import InputText from "primevue/inputtext";
import { slugify } from "@/utils/utils";
import { Inertia } from "@inertiajs/inertia";
import { useConfirm } from "primevue/useconfirm";

const props = defineProps({
  categories: {
    type: Array,
    required: false,
    default: () => [],
  },

  rl_Category: {
    type: String,
    required: false,
    default: "",
  },

  ras_Category: {
    type: String,
    required: false,
    default: "",
  },

  rad_Category: {
    type: String,
    required: true,
    default: "",
  },
});

const isSystemCategory = ref(false);
const confirm = useConfirm();
const search = ref("");
const formCategoryInfo = useForm({
  id: null,
  title: "",
  slug: "",
  meta_title: "",
});

const refreshPage = () => {
  Inertia.get(route(props.rl_Category));
};

const onSaveCategory = () => {
  if (formCategoryInfo.id) {
    confirm.require({
      message:
        "Chỉnh sửa danh mục sẽ ảnh hưởng đến hiển thị của trang web. Bạn có chắc chắn muốn cập nhật không?",
      header: "Thông báo",
      icon: "pi pi-info-circle",
      acceptClass: "p-button-danger",
      acceptLabel: "Đồng ý",
      rejectLabel: "Huỷ",
      accept: () => {
        formCategoryInfo.post(route(props.ras_Category), {
          onSuccess: () => {
            formCategoryInfo.reset();
          },
        });
      },
      reject: () => {},
    });
  } else {
    formCategoryInfo.post(route(props.ras_Category), {
      onSuccess: () => {
        formCategoryInfo.reset();
      },
    });
  }
};

const deleteCategory = (data) => {
  confirm.require({
    message: "Bạn có chắc chắn muốn xoá danh mục không?",
    header: "Thông báo",
    icon: "pi pi-info-circle",
    acceptClass: "p-button-danger",
    acceptLabel: "Đồng ý",
    rejectLabel: "Huỷ",
    accept: () => {
      Inertia.delete(route(props.rad_Category, { id: data.id }));
    },
    reject: () => {},
  });
};

const onShowEdit = (data) => {
  formCategoryInfo.id = data.id;
  formCategoryInfo.title = data.title;
  formCategoryInfo.slug = data.slug;
  formCategoryInfo.meta_title = data.meta_title;

  isSystemCategory.value = data?.menu_type === "system";
};

const refreshForm = () => {
  formCategoryInfo.reset();
  isSystemCategory.value = false;
};

watch(search, (value) => {
  Inertia.get(
    route(props.rl_Category),
    { search: value },
    {
      preserveState: true,
    }
  );
});

watch(
  () => formCategoryInfo.title,
  (title) => {
    if (formCategoryInfo.id) return;
    formCategoryInfo.slug = slugify(title);
    formCategoryInfo.meta_title = title;
  }
);
</script>

<template>
  <AdminLayout>
    <Head title="Quản lý danh mục bài viết" />
    <div class="grid">
      <div class="xl:col-4 col-12">
        <div class="card">
          <h5 class="font-bold flex align-items-center flex-wrap gap-2">
            Thông tin danh mục
          </h5>
          <form @submit.prevent="onSaveCategory" class="flex flex-column gap-2">
            <!-- Title -->
            <div class="flex flex-column">
              <label for="title">Tiêu đề</label>
              <InputText
                id="title"
                maxlength="180"
                v-model="formCategoryInfo.title"
                aria-describedby="title-help"
                :class="formCategoryInfo?.errors?.title && 'p-invalid'"
              />
              <small
                v-if="formCategoryInfo?.errors?.title"
                id="title-help"
                class="p-error"
                >{{ formCategoryInfo?.errors?.title }}</small
              >
            </div>

            <!-- Slug -->
            <div class="flex flex-column">
              <label for="slug">Slug</label>
              <InputText
                id="slug"
                maxlength="180"
                v-model="formCategoryInfo.slug"
                aria-describedby="slug-help"
                :class="formCategoryInfo?.errors?.slug && 'p-invalid'"
                :disabled="isSystemCategory"
              />
              <small
                v-if="formCategoryInfo?.errors?.slug"
                id="slug-help"
                class="p-error"
                >{{ formCategoryInfo?.errors?.slug }}</small
              >
            </div>

            <!-- Meta title -->
            <div class="flex flex-column">
              <label for="meta_title">Tiêu đề meta</label>
              <InputText
                id="meta_title"
                maxlength="180"
                v-model="formCategoryInfo.meta_title"
                aria-describedby="meta_title-help"
                :class="formCategoryInfo?.errors?.meta_title && 'p-invalid'"
              />
              <small
                v-if="formCategoryInfo?.errors?.meta_title"
                id="meta_title-help"
                class="p-error"
                >{{ formCategoryInfo?.errors?.meta_title }}</small
              >
            </div>

            <div class="flex w-full justify-content-end pt-3 gap-2">
              <Button
                v-show="formCategoryInfo.id"
                icon="pi pi-times"
                label="Huỷ"
                class="p-button-outlined"
                @click="refreshForm"
              />
              <Button
                :label="`${!formCategoryInfo.id ? 'Tạo mới' : 'Cập nhật'}`"
                @click="onSaveCategory"
              />
            </div>
          </form>
        </div>
      </div>
      <div class="xl:col-8 col-12">
        <div class="card">
          <DataTable
            :value="categories"
            :rows="200"
            :totalRecords="200"
            :first="0"
            :sortField="null"
            :sortOrder="null"
            dataKey="id"
            :rowHover="true"
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
                    @click="refreshPage"
                  />
                  <!-- <Button icon="pi pi-plus" label="Tạo mới" @click="onClickAddNew" /> -->
                </div>

                <span class="p-input-icon-left w-20rem">
                  <i class="pi pi-search" />
                  <InputText
                    v-model="search"
                    type="text"
                    class="w-full"
                    placeholder="Tìm kiếm"
                  />
                </span>
              </div>
            </template>
            <template #empty>
              <p class="text-center">Không tìm thấy dữ liệu</p>
            </template>
            <Column field="id" header="id" :sortable="true" class="w-3rem"></Column>
            <Column field="title" header="Tiêu đề" :sortable="true"></Column>
            <Column field="slug" header="Slug" :sortable="true"></Column>
            <Column header="Chức năng" class="w-10rem">
              <template #body="slotProps">
                <Button
                  icon="pi pi-file-edit"
                  class="p-button-rounded p-button-text"
                  @click="onShowEdit(slotProps.data)"
                />

                <Button
                  icon="pi pi-trash"
                  class="p-button-rounded p-button-text p-button-danger"
                  @click="deleteCategory(slotProps.data)"
                />
              </template>
            </Column>
          </DataTable>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
