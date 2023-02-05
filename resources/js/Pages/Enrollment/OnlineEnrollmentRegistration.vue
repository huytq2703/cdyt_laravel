<script setup>
import App from "@/Layouts/App.vue";
import EnrollmentNewsComponent from "@/Components/Posts/EnrollmentNewsComponent.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import Button from "primevue/button";
import Dropdown from "primevue/dropdown";
import InputText from "primevue/inputtext";
import Textarea from "primevue/textarea";
import Calendar from "primevue/calendar";
import { onMounted, ref } from "vue";
import { AxiosInstance } from "@/libs/axios";

const selectedProvince = ref("");
const selectedDistrict = ref("");
const selectedWard = ref("");
const provinces = ref([]);
const districts = ref([]);
const wards = ref([]);

const getProvinces = () => {
    AxiosInstance({
        url: "http://cdyt_laravel.develop/api/v1/locations/provinces",
        method: "get",
    })
        .then((response) => response)
        .then(({ data: res }) => {
            if (res.success) {
                provinces.value = res.data.provinces;
            }
        })
        .catch()
        .finally();
};

const getDistricts = () => {
    AxiosInstance({
        url: `http://cdyt_laravel.develop/api/v1/locations/districts/${selectedProvince.value.id}`,
        method: "get",
    })
        .then((response) => response)
        .then(({ data: res }) => {
            if (res.success) {
                districts.value = res.data.districts;
            }
        })
        .catch()
        .finally();
};

const getWards = () => {
    AxiosInstance({
        url: `http://cdyt_laravel.develop/api/v1/locations/wards/${selectedDistrict.value.id}`,
        method: "get",
    })
        .then((response) => response)
        .then(({ data: res }) => {
            if (res.success) {
                wards.value = res.data.wards;
            }
        })
        .catch()
        .finally();
};

onMounted(() => {
    getProvinces();
});

const props = defineProps({
    errors: Object,
});

const contactForm = useForm({
    fullName: "",
    phoneNumber: "",
    email: "",
    department: "",
    content: "",
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
                <p class="mt-4">
                    “Hãy đăng ký liên hệ nhà trường để được hỗ trợ, hướng dẫn.
                </p>
            </div>

            <h3
                class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1 mb-0"
            >
                BẠN NÊN CHỌN HỌC TẠI TRƯỜNG VÌ
            </h3>
            <div
                class="flex lg:flex-row flex-column justify-content-between gap-3 w-full mt-2"
            >
                <div
                    class="border-round-md bg-primary w-full lg:w-20rem h-11rem flex flex-column justify-content-center align-items-center"
                >
                    <i class="pi pi-heart pt-2" style="font-size: 3rem"></i>
                    <h4 class="font-bold text-center px-2">
                        Đội ngũ cán bộ, giảng viên tận tâm
                    </h4>
                </div>

                <div
                    class="border-round-md bg-orange-300 lg:w-20rem h-11rem flex flex-column justify-content-center align-items-center"
                >
                    <i
                        class="pi pi-chart-line pt-2"
                        style="font-size: 3rem"
                    ></i>
                    <h4 class="font-bold text-center py-0 px-2">
                        Sinh viên được phát triển toàn diện
                    </h4>
                </div>

                <div
                    class="border-round-md bg-red-600 lg:w-20rem h-11rem flex flex-column justify-content-center align-items-center text-white"
                >
                    <i class="pi pi-phone pt-2" style="font-size: 3rem"></i>
                    <h4 class="font-bold text-center py-0 px-2">
                        Được tư vấn hướng nghiệp khi đăng ký
                    </h4>
                </div>

                <div
                    class="border-round-md bg-blue-500 lg:w-20rem h-10rem h-11rem flex flex-column justify-content-center align-items-center text-white"
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
                        Bạn vui lòng điền đầy đủ thông tin cá nhân vào bảng đăng
                        ký xét tuyển trực tuyến bên cạnh để tư vấn viên của
                        trường liên hệ với bạn giải đáp các thắc mắc hoàn toàn
                        miễn phí. Chúng tôi sẽ chủ động liên hệ lại với bạn
                        trong vòng 24h kể từ khi nhận được thông tin đăng ký.
                    </p>
                    <div class="border flex flex-column p-5">
                        <!-- Row -->
                        <div
                            class="flex flex-column md:flex-row w-full gap-0 md:gap-5"
                        >
                            <div class="field flex-1 flex flex-column">
                                <label for="fullName" class="font-bold"
                                    >Họ và tên</label
                                >
                                <InputText
                                    v-model="contactForm.fullName"
                                    id="fullName"
                                    aria-describedby="fullName-help"
                                    :class="[errors.fullName && 'p-invalid']"
                                    placeholder="Nhập họ và tên *"
                                />
                                <small
                                    v-if="errors?.fullName"
                                    id="fullName-help"
                                    class="p-error"
                                    >{{ errors.fullName }}</small
                                >
                            </div>

                            <div
                                class="field md:w-15rem w-full flex flex-column"
                            >
                                <label for="birthDay" class="font-bold"
                                    >Ngày sinh</label
                                >
                                <Calendar
                                    inputId="dateformat"
                                    v-model="date2"
                                    dateFormat="mm-dd-yy"
                                />
                                <small
                                    v-if="errors.phoneNumber"
                                    id="phoneNumber-help"
                                    class="p-error"
                                    >{{ errors.phoneNumber }}</small
                                >
                            </div>

                            <div
                                class="field flex flex-column md:w-10rem w-full"
                            >
                                <label for="gender" class="font-bold"
                                    >Giới tính</label
                                >
                                <Dropdown
                                    id="gender"
                                    v-model="contactForm.department"
                                    :options="[
                                        { name: 'Nam', code: 1 },
                                        { name: 'Nữ', code: 0 },
                                    ]"
                                    optionLabel="name"
                                    optionValue="code"
                                    placeholder="Giới tính"
                                    aria-describedby="gender-help"
                                    :class="[errors.department && 'p-invalid']"
                                />
                                <small
                                    v-if="errors.phoneNumber"
                                    id="gender-help"
                                    class="p-error"
                                    >{{ errors.phoneNumber }}</small
                                >
                            </div>
                        </div>

                        <div
                            class="flex md:flex-row flex-column flex-1 justify-content-between md:gap-3"
                        >
                            <div class="field flex-1 flex flex-column">
                                <label for="religion" class="font-bold"
                                    >Tôn giáo</label
                                >
                                <InputText
                                    v-model="contactForm.email"
                                    id="religion"
                                    aria-describedby="religion-help"
                                    :class="[errors.email && 'p-invalid']"
                                    placeholder="Tôn giáo"
                                />
                                <small
                                    v-if="errors.email"
                                    id="religion-help"
                                    class="p-error"
                                    >{{ errors.email }}</small
                                >
                            </div>

                            <div class="field flex-1 flex flex-column">
                                <label for="nation" class="font-bold"
                                    >Dân tộc</label
                                >
                                <InputText
                                    v-model="contactForm.email"
                                    id="nation"
                                    aria-describedby="nation-help"
                                    :class="[errors.email && 'p-invalid']"
                                    placeholder="Dân tộc *"
                                />
                                <small
                                    v-if="errors.email"
                                    id="nation-help"
                                    class="p-error"
                                    >{{ errors.email }}</small
                                >
                            </div>

                            <div class="field flex-1 flex flex-column">
                                <label for="level" class="font-bold"
                                    >Trình độ</label
                                >

                                <Dropdown
                                    id="level"
                                    v-model="contactForm.department"
                                    :options="[
                                        { name: 'THPT', code: 1 },
                                        { name: 'THCS', code: 0 },
                                    ]"
                                    optionLabel="name"
                                    optionValue="code"
                                    placeholder=""
                                    aria-describedby="level-help"
                                    :class="[errors.department && 'p-invalid']"
                                >
                                </Dropdown>
                                <small
                                    v-if="errors.email"
                                    id="level-help"
                                    class="p-error"
                                    >{{ errors.email }}</small
                                >
                            </div>

                            <div class="field flex-1 flex flex-column">
                                <label for="priority" class="font-bold"
                                    >Đối tượng ưu tiên</label
                                >
                                <InputText
                                    v-model="contactForm.email"
                                    id="priority"
                                    aria-describedby="priority-help"
                                    :class="[errors.email && 'p-invalid']"
                                    placeholder="Đối tượng ưu tiên"
                                />
                                <small
                                    v-if="errors.email"
                                    id="priority-help"
                                    class="p-error"
                                    >{{ errors.email }}</small
                                >
                            </div>
                        </div>

                        <!-- Row -->
                        <div class="field flex-1 flex flex-column">
                            <label for="Majors" class="font-bold"
                                >Ngành học</label
                            >

                            <Dropdown
                                id="Majors"
                                v-model="contactForm.Majors"
                                :options="[]"
                                optionLabel="Majors"
                                placeholder="Chọn ngành học"
                                aria-describedby="Majors-help"
                                :class="[errors.Majors && 'p-invalid']"
                                :filter="true"
                                filterPlaceholder=""
                            />
                            <small
                                v-if="errors.Majors"
                                id="Majors-help"
                                class="p-error"
                                >{{ errors.Majors }}</small
                            >
                        </div>

                        <div class="flex md:flex-row flex-column md:gap-3">
                            <div class="field flex-1 flex flex-column">
                                <label for="email" class="font-bold"
                                    >Email</label
                                >
                                <InputText
                                    v-model="contactForm.email"
                                    id="email"
                                    aria-describedby="email-help"
                                    :class="[errors.email && 'p-invalid']"
                                    placeholder="Email *"
                                />
                                <small
                                    v-if="errors?.email"
                                    id="email-help"
                                    class="p-error"
                                    >{{ errors.email }}</small
                                >
                            </div>

                            <div class="field flex-1 flex flex-column">
                                <label for="phoneNumber" class="font-bold"
                                    >Số điện thoại</label
                                >
                                <InputText
                                    v-model="contactForm.phoneNumber"
                                    id="phoneNumber"
                                    aria-describedby="phoneNumber-help"
                                    :class="[errors.phoneNumber && 'p-invalid']"
                                    placeholder="Số điện thoại không để trống và nhập 10 chữ số"
                                />
                                <small
                                    v-if="errors?.phoneNumber"
                                    id="phoneNumber-help"
                                    class="p-error"
                                    >{{ errors.phoneNumber }}</small
                                >
                            </div>
                        </div>

                        <!-- Row -->
                        <div class="field flex-1 flex flex-column">
                            <label for="address" class="font-bold"
                                >Địa chỉ liên hệ</label
                            >
                            <InputText
                                v-model="contactForm.phoneNumber"
                                id="address"
                                aria-describedby="address-help"
                                :class="[errors.address && 'p-invalid']"
                                placeholder="Nhập số nhà ..."
                            />
                            <small
                                v-if="errors.address"
                                id="address-help"
                                class="p-error"
                                >{{ errors.address }}</small
                            >
                        </div>

                        <div
                            class="flex justify-content-between md:gap-3 md:flex-row flex-column"
                        >
                            <div class="field flex-1 flex flex-column">
                                <Dropdown
                                    @change="getDistricts"
                                    id="province"
                                    v-model="selectedProvince"
                                    :options="provinces"
                                    optionLabel="name"
                                    placeholder="Tỉnh"
                                    aria-describedby="province-help"
                                    :class="[errors.province && 'p-invalid']"
                                    :filter="true"
                                    filterPlaceholder=""
                                />
                                <small
                                    v-if="errors.province"
                                    id="province-help"
                                    class="p-error"
                                    >{{ errors.province }}</small
                                >
                            </div>
                            <div class="field flex-1 flex flex-column">
                                <Dropdown
                                    @change="getWards"
                                    id="district"
                                    v-model="selectedDistrict"
                                    :options="districts"
                                    optionLabel="name"
                                    placeholder="TP, Quận, Huyện"
                                    aria-describedby="district-help"
                                    :class="[errors.district && 'p-invalid']"
                                    :filter="true"
                                    filterPlaceholder=""
                                />
                                <small
                                    v-if="errors.district"
                                    id="district-help"
                                    class="p-error"
                                    >{{ errors.district }}</small
                                >
                            </div>

                            <div class="field flex-1 flex flex-column">
                                <Dropdown
                                    :change="getDistricts"
                                    id="ward"
                                    v-model="selectedWard"
                                    :options="wards"
                                    optionLabel="name"
                                    placeholder="Xã, Phường"
                                    aria-describedby="ward-help"
                                    :class="[errors.ward && 'p-invalid']"
                                    :filter="true"
                                    filterPlaceholder=""
                                />
                                <small
                                    v-if="errors.ward"
                                    id="ward-help"
                                    class="p-error"
                                    >{{ errors.ward }}</small
                                >
                            </div>
                        </div>

                        <!-- Row -->
                        <div class="field flex-1 flex flex-column">
                            <Button
                                class="flex text-center justify-content-center bg-default font-bold"
                                @click="onClickSendInfo"
                                >Đăng ký ngay</Button
                            >
                        </div>
                    </div>

                    <EnrollmentNewsComponent />
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
