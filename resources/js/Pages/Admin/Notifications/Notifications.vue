<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { Inertia } from "@inertiajs/inertia";
// import ColumnGroup from "primevue/columngroup"; //optional for column grouping
// import Row from "primevue/row";
import { Head, useForm, usePage } from "@inertiajs/inertia-vue3";
import { onMounted, ref, computed, reactive } from "vue";
import Button from "primevue/button";
import InputText from "primevue/inputtext";
// import CreateOrUpdateModal from "./components/CreateOrUpdateModal.vue";
import ConfirmDialog from "primevue/confirmdialog";
import { useConfirm } from "primevue/useconfirm";
import Badge from "primevue/badge";

const confirm = useConfirm();
const user = computed(() => usePage().props.test);
const page = usePage();
const props = defineProps({
  posts: {
    type: Array,
    required: false,
    default: [],
  },
  params: {
    type: Object,
    required: false,
    default: null,
  },
  errors: Object,
  categories: Array,
  pagination: Object,
  sort: Object,
  rc_Notice: String,
  ru_Notice: String,
  rl_Notice: String,
  rad_Notice: String,
  rpv_Page: String,
  rau_PostReject: String,
});
const filtersForm = useForm({
  search: props?.params?.search,
});

const onClickAddNew = () => {
  Inertia.get(route(props.rc_Notice));
};

const onClickPreviewPost = (postId) => {
  window.open(route(props.rpv_Page, { id: postId }), "_blank");
};

const onSearch = () => {
  filtersForm.get(route(props.rl_Notice), {
    preserveState: true,
    replace: true,
  });
};

const onClickPostDetails = (id) => {
  Inertia.get(
    route(props.ru_Notice, {
      id: id,
    })
  );
};

const deletePost = (details) => {
  confirm.require({
    message: "Bạn có chắc chắn muốn thông báo không?",
    header: "Thông báo",
    icon: "pi pi-info-circle",
    acceptClass: "p-button-danger",
    acceptLabel: "Xoá",
    rejectLabel: "Huỷ",
    accept: () => {
      Inertia.delete(route(props.rad_Notice, { id: details.id }));
    },
    reject: () => {},
  });
};

const onPageChange = ({ page }) => {
  Inertia.get(route(props.rl_Notice), { page: page + 1, search: props?.params?.search });
};

const onSort = ({ sortField, sortOrder }) => {
  Inertia.get(route(props.rl_Notice), {
    search: props?.params?.search,
    sortField: sortField,
    sortOrder: sortOrder,
  });
};

const refreshPage = () => {
  Inertia.get(route(props.rl_Notice));
};

const onClickRejectPosts = (postId) => {
  confirm.require({
    message: "Bạn có chắc chắn muốn ẩn bài viết không?",
    header: "Thông báo",
    icon: "pi pi-info-circle",
    acceptClass: "p-button-danger",
    acceptLabel: "Đồng ý",
    rejectLabel: "Huỷ",
    accept: () => {
      Inertia.put(route(props.rau_PostReject, { id: postId }));
    },
    reject: () => {},
  });
};
onMounted(() => {});
</script>

<template>
  <AdminLayout>
    <Head title="Quản lý thông báo" />

    <div class="card">
      <h5 class="font-bold">Danh sách các thông báo</h5>

      <DataTable
        :value="posts"
        :paginator="true"
        :rows="pagination.perPage"
        :totalRecords="pagination.totalRecords"
        :first="pagination.first"
        :sortField="params?.sortField"
        :sortOrder="Number(params?.sortOrder)"
        dataKey="id"
        :rowHover="true"
        :lazy="true"
        :autoLayout="true"
        responsiveLayout="scroll"
        @page="onPageChange"
        @sort="onSort"
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
              <Button icon="pi pi-plus" label="Tạo mới" @click="onClickAddNew" />
            </div>

            <span class="p-input-icon-left w-20rem">
              <i class="pi pi-search" />
              <InputText
                v-model="filtersForm.search"
                type="text"
                class="w-full"
                placeholder="Nhập và Enter để tìm kiếm"
                @keyup.enter="onSearch"
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
        <Column field="categories" header="Danh mục" class="w-12rem">
          <template #body="slotProps">
            <span v-for="cat in slotProps.data.categories" :key="cat.id">
              {{ cat.title }},
            </span>
          </template>
        </Column>

        <Column field="published" header="Trạng thái" class="w-12rem">
          <template #body="slotProps">
            <Badge
              :severity="`${Number(slotProps.data.published) === 0 ? 'danger' : ''}`"
              :value="`${
                Number(slotProps.data.published) === 0 ? 'Chưa duyệt' : 'Đã duyệt'
              }`"
            />
          </template>
        </Column>
        <Column header="Chức năng" class="w-10rem">
          <template #body="slotProps">
            <Button
              icon="pi pi-file-edit"
              class="p-button-rounded p-button-text"
              @click="onClickPostDetails(slotProps.data.id)"
            />

            <Button
              icon="pi pi-eye-slash"
              class="p-button-rounded p-button-text p-button-warning"
              @click="onClickRejectPosts(slotProps.data.id)"
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
  </AdminLayout>
</template>
