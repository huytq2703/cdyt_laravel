<script setup>
import App from "@/Layouts/App.vue";
import HeaderSlider from "@/Components/HeaderSlider.vue";
import BlogsCarousel from "./Components/BlogsCarousel.vue";
import Carousel from "primevue/carousel";
import { Head } from "@inertiajs/inertia-vue3";
import { onMounted } from "vue";
import PostItemsHomePage from "./Components/PostItemsHomePage.vue";
import Notifications from "../../Components/NotificationsComponent.vue";
import LinksComponent from "./Components/LinksComponent.vue";

const props = defineProps({
  postsTab1: Object,
  postsTab2: Object,
  postsTab3: Object,
  postHeaderSlider: Array,
  notifications: Array,
  v_NotifyDetails: String,
});

const activityImages = ["7.jpg", "5.jpg", "6.jpg", "8.jpg"];

onMounted(() => {
  //   console.log(props.notifications);
});
</script>

<template>
  <Head title="Trang chủ" />
  <App>
    <template #header>
      <HeaderSlider />
    </template>

    <div class="container mx-auto">
      <div class="grid py-3">
        <div class="col-12 xl:col-8">
          <BlogsCarousel :posts="postHeaderSlider" />
        </div>

        <div class="col-12 xl:col-4">
          <Notifications
            :notifications="notifications"
            :v_NotifyDetails="v_NotifyDetails"
          />
        </div>
      </div>
      <div class="flex">
        <LinksComponent />
      </div>
      <div class="grid">
        <!-- START: Category tab 1-->
        <div class="col-12 xl:col-4">
          <h3
            class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1 text-uppercase"
          >
            {{ postsTab1?.meta_title ?? postsTab1?.title }}
          </h3>

          <div class="flex flex-column gap-3 py-3">
            <!-- START: Posts -->
            <PostItemsHomePage
              v-for="post in postsTab1?.posts"
              :key="post.id"
              :categorySlug="postsTab1?.slug"
              :post="post"
            />
            <!-- END: Posts -->
          </div>
        </div>
        <!-- END: Category -->

        <!-- START: Category tab 2-->
        <div class="col-12 xl:col-4">
          <h3
            class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1 text-uppercase"
          >
            {{ postsTab2?.meta_title ?? postsTab2?.title }}
          </h3>

          <div class="flex flex-column gap-3 py-3">
            <!-- START: Posts -->
            <PostItemsHomePage
              v-for="post in postsTab2?.posts"
              :key="post.id"
              :categorySlug="postsTab2?.slug"
              :post="post"
            />
            <!-- END: Posts -->
          </div>
        </div>
        <!-- END: Category -->

        <!-- START: Category tab 3 -->
        <div class="col-12 xl:col-4">
          <h3
            class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1 text-uppercase"
          >
            {{ postsTab3?.meta_title ?? postsTab3?.title }}
          </h3>

          <div class="flex flex-column gap-3 py-3">
            <!-- START: Posts -->
            <PostItemsHomePage
              v-for="post in postsTab3?.posts"
              :key="post.id"
              :categorySlug="postsTab3?.slug"
              :post="post"
            />
            <!-- END: Posts -->
          </div>
        </div>
        <!-- END: Category -->
      </div>

      <h3
        class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1 mt-3"
      >
        TẦM NHÌN VÀ SƯ MỆNH
      </h3>

      <div
        class="flex flex-column justify-content-center text-center text-3xl text-red font-bold py-5"
      >
        <i class="pi pi-book" style="font-size: 12rem"></i>
        <p class="mt-4">
          “ĐÀO TẠO NGUỒN NHÂN LỰC Y TẾ CÓ TRÌNH ĐỘ ĐỂ BẢO VỆ CHĂM SÓC VÀ NÂNG CAO SỨC KHỎE
          CỘNG ĐỒNG VÙNG TÂY NGUYÊN”
        </p>
      </div>
    </div>

    <div class="bg-gray py-5 w-full">
      <div class="container bg-white py-5 px-3">
        <div class="grid grid-nogutter">
          <div class="col-12 xl:col-4 md:col-6 max-h-12rem">
            <h3
              class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
            >
              TẦM NHÌN VÀ SƯ MỆNH
            </h3>

            <p class="font-bold">
              Với triết lý đào tạo “Thực học – Thực nghiệp”, Trường hướng tới đào tạo
              nguồn nhân lực chất lượng cao với phương pháp giảng dạy qua dự án thật.
            </p>
          </div>

          <div class="col-12 xl:col-4 md:col-6">
            <img
              src="storage/images/edu-1.jpg"
              class="w-full h-15rem"
              style="object-fit: cover"
              alt=""
            />
          </div>

          <div class="col-12 xl:col-4 md:col-6">
            <img
              src="storage/images/edu-2.jpg"
              class="w-full h-15rem"
              alt=""
              style="object-fit: cover"
            />
          </div>
          <div class="col-12 xl:col-4 md:col-6">
            <img
              src="storage/images/edu-2.jpg"
              class="w-full h-15rem"
              alt=""
              style="object-fit: cover"
            />
          </div>

          <div class="col-12 xl:col-4 md:col-6">
            <img
              src="storage/images/edu-3.jpg"
              class="w-full h-15rem"
              alt=""
              style="object-fit: cover"
            />
          </div>

          <div class="col-12 xl:col-4 md:col-6">
            <img
              src="storage/images/edu-4.jpg"
              class="w-full h-15rem"
              alt=""
              style="object-fit: cover"
            />
          </div>
        </div>
      </div>
    </div>

    <div class="container pt-5">
      <h3
        class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
      >
        HÌNH ẢNH HOẠT ĐỘNG
      </h3>

      <div class="">
        <Carousel
          :value="activityImages"
          :numVisible="3"
          :numScroll="1"
          :showNavigators="false"
          class="mt-3"
        >
          <template #item="slotProps">
            <img
              :src="`storage/images/activities/${slotProps.data}`"
              style="width: 100%; height: 200px; object-fit: cover"
              alt=""
            />
          </template>
        </Carousel>
      </div>
    </div>

    <div class="container">
      <h3
        class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
      >
        ĐỐI TÁC LIÊN KẾT
      </h3>

      <div class="flex align-items-center flex-wrap justify-content-center py-5 gap-2">
        <img
          src="storage/images/brands/link-01.png"
          style="width: 150px; object-fit: contain"
          alt=""
        />
        <img
          src="storage/images/brands/link-02.png"
          style="width: 150px; object-fit: contain"
          alt=""
        />
        <img
          src="storage/images/brands/link-03.png"
          style="width: 150px; object-fit: contain"
          alt=""
        />
        <img
          src="storage/images/brands/link-04.png"
          style="width: 150px; object-fit: contain"
          alt=""
        />
        <img
          src="storage/images/brands/link-05.png"
          style="width: 150px; object-fit: contain"
          alt=""
        />
        <img
          src="storage/images/brands/link-06.jpg"
          style="width: 150px; object-fit: contain"
          alt=""
        />
      </div>
    </div>
  </App>
</template>
