<script setup>
import App from "@/Layouts/App.vue";
import { Head } from "@inertiajs/inertia-vue3";

const props = defineProps({
  post: {
    type: Object,
    required: false,
    default: null,
  },
});
</script>

<template>
  <Head title="Lịch thi hết môn" />
  <App>
    <div class="container">
      <h3
        class="border-top bg-title bg-title-right text-uppercase text-2xl font-bold text-primary py-2 border-bottom-1 mb-0"
      >
        Lịch thi hết môn
      </h3>
      <div v-html="post?.content"></div>
    </div>
  </App>
</template>
