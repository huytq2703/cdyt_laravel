<script setup>
import { ref, onMounted } from "vue";
import Carousel from "primevue/carousel";
import { Link } from "@inertiajs/inertia-vue3";

const baseUrl = route("home");
const props = defineProps({
  posts: Array,
});
</script>
<template>
  <div>
    <Carousel
      :value="posts"
      :numVisible="1"
      :numScroll="1"
      :autoplayInterval="5000"
      :showNavigators="false"
      :showIndicators="false"
      class="border-1"
    >
      <template #item="slotProps">
        <Link
          :href="`${baseUrl}/${slotProps.data?.categories?.[0]?.slug}/${slotProps.data.slug}`"
        >
          <img
            :src="slotProps.data.cover_image"
            style="height: 370px; width: 100%; object-fit: cover"
          />
          <div class="w-full h-13rem p-3">
            <h3 class="text-xl font-bold text-fixed clamp-2 text-justify">
              {{ slotProps.data.title }}
            </h3>
            <p class="font-bold mt-2 text-fixed clamp-5 text-justify">
              {{ slotProps.data.summary }}
            </p>
          </div>
        </Link>
      </template>
    </Carousel>
  </div>
</template>
