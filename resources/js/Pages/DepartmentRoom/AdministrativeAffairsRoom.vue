<script setup>
import App from "@/Layouts/App.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Listbox from "primevue/listbox";
import { Link } from "@inertiajs/inertia-vue3";
import MenuSideBar from "./Components/MenuSideBar.vue";
</script>

<template>
    <Head title="Phòng tổ chức hành chính" />
    <App>
        <div class="container mx-auto">
            <div class="grid py-4">
                <div class="col-12 xl:col-9 pr-3">
                    <h3
                        class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
                    >
                        PHÒNG TỔ CHỨC HÀNH CHÍNH
                    </h3>
                    <!-- Here content -->
                    <div>
                        <p style="text-align: justify">
                            <strong>I/ VỊ TRÍ, CHỨC NĂNG:</strong>
                        </p>
                        <p style="text-align: justify">
                            Phòng Tổ chức - Hành chính có chức năng tham mưu,
                            giúp Hiệu trưởng về kiện toàn tổ chức bộ máy, công
                            tác nhân sự, quản lý và thực hiện các chế độ chính
                            sách đối với cán bộ, viên chức của nhà trường. Ngoài
                            ra còn có chức năng quản lý hành chính, công nghệ
                            thông tin, Vật tư trang thiết bị của Trường.
                        </p>
                        <p style="text-align: justify">
                            <strong>II/ NHIỆM VỤ:</strong>
                        </p>
                        <p style="text-align: justify">
                            1. Đề xuất các phương án xây dựng, củng cố và kiện
                            toàn bộ máy của Trường: Cơ cấu tổ chức, biên chế cán
                            bộ, chức năng nhiệm vụ của các đơn vị, thành lập,
                            giải thể, sáp nhập các đơn vị.
                        </p>
                        <p style="text-align: justify">
                            2. Lập dự án quy hoạch, kế hoạch về xây dựng, đào
                            tạo, bồi dưỡng và bố trí đội ngũ cán bộ, công nhân
                            viên chức của Trường trình Hiệu trưởng xem xét,
                            quyết định.
                        </p>
                        <p style="text-align: justify">
                            3. Xây dựng kế hoạch biên chế, kế hoạch tuyển dụng
                            cán bộ, soạn thảo hợp đồng lao động dài hạn và ngắn
                            hạn trình Hiệu trưởng xem xét, quyết định.
                        </p>
                        <p style="text-align: justify">
                            4. Soạn thảo các văn bản về tổ chức cán bộ trình
                            Hiệu trưởng ký duyệt.
                        </p>
                        <p style="text-align: justify">
                            5. Thực hiện công tác quản lý cán bộ, công chức theo
                            sự phân cấp của Hiệu trưởng; quản lý hồ sơ, lý lịch
                            cán bộ; làm thủ tục về nhân sự cử đi học tập, công
                            tác ở trong và ngoài nước, tiếp nhận cán bộ, công
                            chức đi học tập, công tác và tiếp tục làm việc tại
                            Trường.
                        </p>
                        <p style="text-align: justify">
                            6. Lập hồ sơ giải quyết các chế độ chính sách về
                            nâng bậc lương, khen thưởng, kỷ luật, hưu trí, mất
                            sức, cho thôi việc và các chế độ khác.
                        </p>
                        <p style="text-align: justify">
                            7. Phối hợp với các đơn vị thực hiện các thủ tục xét
                            đề nghị thi nâng ngạch viên chức, phong các danh
                            hiệu nhà giáo nhân dân, nhà giáo ưu tú, tặng thưởng
                            huân, huy chương và các danh hiệu khác cho các cá
                            nhân và đơn vị trong trường.
                        </p>
                        <p style="text-align: justify">
                            8. Phối hợp với các đơn vị tổ chức trong trường theo
                            dõi, kiểm tra và đề xuất biện pháp xử lý đối với cán
                            bộ, công chức&nbsp;viên chức&nbsp;liên quan đến kỷ
                            luật lao động, an toàn lao động, bảo hiểm y tế và
                            bảo hiểm xã hội.
                        </p>
                        <p style="text-align: justify">
                            9. Phối hợp với các đơn vị thẩm tra, xem xét, đề
                            xuất biện pháp giải quyết đơn thư khiếu nại, tố cáo
                            có liên quan đến cán bộ công nhân viên chức của
                            Trường.
                        </p>
                        <p style="text-align: justify">
                            <strong>III/ TỔ CHỨC:</strong>
                        </p>
                        <p style="text-align: justify">
                            <strong><em>1. Các bộ phận:</em></strong>
                        </p>
                        <p style="text-align: justify">1.1. Tổ chức cán bộ</p>
                        <p style="text-align: justify">
                            1.2. Hành chính - Quản trị &nbsp;- Công nghệ thông
                            tin
                        </p>
                        <p style="text-align: justify">
                            1.3. Vật tư - Thiết bị
                        </p>
                        <p style="text-align: justify">
                            <strong>2. Lãnh đạo:</strong> Trưởng phòng và 1-2
                            Phó phòng
                        </p>
                        <p style="text-align: justify">
                            <strong
                                >IV/ QUYỀN HẠN CỦA TRƯỞNG PHÒNG TỔ CHỨC:</strong
                            >
                        </p>
                        <p style="text-align: justify">
                            Chủ trì giao ban phòng và&nbsp;dự giao ban với các
                            Khoa, Bộ môn khi cần thiết
                        </p>
                        <p style="text-align: justify">
                            Đề xuất với Hiệu trưởng về tuyển dụng, thuyên
                            chuyển, sắp xếp, bố trí, điều động, bổ nhiệm, cử đi
                            đào tạo và khen thưởng kỉ luật các thành viên trong
                            nhà trường.
                        </p>
                        <p style="text-align: justify">
                            Đề xuất việc nhận xét các thành viên trong trường về
                            chấp hành chính sách, luật pháp, khả năng quản lí,
                            tinh thần trách nhiệm, thái độ phục vụ.
                        </p>
                        <p style="text-align: justify">
                            Điều động, bố trí phương tiện vận chuyển trong và
                            ngoài trường.
                        </p>
                        <p style="text-align: justify">
                            Kiểm tra các đơn vị trong toàn trường về quản lí và
                            sử dụng vật tư thiết bị theo quy định;
                        </p>
                        <p style="text-align: justify">
                            Bố trí nhân lực, phân công nhiệm vụ trong phòng cho
                            phù hợp với công việc. Nhận xét các thành viên trong
                            phòng về nhân lực, khả năng chuyên môn, tinh thần
                            phục vụ để trình Hiệu trưởng xét khen thưởng, đề
                            bạt, hoặc kỉ luật
                        </p>
                        <p style="text-align: justify">
                            Được tham gia các hội đồng theo quy định của Nhà
                            nước và sự phân công của Hiệu trưởng
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
.nav-link {
    color: white;
    padding: 7px;
    &:hover {
        background-color: #b83234;
        font-weight: bold;
    }
}
.nav-link {
    color: white;
    font-size: 1rem;
    padding: 0.5rem;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

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
