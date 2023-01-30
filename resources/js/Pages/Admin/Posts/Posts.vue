<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
// import ColumnGroup from "primevue/columngroup"; //optional for column grouping
// import Row from "primevue/row";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { onMounted, ref } from "vue";
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import CreateOrUpdateModal from "./components/CreateOrUpdateModal.vue";

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
});
const createOrUpdateModelVisible = ref(false);

const onClickAddNew = () => {
  createOrUpdateModelVisible.value = true;
};

onMounted(() => {
  console.log(props.posts);
});
</script>

<template>
  <AdminLayout>
    <Head title="Quản lý bài viết" />

    <div class="card">
      <div class="flex justify-content-between mb-4">
        <div>
          <Button label="Tạo mới" @click="onClickAddNew" />
        </div>

        <span class="p-input-icon-left">
          <i class="pi pi-search" />
          <InputText type="text" placeholder="Tìm kiếm" />
        </span>
      </div>
      <DataTable :value="posts">
        <Column field="id" header="id"></Column>
        <Column field="title" header="Tiêu đề"></Column>
        <Column field="slug" header="Slug"></Column>
        <Column field="categories" header="Danh mục">
          <template #body="slotProps">
            <span v-for="cat in slotProps.data.categories" :key="cat.id">
              {{ cat.title }},
            </span>
          </template>
        </Column>
      </DataTable>
    </div>
  </AdminLayout>

  <CreateOrUpdateModal v-model="createOrUpdateModelVisible" />
</template>
