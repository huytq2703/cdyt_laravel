<script setup>
import { ref } from "vue";
// import Button from "primevue/button";
import InputText from "primevue/inputtext";
import NavBar from "./NavBar.vue";
import moment from "moment";
import { Link } from "@inertiajs/inertia-vue3";

const toDate = moment().format("DD/MM/YYYY");
const marqueeText = ref(
  "Trường Cao Đẳng Y tế Đắk Lắk - 32 Y Ngông, phường Tân Tiến, thành phố Buôn Ma Thuột, tỉnh Đắk Lắk."
);
</script>

<template>
  <div class="container mx-auto">
    <div class="border-bottom-1 w-full py-2 flex justify-content-between xl:px-0 px-3">
      <a href="#" class="flex align-items-center hover-custom gap-1 font-bold">
        <i class="pi pi-phone"></i><span>Hotline: 02623.845.678</span>
      </a>

      <div class="flex gap-3">
        <a href="#" class="flex align-items-center hover-custom gap-1 font-bold">
          <i class="pi pi-sitemap"></i><span class="sm:inline hidden">Sitemap</span>
        </a>
        <Link
          :href="route('admin.dashboard')"
          class="flex align-items-center hover-custom gap-1 font-bold"
        >
          <i class="pi pi-book"></i><span class="sm:inline hidden">Quản lý đào tạo</span>
        </Link>
      </div>
    </div>
  </div>

  <div class="container mx-auto">
    <div
      class="flex md:justify-content-between md:flex-row flex-column align-items-center xl:px-0 px-3"
    >
      <Link :href="route('home')" class="">
        <img src="../../assets/images/logo/logo-01.png" alt="" class="w-15rem" />
      </Link>

      <div class="flex align-items-center gap-3">
        <span class="p-input-icon-right">
          <i class="pi pi-search" />
          <InputText type="text" />
        </span>
        <a href="#" class="hover-custom-2">
          <i class="pi pi-facebook" style="font-size: 1.5rem"></i>
        </a>

        <a href="#" class="hover-custom-2">
          <i class="pi pi-youtube" style="font-size: 1.5rem"></i>
        </a>

        <a href="#" class="hover-custom-2">
          <i class="pi pi-phone" style="font-size: 1.5rem"></i>
        </a>
      </div>
    </div>
  </div>

  <div class="w-full bg-default mt-3">
    <NavBar />
  </div>

  <div v-if="$slots.header" class="w-full fadein animation-duration-1000">
    <slot name="header" />
  </div>

  <div class="container mx-auto">
    <div class="flex border-bottom-1 py-2 bg-title bg-title-right font-bold">
      <marquee style="color: #2a8b6c">{{ marqueeText }}</marquee>
      <span class="flex-shrink-0 px-2">Ngày {{ toDate }}</span>
    </div>
  </div>

  <div class="min-h-screen">
    <slot />
  </div>

  <footer class="bg-green w-full bottom-0 slideup animation-duration-1000">
    <div class="container py-5">
      <div class="flex justify-content-between flex-wrap gap-3">
        <div class="flex flex-column text-white font-bold">
          <img
            src="../../assets/images/logo/logo-02.png"
            style="max-width: 300px"
            alt=""
          />
          <p>Địa chỉ: 32 Y Ngông - P. Tân Tiến - Tp.Buôn Ma Thuột - Tỉnh Đắk Lắk</p>
          <p>Điện thoại: 0262 3 845 678</p>
          <p>Email: caodangytedaklak@gmail.com</p>
          <p>Website: http://dmc.edu.vn</p>
        </div>

        <div class="">
          <h3 class="font-bold text-white text-xl border-bottom-2">Thống kê truy cập</h3>

          <div class="flex flex-column text-white mt-3">
            <p class="flex align-items-center gap-2">
              <i class="pi pi-users"></i>Tổng truy cập: 300.000
            </p>
            <p class="flex align-items-center gap-2">
              <i class="pi pi-user"></i>Đang online: 300
            </p>
            <p class="flex align-items-center gap-2">
              <i class="pi pi-calendar"></i>Trong ngày: 6.000
            </p>
            <p class="flex align-items-center gap-2">
              <i class="pi pi-calendar-minus"></i>Hôm qua: 7.000
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-opacity flex justify-content-center">Copyright 2022</div>
  </footer>
</template>

<style lang="scss">
.hover-custom {
  color: #2a8b6c;
  transition: all 0.3s ease;
  &:hover {
    color: #b83234;
  }

  &-2 {
    transition: all 0.3s ease;
    color: var(--text-color);
    &:hover {
      color: #2a8b6c;
    }
  }

  &-3 {
    transition: all 0.3s ease;
    color: var(--text-color);
    &:hover {
      color: #b83234;
    }
  }
}

.bg-default {
  background-color: #2a8b6c;
}

.bg-title {
  background-image: url("../../assets/images/bg_title.png");
  background-repeat: no-repeat;
  &-right {
    background-position: right;
  }
}

.border-top {
  border-top: 5px solid #2a8b6c !important;
}
.text-primary {
  color: #2a8b6c !important;
}

.bg-primary {
  background-color: #2a8b6c !important;
}

.text-red {
  color: #b83234;
}

.bg-gray {
  background-color: gray;
}

.bg-white {
  background-color: white;
}
.bg-green {
  background-color: #2a8b6c;
}

.bg-opacity {
  background-color: rgba(128, 128, 128, 0.267);
}
a {
  transition: all 0.3s ease;
  color: var(--text-color);
  &:hover {
    color: #b83234;
  }
}
</style>
