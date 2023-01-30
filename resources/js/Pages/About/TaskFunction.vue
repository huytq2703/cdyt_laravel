<script setup>
import App from "@/Layouts/App.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Listbox from 'primevue/listbox';
import { Link } from "@inertiajs/inertia-vue3";
import MenuSideBar from "./Components/MenuSideBar.vue";

</script>

<template>
  <Head title="Chức năng nhiệm vụ" />
  <App>
      <div class="container mx-auto">
          <div class="grid py-4">
                <div class="col-12 xl:col-9 pr-3">
                    <h3
                        class="border-top bg-title bg-title-right text-2xl font-bold text-primary py-2 border-bottom-1"
                    >
                        CHỨC NĂNG NHIỆM VỤ
                    </h3>
                    <!-- Here content -->
                    <div>
                        <p style="text-align: justify;"><strong>1. Chức năng:</strong></p>
                        <p style="text-align: justify;">1. Trường Cao đẳng Y tế Đắk Lắk có chức năng đào tạo, bồi dưỡng đội ngũ viên chức Y tế có trình độ Cao đẳng và các trình độ thấp hơn.</p>
                        <p style="text-align: justify;">
                            2. Liên kết đào tạo và nghiên cứu khoa học với các trường Đại học, Cao đẳng trong nước và hợp tác quốc tế nhằm đào tạo nguồn nhân lực theo nhiều chuyên ngành có trình độ từ trung cấp, cao đẳng, đại học theo những chuyên ngành cụ thể
                            được Ủy ban nhân dân tỉnh và Bộ Lao động - Thương binh và Xã hội cho phép.
                        </p>
                        <p style="text-align: justify;">3. Nghiên cứu và tư vấn về khoa học sức khỏe; Ứng dụng các tiến bộ khoa học kỹ thuật và khoa học sức khỏe cho sự nghiệp phát triển kinh tế - chính trị - xã hội của địa phương.</p>
                        <p style="text-align: justify;"><strong>2. Nhiệm vụ và quyền hạn &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong></p>
                        <p style="text-align: justify;">Trường Cao đẳng Y tế Đắk Lắk thực hiện nhiệm vụ, quyền hạn theo quy định tại Điều 23 của Luật Giáo dục nghề nghiệp năm 2014 và các quy định sau:</p>
                        <p style="text-align: justify;">1. Tổ chức đào tạo nhân lực Y tế trực tiếp tham gia cho sản xuất, kinh doanh, dịch vụ trình độ cao đẳng, trung cấp, sơ cấp và đào tạo thường xuyên theo quy định hiện hành;</p>
                        <p style="text-align: justify;">2. Tổ chức biên soạn hoặc lựa chọn, phê duyệt và thực hiện các chương trình, giáo trình đào tạo đối với từng ngành, nghề được phép đào tạo theo quy định của Bộ Lao động - Thương binh và Xã hội;</p>
                        <p style="text-align: justify;">3. Xây dựng kế hoạch tuyển sinh, tổ chức tuyển sinh, đào tạo theo quy định của Bộ Lao động - Thương binh và Xã hội;</p>
                        <p style="text-align: justify;">
                            4. Tổ chức các hoạt động đào tạo, kiểm tra, thi, xét công nhận tốt nghiệp và in phôi văn bằng, quản lý, cấp phát, thu hồi, huỷ bỏ bằng tốt nghiệp cao đẳng, trung cấp, chứng chỉ sơ cấp, chứng chỉ đào tạo theo quy định của Bộ Lao động
                            - Thương binh và Xã hội;
                        </p>
                        <p style="text-align: justify;">
                            5. Tuyển dụng, sử dụng viên chức quản lý, quản lý giảng viên, viên chức, người lao động của trường bảo đảm đủ về số lượng, phù hợp với ngành, nghề, quy mô và trình độ đào tạo theo quy định của pháp luật;
                        </p>
                        <p style="text-align: justify;">6. Phối hợp với các doanh nghiệp, tổ chức, cá nhân, gia đình người học trong hoạt động giáo dục nghề nghiệp;</p>
                        <p style="text-align: justify;">
                            7. Thực hiện dân chủ, công khai trong việc thực hiện các nhiệm vụ đào tạo, nghiên cứu, ứng dụng các kết quả nghiên cứu, chuyển giao công nghệ vào thực tiễn sản xuất, kinh doanh, dịch vụ và hoạt động tài chính; Có cơ chế để người học
                            tham gia đánh giá hoạt động đào tạo, giảng viên tham gia đánh giá viên chức quản lý, viên chức và người lao động của nhà trường;
                        </p>
                        <p style="text-align: justify;">8. Quản lý, sử dụng đất đai, cơ sở vật chất, thiết bị và tài sản của nhà trường theo quy định của pháp luật;</p>
                        <p style="text-align: justify;">
                            9. Quyết định thành lập các tổ chức trực thuộc trường theo cơ cấu tổ chức được phê duyệt trong quy chế tổ chức, hoạt động của trường; Quyết định bổ nhiệm, miễn nhiệm, cách chức các chức vụ từ cấp trưởng phòng, khoa, trung tâm và
                            tương đương trở xuống theo quy định;
                        </p>
                        <p style="text-align: justify;">
                            10. Phối hợp với doanh nghiệp, cơ sở sản xuất, kinh doanh, dịch vụ, các bệnh viện, trung tâm,... trong hoạt động đào tạo về lập kế hoạch đào tạo, xây dựng chương trình, giáo trình đào tạo; Tổ chức giảng dạy, hướng dẫn thực hành,
                            thực tập, đánh giá kết quả học tập của người học;
                        </p>
                        <p style="text-align: justify;">
                            11. Liên doanh, liên kết với các tổ chức kinh tế, giáo dục, y tế, nghiên cứu khoa học,... trong nước và nước ngoài theo quy định của pháp luật nhằm nâng cao chất lượng đào tạo, gắn đào tạo với việc làm và thị trường lao động;
                        </p>
                        <p style="text-align: justify;">
                            12. Sử dụng nguồn thu từ các hoạt động đào tạo, khoa học, công nghệ, sản xuất, kinh doanh và dịch vụ để đầu tư xây dựng cơ sở vật chất của trường, chi cho các hoạt động đào tạo và bổ sung nguồn tài chính của trường theo quy định của
                            pháp luật;
                        </p>
                        <p style="text-align: justify;">
                            13. Được Nhà nước giao đất hoặc cho thuê đất, giao hoặc cho thuê cơ sở vật chất; Được hỗ trợ ngân sách khi thực hiện nhiệm vụ Nhà nước giao theo hợp đồng đặt hàng; Được hưởng các chính sách ưu đãi về thuế và tín dụng theo quy định
                            của pháp luật.
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
