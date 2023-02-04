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

const notices = [
    {
        title: "THÔNG BÁO TUYỂN SINH: CAO ĐẲNG CHÍNH QUY KHOÁ HỌC 2022 - 2025",
        content:
            '<p> 🌟 🌟 🌟 🌟Thầy, Cô, và các em sinh viên trường Cao Đẳng Y Tế cùng tiếp sức mùa thi năm 2022! Chúc các em 2k4 tự tin thi thật tốt và đạt được kết quả như ý nhé!!!🔥 🔥 🔥 🔥 🔥 </p> <p>---------------------------</p> <p> THÔNG TIN TUYỂN SINH: CAO ĐẲNG CHÍNH QUY👉 KHÓA HỌC 2022- 2025 ☀️ ☀️  </p> <p>👉 Cao đẳng ĐIỀU DƯỠNG, Cao đẳng DƯỢC, Cao đẳng HỘ SINH</p> <p>👉 Nhận hồ sơ từ ngày 1/7/2022</p> <p>-----------------------------------</p> <p><img src="https://cdn.cosmicjs.com/f4916ff0-7d93-11ed-bac9-7fe1734a16aa-2917932433635497958595173530987057987503408n.jpg" style="width: 100%;" class="fr-fic fr-dib" /></p> <p> 🍀 1. Học bổng khuyến khích học tập bằng mức trần đóng học phí: Đối với sinh viên có học lực từ loại khá trở lên! </p> <p> 🍀2. Miễn giảm học phí: từ 50%, 70%, 100% đối với sinh viên người dân tộc thiểu số có điều kiện kinh tế khó khăn. Sinh viên thuộc con thương binh, gia đình chính sách, mồ côi cha mẹ, hoặc con cán bộ viên chức bị tai nạn lao động.... </p> <p> 🍀3. Sinh viên là người dân tộc thiểu số thuộc hộ nghèo, hộ cận nghèo: hỗ trợ chi phí học tập bằng 60% mức lương tối thiểu chung và được hưởng không quá 10 tháng/năm học/sinh viên. </p> <p> 🍀4. Sinh viên được học tiếng Nhật miễn phí tại trường. Chương trình kết hợp thực tập và làm việc tại Nhật Bản. </p> <p>🍀5. Nhận ký túc xá ngay ngày nhập học, hỗ trợ chỗ ở cho sinh viên có hoản cảnh khó khăn.</p> <p>----------------------------</p> <p>  ➡️  Hotline liên hệ TUYỂN SINH : 0987.03.7677 hoặc Inbox Fanpage để được Tư vấn chi tiết </p> <p> ➡️  Địa chỉ: 32 Y Ngông, Phường Tân Tiến, Tp Buôn Ma thuột, Đắk Lắk</p> <p><br /></p> <p><img src="https://cdn.cosmicjs.com/de1b29a0-7d93-11ed-bac9-7fe1734a16aa-2903896983635497658595204008505228242677968n.jpg" style="width: 100%;" class="fr-fic fr-dib" /></p> <p><img src="https://cdn.cosmicjs.com/e70d5ab0-7d93-11ed-bac9-7fe1734a16aa-2918103753635497891928512599680382624505903n.jpg" style="width: 100%;" class="fr-fic fr-dib" /></p>',
    },
    {
        title: "TRƯỜNG CAO ĐẲNG Y TẾ ĐẮK LẮK TIẾP TỤC XÉT TUYỂN BỔ SUNG ĐỢT 2",
        content:
            '<p style="text-align: center;">TRƯỜNG CAO ĐẲNG  Y TẾ ĐẮK LẮK TIẾP TỤC XÉT TUYỂN BỔ SUNG ĐỢT 2</p><p style="text-align: center;">👉Đối với 2 ngành DƯỢC VÀ ĐIỀU DƯỠNG, từ ngày 01/10 - 31/10/2022 </p><p style="text-align: center;">--------------------------------------</p><p style="text-align: center;"><img src="https://cdn.cosmicjs.com/04be0cc0-7d90-11ed-bac9-7fe1734a16aa-3105152754512843837723418351508070469380146n.jpg" style="width: 100%;" class="fr-fic fr-dib"></p><p>🍀🍀QUYỀN LỢI HỌC VIÊN:</p></p>',
    },
    {
        title: "ĐỀ CƯƠNG ÔN TẬP TUYỂN DỤNG VIÊN CHỨC TRƯỜNG CĐYT ĐẮK LẮK",
        content: "Đang cập nhật",
    },
    {
        title: "THÔNG BÁO TUYỂN DỤNG VIÊN CHỨC TRƯỜNG CAO ĐẲNG TẾ ĐẮK LẮK",
        content: "Thông báo tuyển dụng viên chức Trường Cao đẳng tế Đắk Lắk",
    },
    {
        title: "THÔNG BÁO V/V ĐIỀU CHỈNH PHỤ LỤC KẾ HOẠCH TUYỂN DỤNG VÀ GIA HẠN NỘP HỒ SƠ DỰ TUYỂN CHO VỊ TRÍ TUYỂN DỤNG ĐƯỢC ĐIỀU CHỈNH",
        content:
            "Thông báo V/v điều chỉnh phụ lục kế hoạch tuyển dụng và gia hạn nộp hồ sơ dự tuyển cho vị trí tuyển dụng được điều chỉnh",
    },
    {
        title: "ĐỀ CƯƠNG ÔN TẬP TUYỂN DỤNG VIÊN CHỨC TRƯỜNG CĐYT ĐẮK LẮK (6/2021)",
        content:
            "Đề cương ôn tập tuyển dụng viên chức Trường CĐYT Đắk Lắk (6/2021)",
    },
    {
        title: "THÔNG BÁO VỀ VIỆC ĐIỀU CHỈNH THỜI GIAN TỔ CHỨC XÉT TUYỂN VIÊN CHỨC TRƯỜNG CĐYT ĐẮK LẮK 2020",
        content: "Nội dung đang cập nhật",
    },
    {
        title: "DANH SÁCH ĐỦ ĐIỀU KIỆN XÉT TUYỂN VIÊN CHỨC CĐYT ĐẮK LẮK (VÒNG 2)",
        content: "299/CĐYT-TB",
    },
    {
        title: "TB NIÊM YẾT ĐIỂM SÁT HẠCH TUYỂN DỤNG TRƯỜNG CĐYT 7-2021",
        content: "Nội dung đang cập nhật",
    },
];
</script>

<template>
    <Head title="Thông báo tuyển sinh" />
    <App>
        <div class="container mx-auto">
            <div class="grid py-4">
                <div class="col-12 xl:col-8">
                    <div v-for="notice in notices" :key="notice.title">
                        <h3
                            class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
                        >
                            {{ notice.title }}
                        </h3>
                        <div v-html="notice.content"></div>
                        <hr />
                    </div>
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
