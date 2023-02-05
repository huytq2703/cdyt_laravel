<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Button from "primevue/button";
import { Inertia } from "@inertiajs/inertia";
import { AxiosInstance } from "@/libs/axios";
import { ref } from "vue";

const testSendMail = () => {
  Inertia.put(route("admin.test_mail"));
};

const posts = ref(null);
const user = ref(null);

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
</script>
<template>
  <AdminLayout>
    <div class="card h-30rem flex justify-content-center text-center">
      <h1>HỆ THỐNG QUẢN LÝ GIÁO DỤC</h1>
      <Button @click="testSendMail">Test send mail</Button>
      <Button @click="testAxios">Test Axios</Button>
      {{ posts }}
      {{ user }}
    </div>
    <div class="card h-30rem flex justify-content-center text-center">
      <h1>HỆ THỐNG QUẢN LÝ GIÁO DỤC</h1>
    </div>
  </AdminLayout>
</template>
