<script setup>
import { onMounted } from "vue";
import App from "@/Layouts/App.vue";
import EnrollmentNewsComponent from "@/Components/Posts/EnrollmentNewsComponent.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import RegistrationForm from "./components/RegistrationForm.vue";
import PostsByCategory from "../Posts/Components/PostsByCategory.vue";

const props = defineProps({
  ra_SubmitFormRegister: String,
  majors: Array,
  levels: Array,
  genders: Array,
  admissionNews: Object,
});

onMounted(() => {
  //   console.log(props.admissionNews);
});
</script>

<template>
  <Head title="Đăng ký tuyển sinh online" />
  <App>
    <div class="container py-3">
      <h3
        class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1 mb-0"
      >
        TRANG TƯ VẤN TUYỂN SINH
      </h3>
      <div
        class="flex flex-column justify-content-center text-center text-3xl text-red font-bold py-5"
      >
        <i class="pi pi-book" style="font-size: 12rem"></i>
        <p class="mt-4">“Hãy đăng ký liên hệ nhà trường để được hỗ trợ, hướng dẫn.</p>
      </div>

      <h3
        class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1 mb-0"
      >
        BẠN NÊN CHỌN HỌC TẠI TRƯỜNG VÌ
      </h3>
      <div class="flex lg:flex-row flex-column justify-content-between gap-3 w-full mt-2">
        <div
          class="border-round-md bg-primary w-full lg:w-20rem h-13rem flex flex-column justify-content-center align-items-center px-3"
        >
          <i class="pi pi-heart pt-2" style="font-size: 3rem"></i>
          <h4 class="font-bold text-center px-2">Đội ngũ cán bộ, giảng viên tận tâm</h4>
        </div>

        <div
          class="border-round-md bg-orange-300 lg:w-20rem h-13rem flex flex-column justify-content-center align-items-center px-3"
        >
          <i class="pi pi-chart-line pt-2" style="font-size: 3rem"></i>
          <h4 class="font-bold text-center py-0 px-2">
            Sinh viên được phát triển toàn diện
          </h4>
        </div>

        <div
          class="border-round-md bg-red-600 lg:w-20rem h-13rem flex flex-column justify-content-center align-items-center text-white px-2"
        >
          <i class="pi pi-phone pt-2" style="font-size: 3rem"></i>
          <h4 class="font-bold text-center py-0 px-2">
            Được tư vấn hướng nghiệp khi đăng ký
          </h4>
        </div>

        <div
          class="border-round-md bg-blue-500 lg:w-20rem h-10rem h-13rem flex flex-column justify-content-center align-items-center text-white px-3"
        >
          <i class="pi pi-upload pt-2" style="font-size: 3rem"></i>
          <h4 class="font-bold text-center py-0 px-2">
            Được giới thiệu việc là khi ra trường
          </h4>
        </div>
      </div>

      <div class="grid mt-6">
        <div class="xl:col-8 col-12">
          <h3
            class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1 mb-0"
          >
            ĐĂNG KÝ TUYỂN SINH
          </h3>
          <p class="text-justify font-bold">
            Bạn vui lòng điền đầy đủ thông tin cá nhân vào bảng đăng ký xét tuyển trực
            tuyến bên cạnh để tư vấn viên của trường liên hệ với bạn giải đáp các thắc mắc
            hoàn toàn miễn phí. Chúng tôi sẽ chủ động liên hệ lại với bạn trong vòng 24h
            kể từ khi nhận được thông tin đăng ký.
          </p>
          <div class="border flex flex-column p-5">
            <RegistrationForm
              :ra_SubmitFormRegister="ra_SubmitFormRegister"
              :majors="majors"
              :levels="levels"
              :genders="genders"
            />
          </div>

          <PostsByCategory :category="admissionNews" />
        </div>

        <div class="xl:col-4 col-12">
          <img
            src="/storage/images/sinhvien.jpg"
            alt="SINH VIEN"
            class="card-img"
            style="width: 100%; height: 100vh; object-fit: cover"
          />
        </div>
      </div>
    </div>
  </App>
</template>
