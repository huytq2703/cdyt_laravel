<script setup>
import App from "@/Layouts/App.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { computed } from "vue";

const props = defineProps({
  post: {
    type: Object,
    required: false,
    default: null,
  },
});

const titlePage = computed(() => {
  return "Xem trước - " + props.post.title;
});
</script>

<template>
  <Head :title="titlePage" />
  <App>
    <div class="container mx-auto">
      <h3 class="font-bold">{{ post.title }}</h3>
      <div v-html="post.content"></div>
    </div>
  </App>
</template>
