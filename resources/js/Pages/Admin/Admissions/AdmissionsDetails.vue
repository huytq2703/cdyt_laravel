<script setup>
const props = defineProps({
  details: {
    type: Object,
    required: false,
    default: null,
  },
});
</script>

<template>
  <AdminLayout>
    <div class="card">
      <h5>Thông tin đăng ký tuyển sinh</h5>
      <div class="flex flex-column">
        <span v-for="(value, index) in Object.keys(details)" :key="index" class="flex-1">
          {{ value }}: {{ details[value] }}
        </span>
      </div>
    </div>
  </AdminLayout>
</template>
