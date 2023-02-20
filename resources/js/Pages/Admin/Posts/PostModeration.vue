<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import Badge from "primevue/badge";
import Button from "primevue/button";
import Column from "primevue/column";
import DataTable from "primevue/datatable";
import InputText from "primevue/inputtext";
import { ref, onMounted, reactive } from "vue";
import { formatStringDateHour } from "@/utils/utils";
import ToggleButton from "primevue/togglebutton";
import { Inertia } from "@inertiajs/inertia";
import { useConfirm } from "primevue/useconfirm";

const props = defineProps({
  posts: {
    type: Array,
    required: false,
    default: [],
  },
  pagination: Object,
  rl_PostsCreated: String,
  rau_PostsPublished: String,
});
const filtersForm = useForm({
  search: props?.params?.search,
});
const confirm = useConfirm();
const postsSelected = ref([]);
const tabButtons = reactive({
  post: {
    selected: true,
    label: "Bài viết",
  },
  page: {
    selected: false,
    label: "Nội dung web",
  },
  notice: {
    selected: false,
    label: "Thông báo",
  },
});

const onTabsChange = (value) => {
  tabButtons.post.selected = false;
  tabButtons.page.selected = false;
  tabButtons.notice.selected = false;

  tabButtons[value].selected = true;
  postsSelected.value = [];
  Inertia.get(route(props.rl_PostsCreated), { type: value }, { preserveState: true });
};

const onClickPublishPosts = () => {
  const ids = postsSelected.value?.map(({ id }) => id);

  confirm.require({
    message: `Nội dung ${ids.length} dòng đã chọn sẽ được công khai trên trang web. Bạn có chắc chắc muốn công khai?`,
    header: "Thông báo",
    icon: "pi pi-info-circle",
    acceptClass: "p-button-danger",
    acceptLabel: "Đồng ý",
    rejectLabel: "Huỷ",
    accept: () => {
      Inertia.put(
        route(props.rau_PostsPublished),
        { ids: ids },
        {
          onSuccess: () => {
            postsSelected.value = [];
          },
        }
      );
    },
    reject: () => {},
  });
};

onMounted(() => {
  console.log(props.posts);
});
</script>

<template>
  <AdminLayout>
    <div class="card">
      <h5 class="font-bold">Danh sách bài viết chờ duyệt</h5>

      <DataTable
        v-model:selection="postsSelected"
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
              <Button
                label="Duyệt"
                @click="onClickPublishPosts"
                :disabled="postsSelected.length <= 0"
              />
            </div>

            <span class="p-input-icon-left w-20rem">
              <i class="pi pi-search" />
              <InputText
                v-model="filtersForm.search"
                type="text"
                class="w-full"
                placeholder="Nhập và enter để tìm kiếm"
                @keyup.enter="onSearch"
              />
            </span>
          </div>
          <div class="flex pt-3 toggle-custom">
            <ToggleButton
              v-model="tabButtons.post.selected"
              :onLabel="tabButtons.post.label"
              :offLabel="tabButtons.post.label"
              @change="onTabsChange('post')"
            />
            <ToggleButton
              v-model="tabButtons.page.selected"
              :onLabel="tabButtons.page.label"
              :offLabel="tabButtons.page.label"
              @change="onTabsChange('page')"
            />
            <ToggleButton
              v-model="tabButtons.notice.selected"
              :onLabel="tabButtons.notice.label"
              :offLabel="tabButtons.notice.label"
              @change="onTabsChange('notice')"
            />
          </div>
        </template>
        <template #empty>
          <p class="text-center">Không tìm thấy dữ liệu</p>
        </template>
        <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
        <Column field="id" header="id" :sortable="true" class="w-3rem"></Column>
        <Column field="title" header="Tiêu đề" :sortable="true"></Column>
        <Column field="created_at" header="Ngày tạo" :sortable="true">
          <template #body="props">
            {{ formatStringDateHour(props.data.created_at) }}
          </template>
        </Column>
        <Column field="updated_at" header="Cập nhật lần cuối" class="w-12rem">
          <template #body="props">
            {{ formatStringDateHour(props.data.updated_at) }}
          </template>
        </Column>
        <Column field="user.username" header="Tạo bởi" class="w-12rem"></Column>

        <!-- <Column field="published" header="Trạng thái" class="w-12rem">
    <template #body="slotProps">
      <Badge value="Chưa duyệt" />
    </template>
  </Column> -->
        <!-- <Column header="Chức năng" class="w-10rem">
    <template #body="slotProps">
      <Button
        icon="pi pi-eye"
        class="p-button-rounded p-button-text"
        @click="onClickPreviewPost(slotProps.data.id)"
      />

      <Button
        icon="pi pi-file-edit"
        class="p-button-rounded p-button-text"
        @click="onClickPostDetails(slotProps.data.id)"
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

<style lang="scss">
.toggle-custom {
  .p-highlight {
    background-color: gray !important;
    outline: none;
    border: none;
  }
  .p-focus {
    outline: none;
    box-shadow: none;
  }
}
</style>
