<script setup>
import { onMounted } from "vue";
import { Head } from "@inertiajs/inertia-vue3";
import PostsByCategory from "./Components/PostsByCategory.vue";
import HighlightPosts from "./Components/HighlightPosts.vue";

const props = defineProps({
  category: {
    type: Object,
    required: false,
    default: null,
  },

  highlightPosts: {
    type: Object,
    required: false,
    default: null,
  },
});

onMounted(() => {
  //   console.log(props.category);
});
</script>
<template>
  <AppLayout>
    <Head :title="category?.meta_title ?? category?.title" />
    <div v-if="!category">Không tìm thấy trang</div>

    <div v-else class="container mx-auto">
      <div class="grid py-4">
        <div class="col-12 xl:col-8">
          <PostsByCategory :category="category" />
        </div>
        <div class="col-12 xl:col-4">
          <HighlightPosts :categoryPost="highlightPosts" />
        </div>
      </div>
    </div>
  </AppLayout>
</template>
