<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Button from "primevue/button";
import { Inertia } from "@inertiajs/inertia";
import { AxiosInstance } from "@/libs/axios";
import Editor from "primevue/editor";
import { ref, onMounted } from "vue";

const props = defineProps({
  task: {
    type: Object,
    required: false,
    default: null,
  },
});
const testSendMail = () => {
  Inertia.put(route("admin.test_mail"));
};

const posts = ref(null);
const user = ref(null);
const taskContent = ref("");
const isShow = ref(true);

const testAxios = () => {
  AxiosInstance({
    url: "/test",
    method: "get",
  })
    .then((response) => response)
    .then(({ data: res }) => {
      if (res.success) {
        posts.value = res.data.posts;
        user.value = res.data.user;
      }
    })
    .catch()
    .finally();
};

const saveTask = () => {
  Inertia.put(route("admin.dashboard.save_task"), {
    content: taskContent.value,
  });
};

onMounted(() => {
  taskContent.value = props.task?.values?.content;
});
</script>
<template>
  <AdminLayout>
    <!-- <div class="card h-30rem flex justify-content-center text-center">
      <h1>HỆ THỐNG QUẢN LÝ GIÁO DỤC</h1>
      <Button @click="testSendMail">Test send mail</Button>
      <Button @click="testAxios">Test Axios</Button>
      {{ posts }}
      {{ user }}
    </div>
    <div class="card h-30rem flex justify-content-center text-center">
      <h1>HỆ THỐNG QUẢN LÝ GIÁO DỤC</h1>

      {{ $page.props.auth }}
    </div> -->
    <div class="card">
      <div v-show="isShow">
        <Button
          icon="pi pi-file-edit"
          class="p-button-rounded p-button-text"
          @click="
            () => {
              isShow = false;
            }
          "
        />
        <div v-html="taskContent" />
      </div>
      <div v-show="!isShow">
        <div class="flex gap-3">
          <Button class="mb-2" @click="saveTask">Lưu</Button>
          <Button
            class="mb-2"
            @click="
              () => {
                isShow = true;
              }
            "
            >Huỷ</Button
          >
        </div>
        <Editor
          :key="update"
          id="content"
          v-model="taskContent"
          editorStyle="min-height: 500px"
        />
      </div>
    </div>
  </AdminLayout>
</template>
