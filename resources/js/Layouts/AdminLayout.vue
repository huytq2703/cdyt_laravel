<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import Button from "primevue/button";
import Sidebar from "primevue/sidebar";
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { useConfirm } from "primevue/useconfirm";
import ConfirmDialog from "primevue/confirmdialog";
import ToastList from "@/Components/Toast/ToastList.vue";

const confirm = useConfirm();
const visibleLeft = ref(false);

const onMenuToggle = () => {
  visibleLeft.value = !visibleLeft.value;
};

const menu = [
  {
    label: "Dashboard",
    route: "admin.dashboard",
  },
  {
    label: "Quản lý bài viết",
    route: "admin.posts",
  },
  {
    label: "Quản lý địa điểm",
    route: "admin.locations.provinces",
  },
];

const signOut = () => {
  confirm.require({
    message: "Bạn có chắc chắn muốn đăng xuất không?",
    header: "Thông báo",
    icon: "pi pi-info-circle",
    acceptClass: "p-button-danger",
    acceptLabel: "Đăng xuất",
    rejectLabel: "Huỷ",
    accept: () => {
      Inertia.post(route("logout"));
    },
    reject: () => {},
  });
};
</script>

<template>
  <ConfirmDialog></ConfirmDialog>
  <!-- START: Header -->
  <div class="layout-topbar">
    <Link :href="route('admin.dashboard')" class="layout-topbar-logo">
      <!-- <img alt="Logo" src="../../assets/images/logo/logo-01.png" /> -->
      <span>Hệ thống quản lý</span>
    </Link>
    <button class="p-link layout-menu-button layout-topbar-button" @click="onMenuToggle">
      <i class="pi pi-bars"></i>
    </button>

    <div class="lg:flex lg:flex-1 lg:justify-content-end layout-topbar-menu-button">
      <!-- <button class="p-link layout-topbar-menu-button lg:flex layout-topbar-button">
        <i class="pi pi-ellipsis-v"></i>
        <i class="pi pi-calendar"></i>
        <span>Events</span>
      </button> -->
      <Button
        icon="pi pi-sign-out"
        class="p-button-rounded p-button-text p-button-plain"
        @click="signOut()"
      />
    </div>
  </div>
  <!-- END: Header -->

  <!-- START: Sidebar -->
  <Sidebar v-model:visible="visibleLeft" position="left">
    <h3>Menu</h3>
    <Button
      v-for="item in menu"
      :key="item.route"
      class="w-full p-button-text p-button-plain"
      @click="
        () => {
          Inertia.get(route(item.route));
        }
      "
      >{{ item.label }}</Button
    >
    <!-- <Button
      class="w-full p-button-text p-button-plain"
      @click="
        () => {
          Inertia.get(route('admin.posts'));
        }
      "
      >Quản lý bài viết</Button
    > -->
    <!-- <Button class="w-full p-button-text p-button-plain">Dashboard</Button> -->
    <!--
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button>
    <Button class="w-full p-button-text p-button-plain">Dashboard</Button> -->
  </Sidebar>
  <!-- END: Sidebar -->
  <div class="layout-main-container pl-5">
    <div class="layout-main">
      <ToastList />
      <slot />
    </div>
    <!-- <AppFooter /> -->
  </div>
</template>

<style lang="scss">
body {
  background-color: #f8f9fa;
}

#nprogress {
  .spinner {
    top: 0;
    right: 0;
    background-color: #0000001f;
    width: 100%;
    height: 100vh;
    margin: 0px;
    padding: 0px;
    position: absolute;
    justify-content: center;
    align-items: center;
    display: flex;
    pointer-events: visible;
    cursor: progress;
    z-index: 99999999;
  }
}
</style>
