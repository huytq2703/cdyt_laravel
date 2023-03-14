<script setup>
import Button from "primevue/button";
import Carousel from "primevue/carousel";
import OverlayPanel from "primevue/overlaypanel";
import { onMounted, ref } from "vue";

const scrollPanel = ref(null);

const scrollX = (e) => {
  //   console.log();
  scrollPanel.value.scrollLeft += e.deltaY;
};
onMounted(() => {});
</script>

<template>
  <div
    ref="scrollPanel"
    class="flex gap-4 overflow-auto max-w-full mb-4 justify-content-between w-full"
    @mousewheel.prevent="scrollX"
  >
    <a class="card" href="http://gddt.daklak.gov.vn/" target="_blank">
      <img src="storage/images/icons/LOGO_SO_GDDT_DAKLAK.jpg" alt="" class="w-3rem" />
      <div class="flex align-items-center h-full">
        <p>SỞ GIÁO DỤC VÀ ĐÀO TẠO ĐẮK LẮK</p>
      </div>
    </a>

    <a class="card" target="_blank" href="https://yte.daklak.gov.vn/ASPX/Default.aspx">
      <img src="/storage/images/icons/so_y_te_dak_lak.png" alt="" class="w-3rem" />
      <div class="flex align-items-center h-full">
        <p>SỞ Y TẾ TỈNH ĐẮK LẮK</p>
      </div>
    </a>

    <a href="https://daklak.gov.vn/" class="card" target="_blank">
      <img src="/storage/images/icons/cttdt_dl.png" alt="" class="w-3rem" />
      <div class="flex align-items-center h-full">
        <p>CỔNG THÔNG TIN ĐIỆN TỬ TỈNH ĐẮK LẮK</p>
      </div>
    </a>
    <a
      href="https://motcua.daklak.gov.vn/trang-chu/tra-cuu/bo-thu-tuc"
      class="card"
      target="_blank"
    >
      <img src="/storage/images/icons/hanh-chinh-cong.png" alt="" class="w-3rem" />
      <div class="flex align-items-center h-full">
        <p>DỊCH VỤ HÀNH CHÍNH CÔNG</p>
      </div>
    </a>
  </div>
</template>

<style lang="scss" scoped>
.card {
  //   border-left: 5px solid #2a8b6c;
  display: flex;
  flex-direction: row;
  align-items: center;
  min-width: 270px;
  gap: 10px;
  font-size: 16px;
  font-weight: 700;
  color: #2a8b6c;
  cursor: pointer;

  &::before {
    content: " ";
    display: block;
    width: 0;
    height: 100%;
    position: absolute;
    background-color: rgba(57, 57, 57, 0.374);
    left: 0;
    border-radius: 10px;
    transition: all 0.3s ease;
  }
  &:hover {
    &::before {
      border-left: 5px solid #2a8b6c;
      width: 100%;
    }
  }

  p {
    max-width: 200px;
    line-height: 1.2;
    text-align: center;
  }
}
.overflow-auto::-webkit-scrollbar {
  display: none !important;
}
</style>
