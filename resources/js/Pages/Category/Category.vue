<script setup>
import App from "@/Layouts/App.vue";
import { Head } from "@inertiajs/inertia-vue3";
import PostItemComponent from "@/Components/Posts/PostItemComponent.vue";
import { onMounted } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
  category: Object,
  highlightPosts: Object,
});

onMounted(() => {
  //   console.log(props.category);
});
</script>

<template>
  <Head :title="category?.title ?? 'Danh mục không xác định'" />
  <App>
    <div class="container mx-auto">
      <div class="grid py-4">
        <div class="col-12 xl:col-8">
          <h3
            class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1 uppercase"
          >
            {{ category?.title ?? "Danh mục không xác định" }}
          </h3>
          <PostItemComponent
            v-if="category"
            v-for="post in category?.posts"
            :key="post?.id"
            :post="post"
            :category-slug="category?.slug"
          />
          <p v-else class="w-full text-center">Không có bài viết</p>
        </div>
        <div class="col-12 xl:col-4">
          <h3
            class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
          >
            TIN TỨC NỔI BẬT
          </h3>
          <div class="container">
            <PostItemComponent
              v-for="post in highlightPosts?.posts"
              :key="post?.id"
              :post="post"
              :category-slug="category?.slug"
              :componentSize="2"
            />
          </div>
        </div>
      </div>
    </div>
  </App>
</template>
