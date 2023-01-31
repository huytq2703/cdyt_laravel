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
import CreateOrUpdateModal from "./components/CreateOrUpdateModal.vue";

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
});
const filtersForm = useForm({
  search: "",
});
const createOrUpdateModelVisible = ref(false);
const postDetails = ref({});

const onClickAddNew = () => {
  postDetails.value = {};
  createOrUpdateModelVisible.value = true;
};

const onClickPreviewPost = (postId) => {
  window.open(route("admin.posts.preview", { id: postId }), "_blank");
};

const onSearch = () => {
  filtersForm.get(route("admin.posts"), {
    preserveState: true,
    replace: true,
  });
};

const getPostDetails = async (details) => {
  postDetails.value = details;
  createOrUpdateModelVisible.value = true;
};

onMounted(() => {
  //   window.addEventListener("beforeunload", function (event) {
  //     Inertia.get(route("admin.posts"));
  //     // event.returnValue = "Write something";
  //   });
});
</script>

<template>
  <AdminLayout>
    <Head title="Quản lý bài viết" />

    <div class="card">
      <h5 class="font-bold">Danh sách bài viết</h5>
      <div class="flex justify-content-between mb-4">
        <div>
          <Button label="Tạo mới" @click="onClickAddNew" />
        </div>

        <span class="p-input-icon-left w-20rem">
          <i class="pi pi-search" />
          <InputText
            v-model="filtersForm.search"
            type="text"
            class="w-full"
            placeholder="Tìm kiếm"
            @keyup.enter="onSearch"
          />
        </span>
      </div>
      <DataTable
        :value="posts"
        :paginator="true"
        :rows="10"
        dataKey="id"
        :rowHover="true"
        lazy
        :totalRecords="20"
        responsiveLayout="scroll"
      >
        <Column field="id" header="id" :sortable="true"></Column>
        <Column field="title" header="Tiêu đề" :sortable="true"></Column>
        <Column field="slug" header="Slug" :sortable="true"></Column>
        <Column field="categories" header="Danh mục">
          <template #body="slotProps">
            <span v-for="cat in slotProps.data.categories" :key="cat.id">
              {{ cat.title }},
            </span>
          </template>
        </Column>

        <Column header="Chức năng" class="w-8rem">
          <template #body="slotProps">
            <Button
              icon="pi pi-eye"
              class="p-button-rounded p-button-text"
              @click="onClickPreviewPost(slotProps.data.id)"
            />

            <Button
              icon="pi pi-file-edit"
              class="p-button-rounded p-button-text"
              @click="getPostDetails(slotProps.data)"
            />
          </template>
        </Column>
      </DataTable>
    </div>
  </AdminLayout>

  <CreateOrUpdateModal
    v-model="createOrUpdateModelVisible"
    :errors="errors"
    :categories="categories"
    :details="postDetails"
  />
</template>
