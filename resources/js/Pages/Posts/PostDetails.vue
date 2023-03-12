<script setup>
import { onMounted, computed, ref } from "vue";
import { Head } from "@inertiajs/inertia-vue3";
import PageCategories from "./Components/PageCategories.vue";
import HighlightPosts from "./Components/HighlightPosts.vue";
import Notifications from "./Components/Notifications.vue";
import Button from "primevue/button";

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
  ziggy: Object,
});

const minSize = 14;
const maxSize = 34;
const fontSize = ref(18);

const urlSharing = computed(() => props?.ziggy?.location);
const type = computed(() => props?.post?.type);

const onClickChangeSize = (upSize) => {
  if (upSize && fontSize.value >= maxSize) return;
  if (!upSize && fontSize.value <= minSize) return;

  if (upSize) {
    fontSize.value += 4;
    return;
  }

  fontSize.value -= 4;
};

onMounted(() => {
  console.log(props.ziggy);
});
</script>

<template>
  <AppLayout>
    <Head :title="post?.meta_title ?? post?.title" />
    <div class="container mx-auto">
      <div class="grid py-4">
        <div :class="`'col-12 pr-3 ' ${type == 'page' ? 'xl:col-9' : 'xl:col-8'}`">
          <h3
            class="border-top bg-title bg-title-right text-uppercase text-2xl font-bold text-primary py-2 border-bottom-1 mb-0"
          >
            {{ post?.meta_title ?? post?.title }}
          </h3>
          <div class="flex justify-content-between py-3 align-items-center">
            <div class="flex gap-2 align-items-center">
              <span class="font-bold text-lg">Cỡ chữ:</span>
              <Button
                icon="pi pi-plus"
                class="p-button-rounded p-button-secondary p-button-outlined w-2rem h-2rem"
                @click="onClickChangeSize(true)"
              />
              <Button
                icon="pi pi-minus"
                class="p-button-rounded p-button-secondary p-button-outlined w-2rem h-2rem"
                @click="onClickChangeSize(false)"
              />
            </div>

            <div class="flex">
              <ShareNetwork
                network="email"
                :url="urlSharing"
                :title="post?.title"
                :description="post?.summary"
                :quote="post?.meta_title"
                class="py-2 px-2 surface-600 text-white"
              >
                <v-icon name="co-gmail" animation="pulse" />
              </ShareNetwork>
              <ShareNetwork
                network="facebook"
                :url="urlSharing"
                :title="post?.title"
                :description="post?.summary"
                :quote="post?.meta_title"
                class="py-2 px-2 bg-blue-700 text-white"
              >
                <v-icon name="fa-facebook-f" animation="pulse" />
              </ShareNetwork>
              <ShareNetwork
                network="twitter"
                :url="urlSharing"
                :title="post?.title"
                :description="post?.summary"
                :quote="post?.meta_title"
                class="py-2 px-2 bg-blue-500 text-white"
              >
                <v-icon name="bi-twitter" animation="pulse" />
              </ShareNetwork>
            </div>
          </div>

          <!-- Here content -->
          <div
            v-if="post?.content"
            v-html="post?.content"
            :style="{ 'font-size': `${fontSize}px` }"
          ></div>
        </div>
        <div :class="`'col-12 xl:col-4' ${type == 'page' ? 'xl:col-3' : 'xl:col-4'}`">
          <PageCategories v-if="type === 'page'" :category="category" />
          <HighlightPosts v-if="type === 'post'" :categoryPost="highlightPosts" />
          <Notifications v-if="type === 'notice'" :notifications="noticeList" />
        </div>
      </div>
    </div>
  </AppLayout>
</template>
