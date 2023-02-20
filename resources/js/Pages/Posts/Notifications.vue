<script setup>
import { onMounted } from "vue";
import { Head } from "@inertiajs/inertia-vue3";
import PostsByCategory from "./Components/PostsByCategory.vue";
import HighlightPosts from "./Components/HighlightPosts.vue";

const props = defineProps({
  notifications: {
    type: Array,
    required: false,
    default: () => [],
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
    <Head title="Thông báo" />

    <div class="container mx-auto">
      <div class="grid py-4">
        <div class="col-12 xl:col-8">
          <div class="flex flex-column">
            <div v-for="notice in notifications" :key="notice.id">
              <h3
                class="border-top bg-title bg-title-right text-uppercase text-2xl font-bold text-primary py-2 border-bottom-1"
              >
                {{ notice?.meta_title ?? notice?.title }}
              </h3>
              <!-- Here content -->
              <div v-if="notice.content" v-html="notice.content"></div>
              <div v-else><p>Nội dung đang được cập nhật</p></div>
            </div>
          </div>
        </div>
        <div class="col-12 xl:col-4">
          <HighlightPosts :categoryPost="highlightPosts" />
        </div>
      </div>
    </div>
  </AppLayout>
</template>
