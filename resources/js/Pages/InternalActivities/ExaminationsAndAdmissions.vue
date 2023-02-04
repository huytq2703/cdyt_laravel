<script setup>
import App from "@/Layouts/App.vue";
import { Head } from "@inertiajs/inertia-vue3";

const topNews = [
    {
        image: "hoat-dong-1.jpg",
        title: "Hội thao chào mừng kỉ niệm 73 năm ngày HS, SV và Hội SV Việt Nam",
        summary:
            "Vào ngày 06/1/2023 vừa qua, được sự cho phép của Ban giáo Hiệu Trường Cao đẳng Y tế Đắk Lắk. Ban chấp hành đoàn trường đã tổ chức ...",
    },
    {
        image: "hoat-dong-2.jpg",
        title: "TRƯỜNG CDYT TỔ CHỨC HỘI THẢO TƯ VẤN GIỚI THIỆU NGÀNH ĐIỀU DƯỠNG TẠI NHẬT BẢN",
        summary:
            "Sáng ngày 6/9/2022 tại Hội trường A Trường Cao đẳng Y tế Đắk Lắk đã tổ chức thành công hội thảo ngành Điều dưỡng tại Nhật Bản ...",
    },
    {
        image: "hoat-dong-3.jpg",
        title: "ĐẠI HỌC KHÔNG PHẢI CON ĐƯỜNG DUY NHẤT",
        summary:
            "🛑🛑['ĐẠI HỌC KHÔNG PHẢI CON ĐƯỜNG DUY NHẤT....', một câu nói tưởng chừng như chỉ dành để an ủi những bạn trượt đại học.] 👉👉 Nh ...",
    },
    {
        image: "hoat-dong-3.jpg",
        title: "ĐẠI HỌC KHÔNG PHẢI CON ĐƯỜNG DUY NHẤT",
        summary:
            "🛑🛑['ĐẠI HỌC KHÔNG PHẢI CON ĐƯỜNG DUY NHẤT....', một câu nói tưởng chừng như chỉ dành để an ủi những bạn trượt đại học.] 👉👉 Nh ...",
    },
    {
        image: "hoat-dong-4.jpg",
        title: "Cuộc thi tìm hiểu văn hóa các nước ASEAN năm 2022",
        summary:
            "Sáng 18/10, Liên hiệp các tổ chức hữu nghị tỉnh phối hợp với Đoàn trường Cao đẳng Y tế Đắk Lắk tổ chức Cuộc thi tìm hiểu văn hóa A ...",
    },
];

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
    {
        image: "hoat-dong-6.jpg",
        title: "CƠ HỘI HỌC TẬP – LÀM VIỆC VÀ ĐỊNH CƯ TẠI ĐỨC, NHẬT BẢN",
        summary:
            "Trường Cao Đẳng Y Tế Đắk Lắk là cơ sở giáo dục nghề nghiệp, đào tạo nguồn nhân lực y tế của tỉnh và khu vực Tây Nguyên, đồng hành cùng các Bệnh viện, đào tạo lý thuyết  gắn liền th ...",
    },
];
</script>

<template>
    <Head title="Hoạt động thi và tuyển sinh" />
    <App>
        <div class="container mx-auto">
            <div class="grid py-4">
                <div class="col-12 xl:col-8">
                    <h3
                        class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
                    >
                        HOẠT ĐỘNG THI VÀ TUYỂN SINH
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
                <div class="col-12 xl:col-4">
                    <h3
                        class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
                    >
                        TIN TỨC NỔI BẬT
                    </h3>
                    <div class="container">
                        <a
                            v-for="topNew in topNews"
                            :key="topNew.title"
                            href="#"
                            class="z-0"
                        >
                            <div class="border-bottom row">
                                <div class="col-4 p-2 col">
                                    <img
                                        alt="Card image cap"
                                        class="card-img-top"
                                        style="height: 100px; object-fit: cover"
                                        :src="`/storage/images/activities/${topNew.image}`"
                                    />
                                </div>
                                <div class="col-8 p-2 col">
                                    <div class="card-body">
                                        <div
                                            class="card-title text-sm font-bold text-justify"
                                        >
                                            {{ topNew.title }}
                                        </div>
                                        <p class="card-text text-justify">
                                            {{ topNew.summary }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </App>
</template>
