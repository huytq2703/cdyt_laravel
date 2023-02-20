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
  <div class="">
    <img :src="post?.cover_image" class="h-20rem w-full object-cover" alt="" />
    <Link :href="`${baseUrl}/${categorySlug}/${post?.slug}`">
      <h3 class="font-bold text-xl text-justify my-2 fixed-text clamp-2">
        {{ post?.title }}
      </h3>
      <p class="fixed-text clamp-5 text-justify">
        {{ post?.summary }}
      </p>
    </Link>
  </div>
</template>
