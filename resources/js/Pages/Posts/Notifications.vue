<script setup>
import { onMounted, computed, ref } from "vue";
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

const minSize = 14;
const maxSize = 34;
const fontSize = ref(18);

const urlSharing = computed(() => props?.ziggy?.location);

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
  //   console.log(props.category);
});
</script>

<template>
  <AppLayout>
    <Head title="Thông báo" />

    <div class="container mx-auto">
      <div class="grid py-4">
        <div class="col-12 xl:col-8">
          <div v-if="notifications.length > 0" class="flex flex-column">
            <div v-for="notice in notifications" :key="notice.id">
              <h3
                class="border-top bg-title bg-title-right text-uppercase text-2xl font-bold text-primary py-2 border-bottom-1"
              >
                {{ notice?.meta_title ?? notice?.title }}
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
              <div v-if="notice.content" v-html="notice.content"></div>
              <div v-else><p>Nội dung đang được cập nhật</p></div>
            </div>
          </div>

          <div v-else class="flex flex-column">
            <h3
              class="border-top bg-title bg-title-right text-uppercase text-2xl font-bold text-primary py-2 border-bottom-1"
            >
              Thông báo đang cập nhật
            </h3>

            <p>Nội dung các thông báo chưa được kiểm duyệt</p>
          </div>
        </div>
        <div class="col-12 xl:col-4">
          <HighlightPosts :categoryPost="highlightPosts" />
        </div>
      </div>
    </div>
  </AppLayout>
</template>
