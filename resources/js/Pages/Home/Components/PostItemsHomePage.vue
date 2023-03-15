<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
  post: {
    type: Object,
    required: false,
    default: null,
  },
  categorySlug: {
    type: String,
    required: false,
    default: "",
  },
});
const baseUrl = route("home");
</script>

<template>
  <div class="card-posts">
    <img
      :src="post?.cover_image"
      class="sm:h-20rem w-full sm:object-cover object-contain"
      alt=""
    />
    <Link :href="`${baseUrl}/${categorySlug}/${post?.slug}`" class="post-content">
      <h3 class="font-bold text-xl text-justify my-2 fixed-text clamp-1 title">
        {{ post?.title }}
      </h3>
      <p class="fixed-text clamp-5 text-justify h-full">
        {{ post?.summary }}
      </p>
    </Link>
  </div>
</template>

<style lang="scss" scoped>
.post-content {
  height: 150px;
  display: flex;
  flex-direction: column;
}
</style>
