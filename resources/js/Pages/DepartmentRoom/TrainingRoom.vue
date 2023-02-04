<script setup>
import App from "@/Layouts/App.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Listbox from "primevue/listbox";
import { Link } from "@inertiajs/inertia-vue3";
import MenuSideBar from "./Components/MenuSideBar.vue";
</script>

<template>
    <Head title="Phòng đào tạo" />
    <App>
        <div class="container mx-auto">
            <div class="grid py-4">
                <div class="col-12 xl:col-9 pr-3">
                    <h3
                        class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
                    >
                        PHÒNG ĐÀO TẠO - NGHIÊN CỨU KHOA HỌC VÀ HỢP TÁC QUỐC TẾ
                    </h3>
                    <!-- Here content -->
                    <div>
                        <p style="text-align: justify">
                            <strong>I/ VỊ TRÍ, CHỨC NĂNG:</strong>
                        </p>
                        <p style="text-align: justify">
                            Phòng Đào tạo có chức năng tham mưu giúp Hiệu trưởng
                            xây dựng kế hoạch, quản lý, tổ chức, triển khai thực
                            hiện công tác đào tạo của trường, bao gồm: Kế hoạch,
                            chương trình, tài liệu học, phương tiện giảng dạy và
                            học tập, tổ chức giảng dạy và chất lượng giảng dạy
                            theo quy chế của Bộ Giáo dục &amp; Đào tạo cũng như
                            quy định của nhà trường đã ban hành. Tổ chức chỉ
                            đạo, thực hiện theo dõi, giám sát công tác giảng dạy
                            và học tập của các hệ đào tạo trong trường theo quy
                            định.
                        </p>
                        <p style="text-align: justify">
                            <strong>II/ NHIỆM VỤ:</strong>
                        </p>
                        <p style="text-align: justify">
                            1. Tham mưu, giúp Hiệu trưởng trong việc nghiên cứu
                            đề xuất phương hướng phát triển của nhà trường về
                            xác định mục tiêu đào tạo, quy mô đào tạo, cơ cấu
                            ngành nghề, mở các ngành hoặc chuyên ngành mới;
                            nghiên cứu đề xuất các biện pháp nhằm cải tiến và
                            hoàn thiện nội dung, chương trình, quy trình, giáo
                            trình, phương pháp đào tạo và quản lý chất lượng đào
                            tạo. Xây dựng kế hoạch chương trình đào tạo theo
                            năm, khoá học cho các đối tượng đào tạo và theo dõi
                            thực hiện chương trình đào tạo. Hàng năm rà soát,
                            điều chỉnh chương trình giáo dục phù hợp với thực tế
                        </p>
                        <p style="text-align: justify">
                            2. Tham mưu cho Hiệu trưởng quyết định Hội đồng
                            tuyển sinh hàng năm, Phối hợp với các bộ phận thực
                            hiện tốt nhiệm vụ tổ chức tuyển sinh.
                        </p>
                        <p style="text-align: justify">
                            3. Tổ chức thực hiện các quy chế chuyên môn, quy
                            trình đào tạo, quản lý, theo dõi và tổ chức thực
                            hiện công tác kiểm tra và thi cho học sinh các lớp
                            (học trình, học phần môn học, thi tốt nghiệp);
                        </p>
                        <p style="text-align: justify">
                            4. Thực hiện theo dõi, giám sát, kiểm tra trên tất
                            cả các mặt hoạt động đào tạo của các khoa, tổ bộ
                            môn, tổ chuyên môn, cán bộ giảng dạy (dạy và học lý
                            thuyết, thực hành, lâm sàng)
                        </p>
                        <p style="text-align: justify">
                            5. Thực hiện các biểu mẫu, sổ sách quản lý đào tạo
                            theo quy định của Bộ, ngành và của nhà trường. Tổ
                            chức, quản lý việc biên soạn, in ấn giáo trình, quản
                            lý công tác giáo vụ (quản lý bài thi, điểm, biểu mẫu
                            đào tạo, giờ giảng lý thuyết, thực hành, lâm sàng).
                        </p>
                        <p style="text-align: justify">
                            6. Thực hiện 3 công khai, thực hiện chuẩn đầu ra các
                            ngành đào tạo của trường. Tổ chức khai giảng, bế
                            giảng, phát bằng tốt nghiệp cho học sinh. Thực hiện
                            các báo cáo đào tạo theo yêu cầu của cấp trên.
                        </p>
                        <p style="text-align: justify">
                            7. Tổ chức thực hiện các biện pháp dạy và học tích
                            cực, tổ chức hội thi, phân công dự giảng, bình
                            giảng. Xây dựng kế hoạch, thực hiện thẩm định làm
                            các thủ tục cần thiết để biên soạn giáo trình, giáo
                            án, kế hoạch bài giảng. Tổ chức, thực hiện các hoạt
                            động bồi dưỡng sư phạm, chuyên môn cho giáo viên.
                        </p>
                        <p style="text-align: justify">
                            8. Xây dựng kế hoạch, thực hiện công tác nghiên cứu
                            khoa học, phát huy sáng kiến cải tiến phục vụ ngành
                            nghề. Tổ chức các hội nghị, hội thảo khoa học và báo
                            cáo các thông tin khoa học mới trong nước và quốc tế
                            cho cán bộ giáo viên, học sinh trong trường. Tổ chức
                            thông qua đề cương, nghiệm thu đề tài, sáng kiến cải
                            tiến đúng tiến độ. Duy trì sinh hoạt khoa học, sinh
                            hoạt chuyên môn hàng tháng theo chủ đề. Xuất bản,
                            phát hành các thông tin tư liệu khoa học, kỷ yếu
                            khoa học, tập san trong trường.
                        </p>
                        <p style="text-align: justify">
                            9. Phổ biến, hướng dẫn việc thực hiện quy chế, quy
                            định đối với giảng viên, giáo viên, học sinh những
                            vấn đề liên quan đến công tác đào tạo. Lắng nghe ý
                            kiến đề xuất của giáo viên và học sinh để tự hoàn
                            thiện mọi hoạt động của phòng.
                        </p>
                        <p style="text-align: justify">
                            10. Phối hợp với các phòng chức năng trong việc thực
                            hiện các chế độ chính sách, quy chế, quy định có
                            liên quan đến dạy và học. Xây dựng định mức giờ
                            giảng của giáo viên theo quy định, trình Hiệu trưởng
                            phê duyệt ngay từ đầu năm học. Phối hợp với các
                            khoa, bộ môn và tổ Kế toán giải quyết kịp thời các
                            chế độ của giáo viên (chế độ giảng vượt giờ, tuyển
                            sinh……), thanh toán giờ mời giảng đối với các giáo
                            viên thỉnh giảng
                        </p>
                        <p style="text-align: justify">
                            11. Phòng đào tạo chủ trì, phối hợp các Khoa, Bộ môn
                            xây dựng kế hoạch mời giảng của các Khoa, bộ môn.
                            Các khoa, Bộ môn xây dựng, đề xuất và Phòng Đào tạo
                            tổng hợp lập kế hoạch mời giảng cụ thể từng môn học
                            cho toàn trường, trình Hiệu trưởng ký duyệt ngay từ
                            đầu năm học. Hoàn chỉnh hồ sơ và trình ký duyệt danh
                            sách giáo viên kiêm nhiệm, thỉnh giảng
                        </p>
                        <p style="text-align: justify">
                            12. Chủ động nghiên cứu, đề xuất phối hợp mở rộng
                            quan hệ hợp tác với các đơn vị (các trường, các tổ
                            chức chính trị xã hội, kinh tế, văn hóa, khoa học kỹ
                            thuật ...), tranh thủ sự hỗ trợ về các nguồn lực,
                            tăng cường kết hợp đào tạo, nghiên cứu khoa học,
                            tiếp thu những thông tin công nghệ mới, nâng cao
                            trình độ về mọi mặt cho cán bộ, giáo viên và học
                            sinh trong toàn trường.
                        </p>
                        <p style="text-align: justify">
                            13. Chịu trách nhiệm quản lý tài sản, thiết bị, lưu
                            trữ hồ sơ, sổ sách trong phạm vi phụ trách. Duy trì
                            lịch giao ban hàng tháng.
                        </p>
                        <p style="text-align: justify">
                            <strong>III/ TỔ CHỨC:</strong>
                        </p>
                        <p style="text-align: justify">
                            <em>1. Các bộ phận:</em>
                        </p>
                        <p style="text-align: justify">
                            1.1. Kế hoạch đào tạo, Quản lý đào tạo, công tác
                            tuyển sinh:
                        </p>
                        <p style="text-align: justify">
                            1.2. Giáo vụ - Giáo tài
                        </p>
                        <p style="text-align: justify">
                            1.3. Nghiên cứu khoa học - Hợp tác Quốc tế.
                        </p>
                        <p style="text-align: justify">
                            1.4. Giám sát, thanh tra, kiểm tra
                        </p>
                        <p style="text-align: justify">
                            <em>2. Lãnh đạo:</em> Trưởng phòng và 1-2 Phó phòng
                        </p>
                        <p style="text-align: justify">
                            <strong
                                >IV/ QUYỀN HẠN CỦA TRƯỞNG PHÒNG ĐÀO TẠO:</strong
                            >
                        </p>
                        <p style="text-align: justify">
                            Hiệu trưởng ủy nhiệm cho Trưởng Phòng Đào tạo tham
                            dự &nbsp;họp giao ban với các phòng, khoa, tổ bộ
                            môn, giáo viên chủ nhiệm hàng tuần, tháng, quý, năm
                            và đột xuất theo yêu cầu, đồng thời tham mưu cho
                            Hiệu trưởng về công tác đào tạo trong toàn trường
                        </p>
                        <p style="text-align: justify">
                            Trưởng phòng Đào tạo có trách nhiệm phân công cụ thể
                            nhiệm vụ, quyền hạn từng viên chức trong phòng phù
                            hợp với công việc. Tổ chức, điều hành, thực hiện
                            nhiệm vụ của phòng đạt chất lượng cao nhất và chịu
                            trách nhiệm trước Hiệu trưởng về mọi mặt hoạt động
                            của phòng.
                        </p>
                        <p style="text-align: justify">
                            Chủ trì giao ban phòng hàng ngày và tham dự giao ban
                            với các Khoa, Bộ môn &nbsp;khi cần thiết.
                        </p>
                        <p style="text-align: justify">
                            Dự các buổi giao ban Trường; các hội thảo khoa học.
                            Ghi chép biên bản họp trường về các lĩnh vực chuyên
                            môn đào tạo.
                        </p>
                        <p style="text-align: justify">
                            Bố trí, phân công cán bộ viên chức, giáo viên trong
                            trường để tổ chức thực hiện các kỳ thi hết môn, học
                            kỳ, tốt nghiệp.
                        </p>
                        <p style="text-align: justify">
                            Kiểm tra việc thực hiện kế hoạch, Quy chế chuyên
                            môn. Đánh giá hoạt động chuyên môn của các Khoa, Bộ
                            môn trong trường để trình Hiệu trưởng.
                        </p>
                        <p style="text-align: justify">
                            Nhận xét về tinh thần thái độ trách nhiệm, khả năng
                            công tác của các thành viên trong phòng để trình
                            Hiệu trưởng xem xét, bổ nhiệm, đề bạt, khen thưởng
                            và kỷ luật.
                        </p>
                        <p style="text-align: justify">
                            Tham gia các hội đồng theo qui định của Nhà nước và
                            sự phân công của Hiệu trưởng.
                        </p>
                        <p style="text-align: justify">
                            Ký các giấy tờ văn bản theo quy định và theo sự phân
                            công ủy nhiệm của Hiệu trưởng.
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
