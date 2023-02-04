<script setup>
import App from "@/Layouts/App.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Listbox from "primevue/listbox";
import { Link } from "@inertiajs/inertia-vue3";
import MenuSideBar from "./Components/MenuSideBar.vue";
</script>

<template>
    <Head title="Phòng công tác HSSV" />
    <App>
        <div class="container mx-auto">
            <div class="grid py-4">
                <div class="col-12 xl:col-9 pr-3">
                    <h3
                        class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
                    >
                        PHÒNG CÔNG TÁC HỌC SINH - SINH VIÊN
                    </h3>
                    <!-- Here content -->
                    <div>
                        <p style="text-align: justify">
                            <strong>I/</strong
                            ><strong>&nbsp;VỊ TRÍ, CHỨC NĂNG</strong>
                        </p>
                        <p style="text-align: justify">
                            Tham mưu, giúp việc Hiệu trưởng trong công tác quản
                            lý học sinh - sinh viên. cụ thể hóa việc thực hiện
                            công tác chính trị tư tưởng, rèn luyện ý thức chấp
                            hành nội quy, quy chế, thực hiện chế độ chính sách
                            và giải quyết các công việc khác có liên quan tới
                            học sinh - sinh viên. Tham mưu cho Hiệu trưởng thực
                            hiện công tác giáo viên chủ nhiệm theo quy định.
                        </p>
                        <p style="text-align: justify">
                            <strong>II/</strong><strong>&nbsp;NHIỆM VỤ:</strong>
                        </p>
                        <p style="text-align: justify">
                            1. Xây dựng kế hoạch học tập bồi dưỡng cho SVHS về
                            chính trị, pháp luật, ý thức tổ chức kỷ luật, phổ
                            biến nội quy, quy định và kiểm tra, giám sát việc
                            thực hiện của HSSV. Tổ chức tốt nội dung đợt sinh
                            hoạt đầu khóa theo quy định của Bộ Giáo dục đào tạo;
                        </p>
                        <p style="text-align: justify">
                            2. Theo dõi, đánh giá HSSV theo quy chế rèn luyện
                            HSSV của Bộ Giáo dục - Đào tạo và những quy định đối
                            với HSSV trong năm học của Nhà trường.
                        </p>
                        <p style="text-align: justify">
                            3. Nghiên cứu tâm tư nguyện vọng, diễn biến tư tưởng
                            của SVHS các lớp, đề xuất việc giáo dục và quản lý
                            SVHS kịp thời. Tham mưu việc bổ nhiệm, miễn nhiệm
                            ban cán sự lớp. Quyết định kỷ luật sinh viên học
                            sinh vi phạm nội quy, quy chế sau khi thông qua Hội
                            đồng;
                        </p>
                        <p style="text-align: justify">
                            4. Quản lý HSSV ở nội trú, ngoại trú. Đôn đốc việc
                            hoàn thành học phí, phí nội trú và các khoản phí
                            khác đối với HSSV theo quy định. Thực hiện chế độ
                            chính sách đối với HSSV
                        </p>
                        <p style="text-align: justify">
                            5. Phối hợp với Đoàn thanh niên Cộng sản Hồ Chí
                            Minh, các Khoa, Phòng, Bộ môn, Giáo viên chủ nhiệm
                            lớp nhằm tăng cường công tác quản lý SVHS trong học
                            tập, rèn luyện và thực hiện các phong trào trong và
                            ngoài trường
                        </p>
                        <p style="text-align: justify">
                            5. Phối hợp thực hiện công tác tuyển sinh đúng theo
                            quy định của Bộ giáo dục Đào tạo. Tiếp nhận học sinh
                            mới nhập trường;
                        </p>
                        <p style="text-align: justify">
                            6. Tập hợp ý kiến phản ánh của HSSV về các hoạt động
                            giảng dạy, học tập và các lĩnh vực khác. Tổ chức lấy
                            ý kiến phản hồi của HSSV về giảng dạy của giáo viên
                            trong năm học.
                        </p>
                        <p style="text-align: justify">
                            7. Tham gia tổ chức các hoạt động ngoại khoá cho
                            HSSV, phối hợp với các đơn vị có liên quan và gia
                            đình trong việc quản lý và phòng ngừa những diễn
                            biến phức tạp có thể diễn ra trong HSSV.
                        </p>
                        <p style="text-align: justify">
                            8. Thực hiện công tác Y tế trường học đúng theo các
                            văn bản chỉ đạo của Bộ, tuyên truyền phòng chống
                            dịch bệnh chăm sóc sức khỏe ban đầu cho HSSV. Tham
                            mưu công tác khám sức khỏe hàng năm cho học HSSV;
                        </p>
                        <p style="text-align: justify">
                            9. Quản lý hoạt động thư viện theo quy định. Lập kế
                            hoạch và bổ sung sách, tài liệu chuyên ngành cho các
                            bộ môn. Sắp xếp, kiểm kê sách, báo, tài liệu thư
                            viện. Tập huấn cho HSSV cách sử dụng thư viện có
                            hiệu quả.
                        </p>
                        <p style="text-align: justify">
                            10. Phối hợp hỗ trợ, triển khai công tác cố vấn học
                            tập. Thực hiện công tác hướng nghiệp, tư vấn việc
                            làm.
                        </p>
                        <p style="text-align: justify">
                            11. Thu thập ý kiến đóng góp của SVHS cho trường,
                            tham mưu cho ban giám hiệu giải quyết các vấn đề
                            liên quan đến SVHS.
                        </p>
                        <p style="text-align: justify">
                            12. Quản lý, lưu trữ hồ sơ, tài sản thiết bị trong
                            phạm vi phụ trách.
                        </p>
                        <p style="text-align: justify">
                            13. Tuyên truyền thực hiện một số loại hình bảo hiểm
                            trong trường.
                        </p>
                        <p style="text-align: justify">
                            14. Xây dựng quy chế giáo viên chủ nhiệm trình Hiệu
                            trưởng phê duyệt. Tổ chức thực hiện, chuẩn bị nội
                            dung sinh hoạt giáo viên chủ nhiệm định kỳ hàng
                            tháng, mời Ban giám hiệu chủ trì và mời các phòng
                            chức năng tham gia khi cần thiết.
                        </p>
                        <p style="text-align: justify">
                            <strong>III/</strong
                            ><strong>&nbsp;CƠ CẤU TỔ CHỨC:</strong>
                        </p>
                        <p style="text-align: justify">
                            <strong><em>3.3.1. Các bộ phận:</em></strong>
                        </p>
                        <p style="text-align: justify">
                            - Chính trị - Quản lý học sinh
                        </p>
                        <p style="text-align: justify">
                            - Thư viện - Y tế học đường
                        </p>
                        <p style="text-align: justify">
                            <strong><em>3.3.2. Lãnh đạo:</em></strong>
                        </p>
                        <p style="text-align: justify">
                            Trưởng phòng và 1 -2 Phó trưởng phòng
                        </p>
                        <p style="text-align: justify">
                            <strong>IV/</strong
                            ><strong>&nbsp;QUYỀN HẠN CỦA TRƯỞNG PHÒNG:</strong>
                        </p>
                        <p style="text-align: justify">
                            Trưởng phòng Công tác sinh viên Học sinh có trách
                            nhiệm tổ chức, điều hành, thực hiện nhiệm vụ của
                            phòng đạt chất lượng cao nhất và chịu trách nhiệm
                            trước Ban giám hiệu về mọi hoạt động của phòng;
                        </p>
                        <p style="text-align: justify">
                            Bố trí nhân lực, phân công nhiệm vụ cụ thể cho nhân
                            viên trong phòng cho phù hợp với công việc;
                        </p>
                        <p style="text-align: justify">
                            Nhận xét các thành viên trong phòng về nhân lực, khả
                            năng chuyên môn, tinh thần phục vụ để trình Hiệu
                            trưởng xét khen thưởng, đề bạt, hoặc kỉ luật;
                        </p>
                        <p style="text-align: justify">
                            Được ký các văn bản, thủ tục trong công tác học sinh
                            sinh viên theo quy định và theo sự ủy nhiệm của Hiểu
                            trưởng;
                        </p>
                        <p style="text-align: justify">
                            Được tham gia các hội đồng theo quy định của Nhà
                            nước và sự phân công của Hiệu trưởng.
                        </p>
                    </div>
                </div>
                <div class="col-12 xl:col-3">
                    <MenuSideBar />
                </div>
            </div>
        </div>
    </App>
</template>

<style lang="scss">
.side-menu {
    height: calc(100vh - 130px);
}
.bg-category {
    background-color: #2a8b6c;
}
.text-category {
    color: white;
}
</style>
