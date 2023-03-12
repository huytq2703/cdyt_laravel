<script setup>
import { Link, usePage } from "@inertiajs/inertia-vue3";
import Button from "primevue/button";
import Sidebar from "primevue/sidebar";
import { ref, onMounted, computed, onUnmounted } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { useConfirm } from "primevue/useconfirm";
import ConfirmDialog from "primevue/confirmdialog";
import { adminMenu } from "@/commons/menu";
import Toast from "primevue/toast";
import { useToast } from "primevue/usetoast";
const page = usePage();
const confirm = useConfirm();
const visibleLeft = ref(false);
const onMenuToggle = () => {
  visibleLeft.value = !visibleLeft.value;
};

const toast = useToast();
const user = computed(() => page?.props?.value?.auth?.user);
const currentRoute = route().current();
const menu = computed(() => {
  if (page?.props?.value?.menu) return page?.props?.value?.menu;
  return [];
});

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

const onMouseEnterMenu = () => {
  visibleLeft.value = true;
};

onMounted(() => {});

onUnmounted(() => {
  removeFinishEventListener();
});
</script>

<template>
  <ConfirmDialog></ConfirmDialog>
  <div
    class="absolute h-full w-2rem top-0 flex align-items-center"
    @mouseenter="onMouseEnterMenu"
    style="z-index: 999"
  >
    <i class="pi pi-angle-right" style="font-size: 1.5rem"></i>
  </div>
  <!-- START: Header -->
  <div class="layout-topbar">
    <button
      class="p-link layout-menu-button layout-topbar-button ml-0 mr-2"
      @click="onMenuToggle"
    >
      <i class="pi pi-bars"></i>
    </button>

    <Link :href="route('admin.dashboard')" class="layout-topbar-logo">
      <!-- <img alt="Logo" src="../../assets/images/logo/logo-01.png" /> -->
      <span>Hệ thống quản lý</span>
    </Link>

    <div
      class="lg:flex lg:flex-1 lg:justify-content-end layout-topbar-menu-button align-items-center gap-2"
    >
      <a href="/">Trang chủ</a>
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
    <template #header><h3 class="p-0 m-0">Menu</h3></template>
    <template v-for="item in menu" :key="item.route">
      <h5 class="m-0 text-base">{{ item.name }}</h5>
      <Button
        v-for="link in item.child"
        :class="[
          'w-full p-button-text p-button-plain',
          currentRoute === link.route && 'active-link',
        ]"
        @click="
          () => {
            Inertia.get(route(link.route));
          }
        "
        >{{ link.name }}</Button
      >
    </template>
  </Sidebar>
  <!-- END: Sidebar -->
  <div class="layout-main-container pl-5">
    <div class="layout-main">
      <Toast />
      <!-- <ToastList /> -->
      <slot />
    </div>
    <!-- <AppFooter /> -->
  </div>
</template>

<style lang="scss">
body {
  background-color: #f8f9fa;
}
</style>
