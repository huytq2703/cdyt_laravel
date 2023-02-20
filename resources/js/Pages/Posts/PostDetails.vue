<script setup>
import { onMounted, computed } from "vue";
import { Head } from "@inertiajs/inertia-vue3";
import PageCategories from "./Components/PageCategories.vue";
import HighlightPosts from "./Components/HighlightPosts.vue";
import Notifications from "./Components/Notifications.vue";
const props = defineProps({
  post: {
    type: Object,
    required: false,
    default: null,
  },

  highlightPosts: {
    type: Array,
    required: false,
    default: () => [],
  },

  noticeList: {
    type: Array,
    required: false,
    default: () => [],
  },

  category: {
    type: Array,
    required: false,
    default: () => [],
  },
});

const type = computed(() => props?.post?.type);

onMounted(() => {
  //   console.log(type.value);
});
</script>

<template>
  <AppLayout>
    <Head :title="post?.meta_title ?? post?.title" />
    <div class="container mx-auto">
      <div class="grid py-4">
        <div class="col-12 xl:col-8 pr-3">
          <h3
            class="border-top bg-title bg-title-right text-uppercase text-2xl font-bold text-primary py-2 border-bottom-1"
          >
            {{ post?.meta_title ?? post?.title }}
          </h3>
          <!-- Here content -->
          <div v-if="post.content" v-html="post.content"></div>
        </div>
        <div class="col-12 xl:col-4">
          <PageCategories v-if="type === 'page'" :category="category" />
          <HighlightPosts v-if="type === 'post'" :categoryPost="highlightPosts" />
          <Notifications v-if="type === 'notice'" :notifications="noticeList" />
        </div>
      </div>
    </div>
  </AppLayout>
</template>
