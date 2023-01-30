<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Button from "primevue/button";
import { ref, onMounted } from "vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import InputText from "primevue/inputtext";
import { formatURLParams } from "@/utils/utils";

const props = defineProps({
  users: {
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

const form = useForm({
  keySearch: "",
});

const getData = () => {
  form.get(route("admin.test"), {
    preserveState: true,
  });
};
</script>

<template>
  <AdminLayout>
    <Head title="Test" />
    <div class="flex">
      <div class="card">
        <h5>Get method</h5>
        <div class="flex align-items-center gap-2">
          <InputText
            v-model="form.keySearch"
            type="text"
            placeholder="Tìm kiếm user"
            @keyup.enter.native="getData"
            autofocus
          />
          <div v-if="form.errors.email">{{ form.errors.keySearch }}</div>
          <Button label="Tìm kiếm" @click="getData" />
        </div>

        <p v-for="user in users" :key="user.id">{{ user.name }}</p>
      </div>

      <div class="card">
        <h5>Post method</h5>
      </div>
    </div>
  </AdminLayout>
</template>
