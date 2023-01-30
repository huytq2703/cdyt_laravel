<script setup>
import App from "@/Layouts/App.vue";
import HeaderSlider from "@/Components/HeaderSlider.vue";
import BlogsCarousel from "./Components/BlogsCarousel.vue";
import Carousel from "primevue/carousel";
import { Head } from "@inertiajs/inertia-vue3";

const activityImages = ["7.jpg", "5.jpg", "6.jpg", "8.jpg"];
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
          <BlogsCarousel />
        </div>

        <div class="col-12 xl:col-4">
          <div class="border-1 border-round-xl px-2 py-0 h-full overflow-scroll">
            <h3
              class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
            >
              THÔNG BÁO
            </h3>

            <div class="flex flex-column gap-2 my-2">
              <div class="flex gap-2">
                <div
                  class="flex flex-shrink-0 w-5rem h-5rem bg-primary font-bold text-xl text-center align-items-center"
                >
                  2022-07-17
                </div>
                <a
                  href=""
                  class="flex-1 h-5rem border-bottom-1 text-justify font-bold hover-custom-2"
                  >Thông báo tuyển sinh: Cao đẳng chính quy khoá học 2022 - 2025</a
                >
              </div>

              <div class="flex gap-2">
                <div
                  class="flex flex-shrink-0 w-5rem h-5rem bg-primary font-bold text-xl text-center align-items-center"
                >
                  2022-07-17
                </div>
                <a href="" class="flex-1 h-5rem border-bottom-1 text-justify font-bold"
                  >Thông báo tuyển sinh: Cao đẳng chính quy khoá học 2022 - 2025</a
                >
              </div>

              <div class="flex gap-2">
                <div
                  class="flex flex-shrink-0 w-5rem h-5rem bg-primary font-bold text-xl text-center align-items-center"
                >
                  2022-07-17
                </div>
                <a href="" class="flex-1 h-5rem border-bottom-1 text-justify font-bold"
                  >Thông báo tuyển sinh: Cao đẳng chính quy khoá học 2022 - 2025</a
                >
              </div>

              <div class="flex gap-2">
                <div
                  class="flex flex-shrink-0 w-5rem h-5rem bg-primary font-bold text-xl text-center align-items-center"
                >
                  2022-07-17
                </div>
                <a href="" class="flex-1 h-5rem border-bottom-1 text-justify font-bold"
                  >Thông báo tuyển sinh: Cao đẳng chính quy khoá học 2022 - 2025</a
                >
              </div>

              <div class="flex gap-2">
                <div
                  class="flex flex-shrink-0 w-5rem h-5rem bg-primary font-bold text-xl text-center align-items-center"
                >
                  2022-07-17
                </div>
                <a href="" class="flex-1 h-5rem border-bottom-1 text-justify font-bold"
                  >Thông báo tuyển sinh: Cao đẳng chính quy khoá học 2022 - 2025</a
                >
              </div>

              <div class="flex gap-2">
                <div
                  class="flex flex-shrink-0 w-5rem h-5rem bg-primary font-bold text-xl text-center align-items-center"
                >
                  2022-07-17
                </div>
                <a href="" class="flex-1 h-5rem border-bottom-1 text-justify font-bold"
                  >Thông báo tuyển sinh: Cao đẳng chính quy khoá học 2022 - 2025</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="grid">
        <div class="col-12 xl:col-4">
          <h3
            class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
          >
            HOẠT ĐỘNG CHUYÊN MÔN
          </h3>

          <div class="flex flex-column gap-3 py-3">
            <div class="">
              <img src="storage/images/activities/6.jpg" alt="" />
              <a href="#">
                <h3 class="font-bold text-xl text-justify py-2">
                  TRƯỜNG CDYT TỔ CHỨC HỘI THẢO TƯ VẤN GIỚI THIỆU NGÀNH ĐIỀU DƯỠNG TẠI NHẬT
                  BẢN
                </h3>

                <p>
                  🇻🇳 Sáng ngày 6/9/2022 tại Hội trường A Trường Cao đẳng Y tế Đắk Lắk đã
                  tổ chức thành công hội thảo ngành Điều dưỡng tại Nhật Bản. 🎌🎌🎌 ...
                </p>
              </a>
            </div>

            <div class="">
              <img src="storage/images/activities/6.jpg" alt="" />
              <a href="#">
                <h3 class="font-bold text-xl text-justify py-2">
                  TRƯỜNG CDYT TỔ CHỨC HỘI THẢO TƯ VẤN GIỚI THIỆU NGÀNH ĐIỀU DƯỠNG TẠI NHẬT
                  BẢN
                </h3>

                <p>
                  🇻🇳 Sáng ngày 6/9/2022 tại Hội trường A Trường Cao đẳng Y tế Đắk Lắk đã
                  tổ chức thành công hội thảo ngành Điều dưỡng tại Nhật Bản. 🎌🎌🎌 ...
                </p>
              </a>
            </div>
          </div>
        </div>
        <div class="col-12 xl:col-4">
          <h3
            class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
          >
            HOẠT ĐỘNG THI VÀ TUYỂN SINH
          </h3>

          <div class="flex flex-column gap-3 py-3">
            <div class="">
              <img src="storage/images/activities/6.jpg" alt="" />
              <a href="#">
                <h3 class="font-bold text-xl text-justify py-2">
                  TRƯỜNG CDYT TỔ CHỨC HỘI THẢO TƯ VẤN GIỚI THIỆU NGÀNH ĐIỀU DƯỠNG TẠI NHẬT
                  BẢN
                </h3>

                <p>
                  🇻🇳 Sáng ngày 6/9/2022 tại Hội trường A Trường Cao đẳng Y tế Đắk Lắk đã
                  tổ chức thành công hội thảo ngành Điều dưỡng tại Nhật Bản. 🎌🎌🎌 ...
                </p>
              </a>
            </div>

            <div class="">
              <img src="storage/images/activities/6.jpg" alt="" />
              <a href="#">
                <h3 class="font-bold text-xl text-justify py-2">
                  TRƯỜNG CDYT TỔ CHỨC HỘI THẢO TƯ VẤN GIỚI THIỆU NGÀNH ĐIỀU DƯỠNG TẠI NHẬT
                  BẢN
                </h3>

                <p>
                  🇻🇳 Sáng ngày 6/9/2022 tại Hội trường A Trường Cao đẳng Y tế Đắk Lắk đã
                  tổ chức thành công hội thảo ngành Điều dưỡng tại Nhật Bản. 🎌🎌🎌 ...
                </p>
              </a>
            </div>
          </div>
        </div>
        <div class="col-12 xl:col-4">
          <h3
            class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
          >
            HOẠT ĐỘNG ĐOÀN THANH NIÊN
          </h3>

          <div class="flex flex-column gap-3 py-3">
            <div class="">
              <img src="storage/images/activities/6.jpg" alt="" />
              <a href="#">
                <h3 class="font-bold text-xl text-justify py-2">
                  TRƯỜNG CDYT TỔ CHỨC HỘI THẢO TƯ VẤN GIỚI THIỆU NGÀNH ĐIỀU DƯỠNG TẠI NHẬT
                  BẢN
                </h3>

                <p>
                  🇻🇳 Sáng ngày 6/9/2022 tại Hội trường A Trường Cao đẳng Y tế Đắk Lắk đã
                  tổ chức thành công hội thảo ngành Điều dưỡng tại Nhật Bản. 🎌🎌🎌 ...
                </p>
              </a>
            </div>

            <div class="">
              <img src="storage/images/activities/6.jpg" alt="" />
              <a href="#">
                <h3 class="font-bold text-xl text-justify py-2">
                  TRƯỜNG CDYT TỔ CHỨC HỘI THẢO TƯ VẤN GIỚI THIỆU NGÀNH ĐIỀU DƯỠNG TẠI NHẬT
                  BẢN
                </h3>

                <p>
                  🇻🇳 Sáng ngày 6/9/2022 tại Hội trường A Trường Cao đẳng Y tế Đắk Lắk đã
                  tổ chức thành công hội thảo ngành Điều dưỡng tại Nhật Bản. 🎌🎌🎌 ...
                </p>
              </a>
            </div>
          </div>
        </div>
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
