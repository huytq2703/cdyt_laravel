<script setup>
import App from "@/Layouts/App.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Listbox from 'primevue/listbox';
import { Link } from "@inertiajs/inertia-vue3";
import MenuSideBar from "./Components/MenuSideBar.vue";

</script>

<template>
  <Head title="Phòng tài chính kế toán" />
  <App>
      <div class="container mx-auto">
          <div class="grid py-4">
                <div class="col-12 xl:col-9 pr-3">
                    <h3
                        class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
                    >
                        PHÒNG TÀI CHÍNH KẾ TOÁN
                    </h3>
                    <!-- Here content -->
                    <div>
                        <p style="text-align: justify;"><strong>I/</strong><strong>&nbsp;VỊ TRÍ - CHỨC NĂNG:</strong></p>
                        <p style="text-align: justify;">
                            Phòng tài chính kế toán là phòng nghiệp vụ chịu sự lãnh đạo trực tiếp của Hiệu trưởng, tham mưu giúp Hiệu trưởng và chịu trách nhiệm trước Hiệu trưởng về thực hiện toàn bộ hoạt động tài chính, kế toán, tài sản của nhà trường.
                        </p>
                        <p style="text-align: justify;"><strong>II/</strong><strong>&nbsp;NHIỆM VỤ:</strong></p>
                        <p style="text-align: justify;">
                            1. Quản lý các nguồn thu, chi của trường theo quy định của tài chính. Lập kế hoạch thu chi; thực hiện các khoản thu chi; lập quyết toán hàng quý, hàng năm đúng theo quy định về chế độ kế toán-tài chính nhà nước. Tham mưu cho Ban
                            giám hiệu về lĩnh vực kinh phí, bảo bản, mua sắm tài sản cơ quan.
                        </p>
                        <p style="text-align: justify;">
                            2. Chịu trách nhiệm xây dựng đề án theo tinh thần Nghị định 43 của Chính phủ và Quy chế chi tiêu nội bộ trình duyệt qua cấp thẩm quyền và thực hiện. Hàng năm chịu trách nhiệm sửa đổi bổ sung Quy chế chi tiêu nội bộ thông qua Hội
                            Nghị cán bộ công chức nhà trường. Triển khai hướng dẫn các Khoa, phòng, bộ môn thực hiện những văn bản liên quan đến tài chính.
                        </p>
                        <p style="text-align: justify;">3. Xây dựng các định mức kinh phí cho các công việc trong trường.</p>
                        <p style="text-align: justify;">4. Chịu trách nhiệm tham mưu cho Ban giám hiệu về tất cả các loại hợp đồng của nhà trường;</p>
                        <p style="text-align: justify;">5. Cùng với phòng hành chính quản trị xây dựng chế độ quản lí về việc sử dụng tài sản, vật tư, trang thiết bị trong trường ngăn ngừa lãng phí.</p>
                        <p style="text-align: justify;">6. Tổng hợp ngân sách làm báo cáo quyết toán lên cấp trên đúng theo hướng dẫn.</p>
                        <p style="text-align: justify;">7. Phối hợp tổ chức kiểm tra các khoản thu và chi, các khoản tiền vốn, sử dụng vật tư, thiết bị và tài sản của các bộ phận trong toàn trường.</p>
                        <p style="text-align: justify;">8. Phối hợp với Phòng Tổ chức - Hành chính, tổ chức thực hiện việc kiểm kê định kỳ, thanh lý, xử lý tài sản trong trường theo đúng chế độ qui định của Nhà nước.</p>
                        <p style="text-align: justify;">9. Chấp hành nghiêm những quy định về quản lý tài chính, nghiên cứu đề xuất ý kiến với cơ quan và cấp trên về cơ chế quản lí tài chính hợp lý.</p>
                        <p style="text-align: justify;">10. Thực hiện tốt vai trò thủ quỹ, kế toán tài sản và một số nhiệm vụ khác do Hiệu trưởng giao.</p>
                        <p style="text-align: justify;">
                            <strong><em>2.1. Lập dự toán:</em></strong>
                        </p>
                        <p style="text-align: justify;">- Đầu mối phối hợp với các đơn vị liên quan xây dựng kế hoạch ngân sách hằng năm;</p>
                        <p style="text-align: justify;">- Lập phương án phân bổ ngân sách chi tiết cho từng nhiệm vụ, từng đơn vị trong trường;</p>
                        <p style="text-align: justify;">- Lập dự toán chi tiết chi ngân sách theo nhóm, mục nguồn kinh phí;</p>
                        <p style="text-align: justify;">- Xây dựng phương án tăng nguồn thu cho trường trình Hiệu trưởng phê duyệt và quyết định.</p>
                        <p style="text-align: justify;">
                            <strong><em>2.2. &nbsp;Quản lý tài chính:</em></strong>
                        </p>
                        <p style="text-align: justify;">- Lập dự trù quỹ tiền lương;</p>
                        <p style="text-align: justify;">
                            - Quản lý và sử dụng thống nhất ngân sách của Nhà trường; Thực hiện chế độ báo cáo tổng kết công tác tài chính, báo cáo quyết toán tài chính, báo cáo tình hình tăng giảm, khấu hao tài sản cố định, báo cáo thuế... theo quy định hiện
                            hành của Nhà nước;
                        </p>
                        <p style="text-align: justify;">- Tổ chức hệ thống sổ sách kế toán và bộ máy kế toán theo quy định của chế độ kế toán hiện hành.</p>
                        <p style="text-align: justify;">- Hướng dẫn, thẩm định, kiểm tra giám sát các đơn vị lập dự trù, kế hoạch chi ngân sách và thực hiện kế hoạch theo đúng quy định.</p>
                        <p style="text-align: justify;">
                            - Có trách nhiệm tham gia xây dựng các loại hợp đồng kinh tế, hợp đồng liên kết đào tạo để tham mưu cho Hiệu trưởng các điều khoản liên quan đến thủ tục tài chính được quy định trong các loại hợp đồng; Theo dõi, các khoản thu, chi
                            để đảm bảo thực hiện đúng các điều khoản về tài chính đã được quy định trong hợp đồng, nếu thực hiện chưa đúng thì kịp thời thông báo với đơn vị đầu mối quản lý để có phương án giải quyết.
                        </p>
                        <p style="text-align: justify;">
                            <strong><em>2.3. Thanh, quyết toán, giám sát thu chi:</em></strong>
                        </p>
                        <p style="text-align: justify;">
                            - Kiểm tra, giám sát các khoản thu, chi tài chính, các nghĩa vụ thu, nộp, thanh toán; &nbsp;Kiểm tra việc quản lý, sử dụng tài sản và nguồn hình thành tài sản; Phát hiện và ngăn ngừa các hành vi vi phạm pháp luật về tài chính, kế
                            toán.
                        </p>
                        <p style="text-align: justify;">
                            - Hướng dẫn, chỉ đạo nghiệp vụ về công tác thanh, quyết toán các khoản thu chi ở các đơn vị trong trường. Hướng dẫn và thực hiện đúng quy định việc giải ngân các nguồn vốn của trường (trong đó có các dự án).
                        </p>
                        <p style="text-align: justify;">
                            - Thực hiện chế độ thanh toán lương, BHXH, BHYT, phụ cấp, thù lao giảng dạy, phục vụ giảng dạy và các chế độ khác cho cán bộ, viên chức và người lao động đúng quy định; Thực hiện quy định về thuế thu nhập và thanh toán qua tài
                            khoản.
                        </p>
                        <p style="text-align: justify;">- Giám sát thực hiện kế hoạch thu học phí, kinh phí hỗ trợ đào tạo;</p>
                        <p style="text-align: justify;">
                            - Theo dõi, quản lý giá trị tài sản cố định và phối hợp với Phòng Tổ chức - Hành chính cùng các đơn vị có liên quan tổ chức thanh lý tài sản hết khấu hao, hư hỏng không sử dụng được hoặc không còn nhu cầu sử dụng.
                        </p>
                        <p style="text-align: justify;">- Tham gia nghiệm thu và nhập vào sổ tài sản của Nhà trường trước khi đưa vào sử dụng tài sản, thiết bị mới từ các nguồn khác nhau.</p>
                        <p style="text-align: justify;">- Tổ chức lưu trữ các văn bản tài chính, chứng từ gốc sau khi thanh quyết toán theo quy định của Nhà nước.</p>
                        <p style="text-align: justify;"><strong>III/</strong><strong>&nbsp;TỔ CHỨC:</strong></p>
                        <p style="text-align: justify;">
                            <strong><em>3</em></strong><strong><em>.1. Các bộ phận:</em></strong>
                        </p>
                        <p style="text-align: justify;">a. &nbsp; &nbsp; &nbsp; Thu chi ngân sách</p>
                        <p style="text-align: justify;">b. &nbsp; &nbsp; &nbsp; Theo dõi thu chi học phí, Theo dõi tài sản</p>
                        <p style="text-align: justify;">c. &nbsp; &nbsp; &nbsp; Thủ quỹ</p>
                        <p style="text-align: justify;">
                            <strong><em>3</em></strong><strong><em>.2. Lãnh đạo:&nbsp;</em></strong>Trưởng phòng và 1 -2 Phó trưởng phòng
                        </p>
                        <p style="text-align: justify;"><strong>IV/</strong><strong>&nbsp;QUYỀN HẠN CỦA TRƯỞNG PHÒNG:</strong></p>
                        <p style="text-align: justify;">Chủ trì giao ban phòng và dự giao ban trường;</p>
                        <p style="text-align: justify;">Bố trí nhân lực trong phòng cho phù &nbsp;hợp với công việc;</p>
                        <p style="text-align: justify;">Kiểm tra theo Pháp lệnh kế toán thống kê và Điều lệ tổ chức kế toán Nhà nước để báo cáo Hiệu trưởng và cơ quan tài chính cấp trên;</p>
                        <p style="text-align: justify;">Trong trường hợp thu, chi không đúng chế độ thì được quyền báo cáo Hiệu trưởng để báo cáo cơ quan tài chính cấp trên theo quy định hiện hành;</p>
                        <p style="text-align: justify;">Nhận xét các thành viên trong phòng về năng lực, khả năng chuyên môn, tinh thần phục vụ, trình Hiệu trưởng xét khen thưởng, đề bạt hoặc kỉ luật;</p>
                        <p style="text-align: justify;">Được tham gia các hội đồng theo quy định của Nhà nước và sự phân công của Hiệu trưởng.</p>
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
