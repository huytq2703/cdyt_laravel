<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { onMounted, ref } from "vue";
import { formatStringDate } from "@/utils/utils";

const props = defineProps({
  post: Object,
  categorySlug: {
    required: true,
    default: "",
  },
  componentSize: 1,
});
const baseUrl = route("home");
const imageSize = ref("md:h-13rem h-20rem");
const summaryLine = ref("clamp-5");
const titleLine = ref("clamp-2");
const fontSize = ref("text-medium");

onMounted(() => {
  //   console.log(props.post);

  switch (props.componentSize) {
    case 1:
      imageSize.value = "md:h-13rem h-20rem";
      summaryLine.value = "clamp-5";
      break;

    case 2:
      imageSize.value = "md:h-7rem h-20rem";
      summaryLine.value = "clamp-3";
      titleLine.value = "clamp-1";
      fontSize.value = "text-sm";
      break;
  }
});
</script>

<template>
  <Link :href="`${baseUrl}/${categorySlug}/${post.slug}`">
    <div class="grid">
      <div class="md:col-4 col-12">
        <img
          alt="Card image cap"
          :class="['card-img', imageSize]"
          style="object-fit: cover"
          :src="post?.cover_image"
        />
      </div>
      <div class="md:col-8 col-12">
        <div class="card-body">
          <h5
            :class="[
              'pb-0 mb-0 font-bold text-justify uppercase fixed-text',
              titleLine,
              fontSize,
            ]"
          >
            {{ post.title }}
          </h5>
          <small>Ngày đăng: {{ formatStringDate(post.created_at) }}</small>
          <p
            :class="['card-text fixed-text mt-2', summaryLine, fontSize]"
            style="text-align: justify"
          >
            {{ post.summary }}
          </p>
        </div>
      </div>
    </div>
  </Link>
</template>
