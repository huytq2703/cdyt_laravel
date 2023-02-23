<script setup>
import { ref, onUnmounted } from "vue";
// import Button from "primevue/button";
import InputText from "primevue/inputtext";
import NavBar from "./NavBar.vue";
import moment from "moment";
import { Inertia } from "@inertiajs/inertia";
import { Link, usePage } from "@inertiajs/inertia-vue3";
import { useToast } from "primevue/usetoast";
import Toast from "primevue/toast";
import SearchAllPage from "./SearchAllPage.vue";
import SpeedDial from "primevue/speeddial";
import Button from "primevue/button";

const page = usePage();
const toast = useToast();
const toDate = moment().format("DD/MM/YYYY");
const marqueeText = ref(
  "Trường Cao Đẳng Y tế Đắk Lắk - 32 Y Ngông, phường Tân Tiến, thành phố Buôn Ma Thuột, tỉnh Đắk Lắk."
);

const items = [
  {
    label: "Add",
    icon: "pi pi-pencil",
    command: () => {
      this.$toast.add({ severity: "info", summary: "Add", detail: "Data Added" });
    },
  },
  {
    label: "Update",
    icon: "pi pi-refresh",
    command: () => {
      this.$toast.add({ severity: "success", summary: "Update", detail: "Data Updated" });
    },
  },
  {
    label: "Delete",
    icon: "pi pi-trash",
    command: () => {
      this.$toast.add({ severity: "error", summary: "Delete", detail: "Data Deleted" });
    },
  },
  {
    label: "Upload",
    icon: "pi pi-upload",
    command: () => {
      this.$router.push("fileupload");
    },
  },
  {
    label: "Vue Website",
    icon: "pi pi-external-link",
    command: () => {
      window.location.href = "https://vuejs.org/";
    },
  },
];

let removeFinishEventListener = Inertia.on("finish", () => {
  const t = page.props.value?.toast;
  if (!t) return;
  const severities = Object.keys(t)[0];
  const message = t[severities];
  const title = t?.title;

  if (message) {
    toast.add({
      severity: severities,
      summary: title ?? "Thông báo",
      detail: message,
      life: 3000,
    });
  }
});
document.documentElement.style.fontSize = "15px";
onUnmounted(() => {
  removeFinishEventListener();
});
</script>

<template>
  <SpeedDial :model="items" direction="up" class="z-4 fixed right-0 bottom-0 mr-3 mb-8">
    <template #button>
      <Button
        class="border-circle w-4rem h-4rem flex justify-content-center align-items-center custom-messages-button"
      >
        <v-icon
          name="ri-message-3-line"
          style="font-size: 12px"
          animation="ring"
          scale="1.5"
        ></v-icon>
      </Button>
    </template>

    <template #item="props">
      <div class="w-2rem h-2rem bg-primary z-5">sdf</div></template
    >
  </SpeedDial>

  <Toast />
  <div class="container mx-auto">
    <div class="border-bottom-1 w-full py-2 flex justify-content-between xl:px-0 pr-6">
      <a
        href="tel:02623845678"
        class="flex align-items-center hover-custom gap-1 font-bold"
      >
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
        <SearchAllPage />
        <!-- <a href="#" class="hover-custom-2">
          <i class="pi pi-facebook" style="font-size: 1.5rem"></i>
        </a>

        <a href="#" class="hover-custom-2">
          <i class="pi pi-youtube" style="font-size: 1.5rem"></i>
        </a>

        <a href="#" class="hover-custom-2">
          <i class="pi pi-phone" style="font-size: 1.5rem"></i>
        </a> -->
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

  <footer class="bg-green w-full bottom-0 animation-duration-1000">
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
.custom-messages-button {
  opacity: 0.5;
  background-color: #b83234;
  border: none;
  box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px,
    rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px,
    rgba(0, 0, 0, 0.09) 0px -3px 5px;
  outline: none;
  transition: all 0.2s ease;

  &:hover {
    opacity: 1;
    border: none !important;
    background: #b83234 !important;
  }
  &:focus {
    box-shadow: none;
  }
  .p-button:enabled:hover {
    border: none !important;
    background: #b83234 !important;
  }
}
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
