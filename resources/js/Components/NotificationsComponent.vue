<script setup>
import { stringDateTimeByFormat } from "@/utils/utils";
import { Link } from "@inertiajs/inertia-vue3";
import ScrollPanel from "primevue/scrollpanel";

const baseUrl = route("home");
const props = defineProps({
  title: {
    type: String,
    required: false,
    default: "Thông báo",
  },

  notifications: {
    type: Array,
    required: false,
    default: () => [],
  },

  v_NotifyDetails: {
    type: String,
    required: false,
    default: "",
  },
});
</script>

<template>
  <div class="border-1 border-round-xl px-2 py-0">
    <h3
      class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1 uppercase"
    >
      {{ title }}
    </h3>

    <ScrollPanel style="width: 100%; height: 490px">
      <div class="flex flex-column gap-3">
        <Link
          :href="`${baseUrl}/${notify.slug}`"
          v-for="notify in notifications"
          :key="notify.id"
          class="relative pt-5 pl-3 pb-2 border-bottom-1 border-right-1"
        >
          <span
            class="flex flex-shrink-0 w-9rem h-2rem bg-primary justify-content-center font-bold text-xl text-center align-items-center absolute top-0 left-0"
          >
            {{ stringDateTimeByFormat(notify?.created_at, "DD/MM/yyyy") }}
          </span>
          <p class="h-3.5rem pt-1 text-justify font-bold m-0 pr-2 fixed-text clamp-2">
            {{ notify?.title }}
          </p>
        </Link>
      </div>
    </ScrollPanel>
  </div>
</template>
