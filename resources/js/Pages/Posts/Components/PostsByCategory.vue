<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { formatStringDateHour } from "@/utils/utils";

const props = defineProps({
  category: {
    type: Object,
    required: false,
    default: null,
  },
});
</script>
<template>
  <h3
    v-if="category"
    class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1 uppercase"
  >
    {{ category?.meta_title ?? category?.title }}
  </h3>
  <div v-show="category?.posts?.length < 1">Không tìm thấy bài viết</div>
  <div class="flex flex-column gap-3">
    <Link
      v-for="(post, index) in category?.posts"
      class="flex flex-wrap flex-1"
      :href="`${category.slug}/${post.slug}`"
    >
      <div class="grid w-full">
        <div class="md:col-4 col-12">
          <img
            alt="Card image cap"
            :class="['card-img', 'w-full h-12rem']"
            style="object-fit: cover"
            :src="post?.cover_image"
          />
        </div>
        <div class="md:col-8 col-12">
          <div class="card-body">
            <h5
              :class="['pb-0 mb-0 font-bold text-justify uppercase fixed-text clamp-2']"
            >
              {{ post?.meta_title ?? post?.title }}
            </h5>
            <small>Ngày đăng: {{ formatStringDateHour(post.created_at) }}</small>
            <p :class="['card-text fixed-text mt-2 clamp-5']" style="text-align: justify">
              {{ post.summary }}
            </p>
          </div>
        </div>
      </div>
    </Link>
  </div>
</template>
