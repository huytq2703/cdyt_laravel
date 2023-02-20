<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
  category: {
    type: Array,
    required: false,
    default: () => [],
  },
});

const baseUrl = route("home");
</script>

<template>
  <div class="row">
    <div class="col-sm-12 bg-category border-round-lg mb-5">
      <h3
        class="bg-title bg-title-right text-2xl font-bold text-category py-2 m-0 border-bottom-1 mt-1"
      >
        DANH MỤC
      </h3>
      <ul style="list-style-type: none" class="side-menu">
        <li
          v-for="menu in category"
          :key="menu?.title"
          style="padding: 10px"
          class="text-white list-item"
        >
          <Link class="nav-link" :key="menu.slug" :href="`${baseUrl}/${menu.slug}`">
            <i class="pi pi-caret-right"></i>
            {{ menu.title }}
          </Link>
        </li>
      </ul>
    </div>
    <div class="col-sm-12">
      <img
        src="/storage/images/sinhvien.jpg"
        alt="SINH VIEN"
        class="card-img"
        style="width: 100%; height: 100%"
      />
    </div>
  </div>
</template>

<style lang="scss">
.nav-link {
  color: white;
  padding: 7px;
  &:hover {
    background-color: #b83234;
    font-weight: bold;
  }
}
.nav-link {
  color: white;
  font-size: 1rem;
  padding: 0.5rem;
  border: none;
  cursor: pointer;
  transition: all 0.2s ease;
}

.side-menu {
  height: calc(100vh - 130px);
}
.bg-category {
  background-color: #2a8b6c;
}
.text-category {
  color: white;
}
</style>
