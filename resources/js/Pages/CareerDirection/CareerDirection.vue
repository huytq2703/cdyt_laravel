<script setup>
import App from "@/Layouts/App.vue";
import { Head } from "@inertiajs/inertia-vue3";
import axios from "axios";
import { onMounted, ref } from "vue";

const selectedProvince = ref("");
const selectedDistrict = ref("");
const selectedWard = ref("");
const provinces = ref([]);
const districts = ref([]);
const wards = ref([]);

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

const getProvinces = () => {
    axios
        .get("https://vn-public-apis.fpo.vn/provinces/getAll?limit=-1")
        .then((response) => {
            provinces.value = response.data.data.data;
        })
        .catch((error) => {
            console.error(error);
        });
};

const getDistricts = () => {
    axios
        .get(
            `https://vn-public-apis.fpo.vn/districts/getByProvince?provinceCode=${selectedProvince.value.code}&limit=-1`
        )
        .then((response) => {
            districts.value = response.data.data.data;
        })
        .catch((error) => {
            console.error(error);
        });
};

const getWards = () => {
    axios
        .get(
            `https://vn-public-apis.fpo.vn/wards/getByDistrict?districtCode=${selectedDistrict.value.code}&limit=-1`
        )
        .then((response) => {
            wards.value = response.data.data.data;
        })
        .catch((error) => {
            console.error(error);
        });
};

onMounted(() => {
    getProvinces();
});
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
                        “Nhà trường luôn sẵn sàng đồng hành cùng bạn để giải
                        quyết các băn khoăn, trăn trở liên quan đến định hướng
                        và phát triển nghề nghiệp.”
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
                                    Được tư vấn viên của nhà trường hướng dẫn
                                    lựa chọn đúng ngành nghề phù hợp
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <div class="m-2 card text-white bg-warning">
                            <div class="card-body hover-text">
                                <h1 class="card-title text-center">
                                    <i
                                        class="pi pi-arrow-up-right text-5xl"
                                    ></i>
                                </h1>
                                <h5 class="card-text text-center font-bold">
                                    Biết được những ngành nghề đang phát triển
                                    và có cơ hội việc làm cao
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
                                    Hạn chế những sai sót trong quá trình đăng
                                    ký tuyển sinh online
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <div
                class="col-12 text-white"
                style="background-color: rgb(114, 14, 16)"
            >
                <form class="">
                    <div class="row p-3 mt-5 mb-2">
                        <div
                            class="d-flex flex-column justify-content-center col-md-6"
                        >
                            <h3
                                class="border-top bg-title bg-title-right text-2xl font-bold text-white py-2 border-bottom-1"
                            >
                                ĐĂNG KÝ HƯỚNG NGHIỆP
                            </h3>
                            <br />
                            <h4>
                                Nhập thông tin để tư vấn viên của trường liên hệ
                                giải đáp các thắc mắc hoàn toàn miễn phí. Chúng
                                tôi sẽ chủ động liên hệ lại với bạn trong vòng
                                24h kể từ khi nhận được thông tin đăng ký.
                            </h4>
                        </div>
                        <div class="border p-3 rounded-3 col-md-6">
                            <div class="mb-3">
                                <div class="field">
                                    <label for="ho_va_ten">Họ và tên</label>
                                    <input
                                        id="ho_va_ten"
                                        type="text"
                                        class="text-base text-color surface-overlay p-2 border-1 border-solid surface-border border-round appearance-none outline-none focus:border-primary w-full"
                                        placeholder="Họ và tên"
                                    />
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="field">
                                    <label for="so_dien_thoai"
                                        >Số điện thoại</label
                                    >
                                    <input
                                        id="so_dien_thoai"
                                        type="tel"
                                        class="text-base text-color surface-overlay p-2 border-1 border-solid surface-border border-round appearance-none outline-none focus:border-primary w-full"
                                        placeholder="Số điện thoại"
                                    />
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="field">
                                    <label for="so_dien_thoai"
                                        >Địa chỉ thường trú</label
                                    >
                                    <input
                                        id="dia_chi"
                                        type="text"
                                        class="text-base text-color surface-overlay p-2 border-1 border-solid surface-border border-round appearance-none outline-none focus:border-primary w-full"
                                        placeholder="Nhập số nhà"
                                    />
                                </div>
                                <div class="field">
                                    <select
                                        id="tinh"
                                        class="w-full text-base text-color surface-overlay p-2 border-1 border-solid surface-border border-round outline-none focus:border-primary"
                                        v-model="selectedProvince"
                                        @change="getDistricts"
                                    >
                                        <option value="">Chọn Tỉnh</option>
                                        <option
                                            v-for="province in provinces"
                                            :key="province._id"
                                            :value="province"
                                        >
                                            {{ province.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="field">
                                    <select
                                        id="thanh_pho"
                                        class="w-full text-base text-color surface-overlay p-2 border-1 border-solid surface-border border-round outline-none focus:border-primary"
                                        v-model="selectedDistrict"
                                        @change="getWards"
                                    >
                                        <option value="">
                                            Chọn TP, Quận, Huyện
                                        </option>
                                        <option
                                            v-for="district in districts"
                                            :key="district.id"
                                            :value="district"
                                        >
                                            {{ district.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="field">
                                    <select
                                        id="xa"
                                        class="w-full text-base text-color surface-overlay p-2 border-1 border-solid surface-border border-round outline-none focus:border-primary"
                                        v-model="selectedWard"
                                    >
                                        <option value="">Chọn Xã Phường</option>
                                        <option
                                            v-for="ward in wards"
                                            :key="ward.id"
                                            :value="ward"
                                        >
                                            {{ ward.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="formgrid grid">
                                    <div class="field col-4">
                                        <label for="thoi_gian_tu_van"
                                            >Thời gian tư vấn</label
                                        >
                                        <input
                                            id="thoi_gian"
                                            value="2023-02-04"
                                            type="text"
                                            class="text-base text-color surface-overlay p-2 border-1 border-solid surface-border border-round appearance-none outline-none focus:border-primary w-full"
                                        />
                                    </div>
                                    <div class="field col-8">
                                        <label for="thoi_gian_tu_van"
                                            >Chọn khung giờ tư vấn</label
                                        >
                                        <select
                                            id="thanh_pho"
                                            class="w-full text-base text-color surface-overlay p-2 border-1 border-solid surface-border border-round outline-none focus:border-primary"
                                        >
                                            <option value="">
                                                Chọn khung giờ tư vấn
                                            </option>
                                            <option value="08:00 AM - 09:00 AM">
                                                08:00 AM - 09:00 AM
                                            </option>
                                            <option value="09:00 AM - 10:00 AM">
                                                09:00 AM - 10:00 AM
                                            </option>
                                            <option value="10:00 AM - 11:00 AM">
                                                10:00 AM - 11:00 AM
                                            </option>
                                            <option value="11:00 AM - 12:00 AM">
                                                11:00 AM - 12:00 AM
                                            </option>
                                            <option value="01:00 PM - 02:00 PM">
                                                01:00 PM - 02:00 PM
                                            </option>
                                            <option value="02:00 PM - 03:00 PM">
                                                02:00 PM - 03:00 PM
                                            </option>
                                            <option value="03:00 PM - 04:00 PM">
                                                03:00 PM - 04:00 PM
                                            </option>
                                            <option value="04:00 PM - 05:00 PM">
                                                04:00 PM - 05:00 PM
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <button
                                class="btn btn-info d-block w-100 text-xl text-black"
                            >
                                ĐĂNG KÝ HƯỚNG NGHIỆP
                            </button>
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
                                <p
                                    class="card-text text-lg"
                                    style="text-align: justify"
                                >
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
