<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Button from "primevue/button";
import { Inertia } from "@inertiajs/inertia";

const testSendMail = () => {
  console.log("ok");
  Inertia.put(route("admin.test_mail"));
};
</script>
<template>
  <AdminLayout>
    <div class="card h-30rem flex justify-content-center text-center">
      <h1>HỆ THỐNG QUẢN LÝ GIÁO DỤC</h1>
      <Button @click="testSendMail">Test send mail</Button>
    </div>
    <div class="card h-30rem flex justify-content-center text-center">
      <h1>HỆ THỐNG QUẢN LÝ GIÁO DỤC</h1>
    </div>
  </AdminLayout>
</template>
