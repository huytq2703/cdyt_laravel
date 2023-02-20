<script setup>
import { formatStringDateHour } from "@/utils/utils";
import { Link } from "@inertiajs/inertia-vue3";
const props = defineProps({
  categoryPost: {
    type: Object,
    required: false,
    default: null,
  },
});

const baseUrl = route("home");
</script>

<template>
  <h3
    class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
  >
    {{ categoryPost.title }}
  </h3>
  <div class="flex flex-column gap-3">
    <Link
      v-for="(post, index) in categoryPost?.posts"
      class="flex flex-wrap"
      :href="`${baseUrl}/${categoryPost.slug}/${post.slug}`"
    >
      <div class="flex gap-2">
        <img
          alt="Card image cap"
          :class="['card-img', 'w-10rem h-8rem']"
          style="object-fit: cover"
          :src="post?.cover_image"
        />
        <div class="card-body">
          <h5
            :class="[
              'pb-0 mb-0 text-sm font-bold text-justify uppercase fixed-text clamp-2',
            ]"
          >
            {{ post.title }}
          </h5>
          <small>Ngày đăng: {{ formatStringDateHour(post.created_at) }}</small>
          <p
            :class="['card-text text-sm fixed-text mt-2 clamp-3']"
            style="text-align: justify"
          >
            {{ post.summary }}
          </p>
        </div>
      </div>
    </Link>
  </div>
</template>
