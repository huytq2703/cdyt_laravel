<script setup>
import { ref, onMounted, computed } from "vue";
import Sidebar from "primevue/sidebar";
import Button from "primevue/button";
import { Link, usePage } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

const page = usePage();
const menu = ref([]);
const baseUrl = route("home");

const menuFullVisible = ref(false);

onMounted(() => {
  menu.value = page.props?.value?.webMenu2
    ?.map((menu) => {
      //   console.log(menu);
      const subMenu = menu.sub_menus
        ?.map((sub) => {
          return {
            title: sub?.category?.title ?? sub?.post?.title,
            slug: sub?.category?.slug ?? sub?.post?.slug,
            orderNumber: sub.order_number,
          };
        })
        .sort((prev, next) => prev.orderNumber - next.orderNumber);

      return {
        title: menu?.category?.title,
        slug: menu?.category?.slug,
        orderNumber: menu?.order_number,
        subMenu: subMenu,
      };
    })
    .sort((pre, next) => pre.orderNumber - next.orderNumber);
});
</script>

<template>
  <!-- Web menu -->
  <div class="lg:flex container mx-auto hidden overflow-scroll hide-scroll">
    <div v-for="item in menu" class="" :key="item.title">
      <div v-if="item?.subMenu?.length > 0" class="dropdown2">
        <button
          class="dropbtn flex align-items-center gap-2 nav-link white-space-nowrap uppercase"
        >
          {{ item.title }}<i class="pi pi-caret-down"></i>
        </button>
        <div class="dropdown2-content">
          <Link
            v-for="subMenu in item.subMenu"
            class="white-space-nowra uppercase"
            :key="subMenu.title"
            :href="`${baseUrl}/${subMenu.slug}`"
          >
            {{ subMenu.title }}
          </Link>
        </div>
      </div>

      <Link
        v-else
        :href="`${baseUrl}/${item.slug}`"
        class="flex nav-link flex-nowrap white-space-nowrap uppercase"
        >{{ item.title }}</Link
      >
    </div>

    <!-- <Link href="hoat-dong-doan-thanh-nien">Test</Link> -->
  </div>

  <!-- Mobile menu -->
  <div class="lg:hidden flex justify-content-end container mx-auto py-1">
    <Button
      class="p-button-text text-white p-0"
      @click="
        () => {
          menuFullVisible = true;
        }
      "
      ><i class="pi pi-align-justify" style="font-size: 1.5rem"></i
    ></Button>
  </div>

  <Sidebar v-model:visible="menuFullVisible" :baseZIndex="1000" position="left">
    <div class="flex flex-column gap-1">
      <div v-for="item in menu" :key="item.slug" class="w-full">
        <div v-if="item?.subMenu?.length > 0" class="mobile-dropdown">
          <button
            class="mobile-dropbtn flex align-items-center justify-content-between gap-2 py-1 font-bold w-full"
          >
            {{ item.title }}<i class="pi pi-chevron-down"></i>
          </button>
          <div class="mobile-dropdown-content">
            <Link
              v-for="subMenu in item?.subMenu"
              class="white-space-nowrap py-2"
              :key="subMenu.slug"
              :href="`${baseUrl}/${subMenu.slug}`"
            >
              {{ subMenu.title }}
            </Link>
          </div>
        </div>

        <Link
          v-else
          :href="`${baseUrl}/${item.slug}`"
          class="flex flex-nowrap white-space-nowrap font-bold mb-1 py-1"
          >{{ item.title }}</Link
        >
      </div>
    </div>
  </Sidebar>
</template>

<style lang="scss" scoped>
.nav-link {
  color: white;
  font-weight: bold;
  padding: 7px;
  &:hover {
    background-color: #b83234;
  }
}

/* Hide scrollbar for Chrome, Safari and Opera */
.hide-scroll::-webkit-scrollbar {
  display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.hide-scroll {
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: none; /* Firefox */
}

.dropbtn,
.nav-link {
  color: white;
  font-size: 1rem;
  padding: 0.5rem;
  font-weight: bold;
  border: none;
  cursor: pointer;
  transition: all 0.2s ease;
}

.dropdown2 {
  //   position: relative;
  display: inline-block;
  transition: all 0.2s ease;

  &-content {
    display: none;
    position: absolute;
    background-color: #2a8b6c;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 99999;
    transition: all 0.5s ease;

    a {
      color: white;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }
    a:hover {
      background-color: #b83234;
    }
  }

  &:hover .dropdown2-content {
    display: block;
  }
}

.mobile {
  &-dropdown {
    //   position: relative;
    display: inline-block;
    transition: all 0.3s ease;
    width: 100%;

    &-content {
      display: block;
      width: 100%;
      max-height: 0px;
      overflow: hidden;
      z-index: 99999;
      transition: all 0.3s ease;

      a {
        // color: white;
        padding: 7px 16px;
        text-decoration: none;
        display: block;
        font-weight: bold;
      }
    }

    &:hover &-content {
      max-height: max-content;
    }
  }
}
</style>
