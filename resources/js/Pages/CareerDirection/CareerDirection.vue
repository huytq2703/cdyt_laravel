<script setup>
import App from "@/Layouts/App.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { onMounted, ref, watch } from "vue";
import InputText from "primevue/inputtext";
import Dropdown from "primevue/dropdown";
import { getProvinces, getDistrict, getWards } from "./service";
import RegistrationForm from "./components/RegistrationForm.vue";

const provinces = ref([]);
const districts = ref([]);
const wards = ref([]);

const infoForm = useForm({
  fullName: "",
  province_id: "",
  district_id: "",
  ward_id: "",
});

watch(
  () => infoForm.province_id,
  async (province_id) => {
    districts.value = null;
    infoForm.district_id = "";
    if (province_id) districts.value = [...(await getDistrict(province_id))];
  }
);

watch(
  () => infoForm.district_id,
  async (district_id) => {
    wards.value = null;
    infoForm.ward_id = "";
    if (district_id) wards.value = [...(await getWards(district_id))];
  }
);

onMounted(async () => {
  provinces.value = await getProvinces();

});

const blogs = [
  {
    image: "hoat-dong-2.jpg",
    title: "TRƯỜNG CDYT TỔ CHỨC HỘI THẢO TƯ VẤN GIỚI THIỆU NGÀNH ĐIỀU DƯỠNG TẠI NHẬT BẢN",
    summary:
      "Sáng ngày 6/9/2022 tại Hội trường A Trường Cao đẳng Y tế Đắk Lắk đã tổ chức thành công hội thảo ngành Điều dưỡng tại Nhật Bản ...",
  },
  {
    image: "hoat-dong-4.jpg",
    title: "Cuộc thi tìm hiểu văn hóa các nước ASEAN năm 2022",
    summary:
      "Sáng 18/10, Liên hiệp các tổ chức hữu nghị tỉnh phối hợp với Đoàn trường Cao đẳng Y tế Đắk Lắk tổ chức Cuộc thi tìm hiểu văn hóa A ...",
  },
  {
    image: "hoat-dong-5.jpg",
    title: "CHÚC MỪNG NGÀY ĐIỀU DƯỠNG VIỆT NAM 26/10",
    summary:
      "Nhân ngày Điều dưỡng Việt Nam 26/10, Trường Cao đẳng Y tế Đắk Lắk xin gửi đến tất cả Điều dưỡng viên ngàn lời tri ân, những lời chúc tốt đẹp nhất đến những ai đã đang và sẽ chọn co ...",
  },
];
</script>

<template>
  <Head title="Tư vấn hướng nghiệp" />
  <App>
    <div class="container mx-auto">
      <div class="col-12">
        <h3
          class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
        >
          TRANG TƯ VẤN HƯỚNG NGHIỆP
        </h3>
        <div
          class="flex flex-column justify-content-center text-center text-3xl text-red font-bold py-5"
        >
          <i class="pi pi-book" style="font-size: 12rem"></i>
          <p class="mt-4">
            “Nhà trường luôn sẵn sàng đồng hành cùng bạn để giải quyết các băn khoăn, trăn
            trở liên quan đến định hướng và phát triển nghề nghiệp.”
          </p>
        </div>
      </div>

      <div class="col-12">
        <h3
          class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
        >
          BẠN NHẬN ĐƯỢC GÌ KHI ĐĂNG KÝ HƯỚNG NGHIỆP?
        </h3>
        <div class="row">
          <div class="col-lg-4 col-sm-4">
            <div class="m-2 card text-white bg-danger">
              <div class="card-body hover-text">
                <h1 class="card-title text-center">
                  <i class="pi pi-phone text-5xl"></i>
                </h1>
                <h5 class="card-text text-center font-bold">
                  Được tư vấn viên của nhà trường hướng dẫn lựa chọn đúng ngành nghề phù
                  hợp
                </h5>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-4">
            <div class="m-2 card text-white bg-warning">
              <div class="card-body hover-text">
                <h1 class="card-title text-center">
                  <i class="pi pi-arrow-up-right text-5xl"></i>
                </h1>
                <h5 class="card-text text-center font-bold">
                  Biết được những ngành nghề đang phát triển và có cơ hội việc làm cao
                </h5>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-4">
            <div class="m-2 card text-white bg-info">
              <div class="card-body hover-text">
                <h1 class="card-title text-center">
                  <i class="pi pi-upload text-5xl"></i>
                </h1>
                <h5 class="card-text text-center font-bold">
                  Hạn chế những sai sót trong quá trình đăng ký tuyển sinh online
                </h5>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br />
      <div class="col-12 text-white" style="background-color: rgb(114, 14, 16)">
        <form class="">
          <div class="row p-3 mt-5 mb-2">
            <div class="d-flex flex-column justify-content-center col-md-6">
              <h3
                class="border-top bg-title bg-title-right text-2xl font-bold text-white py-2 border-bottom-1"
              >
                ĐĂNG KÝ HƯỚNG NGHIỆP
              </h3>
              <br />
              <h4>
                Nhập thông tin để tư vấn viên của trường liên hệ giải đáp các thắc mắc
                hoàn toàn miễn phí. Chúng tôi sẽ chủ động liên hệ lại với bạn trong vòng
                24h kể từ khi nhận được thông tin đăng ký.
              </h4>
            </div>
            <div class="border p-3 rounded-3 col-md-6">
              <RegistrationForm />
            </div>
          </div>
          <br />
        </form>
      </div>
      <br />
      <div class="col-12">
        <h3
          class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
        >
          TIN TỨC HƯỚNG NGHIỆP
        </h3>
        <a href="#" v-for="blog in blogs" :key="blog.title">
          <div class="col-12 pt-3 row">
            <div class="col-4 col">
              <img
                alt="Card image cap"
                class="card-img"
                style="height: 130px; object-fit: cover"
                :src="`/storage/images/activities/${blog.image}`"
              />
            </div>
            <div class="col-8 col">
              <div class="card-body">
                <h5 class="pb-1 card-title font-bold">
                  {{ blog.title }}
                </h5>
                <p class="card-text text-lg" style="text-align: justify">
                  {{ blog.summary }}
                </p>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </App>
</template>

<style lang="scss" scoped>
.hover-text {
  color: white;
  &:hover {
    color: #b83234;
  }
}
</style>
